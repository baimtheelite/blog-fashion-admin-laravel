<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="far fa-bell"></i>
                {{-- <span class="badge badge-warning navbar-badge">15</span> --}}
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
                style="left: inherit; right: 0px; width: 500px">
                <span class="dropdown-item dropdown-header">{{ Auth::user()->notifications->count() }} Notifications</span>
                <div class="dropdown-divider"></div>
                @forelse (Auth::user()->notifications as $notification)
                    <a href="{{ $notification->data['url'] ?? '#' }}" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> {{ $notification->data['body'] }}
                        <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                    </a>
                    <div class="dropdown-divider"></div>

                @empty
                <p class="text-center">Tidak ada notifikasi.</p>
                    <div class="dropdown-divider"></div>

                @endforelse
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn" type="submit">Logout</button>
            </form>
        </li>

    </ul>

</nav>
<!-- /.navbar -->
