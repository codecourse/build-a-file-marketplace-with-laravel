<?php

namespace App\Http\Livewire;

use App\Models\File;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProduct extends Component
{
    use WithFileUploads;

    public $uploads = [];

    public $files = [];

    public $state = [
        'title' => null,
        'slug' => null,
        'description' => null,
        'price' => '0.00',
        'live' => false,
    ];

    protected $rules = [
        'state.title' => 'required|max:255',
        'state.slug' => 'required|max:255|unique:products,slug',
        'state.description' => 'required',
        'state.price' => 'required|decimal:0,2|min:1',
        'state.live' => 'boolean'
    ];

    public function submit()
    {
        $this->validate();

        $product = auth()->user()->products()->create($this->state);

        $files = collect($this->files)->map(function ($file) {
            return File::make([
                'filename' => $file->getClientOriginalName(),
                'path' => $file->store('files')
            ]);
        });

        $product->files()->saveMany($files);

        return redirect()->route('products');
    }

    public function updatedStateTitle($title)
    {
        $this->state['slug'] = Str::slug($title);
    }

    public function updatedUploads($uploads)
    {
        $this->files = array_merge($this->files, $uploads);

        $this->uploads = [];
    }

    public function removeFile($filename)
    {
        $this->files = Arr::where($this->files, function ($file) use ($filename) {
            return $file->getFilename() !== $filename;
        });
    }

    public function render()
    {
        return view('livewire.create-product');
    }
}
