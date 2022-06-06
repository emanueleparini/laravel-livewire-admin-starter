<div class="max-w-6xl mx-auto">
    <div class="flex justify-end m-2 p-2">
        <x-jet-button wire:click="showMarkerModal">Create</x-jet-button>
    </div>
    <div class="m-2 p-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Id</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Image</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Video</th>
                            <th scope="col" class="relative px-6 py-3">Edit</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($markers as $marker)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $marker->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $marker->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img class="w-8 h-8 rounded-full" src="{{ Storage::url($marker->image) }}" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $marker->video_url }}</td>
                                <td class="px-6 py-4 text-right text-sm">
                                    <x-jet-button wire:click="showEditMarkerModal({{ $marker->id }})">Edit</x-jet-button>
                                    Delete
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="m-2 p-2">Pagination</div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <x-jet-dialog-modal wire:model="showMarkerModal">
            <x-slot name="title">Create Marker</x-slot>
            <x-slot name="content">
                <div class="space-y-8 divide-y divide-gray-200 mt-10">
                    <form enctype="multipart/form-data">
                        <div class="sm:col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700"> Marker Name </label>
                            <div class="mt-1">
                                <input type="text" id="name" wire:model.lazy="name" name="name" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('name') <span class="tex-red-400">{{ $message }}</span> @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700"> Marker Image </label>
                            @if($newImage)
                                <img src="{{ $newImage->temporaryUrl() }}">
                            @endif
                            <div class="mt-1">
                                <input type="file" id="image" wire:model="newImage" name="image" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('newImage') <span class="tex-red-400">{{ $message }}</span> @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700"> Video Url </label>
                            <div class="mt-1">
                                <input type="text" id="video_url" wire:model.lazy="video_url" name="video_url" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('video_url') <span class="tex-red-400">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-button wire:click="saveMarker">Save</x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </div>
</div>
