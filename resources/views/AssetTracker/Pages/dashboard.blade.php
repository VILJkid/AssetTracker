{{-- View for Dashboard --}}

{{-- Extending the master template. --}}
@extends('AssetTracker.master')

{{-- Cat will welcome you. --}}
@section('cat')
    @include('AssetTracker.Include.preloader')
@endsection

{{-- Title of the document. --}}
@section('title')
    <title>Home</title>
@endsection

{{-- Header, consisting of a heading and breadcrumb. --}}
@section('header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Asset Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

{{-- The main content. --}}
@section('main')
    @csrf()
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <!-- PIE CHART -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Asset Overview</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <!-- BAR CHART -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Asset Status</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('extrajs')
    <script>
        var assetNames = [];
        var assetTypeNames = [];
        var activeAT = [];
        var inactiveAT = [];
        var noOfAssets = [];
        var pieColor = [];
        $(document).ready(function() {
            // Generate random colors for pie chart everytime page reloads
            function generateRandomString(length) {

                var colorCode = "";
                var possible = "ABCDEF0123456789";

                for (var i = 0; i < length; i++) {
                    colorCode += possible.charAt(Math.floor(Math.random() * possible.length));
                }

                return colorCode;
            }

            // Fetch the Asset and Asset Type details
            function getDetails() {
                $.ajax({
                    url: "{{ url('/getstats') }}",
                    method: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    dataType: "json",
                    success: function(response) {

                        for (var i = 0; i < response.data1.length; i++) {
                            assetNames.push(response.data1[i].assetname);
                        }

                        counterA = 0;
                        counterIa = 0;
                        assetCount = 0;
                        for (var i = 0; i < response.data2.length; i++) {
                            assetTypeNames.push(response.data2[i].assettype);
                            for (var j = 0; j < response.data1.length; j++) {
                                if (response.data2[i].id == response.data1[j].assettype_id) {
                                    if (response.data1[j].assetstatus == 1) {
                                        counterA += 1;
                                    } else {
                                        counterIa += 1;
                                    }
                                    assetCount += 1;
                                }
                            }
                            activeAT.push(counterA);
                            inactiveAT.push(counterIa);
                            noOfAssets.push(assetCount);
                            counterA = 0;
                            counterIa = 0;
                            assetCount = 0;
                            pieColor.push("#" + generateRandomString(6));

                        }

                        showPieChart();
                        showBarGraph();
                    }
                });
            }

            function showPieChart() {
                //-------------
                //- PIE CHART -
                //-------------
                // Get context with jQuery - using jQuery's .get() method.
                var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
                var pieData = {
                    labels: assetTypeNames,
                    datasets: [{
                        data: noOfAssets,
                        backgroundColor: pieColor,
                    }]
                }
                var pieOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and doughnut using the method below.
                new Chart(pieChartCanvas, {
                    type: 'doughnut',
                    data: pieData,
                    options: pieOptions
                })
            }

            function showBarGraph() {
                //-------------
                //- BAR CHART -
                //-------------
                var areaChartData = {
                    labels: assetTypeNames,
                    datasets: [{
                            label: 'Active',
                            backgroundColor: 'rgba(60,141,188,0.9)',
                            borderColor: 'rgba(60,141,188,0.8)',
                            pointRadius: false,
                            pointColor: '#3b8bba',
                            pointStrokeColor: 'rgba(60,141,188,1)',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                            data: activeAT
                        },
                        {
                            label: 'Inactive',
                            backgroundColor: 'rgba(210, 214, 222, 1)',
                            borderColor: 'rgba(210, 214, 222, 1)',
                            pointRadius: false,
                            pointColor: 'rgba(210, 214, 222, 1)',
                            pointStrokeColor: '#c1c7d1',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(220,220,220,1)',
                            data: inactiveAT
                        },
                    ]
                }

                var barChartCanvas = $('#barChart').get(0).getContext('2d')
                var barChartData = $.extend(true, {}, areaChartData)
                var temp0 = areaChartData.datasets[0]
                var temp1 = areaChartData.datasets[1]
                barChartData.datasets[0] = temp1
                barChartData.datasets[1] = temp0

                var barChartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    datasetFill: false
                }

                new Chart(barChartCanvas, {
                    type: 'bar',
                    data: barChartData,
                    options: barChartOptions
                })
            }

            getDetails();
        });
    </script>

@endsection
