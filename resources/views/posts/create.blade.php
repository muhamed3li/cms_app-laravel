@extends('layouts.app')

@section('stylesheet')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset($post) ? 'Update Post' : 'Add New Post' }}
        </div>
        <div class="card-body">
            <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @if (isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="Post">Title : </label>
                    <input type="text" name="title" class="form-control" placeholder="Enter Post Title"
                        value="{{ isset($post) ? $post->title : '' }}">
                </div>
                <div class="form-group">
                    <label for="Post">Description : </label>
                    <textarea class="form-control" name="description" placeholder="Enter Post Description"
                        rows="2">{{ isset($post) ? $post->description : '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="Post">Content : </label>
                    <input id="x" type="hidden" name="content" value="{{ isset($post) ? $post->content : '' }}">
                    <trix-editor input="x"></trix-editor>
                </div>
                @if (isset($post))
                    <div class="form-group">
                        <img src="{{ asset('storage/' . $post->image) }}" style="width: 100%" />
                    </div>
                @endif
                <div class="form-group">
                    <label for="Post">Image : </label>
                    <input type="file" name="image" class="form-control " value="">
                </div>
                <div class="form-group">
                    <label for="selectCategory">Select Category : </label>
                    <select class="form-select" name="categoryId">
                        <option selected>Open this select menu</option>
                        @foreach ($categories as $category)
                            <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @if (!$tags->count() <= 0)
                    <div class="form-group">
                        <label for="selectTage">Select Tage : </label>
                        <select class="form-select tags" id="tags" name="tags[]" multiple="multiple">
                            @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" 
                            @if ($post->hasTag($tag->id))selected @endif
                            >{{ $tag->name }}</option>
                @endforeach
                </select>
        </div>
        @endif
        <div class="form-group">
            <button class="btn btn-success mt-2">
                {{ isset($post) ? 'Update' : 'Add' }}
            </button>
        </div>
        </form>
    </div>
    </div>
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tags').select2();
        });
    </script>

@endsection
@endsection
