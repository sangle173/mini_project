{{--@php--}}
{{--  $id = Auth::user()->id;--}}
{{--  $instructorId = App\Models\User::find($id);--}}
{{--  $status = $instructorId->status;--}}
{{--@endphp--}}

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo_agest.png') }}" class="logo-icon" alt="logo icon">
        </div>
        @auth()
            <div>
                <h4 class="logo-text">
                    @if(Auth::user()->role ==='manager')
                        Manager
                    @elseif(Auth::user()->role ==='user')
                        Employee
                    @endif
                </h4>
            </div>
        @endauth
        <div class="toggle-icon ms-auto"><i class='bx bx-menu'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li>
            <a href="{{ route('manager.all.boards') }}">
                <div class="parent-icon"><i class='text-bg-info bx bxs-dashboard'></i>
                </div>
                <div class="menu-title"><b>Dashboard</b></div>
            </a>
        </li>

        @auth

            <li class="menu-label">Manage Project</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='text-bg-success bx bxs-bolt-circle'></i>
                    </div>
                    <div class="menu-title">Boards</div>
                </a>
                <ul>
                    <li><a href="{{ route('manager.all.boards') }}"><i class='bx bxs-book-bookmark'></i>All Boards </a>
                    </li>

                </ul>
            </li>
        @endauth
        @auth

            @if(Auth::user()->role ==='manager')
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='text-bg-primary bx bxs-user-account'></i>
                        </div>
                        <div class="menu-title">Users</div>
                    </a>
                    <ul>
                        <li><a href="{{ route('manager.all.users') }}"><i class='bx bxs-book-bookmark'></i>All Users </a>
                        </li>

                    </ul>
                </li>
            @else

            @endif
        @endauth
        @auth

            @if(Auth::user()->role ==='manager')
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='text-bg-secondary bx bxs-news'></i>
                        </div>
                        <div class="menu-title">Tasks</div>
                    </a>
                    <ul>
                        <li><a href="{{ route('manager.tasks') }}"><i class='bx bxs-book-bookmark'></i>All Tasks </a>
                        </li>

                    </ul>
                </li>
            @else

            @endif
        @endauth
        @auth

            @if(Auth::user()->role ==='manager')
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='text-bg-info bx bxs-component'></i>
                        </div>
                        <div class="menu-title">Components</div>
                    </a>
                    <ul>
                        <li><a href="{{ route('manager.all.priorities') }}"><i class='bx bxs-book-bookmark'></i>All Teams</a>
                        </li>
                        <li><a href="{{ route('manager.all.types') }}"><i class='bx bxs-book-bookmark'></i>All Types</a>
                        </li>
                        <li><a href="{{ route('manager.all.priorities') }}"><i class='bx bxs-book-bookmark'></i>All Priorities</a>
                        </li>
                        <li><a href="{{ route('manager.all.working_statuses') }}"><i class='bx bxs-book-bookmark'></i>All Working Status</a>
                        </li>
                        <li><a href="{{ route('manager.all.ticket_statuses') }}"><i class='bx bxs-book-bookmark'></i>All Ticket Status</a>
                        </li>
                    </ul>
                </li>
            @else

            @endif
        @endauth
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='text-bg-danger bx bxs-file'></i>
                </div>
                <div class="menu-title">Files</div>
            </a>
            <ul>
                <li><a href="{{ route('all.file') }}"><i class='bx bxs-book-bookmark'></i>All Files </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='text-bg-warning bx bxs-widget'></i>
                </div>
                <div class="menu-title">Post</div>
            </a>
            <ul>
                <li><a href="{{ route('blog.post') }}"><i class='bx bxs-book-bookmark'></i>All Post </a>
                </li>
                <li><a href="{{ route('blog.category') }}"><i class='bx bxs-book-bookmark'></i>All Post Category </a>
                </li>
            </ul>
        </li>
        @auth

            <li class="menu-label">CHART</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='text-bg-success bx bxs-chart'></i>
                    </div>
                    <div class="menu-title">Chart</div>
                </a>
                <ul>
                    <li><a href="{{ route('chart.show') }}"><i class='bx bxs-book-bookmark'></i>View Chart </a>
                    </li>

                </ul>
            </li>
        @endauth
    </ul>
    <!--end navigation-->
</div>
