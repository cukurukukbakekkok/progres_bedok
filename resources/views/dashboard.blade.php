@extends('auth') {{-- kalau layout kamu pakai auth.blade.php --}}
@section('title', 'Dashboard')

@section('content')
<div class="card my-5">
    <div class="card-body text-center">
        <h3>Selamat Datang, {{ Auth::user()->name }} 🎉</h3>
        <p>Kamu berhasil login ke sistem.</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger mt-3">Logout</button>
        </form>
    </div>
</div>
@endsection
