<x-guest-layout>
    <form class="text-center space-y-6" method="post" action="{{ route('subdomain.products.checkout', [$user->subdomain, $product->slug]) }}">
        <h1 class="text-lg">{{ $product->title }} by <a href="{{ route('subdomain.home', $user->subdomain) }}" class="text-indigo-500">{{ $user->name }}</a></h1>

        <p>{{ $product->description }}</p>

        <x-primary-button class="w-full justify-center">
            Buy now for {{ $product->price }}
        </x-primary-button>

        @csrf
    </form>
</x-guest-layout>
