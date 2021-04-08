<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">

        @if ( auth::user()->email_verified_at == null)
        <a href="{{ route('verification.notice') }}" class="nav-link"><i
                class="nav-icon far fa-fw fa-circle text-danger"></i>
            Verification email</a>
        @else
        <div class="nav-link"> <i class="nav-icon fas fa-circle text-green"></i>
            Email verified
        </div>
        @endif

        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
            <i class="nav-icon fas fa-fw fa-sign-out-alt">
            </i>
            logout
        </a>
    </div>
    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</aside>
