<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-none md:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <a href="{{ route('products.edit', $product) }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-44 flex items-center justify-center">
                    <div class="text-gray-900 text-lg">
                        {{ $product->title }}
                    </div>
                </a>
            @endforeach

            <a href="{{ route('products.create') }}" class="bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg h-44 flex items-center justify-center">+ Create a product</a>
        </div>
    </div>
</x-app-layout>
