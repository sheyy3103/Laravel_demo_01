@extends('layout.layout')
@section('main')
    <div class="container pt-5">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('book.back') }}" class="text-dark">&laquo; Back</a>
            <p class="h1 pb-3 text-success text-uppercase text-center">Add a new book</p>
            <span>&nbsp;</span>
        </div>
        <form action="{{ route('book.added') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Book's name: </label>
                <input type="text" class="form-control" placeholder="Enter name..." style="border-radius: 0"
                    name="name">
                @error('name')
                    <small class="help-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Price: </label>
                <input type="text" class="form-control" placeholder="Enter price..." style="border-radius: 0"
                    name="price">
                @error('price')
                    <small class="help-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Sale price: </label>
                <input type="text" class="form-control" placeholder="Enter sale price..." style="border-radius: 0"
                    name="sale_price" value="0">
                @error('sale_price')
                    <small class="help-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Image: </label>
                <input type="file" class="form-control" placeholder="Select image..."
                    style="border-radius: 0;border: none;padding-left: 0" name="image">
                @error('image')
                    <small class="help-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <label for="">Status: </label>
            <div class="form-group d-flex align-items-center">
                <div class="form-check mr-5">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" value="0" checked>
                        In stock
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" value="1">
                        Out of stock
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="">Author's name: </label>
                <select class="form-control custom-select" name="author_id" id="" style="border-radius: 0">
                    @foreach ($author as $au)
                        <option value="{{ $au->id }}">{{ $au->id . '. ' . $au->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-outline-success" style="border-radius: 0">Add</button>
        </form>
    </div>
@endsection
