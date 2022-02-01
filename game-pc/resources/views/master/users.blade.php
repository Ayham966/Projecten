@extends('admin.admin')

@section('title', 'Gebruikers')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>Alle Gebruikers: </h4>
                </div>
                <br>
                @if(session()->has('message'))
                    <div class="alert alert-success w-75 mx-auto">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Naam</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th></th>
{{--                                <th></th>--}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->role }}</td>
{{--                                <td>--}}
{{--                                    <a href="" class="btn btn-primary btn-sm">Bewerken</a>--}}
{{--                                </td>--}}
                                <td class="">
                                    <a href="{{ url('Duser',$item->id) }}" class="btn btn-danger btn-sm">Verwijderen</a>
                                    <a href="{{ url('editUser',$item->id) }}" class="btn btn-info btn-sm">Bewerken</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
