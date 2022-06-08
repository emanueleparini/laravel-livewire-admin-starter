<?php

namespace App\Http\Livewire;

use App\Models\Markers;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MarkerIndex extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $showMarkerModal = false;
    public $deleteMarkerModal = false;

    public $name, $newImage, $video_url;
    public $oldImage;
    public $isEditMode = false;
    public $isDeleteMode = false;
    public $marker;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function showMarkerModal()
    {
        $this->reset();
        $this->showMarkerModal = true;
    }

    public function deleteMarkerModal()
    {
        $this->reset();
        $this->deleteMarkerModal = true;
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
        $this->marker = Markers::findOrFail($id);
        $this->name = $this->marker->name;
        $this->video_url = $this->marker->video_url;
        $this->oldImage = $this->marker->image;
        $this->isEditMode = true;
        $this->showMarkerModal = true;
    }

    public function updateMarker()
    {
        $this->validate([
            'name' => 'required',
            'video_url' => 'required'
        ]);

        $image = $this->marker->image;
        if($this->newImage){
            $image = $this->newImage->store('public/markers');
        }

        $this->marker->update([
            'name' => $this->name,
            'image' => $image,
            'video_url' => $this->video_url
        ]);

        $this->reset();
    }

    public function showDeleteMarkerModal($id)
    {
        $this->marker = Markers::findOrFail($id);
        $this->isDeleteMode = true;
        $this->deleteMarkerModal = true;
    }

    public function deleteMarker()
    {
        Storage::delete($this->marker->image);
        $this->marker->delete();

        $this->reset();
    }

    public function closeModal()
    {
        $this->showMarkerModal = false;
        $this->deleteMarkerModal = false;
    }

    public function render()
    {
        return view('livewire.marker-index', [
            'markers' => Markers::where('name', 'like', '%'.$this->search.'%')->paginate(10),
        ]);
    }
}
