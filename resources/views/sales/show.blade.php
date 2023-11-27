<x-guest-layout>
    <div class="text-center space-y-6">
        <p>Thanks for purchasing {{ $sale->product->title }} from {{ $sale->product->user->name }}</p>

        <ul>
            @foreach ($sale->product->files as $file)
                <li>
                    <a href="{{ URL::temporarySignedRoute('files.show', now()->addMinutes(10), $file) }}" class="text-indigo-500">{{ $file->filename }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</x-guest-layout>
