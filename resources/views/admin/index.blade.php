@extends('template.dashboard')

@section('title', 'Dashboard')
@section('styles')

    <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection

@section('container')
    <div class="container-fluid">
        <!--  Owl carousel -->
        <div class="owl-carousel counter-carousel owl-theme">
            @foreach ($books->take(10) as $book)
                <div class="item">
                    <div class="card border-0 zoom-in shadow-none">
                        <div class="card-body">
                            <div class="text-center">
                                <div class="for-item">
                                    <div class="tier">
                                        @if ($book->kualitas === 5)
                                            <div class="best">
                                                Best Seller
                                            </div>
                                        @endif
                                        {{-- <div class="seller">
                                            Popular
                                        </div> --}}
                                    </div>
                                    <img src="{{ asset('upload/' . $book->gambar) }}">
                                    <div class="detail">
                                        <div class="name">
                                            {{ $book->nama }}
                                        </div>
                                        <div class="star">
                                            <div class="non">
                                                @for ($a = $book->kualitas; $a < 5; $a++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                            </div>
                                            <div class="active">
                                                @for ($a = 0; $a < $book->kualitas; $a++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12 d-flex align-items-strech colums">
                <div class="add" data-bs-toggle="modal" data-bs-target="#tambah">
                    <div class="txt">Tambah Produk</div>
                    <i class="bi bi-plus-square-"></i>
                </div>
            </div>
        </div>

        <div class="produk">
            @foreach ($books as $item)
                <div class="item">
                    <div class="product-view">
                        <div class="tier">
                            @if ($item->kualitas === 5)
                                <div class="best">
                                    Best Seller
                                </div>
                            @endif
                            {{-- <div class="seller">
                                Popular
                            </div> --}}
                        </div>
                        <img src="{{ asset('upload/' . $item->gambar) }}">
                    </div>
                    <div class="product-detail">
                        <div class="general">
                            <div class="nama">
                                {{ $item->nama }}
                            </div>
                            <div class="creator">
                                {{ $item->penulis }}
                            </div>
                            <div class="rating">
                                <div class="active">
                                    @for ($a = 0; $a < $item->kualitas; $a++)
                                        <i class="bi bi-star-fill"></i>
                                    @endfor
                                </div>
                                <div class="non">
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
                        </div>
                        <div class="act">
                            <div class="edit" data-bs-toggle="modal" data-bs-target="#update{{ $item->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </div>
                            {{-- <div class="see" data-bs-toggle="modal" data-bs-target="#detail">
                            <i class="bi bi-eye"></i>
                        </div> --}}
                            <form action="/delete-produk/{{ $item->id }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('delete')
                                <div class="delete">
                                    <i class="bi bi-trash3"></i>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- editz --}}
                <div class="modal fade edit" tabindex="-1" id="update{{ $item->id }}">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="titles">
                                    Edit Produk
                                </div>
                                <div class="ele">
                                    <img src="{{ asset('images/book.png') }}">
                                </div>
                            </div>

                            {{-- Form --}}
                            <form action="/update-produk/{{ $item->id }}" method="post" enctype="multipart/form-data" x-data="{ type: '{{ $item->type }}' }">
                                @csrf
                                @method('put')
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Nama Buku</label>
                                            <input type="text" placeholder="nama buku.." class="form-control" name="nama" value="{{ $item->nama }}" required>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Penulis</label>
                                            <input type="text" placeholder="penulis.." class="form-control" name="penulis" value="{{ $item->penulis }}" required>
                                        </div>
                                        <div class="col-12 drops">
                                            <label class="form-label">Tipe Buku</label>
                                            <div class="dropdown">
                                                <input type="text" placeholder="Tipe buku.." class="form-control" name="type" x-model="type" value="" required readonly>
                                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-caret-down-fill"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <div class="wrap" x-on:click="type = 'Science'">Science</div>
                                                    </li>
                                                    <li>
                                                        <div class="wrap" x-on:click="type = 'Novel / Comic'">Novel / Comic</div>
                                                    </li>
                                                    <li>
                                                        <div class="wrap" x-on:click="type = 'Biography'">Biography</div>
                                                    </li>
                                                    <li>
                                                        <div class="wrap" x-on:click="type = 'Education / Health'">Education / Health</div>
                                                    </li>
                                                    <li>
                                                        <div class="wrap" x-on:click="type = 'History'">History</div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-12 harga">
                                            <label class="form-label">Harga</label>
                                            <div class="split">
                                                <div class="rp">Rp.</div>
                                                <input type="number" placeholder="harga.." class="form-control" name="harga" value="{{ $item->harga }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 quality">
                                            <label class="form-label">Kualitas</label>
                                            <div class="stars" data-book-id="{{ $item->id }}">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <div class="star" data-value="{{ $i }}" onclick="setRating(this, '{{ $item->id }}')">
                                                        <i class="bi bi-star-fill {{ $i <= $item->kualitas ? 'text-warning' : '' }}"></i>
                                                    </div>
                                                @endfor
                                                <input type="hidden" name="rating" value="{{ $item->kualitas }}" class="ratings">
                                            </div>

                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Gambar Cover Buku</label>
                                            <input type="file" accept="image/jpg, image/png, image/jpeg" class="form-control" name="gambar">
                                        </div>
                                    </div>

                                    <div class="submits">
                                        <button type="submit">Simpan</button>
                                    </div>
                                </div>
                            </form>
                            {{-- Form --}}
                        </div>
                    </div>
                </div>
                {{-- editz --}}
            @endforeach
        </div>

    </div>


    <div class="modal fade tambah" tabindex="-1" id="tambah">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="titles">
                        Tambahkan Produk
                    </div>
                    <div class="ele">
                        <img src="{{ asset('images/book.png') }}">
                    </div>
                </div>

                {{-- Form --}}
                <form action="/tambah-produk" method="post" enctype="multipart/form-data" x-data="{ type: '' }">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label">Nama Buku</label>
                                <input type="text" placeholder="nama buku.." class="form-control" name="nama" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Penulis</label>
                                <input type="text" placeholder="penulis.." class="form-control" name="penulis" required>
                            </div>
                            <div class="col-12 drops">
                                <label class="form-label">Tipe Buku</label>
                                <div class="dropdown">
                                    <input type="text" placeholder="Tipe buku.." class="form-control" name="type" required readonly x-model="type">
                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-caret-down-fill"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li x-on:click="type = 'Science'">
                                            <div class="wrap">
                                                Science
                                            </div>
                                        </li>
                                        <li x-on:click="type = 'Novel / Comic'">
                                            <div class="wrap">
                                                Novel / Comic
                                            </div>
                                        </li>
                                        <li x-on:click="type = 'Biography'">
                                            <div class="wrap">
                                                Biography
                                            </div>
                                        </li>
                                        <li x-on:click="type = 'Education / Health'">
                                            <div class="wrap">
                                                Education / Health
                                            </div>
                                        </li>
                                        <li x-on:click="type = 'History'">
                                            <div class="wrap">
                                                History
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <div class="col-12 harga">
                                <label class="form-label">Harga</label>
                                <div class="split">
                                    <div class="rp">Rp.</div>
                                    <input type="number" placeholder="harga.." class="form-control" name="harga" required>
                                </div>
                            </div>
                            <div class="col-12 quality">
                                <label class="form-label">Kualitas</label>
                                <div class="stars">
                                    <div class="star selected" data-value="1">
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <div class="star" data-value="2">
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <div class="star" data-value="3">
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <div class="star" data-value="4">
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <div class="star" data-value="5">
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <input type="hidden" id="rating_value" name="rating" value="1">
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Gambar Cover Buku</label>
                                <input type="file" accept="image/jpg, image/png, image/jpeg" class="form-control" name="gambar" required>
                            </div>
                        </div>

                        <div class="submits">
                            <button type="submit">Tambah</button>
                        </div>
                    </div>
                </form>
                {{-- Form --}}

            </div>
        </div>
    </div>

