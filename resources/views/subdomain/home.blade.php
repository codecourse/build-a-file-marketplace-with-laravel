<x-guest-layout>
    <div class="text-center space-y-4">
        <h1 class="text-lg">{{ Str::possessive($user->name) }} marketplace</h1>

        @if ($products->count())
            <ul>
                @foreach ($products as $product)
                    <li><a href="{{ route('subdomain.products.show', [$user->subdomain, $product->slug]) }}" class="text-indigo-500">{{ $product->title }}</a></li>
                @endforeach
            </ul>
        @else
            <p>{{ $user->name }} doesn't have any products for sale yet.</p>
        @endif
    </div>
</x-guest-layout>
