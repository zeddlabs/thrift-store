@extends('layouts.app')

@section('content')
    <!-- Products -->
    <section>
        <div class="container my-5">
            <header class="mb-4">
                <h3>Produk Terbaru</h3>
            </header>

            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card w-100 my-2 shadow-2-strong">
                            <a href="{{ route('home.product', $product->slug) }}" class="img-wrap">
                                <img src="{{ Storage::url($product->image) }}" class="card-img-top"
                                    style="aspect-ratio: 1 / 1">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $product->name }}
                                </h5>
                                <p class="card-text">
                                    {{ Number::currency($product->price, in: 'IDR', locale: 'id') }}</p>
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
                @endforeach
            </div>
        </div>
    </section>
    <!-- Products -->
@endsection
