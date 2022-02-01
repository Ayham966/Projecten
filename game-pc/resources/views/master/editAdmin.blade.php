@extends('admin.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 ">
                <div class="card">
                    <div class="card-header">Edit Admin</div>
                    <div class="card-body">
                        <form action="{{ route('updateUser', ['user'=>$user->id] ) }}" method="post">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="name" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="nickname">Nickname:</label>
                                <input type="nickname" class="form-control" id="nickname" name="nickname" value="{{ $user->nickname }}">
                                <span class="text-danger">{{ $errors->first('nickname') }}</span>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="nickname">Role:</label>
                                <input id="name" type="radio" name="role" value="admin" {{ ($user->role == 'admin' ? ' checked' : '') }}> Admin
                                <span class="text-danger">{{ $errors->first('role') }}</span>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Update Password</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('change.password', ['id'=>auth()->user()->id] ) }}">
                            @csrf
                            @foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
