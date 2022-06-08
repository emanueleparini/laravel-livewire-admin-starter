<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Videos') }}
    </h2>
</x-slot>

<div class="max-w-6xl mx-auto">
    <div class="m-2 p-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Id</th>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Video</th>
                            <th scope="col" class="relative px-6 py-3"></th>
                        </tr>
                        <tr>
                            <th scope="col" class="px-6 py-3"></th>
                            <th scope="col" class="px-6 py-3">
                                <input type="text" wire:model="search" placeholder="Filter" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </th>
                            <th scope="col" class="px-6 py-3"></th>
                            <th scope="col" class="px-6 py-3">
                                <x-jet-button class="float-right" wire:click="showVideoModal">Upload</x-jet-button>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($videos as $video)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ $video->id }}
                                </th>
                                <td class="px-6 py-4">{{ $video->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($video->video_url)
                                        <a href="{{ $video->video_url }}" target="_blank"><img class="w-8 h-8" src="/storage/app/play.png" /></a>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <x-jet-button class="bg-red-400 hover:bg-red-600" wire:click="showDeleteVideoModal({{ $video->id }})">Delete</x-jet-button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="m-2 p-2">{{ $videos->links() }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <x-jet-dialog-modal wire:model="showVideoModal">
            <x-slot name="title">Upload Video</x-slot>
            <x-slot name="content">
                <div class="space-y-8 divide-y divide-gray-200 mt-10">
                    <form enctype="multipart/form-data">
                        <div class="sm:col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700"> Video Name </label>
                            <div class="mt-1">
                                <input type="text" id="name" wire:model.lazy="name" name="name" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('name') <span class="tex-red-400">{{ $message }}</span> @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700"> Video </label>
                            <div class="mt-1">
                                <input type="file" id="video_url" wire:model="video_url" name="video_url" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('video_url') <span class="tex-red-400">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-button class="m-2 p-2" wire:click="closeModal">Cancel</x-jet-button>
                <x-jet-button class="m-2 p-2" wire:click="saveVideo">Save</x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
        <x-jet-dialog-modal wire:model="deleteVideoModal">
            <x-slot name="title">Confirm Delete</x-slot>
            <x-slot name="content">
                Are you sure to delete this Video?
            </x-slot>
            <x-slot name="footer">
                <x-jet-button class="m-2 p-2" wire:click="closeModal">Cancel</x-jet-button>
                <x-jet-button class="m-2 p-2 bg-red-400 hover:bg-red-600" wire:click="deleteVideo">Delete</x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </div>
</div>
