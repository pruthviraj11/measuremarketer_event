<div class="col-md-3 sidebar">
    <div class="d-flex flex-column flex-shrink-0 p-3" style="">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <span class="fs-4">Menus</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('registerd_event') }}"
                    class="nav-link {{ Route::is('registerd_event') ? 'active' : '' }}" aria-current="page">
                    Registered Events
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('profile.edit') }}" class="nav-link {{ Route::is('profile.edit') ? 'active' : '' }}"
                    aria-current="page">
                    My Profile
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link {{ Route::is('messages') ? 'active' : '' }}" aria-current="page">
                    My Messages
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('add.guests') }}" class="nav-link {{ Route::is('add.guests') ? 'active' : '' }}"
                    aria-current="page">
                    Add Guests
                </a>
            </li>
        </ul>
    </div>
</div>
