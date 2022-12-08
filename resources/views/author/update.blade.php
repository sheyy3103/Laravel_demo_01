@extends('layout.layout')
@section('main')
    <div class="container pt-5">
        <p class="h1 pb-3 text-info text-uppercase text-center">Update of "{{ $author->name }}"</p>
        <form action="{{ route('author.updated', $author->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="">Author's name: </label>
                <input type="text" class="form-control" placeholder="Enter name..." style="border-radius: 0" name="name"
                    value="{{ $author->name }}">
                @error('name')
                    <small class="help-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Status: </label>
            </div>
            <div class="form-group d-flex align-items-center">
                <div class="form-check mr-5">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" value="0"
                            {{ $author->status == 0 ? 'checked' : '' }}>
                        Alive
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" value="1"
                            {{ $author->status == 1 ? 'checked' : '' }}>
                        Dead
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-info" style="border-radius: 0">Update</button>
        </form>
    </div>
@endsection
