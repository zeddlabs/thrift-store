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
              <form class="d-flex flex-column align-items-center" method="POST" action="{{ route('authenticate') }}">
                @csrf
                <h2>Masuk</h2>
                <div class="w-100 mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" placeholder="Email anda...">
                  @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="w-100 mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password"
                    placeholder="Password anda...">
                </div>
                <button class="btn btn-primary" type="submit">Masuk</button>
              </form>
              <hr>
              <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
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
