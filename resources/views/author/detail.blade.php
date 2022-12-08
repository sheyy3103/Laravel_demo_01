@extends('layout.layout')
@section('main')
    <div class="container-fluid px-5 py-3">
        <a href="{{ route('author.back') }}" class="text-dark">&laquo; Back to authors list</a>
        <p class="h1 text-secondary font-weight-bold py-3 text-center">List books of "{{ $author->name }}"</p>
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
                    <th class="text-right"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($book as $value)
                    <tr>
                        <th scope="row" class="pl-4" style="width: 5%">{{ $loop->iteration }}</th>
                        <td class="text-center">{{ $value->id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>
                            {!! $value->sale_price == 0 ? "<span class='text-danger'>" : "<del class='text-muted'>" !!}{{ number_format($value->price) }}<small {{ $value->sale_price == 0 ? '' : 'hidden' }}>$</small>{!! $value->sale_price == 0 ? '</span>' : '</del>' !!}
                        </td>
                        <td>
                            <span class="{{ $value->sale_price == 0 ? 'text-muted' : 'text-danger' }}">
                                {{ number_format($value->sale_price) }}<small {{ $value->sale_price > 0 ? '' : 'hidden' }}>$</small></span>
                        </td>
                        <td><img src="/uploads/{{ $value->image }}" alt="" height="75px" width="auto"></td>
                        <td>
                            <span class="badge badge-{{ $value->status == 0 ? 'success' : 'danger' }}"
                                style="border-radius: 0">
                                {{ $value->status == 0 ? 'In stock' : 'Out of stock' }}
                            </span>
                        </td>
                        <td class="text-right" style="width: 10%">
                            <a href="{{ route('book.detail', $value->id) }}" class="btn btn-outline-secondary"
                                style="border-radius: 0">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $book->links() }}
    </div>
@endsection
