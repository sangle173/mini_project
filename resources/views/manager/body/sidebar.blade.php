{{--@php--}}
{{--  $id = Auth::user()->id;--}}
{{--  $instructorId = App\Models\User::find($id);--}}
{{--  $status = $instructorId->status;--}}
{{--@endphp--}}

<div class="sidebar-wrapper" style="background-color: #334155;" data-simplebar="true">
    <div class="sidebar-header" style="background-color: #334155;" >
        @auth()
            <div>
                <h4 class="text-white">
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
                <div class="parent-icon"><i style="color: #94A3B8" class='bx bxs-dashboard'></i>
                </div>
                <div class="menu-title"><b style="color: #94A3B8">Dashboard</b></div>
            </a>
        </li>

        @auth

            <li class="menu-label" style="color: #94A3B8">Manage Project</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i style="color: #94A3B8" class='bx bxs-bolt-circle'></i>
                    </div>
                    <div class="menu-title" style="color: #94A3B8">Boards</div>
                </a>
                <ul style="background-color: #334155;">
                    <li><a href="{{ route('manager.all.boards') }}" style="color: #94A3B8">All Boards </a>
                    </li>

                </ul>
            </li>
        @endauth
        @auth

            @if(Auth::user()->role ==='manager')
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i style="color: #94A3B8" class='bx bxs-user-account'></i>
                        </div>
                        <div class="menu-title" style="color: #94A3B8">Users</div>
                    </a>
                    <ul style="background-color: #334155;">
                        <li><a style="color: #94A3B8" href="{{ route('manager.all.users') }}">All Users </a>
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
                        <div class="parent-icon"><i style="color: #94A3B8" class='bx bxs-news'></i>
                        </div>
                        <div class="menu-title" style="color: #94A3B8">Tasks/Export</div>
                    </a>
                    <ul style="background-color: #334155;">
                        <li><a style="color: #94A3B8" href="{{ route('manager.tasks') }}">All Tasks </a>
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
                        <div class="parent-icon"><i style="color: #94A3B8" class='bx bxs-component'></i>
                        </div>
                        <div class="menu-title" style="color: #94A3B8">Components</div>
                    </a>
                    <ul style="background-color: #334155;">
                        <li><a style="color: #94A3B8" href="{{ route('manager.all.teams') }}">All Teams</a>
                        </li>
                        <li><a style="color: #94A3B8" href="{{ route('manager.all.types') }}">All Types</a>
                        </li>
                        <li><a style="color: #94A3B8" href="{{ route('manager.all.priorities') }}">All Priorities</a>
                        </li>
                        <li><a style="color: #94A3B8" href="{{ route('manager.all.working_statuses') }}">All Working Status</a>
                        </li>
                        <li><a style="color: #94A3B8" href="{{ route('manager.all.ticket_statuses') }}">All Ticket Status</a>
                        </li>
                    </ul>
                </li>
            @else

            @endif
        @endauth
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i style="color: #94A3B8" class='bx bxs-file'></i>
                </div>
                <div class="menu-title" style="color: #94A3B8">Files</div>
            </a>
            <ul style="background-color: #334155;">
                <li><a style="color: #94A3B8" href="{{ route('all.file') }}">All Files </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i style="color: #94A3B8" class='bx bxs-widget'></i>
                </div>
                <div class="menu-title" style="color: #94A3B8">Post</div>
            </a>
            <ul style="background-color: #334155;">
                <li><a style="color: #94A3B8" href="{{ route('blog.post') }}">All Post </a>
                </li>
                <li><a style="color: #94A3B8" href="{{ route('blog.category') }}">All Post Category </a>
                </li>
            </ul>
        </li>
        @auth
            <li class="menu-label" >CHART</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i style="color: #94A3B8" class='bx bxs-chart'></i>
                    </div>
                    <div class="menu-title" style="color: #94A3B8">Chart</div>
                </a>
                <ul style="background-color: #334155;">
                    <li><a style="color: #94A3B8" href="{{ route('chart.show') }}">View Chart </a>
                    </li>

                </ul>
            </li>
        @endauth
        @auth

            <li class="menu-label" style="color: #94A3B8">TRAINING COURSE</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i style="color: #94A3B8" class='bx bxs-school'></i>
                    </div>
                    <div class="menu-title" style="color: #94A3B8">Training Course</div>
                </a>
                <ul style="background-color: #334155;">
                    <li><a style="color: #94A3B8" href="{{ route('all.course') }}">All Courses </a>
                    </li>
                    <li><a style="color: #94A3B8" href="{{ route('all.category') }}">Category </a>
                    </li>
                    <li><a style="color: #94A3B8" href="{{ route('all.subcategory') }}">Sub Category </a>
                    </li>
                </ul>
            </li>
        @endauth

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i style="color: #94A3B8" class='bx bxs-file'></i>
                </div>
                <div class="menu-title" style="color: #94A3B8">QR Code</div>
            </a>
            <ul style="background-color: #334155;">
                <li><a style="color: #94A3B8" href="{{ route('qrcode') }}">Dev Mode </a>
                </li>
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</div>
