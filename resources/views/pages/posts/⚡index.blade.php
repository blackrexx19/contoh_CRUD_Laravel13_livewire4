<?php

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;
    public function delete($id)
    {
        $post = Post::findOrFail($id);

        // delete data
        $post->delete();

        // flash message
        session()->flash('message', 'Data Post Berhasil Dihapus.');
    }

    public function render()
    {
        // Return view with layout and title
        return $this->view([
            // Get all posts with latest pagination
            'posts' => Post::latest()->paginate(3),
        ])
            ->layout('layouts::app')
            ->title('Posts List');
    }
};
?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">

            <!-- flash message -->
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <!-- end flash message -->

            <a href="/create" wire:navigate class="btn btn-md btn-success rounded shadow-sm border-0 mb-3">
                ADD NEW POST
            </a>

            <div class="card border-0 rounded shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Content</th>
                                <th scope="col" style="width: 15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($posts as $post)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ asset('/storage/posts/' . $post->image) }}" class="rounded"
                                            style="width: 150px">
                                    </td>
                                    <td>{{ $post->title }}</td>
                                    <td>{!! $post->content !!}</td>
                                    <td class="text-center">
                                        <a href="/edit/{{ $post->id }}" wire:navigate
                                            class="btn btn-sm btn-primary">
                                            EDIT
                                        </a>

                                        <button class="btn btn-sm btn-danger"
                                            onclick="confirm('Yakin ingin menghapus data ini?') || event.stopImmediatePropagation()"
                                            wire:click="delete({{ $post->id }})">
                                            DELETE
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Post belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $posts->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>
</div>
