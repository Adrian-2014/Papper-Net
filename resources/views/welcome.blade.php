@extends('template.main')

{{-- Prepare --}}

@section('title', 'Home')

@section('internal-head')

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

@endsection

{{-- Prepare --}}


{{-- Main --}}

@include('template.navbar')


{{-- Landing Page --}}
<section class="landing">
    <div class="left">
        <div class="head">
            Temukan kisah dan pengetahuan <span>Terbaikmu!</span>
        </div>
        <div class="text">
            Papper Net menyediakan berbagai macam buku dengan kualitas tinggi dengan informasi yang Up To Date.
            Segera temukan keajaiban Manuskrip faforit anda Disini!
        </div>
        <div class="shop">
            <div class="lefts">
                Beli Sekarang
            </div>
            <div class="rights">
                <a href="#" class="cart-btn"><i class="bi bi-cart"></i></a>
            </div>
        </div>
    </div>
    <div class="right">
        <img src="{{ asset('images/landing.png') }}">
    </div>
</section>
{{-- Landing Page --}}


{{-- Product --}}
<section class="product">

    <div class="heading">
        Produk Kami
    </div>

    <div class="for-product">
        <div class="judul">
            Recomendation
        </div>
        <div class="swipper">
            <div class="lists swiper-wrapper">

                {{-- Item --}}
                @foreach ($buku->take(10) as $item)
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="product-view">
                                <div class="tier">
                                    @if ($item->kualitas === 5)
                                        <div class="best-seller">
                                            Best Seller
                                        </div>
                                    @endif
                                    {{-- <div class="popular">
                                        Popular
                                    </div> --}}
                                </div>
                                <img src="{{ asset('upload/' . $item->gambar) }}">
                            </div>
                            <div class="product-detail">
                                <div class="general">
                                    <div class="nama bookName">
                                        {{ $item->nama }}
                                    </div>
                                    {{-- <div class="type">
                                        Science
                                    </div> --}}
                                    <div class="creator">
                                        {{ $item->penulis }}
                                    </div>
                                    <div class="rating">
                                        <div class="active">
                                            @for ($a = 0; $a < $item->kualitas; $a++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                        </div>
                                        <div class="passive">
                                            @for ($a = $item->kualitas; $a < 5; $a++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="buy">
                                    <div class="harga">
                                        Rp. {{ number_format($item->harga, 0, ',', '.') }}
                                    </div>
                                    @auth
                                        {{-- <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="book_id" value="{{ $item->id }}"> --}}
                                        <div class="add already-log" data-product-id="{{ $item->id }}" data-user-id="{{ auth()->id() }}">
                                            <i class="bi bi-cart-plus"></i>
                                        </div>
                                    @endauth
                                    @guest
                                        <div class="add not-login" data-bs-toggle="modal" data-bs-target="#login-modal">
                                            <i class="bi bi-cart-plus"></i>
                                        </div>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- Item --}}

            </div>
        </div>
    </div>
    <div class="for-product">
        <div class="judul">
            Science
        </div>
        <div class="swipper">
            <div class="lists swiper-wrapper">

                {{-- Item --}}
                @foreach ($buku->filter(function ($item) {
        return $item->type === 'Science';
    }) as $item)
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="product-view">
                                <div class="tier">
                                    @if ($item->kualitas === 5)
                                        <div class="best-seller">
                                            Best Seller
                                        </div>
                                    @endif
                                    {{-- <div class="popular">
                                        Popular
                                    </div> --}}
                                </div>
                                <img src="{{ asset('upload/' . $item->gambar) }}">
                            </div>
                            <div class="product-detail">
                                <div class="general">
                                    <div class="nama bookName">
                                        {{ $item->nama }}
                                    </div>
                                    {{-- <div class="type">
                                        Science
                                    </div> --}}
                                    <div class="creator">
                                        {{ $item->penulis }}
                                    </div>
                                    <div class="rating">
                                        <div class="active">
                                            @for ($a = 0; $a < $item->kualitas; $a++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                        </div>
                                        <div class="passive">
                                            @for ($a = $item->kualitas; $a < 5; $a++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="buy">
                                    <div class="harga">
                                        Rp. {{ number_format($item->harga, 0, ',', '.') }}
                                    </div>
                                    @auth
                                        <div class="add already-log" data-product-id="{{ $item->id }}" data-user-id="{{ auth()->id() }}">
                                            <i class="bi bi-cart-plus"></i>
                                        </div>
                                    @endauth
                                    @guest
                                        <div class="add not-login" data-bs-toggle="modal" data-bs-target="#login-modal">
                                            <i class="bi bi-cart-plus"></i>
                                        </div>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- Item --}}

            </div>
        </div>
    </div>
    <div class="for-product">
        <div class="judul">
            Novel / Comic
        </div>
        <div class="swipper">
            <div class="lists swiper-wrapper">

                {{-- Item --}}
                @foreach ($buku->filter(function ($item) {
        return $item->type === 'Novel / Comic';
    }) as $item)
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="product-view">
                                <div class="tier">
                                    @if ($item->kualitas === 5)
                                        <div class="best-seller">
                                            Best Seller
                                        </div>
                                    @endif
                                    {{-- <div class="popular">
                                        Popular
                                    </div> --}}
                                </div>
                                <img src="{{ asset('upload/' . $item->gambar) }}">
                            </div>
                            <div class="product-detail">
                                <div class="general">
                                    <div class="nama bookName">
                                        {{ $item->nama }}
                                    </div>
                                    {{-- <div class="type">
                                        Science
                                    </div> --}}
                                    <div class="creator">
                                        {{ $item->penulis }}
                                    </div>
                                    <div class="rating">
                                        <div class="active">
                                            @for ($a = 0; $a < $item->kualitas; $a++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                        </div>
                                        <div class="passive">
                                            @for ($a = $item->kualitas; $a < 5; $a++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="buy">
                                    <div class="harga">
                                        Rp. {{ number_format($item->harga, 0, ',', '.') }}
                                    </div>
                                    @auth
                                        <div class="add already-log" data-product-id="{{ $item->id }}" data-user-id="{{ auth()->id() }}">
                                            <i class="bi bi-cart-plus"></i>
                                        </div>
                                    @endauth
                                    @guest
                                        <div class="add not-login" data-bs-toggle="modal" data-bs-target="#login-modal">
                                            <i class="bi bi-cart-plus"></i>
                                        </div>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- Item --}}

            </div>
        </div>
    </div>
    <div class="for-product">
        <div class="judul">
            Education / Health
        </div>
        <div class="swipper">
            <div class="lists swiper-wrapper">

                {{-- Item --}}
                @foreach ($buku->filter(function ($item) {
        return $item->type === 'Education / Health';
    }) as $item)
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="product-view">
                                <div class="tier">
                                    @if ($item->kualitas === 5)
                                        <div class="best-seller">
                                            Best Seller
                                        </div>
                                    @endif
                                    {{-- <div class="popular">
                                        Popular
                                    </div> --}}
                                </div>
                                <img src="{{ asset('upload/' . $item->gambar) }}">
                            </div>
                            <div class="product-detail">
                                <div class="general">
                                    <div class="nama bookName">
                                        {{ $item->nama }}
                                    </div>
                                    {{-- <div class="type">
                                        Science
                                    </div> --}}
                                    <div class="creator">
                                        {{ $item->penulis }}
                                    </div>
                                    <div class="rating">
                                        <div class="active">
                                            @for ($a = 0; $a < $item->kualitas; $a++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                        </div>
                                        <div class="passive">
                                            @for ($a = $item->kualitas; $a < 5; $a++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="buy">
                                    <div class="harga">
                                        Rp. {{ number_format($item->harga, 0, ',', '.') }}
                                    </div>
                                    @auth
                                        <div class="add already-log" data-product-id="{{ $item->id }}" data-user-id="{{ auth()->id() }}">
                                            <i class="bi bi-cart-plus"></i>
                                        </div>
                                    @endauth
                                    @guest
                                        <div class="add not-login" data-bs-toggle="modal" data-bs-target="#login-modal">
                                            <i class="bi bi-cart-plus"></i>
                                        </div>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- Item --}}

            </div>
        </div>
    </div>
    <div class="for-product">
        <div class="judul">
            History
        </div>
        <div class="swipper">
            <div class="lists swiper-wrapper">

                {{-- Item --}}
                @foreach ($buku->filter(function ($item) {
        return $item->type === 'History';
    }) as $item)
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="product-view">
                                <div class="tier">
                                    @if ($item->kualitas === 5)
                                        <div class="best-seller">
                                            Best Seller
                                        </div>
                                    @endif
                                    {{-- <div class="popular">
                                        Popular
                                    </div> --}}
                                </div>
                                <img src="{{ asset('upload/' . $item->gambar) }}">
                            </div>
                            <div class="product-detail">
                                <div class="general">
                                    <div class="nama bookName">
                                        {{ $item->nama }}
                                    </div>
                                    {{-- <div class="type">
                                        Science
                                    </div> --}}
                                    <div class="creator">
                                        {{ $item->penulis }}
                                    </div>
                                    <div class="rating">
                                        <div class="active">
                                            @for ($a = 0; $a < $item->kualitas; $a++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                        </div>
                                        <div class="passive">
                                            @for ($a = $item->kualitas; $a < 5; $a++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="buy">
                                    <div class="harga">
                                        Rp. {{ number_format($item->harga, 0, ',', '.') }}
                                    </div>
                                    @auth
                                        <div class="add already-log" data-product-id="{{ $item->id }}" data-user-id="{{ auth()->id() }}">
                                            <i class="bi bi-cart-plus"></i>
                                        </div>
                                    @endauth
                                    @guest
                                        <div class="add not-login" data-bs-toggle="modal" data-bs-target="#login-modal">
                                            <i class="bi bi-cart-plus"></i>
                                        </div>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- Item --}}

            </div>
        </div>
    </div>
    <div class="for-product">
        <div class="judul">
            Biography
        </div>
        <div class="swipper">
            <div class="lists swiper-wrapper">

                {{-- Item --}}
                @foreach ($buku->filter(function ($item) {
        return $item->type === 'Biography';
    }) as $item)
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="product-view">
                                <div class="tier">
                                    @if ($item->kualitas === 5)
                                        <div class="best-seller">
                                            Best Seller
                                        </div>
                                    @endif
                                    {{-- <div class="popular">
                                        Popular
                                    </div> --}}
                                </div>
                                <img src="{{ asset('upload/' . $item->gambar) }}">
                            </div>
                            <div class="product-detail">
                                <div class="general">
                                    <div class="nama bookName">
                                        {{ $item->nama }}
                                    </div>
                                    {{-- <div class="type">
                                        Science
                                    </div> --}}
                                    <div class="creator">
                                        {{ $item->penulis }}
                                    </div>
                                    <div class="rating">
                                        <div class="active">
                                            @for ($a = 0; $a < $item->kualitas; $a++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                        </div>
                                        <div class="passive">
                                            @for ($a = $item->kualitas; $a < 5; $a++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="buy">
                                    <div class="harga">
                                        Rp. {{ number_format($item->harga, 0, ',', '.') }}
                                    </div>
                                    @auth
                                        <div class="add already-log" data-product-id="{{ $item->id }}" data-user-id="{{ auth()->id() }}">
                                            <i class="bi bi-cart-plus"></i>
                                        </div>
                                    @endauth
                                    @guest
                                        <div class="add not-login" data-bs-toggle="modal" data-bs-target="#login-modal">
                                            <i class="bi bi-cart-plus"></i>
                                        </div>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- Item --}}

            </div>
        </div>
    </div>

