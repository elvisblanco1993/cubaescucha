<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <form method="POST" wire:submit.prevent="save">
        @csrf
        <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-3">
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Name
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" wire:model.defer="name" id="name" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                        </div>
                        @error('name')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">
                        Description
                    </label>
                    <div class="mt-1">
                        <textarea id="description" wire:model.defer="description" rows="10"></textarea>
                    </div>
                    @error('description')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">
                        Brief description for your podcast. Markdown is supported.
                    </p>
                </div>

                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-700">
                        {{ __('Tags') }}
                    </label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <input type="text" wire:model.defer="tags" id="tags" placeholder="entertainment, sports, music..." class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                    </div>
                    @error('tags')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">
                    Cover photo
                    </label>
                    <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span>Upload a file</span>
                                    <input id="file-upload" wire:model.defer="thumbnail" type="file" accept="image/x-png,image/webp,image/jpeg" class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">
                                PNG, JPG, WEBP up to 4MB.
                            </p>
                        </div>
                    </div>
                    <small class="block text-gray-600">
                        {{ __('The cover photo must be squared, with a minimum size must be at least 500x500px, up to 1000x1000px.') }}
                    </small>
                    @error('thumbnail')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <x-jet-button>
                    <div wire:loading>
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                    {{__('Save changes')}}
                </x-jet-button>
            </div>
        </div>
    </form>
</div>
