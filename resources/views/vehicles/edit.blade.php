@extends('layouts.app') <!-- Include your layout file if you have one -->

@section('content')
    <div class="container">
        <h2>Edit Vehicle</h2>
        <form method="POST" action="{{ route('vehicles.update', $vehicle->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $vehicle->title) }}" required>
            </div>

            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" name="model" id="model" class="form-control" value="{{ old('model', $vehicle->model) }}" required>
            </div>

            <div class="form-group">
                <label for="mileage">Mileage</label>
                <input type="number" name="mileage" id="mileage" class="form-control" value="{{ old('mileage', $vehicle->mileage) }}" required>
            </div>

            <div class="form-group">
                <label for="transmission">Transmission</label>
                <select name="transmission" id="transmission" class="form-control" required>
                <option @if($vehicle->transmission=="manual") selected @endif value="manual">Manual</option>
                <option @if($vehicle->transmission=="automaticb") selected @endif value="automatic">Automatic</option>
            </select>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $vehicle->price) }}" required>
            </div>

            <!-- <div class="form-group">
                <label for="images">Images (Up to 5 images, max 2MB each)</label>
                <input type="file" name="images[]" id="images" class="form-control-file" multiple accept="image/*">
            </div> -->

            <button type="submit" class="btn btn-primary">Update Vehicle</button>
        </form>
    </div>
@endsection