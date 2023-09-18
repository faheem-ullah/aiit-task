@extends('layouts.app') <!-- Include your layout file if you have one -->

@section('content')
<div class="container">
    <h2>Create Vehicle</h2>
    <form method="POST" action="{{ route('vehicles.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" name="model" id="model" class="form-control" value="{{ old('model') }}" required>
        </div>

        <div class="form-group">
            <label for="mileage">Mileage</label>
            <input type="number" name="mileage" id="mileage" class="form-control" value="{{ old('mileage') }}" required>
        </div>

        <div class="form-group">
            <label for="transmission">Transmission</label>
            <select name="transmission" id="transmission" class="form-control" required>
                <option value="manual">Manual</option>
                <option value="automatic">Automatic</option>
            </select>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
            </div>

            <div class="form-group">
                <label for="images">Images (Up to 5 images, max 2MB each)</label>
                <input type="file" name="images[]" id="images" class="form-control-file" multiple accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Vehicle</button>
    </form>
</div>
@endsection