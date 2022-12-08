@extends('layout.layout')
@section('main')
    <div class="container-fluid px-5">
        <div class="d-flex justify-content-between align-items-center py-3">
            <p class="h1 text-secondary font-weight-bold">List Authors</p>
            <a href="{{ route('author.add') }}" class="btn btn-lg btn-outline-success" style="border-radius: 0">Add a new
                author</a>
        </div>
        @if (session('notification'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{ session('notification') }}</strong>
            </div>

            <script>
                $(".alert").alert();
            </script>
        @endif
        @if (session('errors'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{ session('errors') }}</strong>
            </div>

            <script>
                $(".alert").alert();
            </script>
        @endif
        <table class="table table-hover table-borderless">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th class="text-center">ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($author as $value)
                    <tr>
                        <th scope="row" class="pl-4" style="width: 5%">{{ $loop->iteration }}</th>
                        <td class="text-center">{{ $value->id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>
                            <span class="badge badge-{{ $value->status == 0 ? 'success' : 'danger' }}"
                                style="border-radius: 0">
                                {{ $value->status == 0 ? 'Alive' : 'Dead' }}
                            </span>
                        </td>
                        <td class="text-right w-25">
                            <form action="{{ route('author.delete', $value->id) }}" method="POST">
                                @method('DELETE') @csrf
                                <a href="{{ route('author.detail', $value->id) }}" class="btn btn-outline-secondary"
                                    style="border-radius: 0">View</a>
                                <a href="{{ route('author.update', $value->id) }}" class="btn btn-outline-info"
                                    style="border-radius: 0">Update</a>
                                <button type="submit" class="btn btn-outline-danger" style="border-radius: 0"
                                    onclick="return confirm('Are you sure about delete {{ $value->name }}? ')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $author->links() }}
    </div>
@endsection
