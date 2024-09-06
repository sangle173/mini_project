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
            <a href="{{ route('manager.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        @auth

        <li class="menu-label">Manage Project </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bxs-bolt-circle'></i>
                </div>
                <div class="menu-title">Board</div>
            </a>
            <ul>
                <li> <a href="{{ route('manager.all.boards') }}"><i class='bx bxs-book-bookmark'></i>All Board </a>
                </li>

            </ul>
        </li>
        @endauth
        @auth

        @if(Auth::user()->role ==='manager')
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bxs-user-account'></i>
                    </div>
                    <div class="menu-title">User</div>
                </a>
                <ul>
                    <li> <a href="{{ route('manager.all.users') }}"><i class='bx bxs-book-bookmark'></i>All User </a>
                    </li>

                </ul>
            </li>
        @else

        @endif
        @endauth
    </ul>
    <!--end navigation-->
</div>
