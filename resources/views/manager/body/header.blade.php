<style>
    /* Hover effect for nav links */
    .navbar-nav .nav-link:hover {
        color: #007bff !important; /* Change to your desired color */
        text-decoration: none; /* Optional underline effect */
    }
</style>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark shadow text-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('manager.all.boards') }}">
                <img src="{{ asset('backend/assets/images/logo-en.svg') }}" alt="logo icon" width="100px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->is('manager.all.boards') ? 'active' : '' }}" aria-current="page"
                           href="{{ route('manager.all.boards') }}">Boards</a>
                    </li>
                    @auth
                        @if(Auth::user()->role ==='manager')
                            <li class="nav-item">
                                <a class="nav-link text-white" aria-current="page"
                                   href="{{ route('manager.all.users') }}">Users</a>
                            </li>
                        @else
                        @endif
                    @endauth
                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page"
                               href="{{ route('manager.tasks') }}">Tasks</a>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page"
                           href="{{ route('all.file') }}">Files</a>
                    </li>
                    @auth
                        @if(Auth::user()->role ==='manager')
                            <li class="nav-item dropdown dropdown-laungauge d-none d-sm-flex">
                                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                                   id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="ms-2 text-white">Components</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item d-flex align-items-center py-2"
                                           href="{{ route('manager.all.teams') }}"><span
                                                class="ms-2">All Teams</span></a>
                                    </li>
                                    <li><a class="dropdown-item d-flex align-items-center py-2"
                                           href="{{ route('manager.all.types') }}"><span
                                                class="ms-2">All Types</span></a>
                                    </li>
                                    <li><a class="dropdown-item d-flex align-items-center py-2"
                                           href="{{ route('manager.all.priorities') }}"><span class="ms-2">All Priorities</span></a>
                                    </li>
                                    <li><a class="dropdown-item d-flex align-items-center py-2"
                                           href="{{ route('manager.all.working_statuses') }}"><span class="ms-2">All Working Status</span></a>
                                    </li>
                                    <li><a class="dropdown-item d-flex align-items-center py-2"
                                           href="{{ route('manager.all.ticket_statuses') }}"><span class="ms-2">All Ticket Status</span></a>
                                    </li>
                                </ul>
                            </li>
                        @else
                        @endif
                    @endauth
                    @auth
                        <li class="nav-item dropdown dropdown-laungauge d-none d-sm-flex">
                            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                               id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="ms-2 text-white">Blogs</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item d-flex align-items-center py-2"
                                       href="{{ route('blog.post') }}"><span
                                            class="ms-2">All Blogs</span></a>
                                </li>
                                @if(Auth::user()->role ==='manager')
                                    <li><a class="dropdown-item d-flex align-items-center py-2"
                                           href="{{ route('blog.category') }}"><span
                                                class="ms-2">Blog Category</span></a>
                                    </li>
                                @endif
                            </ul>
                        </li>

                    @endauth
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page"
                           href="{{ route('qrcode') }}">QR Code</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown dropdown-laungauge d-none d-sm-flex">
                            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                               id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="ms-2 text-white">Courses</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item d-flex align-items-center py-2"
                                       href="{{ route('all.course') }}"><span
                                            class="ms-2">All Courses</span></a>
                                </li>
                                @if(Auth::user()->role ==='manager')
                                    <li><a class="dropdown-item d-flex align-items-center py-2"
                                           href="{{ route('all.category') }}"><span
                                                class="ms-2">Category</span></a>
                                    </li>
                                    <li><a class="dropdown-item d-flex align-items-center py-2"
                                           href="{{ route('all.subcategory') }}"><span class="ms-2">Sub Category</span></a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page"
                           href="{{ route('files.index') }}">Fetch Files</a>
                    </li>
                </ul>
                <div class="d-flex me-3">
                    <a href="{{route('note.all')}}" class="btn px-2" style="background-color: #FFE800" disabled type="submit"><i class="bx bxs-note"></i>My Notes</a>
                </div>
                @auth()
                    @php
                        $id = Auth::user()->id;
                        $profileData = App\Models\User::find($id);
                    @endphp

                    <div class="user-box dropdown px-3">
                        <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                           href="#"
                           role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img
                                src="{{ (!empty($profileData->photo)) ? url('upload/manager_images/'.$profileData->photo) : url('upload/no_image.jpg')}}"
                                class="user-img" alt="user avatar">
                            <div class="user-info">
                                <p class="user-name mb-0 text-white">{{ $profileData->name }}</p>
                                <p class="designattion mb-0 text-white">{{ $profileData->email }}</p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item d-flex align-items-center"
                                   href="{{ route('manager.profile') }}"><i
                                        class="bx bx-user fs-5"></i><span>Profile</span></a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center"
                                   href="{{ route('select.user') }}"><i
                                        class="bx bx-folder-open fs-5"></i><span>Your Folder</span></a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center"
                                   href="{{ route('manager.change.password') }}"><i class="bx bx-cog fs-5"></i><span>Change Password </span></a>
                            </li>
                            <li>
                                <div class="dropdown-divider mb-0"></div>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center" href="{{ route('manager.logout') }}"><i
                                        class="bx bx-log-out-circle"></i><span>Logout</span></a>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="user-box dropdown px-3">
                        <div class="col">
                            <a href="{{ route('admin.login') }}" type="button" class="btn btn-outline-danger px-5"><i
                                    class='bx bx-log-in mr-1'></i>Login
                            </a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
</header>