@endsection

@section('internal-script')
    @if (Session::has('success'))
        <script>
            Swal.fire({
                title: 'Sukses!',
                text: '{{ Session::get('success') }}',
                icon: 'success',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif

    <script>
        var tambah = document.querySelector('.tambah');
        const stars = tambah.querySelectorAll('.star');
        const ratingInput = tambah.querySelector('#rating_value');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                ratingInput.value = value;

                stars.forEach(s => {
                    s.classList.remove('selected');
                });
                for (let i = 0; i < value; i++) {
                    stars[i].classList.add('selected');
                }
            });
        });
    </script>


    <script>
        function setRating(selectedStar, bookId) {
            const stars = document.querySelectorAll(`[data-book-id='${bookId}'] .star`);
            const ratingInput = document.querySelector(`[data-book-id='${bookId}'] .ratings`);
            const value = selectedStar.getAttribute('data-value');

            ratingInput.value = value;

            stars.forEach((star, index) => {
                if (index < value) {
                    star.classList.add('selected');
                    star.querySelector('i').classList.add('text-warning');
                } else {
                    star.classList.remove('selected');
                    star.querySelector('i').classList.remove('text-warning');
                }
            });
        }
    </script>

    <script>
        document.querySelectorAll('.delete').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                var form = this.closest('form');

                // Display Sweet Alert for confirmation
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Item ini akan dihapus secara permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

@endsection
