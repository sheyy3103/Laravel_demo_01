@extends('layout.layout')
@section('main')
    <div class="container pt-5">
        <div class="d-flex justify-content-between align-items-center py-3">
            <a href="{{ route('author.back') }}" class="text-dark">&laquo; Back</a>
            <p class="h1 text-success text-uppercase ">Add a new author</p>
            <span>&nbsp;</span>
        </div>
        <form action="{{ route('author.added') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Author's name: </label>
                <input type="text" class="form-control" placeholder="Enter name..." style="border-radius: 0" name="name">
                @error('name')
                    <small class="help-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <label for="">Status: </label>
            <div class="form-group d-flex align-items-center">
                <div class="form-check mr-5">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" value="0" checked>
                        Alive
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" value="1">
                        Dead
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-success" style="border-radius: 0">Add</button>
        </form>
    </div>
@endsection
