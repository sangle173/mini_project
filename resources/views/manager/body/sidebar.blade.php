@php
  $id = Auth::user()->id;
  $instructorId = App\Models\User::find($id);
  $status = $instructorId->status;
@endphp

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo_agest.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Manager</h4>
        </div>
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

        @if ($status === '1')

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
        @else

        @endif
    </ul>
    <!--end navigation-->
</div>
