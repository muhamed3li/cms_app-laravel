@extends('layouts.app')

@section('content')
@if (session()->has('error'))
        <div class="alert alert-danger">
          {{session()->get('error')}}
        </div>
    @endif
    <div class="clearfix">
        <a href="{{ route('tags.create') }}" class="btn btn-success mb-2 float-end">Create Tag</a>
    </div>
    <div class="card card-default">
        <div class="card-header">All Tags</div>
        @if ($tags->count() > 0)
        <table class="card-body">
          <table class="table">
              <tbody>
                  @foreach ($tags as $tag)
                      <tr>
                          <td class="px-3">
                              {{ $tag->name }}<span class="badge bg-primary ml-2">{{$tag->posts->count()}}</span>
                          </td>
                          <td class="d-flex float-end">
                              <a href="{{ route('tags.edit', $tag->id) }} "
                                  class="btn btn-primary btn-sm">Edit
                              </a>
                              <form class=" ml-2 form-group" action="{{ route('tags.destroy', $tag->id) }}"
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
        @else
          <div class="text-center py-3">
            <h1>No Tags Yet.</h1>
          </div>
        @endif
    </div>

@endsection
