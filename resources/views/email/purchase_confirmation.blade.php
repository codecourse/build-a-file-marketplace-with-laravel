<x-mail::message>
# Thanks for your purchase

You've bought *{{ $sale->product->title }}*. You can now access and download the files for this product below.

<x-mail::button :url="''">
Access files
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
