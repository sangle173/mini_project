@extends('manager.manager_dashboard')
@section('users')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bxs-home-circle"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Board Config</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <form id="myForm" action="{{ route('manager.update-board-config') }}" method="post" class="row g-3"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <h5 class="mb-4">Board Config</h5>
                        <input type="hidden" name="board_config_id" value="{{$board_config -> id}}">
                        <div class="row mb-3">
                            <label for="project_name" class="col-sm-3 col-form-label">Board Name</label>
                            <div class="col-sm-9">
                                <div class="position-relative input-icon">
                                    <input type="text" class="form-control" disabled value="{{$board ->name}}"  id="board_name">
                                    <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Team</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> team == 1 ? 'checked': ''}} type="radio" name="team" id="team" value="1">
                                    <label class="form-check-label" for="name1">Enable</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> team == 0 ? 'checked': ''}} type="radio" name="team" id="team" value="0">
                                    <label class="form-check-label" for="name0">Disable</label>
                                </div>
                                @error('team')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Type</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> type == 1 ? 'checked': ''}} type="radio" name="type" id="type" value="1">
                                    <label class="form-check-label" for="type1">Enable</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> type == 0 ? 'checked': ''}} type="radio" name="type" id="type" value="0">
                                    <label class="form-check-label"  for="type0">Disable</label>
                                </div>
                                @error('type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Jira Id</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> jira_id == 1 ? 'checked': ''}} type="radio" name="jira_id" id="jira_id" value="1">
                                    <label class="form-check-label" for="jira_id1">Enable</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> jira_id == 0 ? 'checked': ''}} type="radio" name="jira_id" id="jira_id" value="0">
                                    <label class="form-check-label" for="jira_id0">Disable</label>
                                </div>
                                @error('jira_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Jira Summary</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> jira_summary == 1 ? 'checked': ''}} type="radio" name="jira_summary" id="jira_id" value="1">
                                    <label class="form-check-label" for="jira_summary1">Enable</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> jira_summary == 0 ? 'checked': ''}} type="radio" name="jira_summary" id="jira_summary" value="0">
                                    <label class="form-check-label" for="jira_summary0">Disable</label>
                                </div>
                                @error('jira_summary')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Working Status</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> working_status == 1 ? 'checked': ''}} type="radio" name="working_status" id="working_status" value="1">
                                    <label class="form-check-label" for="working_status1">Enable</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> working_status == 0 ? 'checked': ''}} type="radio" name="working_status" id="working_status" value="0">
                                    <label class="form-check-label" for="working_status0">Disable</label>
                                </div>
                                @error('working_status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Ticket Status</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> ticket_status == 1 ? 'checked': ''}} type="radio" name="ticket_status" id="ticket_status" value="1">
                                    <label class="form-check-label" for="ticket_status1">Enable</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> ticket_status == 0 ? 'checked': ''}} type="radio" name="ticket_status" id="ticket_status" value="0">
                                    <label class="form-check-label" for="ticket_status0">Disable</label>
                                </div>
                                @error('ticket_status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Link To Result</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> link_to_result == 1 ? 'checked': ''}} type="radio" name="link_to_result" id="link_to_result" value="1">
                                    <label class="form-check-label" for="link_to_result1">Enable</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> link_to_result == 0 ? 'checked': ''}} type="radio" name="link_to_result" id="link_to_result" value="0">
                                    <label class="form-check-label" for="link_to_result0">Disable</label>
                                </div>
                                @error('link_to_result')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Test Plan</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> test_plan == 1 ? 'checked': ''}} type="radio" name="test_plan" id="test_plan" value="1">
                                    <label class="form-check-label" for="test_plan1">Enable</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> test_plan == 0 ? 'checked': ''}} type="radio" name="test_plan" id="test_plan" value="0">
                                    <label class="form-check-label" for="test_plan0">Disable</label>
                                </div>
                                @error('test_plan')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Sprint</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> sprint == 1 ? 'checked': ''}} type="radio" name="sprint" id="sprint" value="1">
                                    <label class="form-check-label" for="sprint1">Enable</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> sprint == 0 ? 'checked': ''}} type="radio" name="sprint" id="sprint" value="0">
                                    <label class="form-check-label" for="sprint0">Disable</label>
                                </div>
                                @error('sprint')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Note</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> note == 1 ? 'checked': ''}} type="radio" name="note" id="note" value="1">
                                    <label class="form-check-label" for="note1">Enable</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> note == 0 ? 'checked': ''}} type="radio" name="note" id="note" value="0">
                                    <label class="form-check-label" for="note0">Disable</label>
                                </div>
                                @error('note')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Tester 1</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> tester_1 == 1 ? 'checked': ''}} type="radio" name="tester_1" id="tester_1" value="1">
                                    <label class="form-check-label" for="tester_11">Enable</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> tester_1 == 0 ? 'checked': ''}} type="radio" name="tester_1" id="tester_1" value="0">
                                    <label class="form-check-label" for="tester_10">Disable</label>
                                </div>
                                @error('tester_1')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Tester 2</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> tester_2 == 1 ? 'checked': ''}} type="radio" name="tester_2" id="tester_2" value="1">
                                    <label class="form-check-label" for="tester_21">Enable</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> tester_2 == 0 ? 'checked': ''}} type="radio" name="tester_2" id="tester_2" value="0">
                                    <label class="form-check-label" for="tester_20">Disable</label>
                                </div>
                                @error('tester_2')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Tester 3</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> tester_3 == 1 ? 'checked': ''}} type="radio" name="tester_3" id="tester_3" value="1">
                                    <label class="form-check-label" for="tester_31">Enable</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> tester_3 == 0 ? 'checked': ''}} type="radio" name="tester_3" id="tester_3" value="0">
                                    <label class="form-check-label" for="tester_30">Disable</label>
                                </div>
                                @error('tester_3')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Tester 4</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> tester_4 == 1 ? 'checked': ''}} type="radio" name="tester_4" id="tester_4" value="1">
                                    <label class="form-check-label" for="tester_41">Enable</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> tester_4 == 0 ? 'checked': ''}} type="radio" name="tester_4" id="tester_3" value="0">
                                    <label class="form-check-label" for="tester_30">Disable</label>
                                </div>
                                @error('tester_4')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Tester 5</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> tester_5 == 1 ? 'checked': ''}} type="radio" name="tester_5" id="tester_5" value="1">
                                    <label class="form-check-label" for="tester_51">Enable</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$board_config -> tester_5 == 0 ? 'checked': ''}} type="radio" name="tester_5" id="tester_5" value="0">
                                    <label class="form-check-label" for="tester_50">Disable</label>
                                </div>
                                @error('tester_5')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-5"><i
                                            class='bx bx-add-to-queue mr-1'></i>Save Config
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary px-5"><i
                                            class='bx bx-reset mr-1'></i>Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>


    <script type="text/javascript">
        $(document).ready(function () {
            $('#image').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

    </script>
@endsection
