@extends('layouts.app')



@section('content')
    <div class="clearfix">
        <a href="{{ route('posts.create') }}" class="btn btn-success mb-2 float-end">Create Post</a>
    </div>
    <div class="card card-default">
        <div class="card-header">All Posts</div>
          @if ($posts->count() > 0)
            <table class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="" width="100px" height="50px">
                                </td>
                                <td>
                                    {{ $post->title }}
                                </td>
                                <td class="d-flex">
                                    <form class=" ml-2" action="{{ route('posts.destroy', $post->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            {{ $post->trashed() ? 'Delete' : 'Trash' }}
                                        </button>
                                    </form>
                                    @if (!$post->trashed())
                                        <a href="{{ route('posts.edit', $post->id) }}"
                                            class="btn btn-primary float-right btn-sm">Edit</a>
                                    @else
                                        <a href="{{ route('trashed.restore', $post->id) }}"
                                            class="btn btn-primary float-right btn-sm">Restore</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </table>
          @else
            <div class="card-body text-center">
                <h4>No Posts Yet.</h4>
            </div>
          @endif
    </div>

@endsection
