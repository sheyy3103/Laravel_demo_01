@extends('layout.layout')
@section('main')
    <div class="container pt-5">
        <p class="h1 pb-3 text-info text-uppercase text-center">Update of "{{ $book->name }}"</p>
        <form action="{{ route('book.updated',$book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="">Book's name: </label>
                <input type="text" class="form-control" placeholder="Enter name..." style="border-radius: 0" name="name" value="{{ $book->name }}">
                @error('name')
                    <small class="help-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Price: </label>
                <input type="text" class="form-control" placeholder="Enter price..." style="border-radius: 0"
                    name="price" value="{{ $book->price }}">
                @error('price')
                    <small class="help-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Sale price: </label>
                <input type="text" class="form-control" placeholder="Enter sale price..." style="border-radius: 0"
                    name="sale_price" value="{{ $book->sale_price }}">
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
                <img src="/uploads/{{ $book->image }}" alt="" height="75px" width="auto">
            </div>
            <label for="">Status: </label>
            <div class="form-group d-flex align-items-center">
                <div class="form-check mr-5">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" value="0" {{ $book->status == 0 ? 'checked' : '' }}>
                        In stock
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" value="1" {{ $book->status == 1 ? 'checked' : '' }}>
                        Out of stock
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="">Author's name: </label>
                <select class="form-control custom-select" name="author_id" id="" style="border-radius: 0">
                    @foreach ($author as $au)
                        <option value="{{ $au->id }}" {{ $au->id == $book->author_id ? "selected" : '' }}>{{ $au->id.'. '.$au->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-outline-info" style="border-radius: 0">Update</button>
        </form>
    </div>
@endsection

