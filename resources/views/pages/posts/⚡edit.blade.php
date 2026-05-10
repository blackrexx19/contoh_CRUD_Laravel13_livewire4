<?php

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

new class extends Component {
    use WithFileUploads;

    public Post $post;

    #[Validate('nullable|image|max:2048')]
    public $image;

    #[Validate('required')]
    public $title;

    #[Validate('required')]
    public $content;

    public function mount($id)
    {
        $this->post = Post::findOrFail($id);

        // set default value from database
        $this->title = $this->post->title;
        $this->content = $this->post->content;
    }

    public function update()
    {
        $this->validate();

        // if upload new image, replace image
        if ($this->image) {
            // delete old image
            Storage::disk('public')->delete('posts/' . $this->post->image);

            // store image
            $this->image->storeAs('posts', $this->image->hashName(), 'public');

            // get image name
            $imageName = $this->image->hashName();
        } else {
            $imageName = $this->post->image;
        }

        // update to database
        $this->post->update([
            'image' => $imageName,
            'title' => $this->title,
            'content' => $this->content,
        ]);

        session()->flash('message', 'Data Post Berhasil Diupdate.');

        return redirect()->route('posts.index');
    }

    public function render()
    {
        return $this->view()->layout('layouts::app')->title('Edit Post');
    }
};
?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">

            <div class="card border-0 rounded shadow-sm">
                <div class="card-body">

                    <form wire:submit.prevent="update" enctype="multipart/form-data">

                        <div class="mb-3 text-center">
                            <label class="form-label">Image</label><br>
                            <img src="{{ asset('/storage/posts/' . $post->image) }}" class="rounded mb-2" width="150">
                            <input type="file" class="form-control" wire:model="image">
                            @error('image')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" wire:model="title">
                            @error('title')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Content</label>
                            <textarea class="form-control" wire:model="content" rows="5"></textarea>
                            @error('content')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                        <a href="/" wire:navigate class="btn btn-md btn-secondary">BACK</a>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
