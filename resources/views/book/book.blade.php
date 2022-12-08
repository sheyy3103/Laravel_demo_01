@extends('layout.layout')
@section('main')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center py-3">
            <p class="h1 text-secondary font-weight-bold">List Books</p>
            <a href="{{ route('book.add') }}" class="btn btn-lg btn-outline-success" style="border-radius: 0">Add a new
                book</a>
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
                    <th>Price</th>
                    <th>Sale price</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Author</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($book as $value)
                    <tr>
                        <th scope="row" class="pl-4" style="width: 5%">{{ $loop->iteration }}</th>
                        <td class="text-center">{{ $value->id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>
                            {!! $value->sale_price == 0 ? '<span>' : "<del class='text-muted'>" !!}{{ number_format($value->price, '2', '.', ',') }}{!! $value->sale_price == 0 ? '</span>' : '</del>' !!}
                        </td>
                        <td>
                           <span class="{{ $value->sale_price == 0 ? 'text-muted' : '' }}"> {{ number_format($value->sale_price,'2','.',',') }}</span>
                        </td>
                        <td><img src="/uploads/{{ $value->image }}" alt="" height="75px" width="auto"></td>
                        <td>
                            <span class="badge badge-{{ $value->status == 0 ? 'success' : 'danger' }}"
                                style="border-radius: 0">
                                {{ $value->status == 0 ? 'In stock' : 'Out of stock' }}
                            </span>
                        </td>
                        <td>
                            {{ $value->author->name }}
                        </td>
                        <td class="text-right w-25">
                            <form action="{{ route('book.delete', $value->id) }}" method="POST">
                                @method('DELETE') @csrf
                                <a href="{{ route('book.update', $value->id) }}" class="btn btn-outline-info"
                                    style="border-radius: 0">Update</a>
                                <button type="submit" class="btn btn-outline-danger" style="border-radius: 0"
                                    onclick="return confirm('Are you sure about delete {{ $value->name }}? ')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $book->links() }}
    </div>
@endsection
