<nav class="navbar sticky-top">
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
            <div class="link">
                <a href="/">Home</a>
            </div>
            <div class="link">
                <a href="/">Product</a>
            </div>
            <div class="link">
                <a href="/">About</a>
            </div>
        </div>
        @auth
            <div class="extra">
                <div class="name">{{ Auth()->user()->name }}</div>
                <div class="dropdown">
                    <div class="user-profil" data-bs-toggle="dropdown" aria-expanded="true">
                        <img src="{{ asset('images/avatar.jpeg') }}">p
                    </div>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <div class="txt">Logout</div>
                                    <i class="bi bi-box-arrow-right"></i>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="cart-btn" data-bs-toggle="offcanvas" data-bs-target="#cart">
                    <i class="bi bi-cart"></i>
                    <div class="counting" id="ss">
                        
                        @include('template.cart-keranjang', ['hitung' => $hitung])
                    </div>
                </div>
            </div>
        @endauth

        @guest
            <a href="/login" class="login">
                <div class="lefts">
                    <div class="button">
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="txt">
                        LOG IN
                    </div>
                </div>
                <div class="arrow">
                    <i class="bi bi-chevron-right"></i>
                </div>
            </a>
        @endguest
    </div>
</nav>

