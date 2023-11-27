<x-guest-layout>
    <div class="text-center space-y-6">
        <h1 class="text-lg">Thanks for purchasing <em>{{ $product->title }}</em> from <a href="{{ route('subdomain.home', $product->user->subdomain) }}" class="text-indigo-500">{{ $product->user->name }}</a></h1>

        <p>We've sent a download link to your email address</p>
    </div>
</x-guest-layout>
