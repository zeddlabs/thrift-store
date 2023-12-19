@extends('layouts.app')

@section('content')
  <!-- Products -->
  <section>
    <div class="container my-5">
      <div class="card shadow-0 border rounded-3">
        <div class="card-body p-0 overflow-hidden">
          <div class="row">
            <div class="col-lg-6">
              <img
                src="https://images.unsplash.com/photo-1470309864661-68328b2cd0a5?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                class="object-fit-cover w-100 h-100" />
            </div>
            <div class="col-lg-6 p-5">
              <div class="d-flex flex-column align-items-center">
                <h2>Pembayaran</h2>
                <p class="fw-bold">
                  Total Pembayaran: {{ Number::currency($order->total_price, in: 'IDR', locale: 'id') }}
                </p>
                <div class="w-100 mb-3">
                  <label class="form-label">BRI</label>
                  <input type="text" class="form-control" disabled value="{{ env('REKENING_BRI') }}">
                </div>
                <div class="w-100 mb-3">
                  <label class="form-label">BNI</label>
                  <input type="text" class="form-control" disabled value="{{ env('REKENING_BNI') }}">
                </div>
                <div class="w-100 mb-3">
                  <label class="form-label">BCA</label>
                  <input type="text" class="form-control" disabled value="{{ env('REKENING_BCA') }}">
                </div>

                <p class="text-center">Silahkan transfer ke salah satu rekening diatas</p>

                <a href="https://wa.me/{{ env('WHATSAPP_NUMBER') }}/?text={{ $whatsapp_text }}" class="btn btn-success"
                  target="_blank">Kirim Bukti Melalui WhatsApp</a>
              </div>
              <hr>
              <p>Mau beli lagi? <a href="{{ route('home') }}">Ayo Beli</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <br>
  <br>
  <br>
  <!-- Products -->
@endsection