</section>
{{-- Product --}}


{{-- About --}}
<section class="about">
    <div class="heading">
        Tentang Kami
    </div>

    <div class="about-company">
        <div class="abouts">
            <div class="text">
                <div class="judul">
                    Siapa Kami?
                </div>
                <div class="desk">
                    <span class="papper">Papper</span><span class="net">Net</span> adalah sebuah website E-Commerce yang menjual buku buku dengan <span>kualitas tinggi</span> dengan harga yang sesuai.
                    Kami menyediakan berbagai macam jenis buku untuk berbagai macam kebutuhan, mulai dari buku Sains, Novel, Sejarah, hingga buku yang biasa di gunakan untuk pembelajaran di sekolah.
                </div>
            </div>
            <div class="text">
                <div class="judul">
                    Sejarah Kami
                </div>
                <div class="desk">
                    Website ini di bangun pada 2024 oleh <span>Adrianss</span> dengan tujuan untuk mempermudah Masyarakat dalam mengakses ilmu pengetahuandan karya karya autentik dengan kualitas tinggi dan <span>legal</span>.
                    dengan diciptakannya website ini, Adrian berharap minat baca dan apresiasi masyarakat terhadap karya karya penulis dapat meningkat secara signifikan. <br>
                    <div class="indent">Website ini memiliki perkembangan yang stabil dari awal pembuatan nya hingga saat ini, membuat kami lebih bersemangat untuk berinovasi dalam <span>Ekspansi</span> ke dalam ranah yang lebih luas lagi
                        untuk membantu masyarakat.</div>
                </div>
            </div>
            <div class="text">
                <div class="judul">
                    Pecapaian Kami
                </div>
                <div class="desk">
                    Setelah berjalan kurang lebih selama 1 tahun, kami telah mendapatkan beberapa pencapaian yang cukup memuaskan. antara lain seperti penghargaan <span>Website dengan pertumbuhan tercepat di Dunia</span> &
                    <span>Organisasi paling berpengaruh di Indonesia</span>.
                    <div class="indent">penghargaan tingkat tinggi ini kami raih tentu saja berkat dukungan dan keterlibatan dari berbagai pihak. Kami sangat mengapresiasi nya dan berharap dapat mengucapkan terimakasih secara langsung kepada
                        pihak yang berkaitan.
                    </div>
                </div>
            </div>
        </div>
        <div class="pics">
            <div class="top">
                <img src="{{ asset('images/book1.jpeg') }}">
            </div>
            <div class="bottom">
                <div class="right">
                    <img src="{{ asset('images/book3.jpeg') }}">
                </div>
                <div class="left">
                    <img src="{{ asset('images/book2.jpeg') }}">
                </div>
            </div>
        </div>
    </div>
