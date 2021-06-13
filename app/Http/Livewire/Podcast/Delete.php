<?php

namespace App\Http\Livewire\Podcast;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Delete extends Component
{
    public $confirmDeleteDialog = false;
    public $podcast;

    public function deletePodcast()
    {
        foreach ($this->podcast->episodes as $episode) {
            // Delete episode files
            Storage::disk('s3')->delete($episode->file_name);

            // Delete episodes from DB
            $episode->delete();
        }

        // Delete podcast thumbnail image
        Storage::disk('s3')->delete($this->podcast->thumbnail);

        // Delete podcast
        $this->podcast->delete();

        session()->flash('success', 'The podcast ' . $this->podcast->name . ', and all its content has been successfully deleted from our platform.');

        return redirect(route('podcasts'));
    }
    public function render()
    {
        return view('livewire.podcast.delete');
    }
}
