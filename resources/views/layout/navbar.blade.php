<nav id="navbar" class="navbar navbar-expand-lg bg-dark navbar-dark shadow">
    <div class="container">
        <a class="navbar-brand"><span>{{ env('APP_NAME') }}</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-items"><span class="navbar-toggler-icon"></span></button>
        @auth
        <div class="collapse navbar-collapse" id="navbar-items">
            <ul id="navbar-navlist" class="navbar-nav ms-auto m-2">
                <li class="nav-item"><a class="nav-link" href="{{ route('submit') }}">ثبت</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('orders.list') }}">لیست</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('analytics') }}">آمار</a></li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">@csrf<button class="btn nav-link text-danger">خروج</button></form>
                </li>
            </ul>
        </div>
        @endauth
    </div>
</nav>
