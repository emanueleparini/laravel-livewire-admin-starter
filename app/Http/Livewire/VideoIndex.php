<?php

namespace App\Http\Livewire;

use App\Models\Videos;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class VideoIndex extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $showVideoModal = false;
    public $deleteVideoModal = false;

    public $name, $video_url;
    public $isDeleteMode = false;
    public $video;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function showVideoModal()
    {
        $this->reset();
        $this->showVideoModal = true;
    }

    public function deleteVideoModal()
    {
        $this->reset();
        $this->deleteVideoModal = true;
    }

    public function saveVideo()
    {
        $this->validate([
            'name' => 'required',
            'video_url' => 'required|mimes:mp4|max:10240'
        ]);

        $video_im = $this->video_url->store('public/markers');

        Videos::create([
            'name' => $this->name,
            'video_url' => $video_im
        ]);

        $this->reset();
    }

    public function showDeleteVideoModal($id)
    {
        $this->video = Videos::findOrFail($id);
        $this->isDeleteMode = true;
        $this->deleteVideoModal = true;
    }

    public function deleteVideo()
    {
        Storage::delete($this->video->video_url);
        $this->video->delete();

        $this->reset();
    }

    public function closeModal()
    {
        $this->showVideoModal = false;
        $this->deleteVideoModal = false;
    }

    public function render()
    {
        return view('livewire.video-index', [
            'videos' => Videos::where('name', 'like', '%'.$this->search.'%')->paginate(10),
        ]);
    }
}
