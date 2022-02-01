@extends('admin.admin')

@section('title', 'Berichten')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>Alle Berichten: </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Naam</th>
                                <th>Email</th>
                                <th>Bericht</th>
                                <th>Tijd</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($messeges as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->message }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ url('Dmessege',$item->id) }}" class="btn btn-danger btn-sm">Verwijderen</a>
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
