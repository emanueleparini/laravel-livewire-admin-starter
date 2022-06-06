<?php

namespace App\Http\Livewire;

use App\Models\Markers;
use Livewire\Component;
use Livewire\WithFileUploads;

class MarkerIndex extends Component
{
    use WithFileUploads;

    public $showMarkerModal = false;

    public $name, $newImage, $video_url;

    public function showMarkerModal()
    {
        $this->showMarkerModal = true;
    }

    public function saveMarker()
    {
        $this->validate([
            'name' => 'required',
            'newImage' => 'image|max:1024',
            'video_url' => 'required'
        ]);

        $image = $this->newImage->store('public/markers');

        Markers::create([
            'name' => $this->name,
            'image' => $image,
            'video_url' => $this->video_url
        ]);

        $this->reset();
    }

    public function showEditMarkerModal($id)
    {
        $marker = Markers::findOrFail($id);
        $this->name = $marker->name;
        $this->video_url = $marker->video_url;
        $this->showMarkerModal = true;
    }

    public function render()
    {
        return view('livewire.marker-index', [
            'markers' => Markers::all()
        ]);
    }
}