</section>
{{-- About --}}


{{-- Footer --}}
<footer class="footer">
    <div class="left">
        <div class="head">
            Papper Net
        </div>
        <div class="mid">

        </div>
        <div class="navigate">
            <div class="me">Created & Published by Adrian Kurniawan.</div>
            <div class="copyright">
                &copy; 2024 Adrianss All Right Deserved.
            </div>
        </div>
    </div>

    <div class="right">
        <div class="media">
            <a href="" class="sosmed">
                <i class="bi bi-github"></i>
            </a>
            <a href="" class="sosmed">
                <i class="bi bi-youtube"></i>
            </a>
            <a href="" class="sosmed">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="" class="sosmed">
                <i class="bi bi-instagram"></i>
            </a>
            <a href="" class="sosmed">
                <i class="bi bi-pinterest"></i>
            </a>
        </div>
        <div class="support">
            Support: interwolrd2014@gmail.com
        </div>
    </div>
</footer>
{{-- Footer --}}


<div class="modal fade login-alert" id="login-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="isian"></div>
                <div class="wrap-cls" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i>
                </div>
                <div class="content">
                    <div class="icon">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <div class="message">
                        <div class="mess-title">
                            Pemberitahuan
                        </div>
                        <div class="mess-txt">
                            Anda Harus Login terlebih dahulu agar dapat melakukan Pembelian.
                        </div>
                    </div>
                </div>
                <div class="tombol">
                    <a href="/login" class="login-btn">
                        LOGIN
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Sidebar Cart --}}
<div class="offcanvas offcanvas-end cart" tabindex="-1" id="cart">
    <div class="offcanvas-header">
        <div class="icon-cart">
            <i class="bi bi-cart4"></i>
        </div>
        <div class="cart-txt" id="kurungs">
            @include('template.cart-kurung', ['count' => $count])
        </div>
    </div>
    <div class="offcanvas-body">
        <div id="cart-items">
            @include('template.cart', ['crot' => $crot])
        </div>
        <div class="final-part">
            <div class="total-harga">
                <div class="txt">
                    Total Harga :
                </div>
                <div class="val" id="total-harga">
                    @include('template.total', ['total', $total])
                </div>
            </div>
            <div class="btns">
                <a href="/checkout" class="for checkout">
                    <i class="bi bi-cart-check"></i>
                    <div class="word">Checkout</div>
                </a>
                <button class="for remove-all" data-product-id="1" data-user-id="{{ auth()->id() }}">
                    <i class="bi bi-trash3"></i>
                    <div class="word">Hapus Semua</div>
                </button>
            </div>
        </div>
    </div>
