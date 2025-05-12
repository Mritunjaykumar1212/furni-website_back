<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
    <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Home</a></li>
    <li><a class="nav-link" href="{{ route('about') }}">About</a></li>
    <li><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
    <li><a class="nav-link" href="{{ route('shop') }}">Shop</a></li>
    <li><a class="nav-link" href="{{ route('blog') }}">Blog</a></li>

    @auth
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="nav-link btn btn-link" type="submit" style="border: none; background: none;">
                    Logout
                </button>
            </form>
        </li>
    @endauth

    @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
            <!-- <button class="nav-link btn btn-link" type="submit" onclick="openModal()" style="border: none; background: none;">Login</button> -->
            @include('modal')
        </li>
    @endguest
</ul>
<!-- In your main layout or header -->

