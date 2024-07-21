@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bxs-home-circle"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add User</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <form id="myForm" action="{{ route('admin.save-user') }}" method="post" class="row g-3"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <h5 class="mb-4">New User</h5>
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label">Enter Name</label>
                            <div class="col-sm-9">
                                <div class="position-relative input-icon">
                                    <input type="text" class="form-control" name="name" id="name"
                                           placeholder="Enter Name">
                                    <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                                </div>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-sm-3 col-form-label">Email Address</label>
                            <div class="col-sm-9">
                                <div class="position-relative input-icon">
                                    <input type="text" class="form-control" name="email" id="email"
                                           placeholder="Email Address">
                                    <span class="position-absolute top-50 translate-middle-y"><i
                                            class='bx bx-envelope'></i></span>
                                </div>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phone" class="col-sm-3 col-form-label">Phone No</label>
                            <div class="col-sm-9">
                                <div class="position-relative input-icon">
                                    <input type="text" class="form-control" name="phone" id="phone"
                                           placeholder="Phone No">
                                    <span class="position-absolute top-50 translate-middle-y"><i
                                            class='bx bx-phone'></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-sm-3 col-form-label">Choose Password</label>
                            <div class="col-sm-9">
                                <div class="position-relative input-icon">
                                    <input type="password" class="form-control" name="password" id="password"
                                           placeholder="Choose Password">
                                    <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-lock'></i></span>
                                </div>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="title" class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <div class="position-relative input-icon">
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                                    <span class="position-absolute top-50 translate-middle-y"><i
                                            class='bx bx-adjust'></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="role" class="col-sm-3 col-form-label">Select Role</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="role" id="role">
                                    <option value="" disabled selected>Select Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                    <option value="user">User</option>
                                </select>
                                @error('role')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="address" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="address" id="address" rows="3"
                                          placeholder="Address"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-5"><i class='bx bx-user-plus mr-1'></i>Create</button>
                                    <button type="reset" class="btn btn-outline-secondary px-5"><i class='bx bx-reset mr-1'></i>Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
