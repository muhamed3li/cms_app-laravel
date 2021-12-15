@extends('layouts.app')

@section('content')
    <div class="clearfix">
        <a href="{{ route('categories.create') }}" class="btn btn-success mb-2 float-end">Create Category</a>
    </div>
    <div class="card card-default">
        <div class="card-header">All Categories</div>
        <table class="card-body">
            <table class="table">
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td class="px-3">
                                {{ $category->name }}
                            </td>
                            <td class="d-flex float-end">
                                <a href="{{ route('categories.edit', $category->id) }} "
                                    class="btn btn-primary btn-sm">Edit
                                </a>
                                <form class=" ml-2 form-group" action="{{ route('categories.destroy', $category->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </table>
    </div>

@endsection
