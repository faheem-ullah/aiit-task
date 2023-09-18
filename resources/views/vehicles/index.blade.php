@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Vehicle</h2>
        </div>
        @can('isSeller')
        <div class="col-md-6 d-flex justify-content-end">
            <a href="{{route('vehicles.create')}}" class="btn btn-primary">New Vehicle</a>
        </div>
        @endcan
    </div>
    <div class="row">
        <div class="col-md-10 offset-1">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Model</th>
                        <th>Price</th>
                        <th>Mileage</th>
                        <th>Transmission</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehicles as $vehicle)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$vehicle->title ?? ''}}</td>
                        <td>{{$vehicle->model ?? ''}}</td>
                        <td>{{$vehicle->price ?? ''}}</td>
                        <td>{{$vehicle->mileage ?? ''}}</td>
                        <td>{{$vehicle->transmission ?? ''}}</td>
                        <td>
                        @can('isSeller')
                            <a href="{{route('vehicles.edit',$vehicle->id)}}" class="btn btn-warning btn-sm">Edit</a>
                        @endcan
                        @can('isBuyer')
                        <a href="{{route('vehicles.purchase',$vehicle->id)}}" class="btn btn-success btn-sm">Purchase</a>
                        @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection