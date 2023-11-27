<form wire:submit.prevent="submit" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 md:p-8 space-y-12">
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Product information') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __("Add the basic details for your product that'll be visible to customers.") }}
            </p>
        </header>

        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input wire:model.lazy="state.title" id="title" class="block mt-1 w-full" type="text" name="title" />
            <x-input-error :messages="$errors->get('state.title')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="slug" :value="__('Slug')" />
            <x-text-input wire:model.lazy="state.slug" id="slug" class="block mt-1 w-full" type="text" name="slug" />
            <x-input-error :messages="$errors->get('state.slug')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-textarea wire:model.lazy="state.description" id="description" class="block mt-1 w-full" rows="4" type="text" name="description" />
            <x-input-error :messages="$errors->get('state.description')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input wire:model.lazy="state.price" id="price" class="block mt-1 w-full" type="text" name="price" />
            <x-input-error :messages="$errors->get('state.price')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="live" class="inline-flex items-center">
                <input wire:model.lazy="state.live" id="live" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="live">
                <span class="ml-2 text-sm text-gray-600">Live</span>
            </label>
        </div>
    </section>

    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Add files') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __("Attach files that your customers will be able to download.") }}
            </p>
        </header>

        <div>
            <input type="file" wire:model="uploads" multiple>
        </div>

        <ul>
            @foreach ($files as $file)
                <li>
                    {{ $file->getClientOriginalName() }}
                    <button type="button" class="text-indigo-500" wire:click="removeFile('{{ $file->getFilename() }}')">Remove</button>
                </li>
            @endforeach
        </ul>
    </section>

    <div>
        <x-primary-button>
            {{ __('Create product') }}
        </x-primary-button>
    </div>
</form>
