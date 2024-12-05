<div class="col-md-3 sidebar">
    <div class="d-flex flex-column flex-shrink-0 p-3" style="">
        <a href="/"
            class="d-flex align-items-center text-white mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            {{-- <span class="fs-4">Menus</span> --}}
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('profile.edit') }}" class="nav-link {{ Route::is('profile.edit') ? 'active' : '' }}"
                    aria-current="page">
                    My Profile
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('registerd_event') }}"
                    class="nav-link {{ Route::is('registerd_event') ? 'active' : '' }}" aria-current="page">
                    Registered Events
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('list.attending') }}"
                    class="nav-link {{ Route::is('list.attending') ? 'active' : '' }}" aria-current="page">
                    List Of Attendees

                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('event_messages') }}"
                    class="nav-link {{ Route::is('event_messages') ? 'active' : '' }}" aria-current="page">
                    My Messages
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('list.guests') }}" class="nav-link {{ Route::is('add.guests') ? 'active' : '' }}"
                    aria-current="page">
                    Add Members
                </a>
            </li>
        </ul>
    </div>
</div>
