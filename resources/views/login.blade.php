@extends('template.main')

@section('title', 'Login')

@section('internal-head')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

<nav class="navbar fixed-top">
    <div class="container-fluid">
        <a href="/" class="brand">
            <div class="f">
                Papper
            </div>
            <div class="s">
                Net
            </div>
        </a>
        <div class="navs">
            <div class="navi user active">
                Login User
            </div>
            <div class="navi admin">
                Login Admin
            </div>
        </div>
    </div>
</nav>

<div class="section1">
    <div class="container" id="container1">
        <div class="form-container sign-up">
            <form action="/users-reg" method="post">
                @csrf
                <h1>Buat Akun</h1>
                <span>Daftar sebagai user</span>
                <input type="text" placeholder="Nama" required name="nama" maxlength="25">
                <input type="email" placeholder="Email" required name="email" maxlength="30">
                <input type="text" placeholder="Nomor Telepon" required name="nomor_telepon" maxlength="15">
                <input type="text" placeholder="Password" required name="password" maxlength="25" min="4">
                <button type="submit">Daftar</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="post" action="/users-log">
                @csrf
                <h1>LOG IN</h1>
                <span>Login sebagai user</span>
                <input type="email" placeholder="Email" name="email" required>
                <input type="text" placeholder="Password" name="password" required>
                <button type="submit">Log In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h2>Selamat Datang!</h2>
                    <p>Masuk ke akun anda untuk lebih banyak fitur</p>
                    <button class="hidden" id="login">Login</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h2>Selamat Datang!</h2>
                    <p>Daftar untuk mengakses lebih banyak hal dan fitur</p>
                    <button class="hidden" id="register">Daftar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section2">
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <h1>Buat Akun</h1>
                <span>Atau gunakan email untuk mendaftar</span>
                <input type="text" placeholder="Name">
                <input type="email" placeholder="Email">
                <input type="password" placeholder="Password">
                <button>Daftar</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="/admins-log" method="post">
                @csrf
                <h1>LOG IN </h1>
                <span>Login Sebagai Admin</span>
                <input type="email" placeholder="Email" required name="email">
                <input type="text" placeholder="Password" required name="password">
                <button type="submit">Log In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h2>Selamat Datang Kembali!</h2>
                    <p>Masuk ke akun anda untuk melihat lebih banyak</p>
                    <button class="hidden" id="login">Login</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h2>Selamat Datang!</h2>
                    <p>Login Sebagai Admin untuk mengelola Website</p>
                </div>
            </div>
        </div>
    </div>
</div>

@section('internal-foot')
    <script src="{{ asset('js/login.js') }}"></script>

    <script>
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '{{ session('error') }}',
            });
        @endif
    </script>
@endsection



