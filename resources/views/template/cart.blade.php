<div class="main-content" id="cart-items">
    @foreach ($crot as $item)
        <div class="item">
            <div class="book">
                <div class="for-img">
                    <img src="{{ asset('upload/' . $item->book->gambar) }}">
                </div>
                <div class="detail">
                    <div class="star">
                        <div class="active">
                            @for ($a = 0; $a < $item->book->kualitas; $a++)
                                <i class="bi bi-star-fill"></i>
                            @endfor
                        </div>
                        <div class="passive">
                            @for ($a = $item->book->kualitas; $a < 5; $a++)
                                <i class="bi bi-star-fill"></i>
                            @endfor
                        </div>
                    </div>
                    <div class="nama">{{ $item->book->nama }}</div>
                    <div class="extra-detail">
                        <div class="author">
                            <span>Penulis:</span> {{ $item->book->penulis }}
                        </div>
                        <div class="type">
                            <span>Tipe:</span> {{ $item->book->type }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="valuation">
                <div class="harga">
                    Rp. {{ number_format($item->book->harga, 0, ',', '.') }}
                </div>
                <div class="values">
                    <button class="for kurang" data-product-id="{{ $item->id }}" data-user-id="{{ auth()->id() }}">
                        -
                    </button>
                    <input type="number" readonly value="{{ $item->quantity }}">
                    <button class="for tambah" data-product-id="{{ $item->id }}" data-user-id="{{ auth()->id() }}">
                        +
                    </button>
                </div>
                <button class="delete" data-product-id="{{ $item->id }}" data-user-id="{{ auth()->id() }}">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    @endforeach
</div>
