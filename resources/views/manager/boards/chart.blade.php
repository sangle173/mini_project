@extends('manager.manager_dashboard')
@section('users')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto);

        body {
            font-family: Roboto, sans-serif;
        }

        /*#chart {*/
        /*    max-width: 650px;*/
        /*    margin: 35px auto;*/
        /*}*/

    </style>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Chart</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bxs-home-circle"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Charts</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="card w-75">
                <div class="card-body">
                    <div id="chart">
                    </div>
                    <input type="hidden" id="myInput" value="{{$tasks}}" name="task_id">
                </div>
            </div>
        </div>
        <!--end row-->

        <div class="row">
            <div class="card w-75">
                <div class="card-body">
                    <div id="chart8">
                    </div>
                    <input type="hidden" id="myInput2" value="{{$tasks}}" name="task_id">
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script type="text/javascript">
        const input = document.getElementById("myInput");
        let data = JSON.parse(input.value);
        console.log('===========================')
        console.log(data);
        console.log('===========================')
        var options = {
            chart: {
                type: 'bar'
            },
            series: [
                {
                    name: 'Bug Found',
                    data: [30, 40, 45, 50, 49, 60, 70, 91, 125, 20, 5]
                },
                {
                    name: 'Testing Request',
                    data: [20, 40, 45, 20, 49, 60, 70, 91, 100, 40, 10]
                }
                ,
                {
                    name: 'Ticket Verification',
                    data: [20, 40, 45, 70, 59, 10, 70, 91, 150, 50,20]
                }
            ],

            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>

    <script type="text/javascript">
        const input = document.getElementById("myInput2");
        let data = JSON.parse(input.value);
        console.log('===========================')
        console.log(data);
        console.log('===========================')
        var options = {
            chart: {
                type: 'pie'
            },
            series: [
                {
                    name: 'Bug Found',
                    data: [30, 40, 45, 50, 49, 60, 70, 91, 125, 20, 5]
                },
                {
                    name: 'Testing Request',
                    data: [20, 40, 45, 20, 49, 60, 70, 91, 100, 40, 10]
                }
                ,
                {
                    name: 'Ticket Verification',
                    data: [20, 40, 45, 70, 59, 10, 70, 91, 150, 50,20]
                }
            ],

            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
        }

        var chart = new ApexCharts(document.querySelector("#chart8"), options);

        chart.render();
    </script>
@endsection
