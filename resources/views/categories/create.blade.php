@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
          {{isset($category) ? "Update Category" : "Add New Category"}}
        </div>
        <div class="card-body">
            <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
              @csrf
              @if (isset($category))
                @method('PUT')
              @endif
                <div class="form-group">
                    <label for="Category">Category Name: </label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Enter Category Name" value="{{ isset($category) ? $category->name : "" }}">
                        @error('name')
                            <div class="alert alert-danger">
                              {{$message}}
                            </div>
                        @enderror
                      </div>
                <div class="form-group">
                    <button class="btn btn-success mt-2">
                      {{isset($category) ? "Update" : "Add"}}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
