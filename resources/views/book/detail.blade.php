@extends('layout.layout')
@section('main')
    <div class="container py-3">
        <div class="card" style="border-radius: 0">
            <a href="{{ route('book.back') }}" class="text-dark p-2 ml-3">&laquo; Back to books list</a>
            <div class="card-body p-0 px-4">
                <div class="d-flex align-items-end mb-3">
                    <h2 class="card-title p-0 m-0">{{ $book->name }}&nbsp;&nbsp;</h2>
                    <span class="badge badge-{{ $book->status == 0 ? 'success' : 'danger' }}" style="border-radius: 0">
                        {{ $book->status == 0 ? 'In stock' : 'Out of stock' }}
                    </span>
                </div>
                <h6 class="card-subtitle font-italic">Author: {{ $book->author->name }}</h6>
                <div class="row align-items-center py-3">
                    <div class="col-lg-5 col-md-5 col-sm-6">
                        <div class="white-box text-center"><img src="{{ url('uploads') }}/{{ $book->image }}"
                                class="card-img" style="border-radius: 0"></div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-6">
                        <h4 class="box-title">Product description</h4>
                        <p>Lorem Ipsum available,but the majority have suffered alteration in some form,by injected
                            humour,or randomised words which don't look even slightly believable.but the majority have
                            suffered alteration in some form,by injected humour</p>
                        <div class="d-flex align-items-end py-3">
                            <h2 class="py-0 my-0">
                                {!! $book->sale_price == 0 ? "<span class='text-danger'>" : "<del class='text-muted'>" !!}{{ number_format($book->price) }}<small
                                    {{ $book->sale_price == 0 ? '' : 'hidden' }}>$</small>{!! $book->sale_price == 0 ? '</span>' : '</del>' !!}
                                <span class="text-danger"
                                    {{ $book->sale_price == 0 ? 'hidden' : '' }}>{{ number_format($book->sale_price) }}<small>$</small></span>
                            </h2>
                            <small>({{ $discount }}%off)</small>
                        </div>
                        <button class="btn btn-danger" style="border-radius: 0">Buy Now</button>
                        <h3 class="box-title mt-5">Key Highlights</h3>
                        <ul class="list-unstyled">
                            <li><i class="fa fa-check text-success"></i>Sturdy structure</li>
                            <li><i class="fa fa-check text-success"></i>Designed to foster easy portability</li>
                            <li><i class="fa fa-check text-success"></i>Perfect furniture to flaunt your wonderful
                                collectibles</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
