<?php

namespace App\Actions\Jetstream;

use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Contracts\DeletesTeams;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * The team deleter implementation.
     *
     * @var \Laravel\Jetstream\Contracts\DeletesTeams
     */
    protected $deletesTeams;

    /**
     * Create a new action instance.
     *
     * @param  \Laravel\Jetstream\Contracts\DeletesTeams  $deletesTeams
     * @return void
     */
    public function __construct(DeletesTeams $deletesTeams)
    {
        $this->deletesTeams = $deletesTeams;
    }

    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        DB::transaction(function () use ($user) {
            $this->deletePodcasts( $user );
            $this->deleteTeams($user);
            $user->deleteProfilePhoto();
            $user->tokens->each->delete();
            $user->delete();
        });
    }

    /**
     * Delete the teams and team associations attached to the user.
     *
     * @param  mixed  $user
     * @return void
     */
    protected function deleteTeams($user)
    {
        $user->teams()->detach();

        $user->ownedTeams->each(function ($team) {
            $this->deletesTeams->delete($team);
        });
    }

    /**
     * Delete the podcasts and episodes associated to the user's owned Teams.
     *
     * @param mixed $user
     * @return void
     */
    protected function deletePodcasts($user)
    {

        foreach ($user->ownedTeams as $team) {
            foreach ($team->podcasts as $podcast) {

                foreach ($podcast->episodes as $episode) {
                    // Delete episode
                    \Illuminate\Support\Facades\Storage::disk('local')->delete($episode->file_name);
                    $episode->delete();
                }

                // Delete podcast
                \Illuminate\Support\Facades\Storage::disk('local')->delete($podcast->thumbnail);
                $podcast->delete();
            }
        }

    }
}