</div>
{{-- Sidebar Cart --}}

{{-- Main --}}


{{-- Last --}}
@section('internal-foot')
    {{-- <script src="{{ asset('js/cart.js') }}"></script> --}}
    <script>
        const swiper = new Swiper('.swipper', {
            loop: true,
            slidesPerView: 4.25,
            // freeMode: true,
            // centeredSlides: true,
        });
    </script>

    <script>
        var targetName = document.querySelectorAll('.bookName');
        targetName.forEach(function(target) {
            var hamas = target.textContent.trim().length;

            if (hamas < 20) {
                target.classList.add('bigs');
            }
        });
    </script>

    <script>
        var addToCartBtns = document.querySelectorAll(".already-log");
        addToCartBtns.forEach(function(button) {
            button.addEventListener("click", function() {
                var productId = this.dataset.productId;
                var userId = this.dataset.userId;

                fetch('/add-to-cart', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            user_id: userId,
                            book_id: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('cart-items').innerHTML = data.html;
                            document.getElementById('kurungs').innerHTML = data.xml;
                            document.getElementById('ss').innerHTML = data.ss;
                            document.getElementById('total-harga').innerHTML = data.total;
                        } else {
                            alert('Gagal menambahkan item ke keranjang');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menambahkan item ke keranjang');
                    });
            });
        });
    </script>
    <script>
        document.getElementById('cart-items').addEventListener('click', function(event) {
            if (event.target.classList.contains('kurang')) {
                var productId = event.target.dataset.productId;
                var userId = event.target.dataset.userId;

                fetch('/kurangi-pro', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            user_id: userId,
                            cart_id: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // Tambahkan log untuk debug
                        if (data.success) {
                            // Update HTML untuk menampilkan quantity baru
                            document.getElementById('cart-items').innerHTML = data.html;
                            document.getElementById('kurungs').innerHTML = data.xml;
                            document.getElementById('ss').innerHTML = data.ss;
                            document.getElementById('total-harga').innerHTML = data.total;
                        } else {
                            alert('Gagal mengurangi item dari keranjang');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengurangi item dari keranjang');
                    });
            }
        });
    </script>

    <script>
        document.getElementById('cart-items').addEventListener('click', function(event) {
            if (event.target.classList.contains('tambah')) {
                var productId = event.target.dataset.productId;
                var userId = event.target.dataset.userId;

                fetch('/tambah-pro', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            user_id: userId,
                            cart_id: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // Tambahkan log untuk debug
                        if (data.success) {
                            // Update HTML untuk menampilkan quantity baru
                            document.getElementById('cart-items').innerHTML = data.html;
                            document.getElementById('kurungs').innerHTML = data.xml;
                            document.getElementById('ss').innerHTML = data.ss;
                            document.getElementById('total-harga').innerHTML = data.total;
                        } else {
                            alert('Gagal mengurangi item dari keranjang');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengurangi item dari keranjang');
                    });
            }
        });
    </script>

    <script>
        document.getElementById('cart-items').addEventListener('click', function(event) {
            if (event.target.classList.contains('delete')) {
                var productId = event.target.dataset.productId;
                var userId = event.target.dataset.userId;

                fetch('/delete-item', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            user_id: userId,
                            cart_id: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // Tambahkan log untuk debug
                        if (data.success) {
                            // Update HTML untuk menampilkan quantity baru
                            document.getElementById('cart-items').innerHTML = data.html;
                            document.getElementById('kurungs').innerHTML = data.xml;
                            document.getElementById('ss').innerHTML = data.ss;
                            document.getElementById('total-harga').innerHTML = data.total;
                        } else {
                            alert('Gagal mengurangi item dari keranjang');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengurangi item dari keranjang');
                    });
            }
        });
    </script>

    <script>
        var addToCartBtns = document.querySelectorAll(".remove-all");
        addToCartBtns.forEach(function(button) {
            button.addEventListener("click", function() {
                var productId = this.dataset.productId;
                var userId = this.dataset.userId;

                fetch('/delete-all', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            user_id: userId,
                            book_id: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('cart-items').innerHTML = data.html;
                            document.getElementById('kurungs').innerHTML = data.xml;
                            document.getElementById('ss').innerHTML = data.ss;
                            document.getElementById('total-harga').innerHTML = data.total;
                        } else {
                            alert('Gagal menambahkan item ke keranjang');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menambahkan item ke keranjang');
                    });
            });
        });
    </script>

@endsection
{{-- Last --}}
