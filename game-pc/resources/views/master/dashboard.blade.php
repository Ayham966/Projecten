@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @auth
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5 border border-dark" width="200" height="200" src="/storage/images/{{auth()->user()->image}}">
                    <span class="font-weight-bold">User</span><span class="text-black-50">{{auth()->user()->email}}</span>
                </div>
                <form action="{{ route('imageUpload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row p-3">
                        <div class="col-md-6">
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                    </div>
                </form>
                <br>

                @if(auth()->user()->image != 'user.png')
                    <form action="{{ route('deleteImage', ['id'=> auth()->user()->id]) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <button class="btn btn-xs btn-danger">Delete my image</button>
                    </form>
                @endif
            </div>

            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <form action="{{ route('profileUpdate', ['user'=>auth()->user()->id] ) }}" method="post">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">
                        <div class="row mt-2">
    {{--                        <div class="col-md-6"><label class="labels">Name</label><input type="text" class="form-control" placeholder="first name" value="{{auth()->user()->name}}"></div>--}}
    {{--                        <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control" value="{{ Auth()->user()->nickname }}" placeholder=""></div>--}}
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth()->user()->name }}">
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Email:</label>
                                <input readonly type="text" class="form-control" id="email" name="email" value="{{ Auth()->user()->email }}">
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Nickname:</label>
                                <input type="text" class="form-control" id="nickname" name="nickname"  value="{{ Auth()->user()->nickname }}">
                                <span class="text-danger">{{ $errors->first('nickname') }}</span>
                            </div>
                            <div class="col-md-12"><label class="labels">Created at:</label><input readonly type="text" class="form-control"  value="{{ Auth()->user()->created_at }}"></div>
                            <div class="col-md-12"><label class="labels">Updated at:</label><input readonly type="text" class="form-control"  value="{{ Auth()->user()->updated_at }}"></div>
    {{--                        <div class="col-md-12"><label class="labels">Area</label><input type="text" class="form-control" placeholder="enter address line 2" value=""></div>--}}
    {{--                        <div class="col-md-12"><label class="labels">Email ID</label><input type="text" class="form-control" placeholder="enter email id" value=""></div>--}}
    {{--                        <div class="col-md-12"><label class="labels">Education</label><input type="text" class="form-control" placeholder="education" value=""></div>--}}
                        </div>
{{--                        <div class="row mt-3">--}}
{{--                            <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value="Netherlands"></div>--}}
{{--                            <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="Arnhem" placeholder="state"></div>--}}
{{--                        </div>--}}
                        <div class="mt-5 text-center"><button class="btn btn-primary" type="submit">Save Profile</button></div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <form method="POST" action="{{ route('change.password', ['id'=>auth()->user()->id] ) }}">
                        @csrf
                        @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                        @endforeach
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Change Password</h4>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                            </div>
                        </div>

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
    @endauth
@endsection
