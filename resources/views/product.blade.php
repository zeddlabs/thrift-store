@extends('layouts.app')

@section('content')
  <!-- Products -->
  <section>
    <div class="container my-5">
      <div class="card shadow-0 border rounded-3">
        <div class="card-body">
          <div class="row g-5">
            <div class="col-lg-5 col-md-12 col-sm-12 bg-image hover-zoom ripple rounded ripple-surface">
              <img src="{{ Storage::url($product->image) }}" class="w-100" />

              <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
              </div>
            </div>
            <div class="col-lg-7 col-md-12 col-sm-12 d-flex flex-column justify-content-between">
              <div class="row">
                <h3 class="mb-3">
                  {{ $product->name }}
                </h3>
                <p class="mb-3">
                  {{ Number::currency($product->price, in: 'IDR', locale: 'id') }}
                </p>
                <p class="mb-3">
                  <span class="fw-bold">Stok:</span> {{ $product->stock }}
                </p>
                <p class="mb-3">
                  <span class="fw-bold">Deskripsi:</span>
                  {!! $product->description !!}
                </p>
              </div>
              <div class="row mt-auto">
                @auth('customer')
                  @if ($product->stock > 0)
                    <a href="{{ route('home.checkout', $product->slug) }}" class="btn btn-primary shadow-0">Checkout</a>
                  @else
                    <a href="#" class="btn btn-primary shadow-0 disabled">Stok
                      Habis</a>
                  @endif
                @else
                  <a href="{{ route('login') }}" class="btn btn-primary shadow-0">Login untuk
                    Checkout</a>
                @endauth
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Products -->
@endsection
