@extends('layouts.app')



@section('content')
    <div class="card card-default">
        <div class="card-header">All Users</div>
          @if ($users->count() > 0)
            <table class="card-body ">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>username</th>
                            <th>Role</th>
                            <th>Permissions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    {{-- <img src="{{ asset('storage/' . $post->image) }}" alt="" width="100px" height="50px"> --}}
                                    <img src="{{$user->getGravatar()}}" class="rounded-circle w-25" >
                                </td>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                  {{ $user->role }}
                              </td>
                                <td >
                                  @if (!$user->isAdmin())
                                      <form action="{{route('users.make-admin',$user->id)}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Make Admin</button>
                                      </form>
                                  @else
                                  <form action="{{route('users.make-user',$user->id)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Make User</button>
                                  </form>
                                  @endif
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </table>
          @else
            <div class="card-body text-center">
                <h4>No Users Yet.</h4>
            </div>
          @endif
    </div>

@endsection
