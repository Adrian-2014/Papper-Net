@extends('template.main')

@section('title', 'Checkout')

@section('internal-head')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">

@endsection

<nav class="navbar fixed-top">
    <div class="container-fluid">
        <a href="/" class="extra">
            <i class="fa-solid fa-chevron-left"></i> </a>
        <div class="check">
            Checkout
        </div>
    </div>
</nav>


<section class="checkout">
    <div class="data pengiriman">
        <div class="head">
            RINCIAN PENGIRIMAN
        </div>
        <div class="content">
            <form action="/checkout-now" method="post" x-data="{ type: '', selectMethod(method) { this.type = method } }">
                @csrf
                <input type="hidden" name="total_harga" value="{{ $total }}">
                <input type="hidden" name="total_item" value="{{ $quantity }}">
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">Nama Penerima</label>
                        <input type="text" class="form-control" autocomplete="off" required placeholder="Nama Penerima.." name="nama">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Alamat</label>
                        <input type="text" class="form-control" autocomplete="off" required placeholder="Alamat Pengiriman.." name="alamat">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Tanggal Pengiriman</label>
                        <input type="date" class="form-control" autocomplete="off" required placeholder="Tanggal Pengiriman.." name="tanggal_pengiriman">
                    </div>
                    <div class="col-12 method">
                        <label class="form-label">Metode Pembayaran</label>
                        <div class="option">
                            <div class="imgs" @click="selectMethod('Gopay')" :class="{ 'selected': type === 'Gopay' }">
                                <img src="{{ asset('images/gopay.jpeg') }}">
                            </div>
                            <div class="imgs" @click="selectMethod('Dana')" :class="{ 'selected': type === 'Dana' }">
                                <img src="{{ asset('images/dana.jpeg') }}">
                            </div>
                            <div class="imgs" @click="selectMethod('Paypal')" :class="{ 'selected': type === 'Paypal' }">
                                <img src="{{ asset('images/paypal.jpeg') }}">
                            </div>
                            <div class="imgs" @click="selectMethod('Ovo')" :class="{ 'selected': type === 'Ovo' }">
                                <img src="{{ asset('images/ovo.jpeg') }}">
                            </div>
                        </div>
                        <input type="hidden" name="metode_pembayaran" required readonly x-model="type">
                    </div>
                    <div class="col-12" x-show="type">
                        <label class="form-label" x-text="type ? `Masukkan Nomor ${type}` : 'Masukkan Nomor E-Wallet'"></label>
                        <input type="text" class="form-control" autocomplete="off" required placeholder="Nomor E-Wallet" name="e_wallet">
                    </div>
                </div>
                <button type="submit" class="my-btn">
                    <div class="texs">
                        Checkout
                    </div>
                    <i class="bi bi-cart"></i>
                </button>
            </form>

        </div>
    </div>
    <div class="data item">
        <div class="head">
            RINCIAN ITEM
        </div>
        <div class="content">
            <div class="list-item">
                @foreach ($itemCheck as $item)
                    <div class="items {{ $loop->first ? 'pertamax' : '' }} {{ $loop->last ? 'last' : '' }}">
                        <div class="book">
                            <div class="for-img">
                                <img src="{{ asset('upload/' . $item->book->gambar) }}">
                            </div>
                            <div class="for-explain">
                                <div class="nama">
                                    {{ $item->book->nama }}
                                </div>
                                <div class="creator">
                                    {{ $item->book->penulis }}
                                </div>
                            </div>
                        </div>
                        <div class="properties">
                            <div class="harga">
                                Rp. {{ number_format($item->book->harga, 0, ',', '.') }}
                            </div>
                            <div class="quantity">
                                {{ $item->quantity }}
                            </div>
                            <div class="subtotal">
                                @php
                                    $harga = $item->book->harga ?? 0;
                                    $quantitas = $item->quantity ?? 0;

                                    $hasilnya = $harga * $quantitas;
                                @endphp
                                Rp. {{ number_format($hasilnya, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="rincians">
                <div class="for-rincian">
                    <div class="left">
                        Jumlah Item
                    </div>
                    <div class="right">
                        {{ $quantity }} Item
                    </div>
                </div>
                <div class="for-rincian">
                    <div class="left">
                        Harga Total
                    </div>
                    <div class="right">
                        Rp. {{ number_format($total, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@section('internal-foot')

@endsection
