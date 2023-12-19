@extends('layouts.app')

@section('content')
    <section>
        <div class="container my-5">
            <div class="row">
                <div class="col-12">
                    @foreach ($products as $product)
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6 d-flex">
                                <div class="card w-100 my-2 shadow-2-strong">
                                    <img src="{{ Storage::url($product->image) }}" class="card-img-top" />
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex flex-row">
                                            <h5 class="mb-1 me-1">
                                                {{ $product->name }}</h5>
                                        </div>
                                        <p class="card-text">
                                            {{ Number::currency($product->price, in: 'IDR', locale: 'id') }}
                                        </p>
                                        <p class="text-muted">
                                            Stok: {{ $product->stock }}
                                        </p>
                                        @if ($product->stock > 0)
                                            <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">
                                                <a href="{{ route('home.product', $product->slug) }}"
                                                    class="btn btn-primary shadow-0 me-1">Detail</a>
                                            </div>
                                        @else
                                            <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">
                                                <a href="#" class="btn btn-primary shadow-0 me-1 disabled">Stok
                                                    Habis</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
