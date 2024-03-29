<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use App\Notifications\NotifyAdminOfNewUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Log;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) {
                $this->createTeam($user);
                $user->currentTeam->createAsStripeCustomer([
                    'name' => $user->currentTeam->name,
                    'email' => $user->email,
                ]);
                $user->currentTeam->update([
                    'trial_ends_at' => now()->addDays(14),
                ]);

                // Notify administrator about new user via Slack
                if ($user->id > 1) {
                    try {
                        $admin = User::findOrFail(1);
                        $admin->notify(new NotifyAdminOfNewUsers("New User Created!"));
                    } catch (\Throwable $th) {
                        Log::error($th);
                    }
                }
            });
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
