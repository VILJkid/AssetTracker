{{-- View for Show Asset --}}

{{-- Extending the master template. --}}
@extends('AssetTracker.master')

{{-- Title of the document. --}}
@section('title')
    <title>Display Assets</title>
@endsection

{{-- Header, consisting of a heading and breadcrumb. --}}
@section('header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Show Assets</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/showasset">Show Assets</a></li>
                        <li class="breadcrumb-item active">Manage Assets</li>
                        <li class="breadcrumb-item active">Asset Management</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

{{-- The main content. --}}
@section('main')
    @php
    // To calculate Last Updated time
    function time_Ago($time)
    {
        // Calculate difference between current
        // time and given timestamp in seconds
        $diff = time() - $time;

        // Time difference in seconds
        $sec = $diff;

        // Convert time difference in minutes
        $min = round($diff / 60);

        // Convert time difference in hours
        $hrs = round($diff / 3600);

        // Convert time difference in days
        $days = round($diff / 86400);

        // Convert time difference in weeks
        $weeks = round($diff / 604800);

        // Convert time difference in months
        $mnths = round($diff / 2600640);

        // Convert time difference in years
        $yrs = round($diff / 31207680);

        // Check for seconds
        if ($sec <= 60) {
            echo "$sec seconds ago";
        }

        // Check for minutes
        elseif ($min <= 60) {
            if ($min == 1) {
                echo 'One minute ago';
            } else {
                echo "$min minutes ago";
            }
        }

        // Check for hours
        elseif ($hrs <= 24) {
            if ($hrs == 1) {
                echo 'An hour ago';
            } else {
                echo "$hrs hours ago";
            }
        }

        // Check for days
        elseif ($days <= 7) {
            if ($days == 1) {
                echo 'Yesterday';
            } else {
                echo "$days days ago";
            }
        }

        // Check for weeks
        elseif ($weeks <= 4.3) {
            if ($weeks == 1) {
                echo 'A week ago';
            } else {
                echo "$weeks weeks ago";
            }
        }

        // Check for months
        elseif ($mnths <= 12) {
            if ($mnths == 1) {
                echo 'A month ago';
            } else {
                echo "$mnths months ago";
            }
        }

        // Check for years
        else {
            if ($yrs == 1) {
                echo 'One year ago';
            } else {
                echo "$yrs years ago";
            }
        }
    }
    @endphp
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Asset Details</h3>
                            {{-- Pagination links --}}
                            <div class="card-tools">
                                @if (!empty($aData))
                                    {{-- {{ $atData->onEachSide(1)->links() }} --}}
                                    {{ $aData->links() }}
                                @endif
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {{-- Table displaying Asset --}}
                            <table id="example1" class="table table-bordered table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>Asset Name</th>
                                        <th>Asset Code</th>
                                        <th>Asset Type</th>
                                        <th>Last Updated</th>
                                        <th>Asset Status</th>
                                        <th>Asset Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- If no records found --}}
                                    @if (empty($aData[0]->assetname))
                                        <tr>
                                            <td colspan="8">Nothing
                                                here, only pain and sorrow.
                                            </td>
                                        </tr>
                                    @else
                                        {{-- If records found --}}
                                        @foreach ($aData as $adata)
                                            @php
                                                // Split the asset code into 4 parts
                                                $acode = str_split($adata->assetcode, 4);
                                            @endphp
                                            <tr>
                                                {{-- Asset Name --}}
                                                <td>
                                                    {{ $adata->assetname }}</td>

                                                {{-- Asset Code --}}
                                                <td>{{ $acode[0] }}-{{ $acode[1] }}-{{ $acode[2] }}-{{ $acode[3] }}
                                                </td>

                                                {{-- Asset Type --}}
                                                <td>{{ $adata->assettype->assettype }}
                                                </td>

                                                {{-- Last Updated --}}
                                                <td>{{ time_Ago(strtotime($adata->updated_at)) }}
                                                </td>

                                                {{-- Asset Status --}}
                                                <td>
                                                    <div
                                                        class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input type="hidden" name="assetstatus" value="0">
                                                        <input type="checkbox" class="custom-control-input as"
                                                            id="{{ $adata->id }}" name="assetstatus"
                                                            aid="{{ $adata->id }}" value="1"
                                                            {{ $adata->assetstatus == 1 ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="{{ $adata->id }}"
                                                            id="statusLabel{{ $adata->id }}">{{ $adata->assetstatus == 1 ? 'Active' : 'Inactive' }}</label>
                                                    </div>
                                                </td>

                                                {{-- Asset Image --}}
                                                <td><a href="javascript:void(0)" class="btn btn-warning image"
                                                        aid="{{ $adata->id }}" data-toggle="modal"
                                                        data-target="#imageModal"><i class="far fa-eye"></i>
                                                        Show Image</a></td>

                                                {{-- Action --}}
                                                <td>
                                                    {{-- Edit button --}}
                                                    <a href="javacsript:void(0)" class="btn btn-success edit"
                                                        aid="{{ $adata->id }}" data-toggle="modal"
                                                        data-target="#editModal"><i class="fas fa-edit"></i>
                                                        Edit</a>
                                                    &nbsp;&nbsp;

                                                    {{-- Delete button --}}
                                                    <a href="javascript:void(0)" class="btn btn-danger del"
                                                        aid="{{ $adata->id }}" data-toggle="modal"
                                                        data-target="#delModal"><i class="fas fa-trash"></i>
                                                        Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a href="/createasset" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Create
                                asset</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- delModal -->
    <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delModalLongTitle">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure? If you delete this
                    asset, all asset images of this asset
                    will be deleted too!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="confirmDel" data-dismiss="modal" class="btn btn-danger"><i
                            class="fas fa-trash"></i> Delete Anyway</button>
                </div>
            </div>
        </div>
    </div>

    <!-- imageModal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="">
                            </li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active">
                            </li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2" class="">
                            </li>
                        </ol>
                        <div class="carousel-inner" id="innerCarousel">
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true">
                                {{-- <i class="fas fa-chevron-left"></i> --}}
                            </span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true">
                                {{-- <i class="fas fa-chevron-right"></i> --}}
                            </span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- editModal -->
    <!-- Modal HTML Markup -->
    <div id="editModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Asset</h3>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Transform to Epic !</h3>
                        </div>
                        <div id="formResult"></div>
                        {{-- <div id="sentUnuccessfully"></div> --}}
                        <form id="editForm">
                            @csrf()
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="assetname">Asset Name</label>
                                    <input type="text" class="form-control" id="assetname" placeholder="Asset Name"
                                        name="assetname">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" id="confirmEdit" class="btn btn-primary"><i
                                        class="fas fa-edit"></i> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    {{-- Succes message Toastr --}}
    <button type="button" id="toastrSuccessButton" class="invisible btn btn-success toastrDefaultSuccess">
        Launch Success Toast
    </button>

    {{-- Error message Toastr --}}
    <button type="button" id="toastrErrorButton" class="invisible btn btn-danger toastrDefaultError">
        Launch Error Toast
    </button>

@endsection

@section('extrajs')
    <script>
        $(document).ready(function() {
            // For CSV, PDF, and Copy buttons
            $(function() {
                $("#example1").DataTable({
                    "searching": false,
                    "paging": false,
                    "info": false,
                    "ordering": false,
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "pdf"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });

            //delete asset
            $('.del').click(function() {
                aid = $(this).attr('aid');

                $("#confirmDel").click(function() {
                    $.ajax({
                        url: "{{ url('/delasset') }}",
                        method: 'post',
                        data: {
                            _token: '{{ csrf_token() }}',
                            aid: aid
                        },
                        success: function(response) {

                            $("#example1").load(location.href + " #example1");
                        }
                    });
                });
            });

            //show image
            $(".image").click(function() {
                aid = $(this).attr("aid");

                $.ajax({
                    url: "{{ url('/showimage') }}",
                    method: "post",
                    data: {
                        _token: '{{ csrf_token() }}',
                        aid: aid
                    },
                    dataType: "json",
                    success: function(response) {

                        var html = '';
                        var meowActive = '';
                        $("#imageModalLongTitle").html(response.aData.assetname);
                        if (response.iData) {
                            for (var count = 0; count < response.iData.length; count++) {
                                if (count == 1)
                                    meowActive = 'active';
                                else
                                    meowActive = '';
                                html +=
                                    `<div class="carousel-item ${meowActive}"><img class="d-block w-100" src = "{{ asset('Images/${response.aData[0].assettype_id}/${response.aData[0].id}/${response.iData[count].assetimage}') }}" alt = "Slide ${response.iData[count].id}" ></div>`;

                            }

                        } else {
                            html =
                                `<div class="alert alert-danger text-center">No images uploaded for this asset.</div>`;
                        }

                        $('#innerCarousel').html(html);
                    }

                });
            });

            //change status
            $(".as").click(function() {
                check = $(this).prop('checked') ? 1 : 0;
                aid = $(this).attr('aid');

                console.log(check);
                if (check == 1) {

                    $("#toastrSuccessButton").click();
                    $("#statusLabel" + aid).html("Active");


                } else {

                    $("#toastrErrorButton").click();
                    $("#statusLabel" + aid).html("Inactive");

                }

                $("#toastrButton").click();

                $.ajax({
                    url: "{{ url('/changestatus') }}",
                    method: "post",
                    data: {
                        _token: '{{ csrf_token() }}',
                        aid: aid,
                        check: check,
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                    }
                });
            });

            // Toastr Success message
            $('.toastrDefaultSuccess').click(function() {
                toastr.success('Asset activated.')
            });

            // Toastr error message
            $('.toastrDefaultError').click(function() {
                toastr.error('Asset deactivated.')
            });

            // Edit Asset
            $('.edit').click(function() {
                aid = $(this).attr('aid');
                $.ajax({
                    url: "{{ url('/editasset') }}",
                    method: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        aid: aid
                    },
                    success: function(response) {

                        $("#assetname").attr('placeholder', response.assetname);

                        $("#confirmEdit").attr('aid', aid);
                        $("#assetname").val(response.assetname);


                        $("#confirmEdit").click(function() {

                            assetname = $("#assetname").val();

                        });
                    }
                });
            });

            // Update Button in Edit modal
            $("#editForm").on("submit", function(event) {
                event.preventDefault();
                aid = $("#confirmEdit").attr('aid');
                assetname = $("#assetname").val();
                $.ajax({
                    url: "{{ url('/editasset_check') }}",
                    method: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        aid: aid,
                        assetname: assetname,
                        // assetdesc: assetdesc
                    },
                    dataType: "json",
                    success: function(response) {
                        var html = '';
                        if (response.errors) {
                            html =
                                '<div class="alert alert-danger">';
                            for (var count =
                                    0; count <
                                response
                                .errors
                                .length; count++) {
                                html += '<p>' +
                                    response
                                    .errors[count] +
                                    '</p>';
                            }
                            html += '</div>';
                        }
                        if (response.success) {
                            html =
                                '<div class="alert alert-success">' +
                                response.success +
                                '</div>';
                            $("#example1").load(
                                location.href +
                                " #example1");

                            $("#assetname").attr(
                                'placeholder',
                                assetname);
                            // $("#assetdesc").attr(
                            //     'placeholder',
                            //     assetdesc);
                            $("#confirmEdit").attr(
                                'aid', aid);
                            $("#assetname").val(
                                assetname);
                            // $("#assetdesc").val(
                            //     assetdesc);
                        }
                        $('#formResult').html(html);
                        setTimeout(() => {
                            $('#formResult')
                                .html('');
                        }, 2000);
                    }
                });
            });
        });
    </script>
@endsection
