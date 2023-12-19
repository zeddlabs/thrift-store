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
              </div>
              <div class="row">
                <form action="{{ route('home.checkout.process', $product->slug) }}" method="post">
                  @csrf
                  <div class="mb-3">
                    <label for="quantity" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="1"
                      max="{{ $product->stock }}" value="1" required>
                  </div>
                  <div class="mb-3">
                    <label for="province" class="form-label">Provinsi</label>
                    <input type="text" class="form-control" id="province" name="province" required>
                  </div>
                  <div class="mb-3">
                    <label for="city" class="form-label">Kab./Kota</label>
                    <input type="text" class="form-control" id="city" name="city" required>
                  </div>
                  <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                  </div>
                  <div class="mb-3">
                    <label for="more_address" class="form-label">Detail lainnya</label>
                    <input type="text" class="form-control" id="more_address" name="more_address" required>
                  </div>

                  <button type="submit" class="btn btn-primary">Beli Sekarang</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Products -->
@endsection
