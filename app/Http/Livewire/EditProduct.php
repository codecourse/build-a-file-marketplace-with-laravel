<?php

namespace App\Http\Livewire;

use App\Models\File;
use App\Models\Product;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
    use WithFileUploads;

    public Product $product;

    public $uploads = [];

    public $files = [];

    public $existingFiles = [];

    public $removedFiles = [];

    public $state = [
        'title' => null,
        'slug' => null,
        'description' => null,
        'price' => '0.00',
        'live' => false,
    ];

    public function rules()
    {
        return [
            'state.title' => 'required|max:255',
            'state.slug' => 'required|max:255|unique:products,slug,' . $this->product->id,
            'state.description' => 'required',
            'state.price' => 'required|decimal:0,2|min:1',
            'state.live' => 'boolean'
        ];
    }

    public function mount()
    {
        $this->state = $this->product->withoutRelations()->toArray();
        $this->state['price'] = money($this->state['price']['amount'])->formatByDecimal();
        $this->existingFiles = $this->product->files;
    }

    public function submit()
    {
        $this->validate();

        $this->product->update($this->state);

        $files = collect($this->files)->map(function ($file) {
            return File::make([
                'filename' => $file->getClientOriginalName(),
                'path' => $file->store('files')
            ]);
        });

        $this->product->files()->saveMany($files);

        $this->product->files()->whereIn('id', $this->removedFiles)->delete();

        $this->dispatchBrowserEvent('alert', 'Product updated!');
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

    public function removeExistingFile($id)
    {
        $this->removedFiles[] = $id;
    }

    public function getFilteredExistingFilesProperty()
    {
        return $this->existingFiles->filter(function ($file) {
            return !in_array($file->id, $this->removedFiles);
        });
    }

    public function render()
    {
        return view('livewire.edit-product');
    }
}
