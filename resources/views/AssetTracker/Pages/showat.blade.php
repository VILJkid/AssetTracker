{{-- View for Show Asset Type --}}

{{-- Extending the master template. --}}
@extends('AssetTracker.master')

{{-- Title of the document. --}}
@section('title')
    <title>Display Asset Type</title>
@endsection

{{-- Header, consisting of a heading and breadcrumb. --}}
@section('header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Show Asset Types</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/showat">Show Asset Types</a></li>
                        <li class="breadcrumb-item active">Manage Asset Types</li>
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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" id="atmain" style="position: relative; left: 0px; top: 0px;">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                            <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                Asset Types
                            </h3>
                            {{-- Pagination links --}}
                            <div class="card-tools">
                                @if (!empty($atData))
                                    {{-- {{ $atData->onEachSide(1)->links() }} --}}
                                    {{ $atData->links() }}
                                @endif

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <ul class="todo-list ui-sortable" data-widget="todo-list">
                                @if (empty($atData[0]->assettype))
                                    {{-- If No records found --}}
                                    <li>
                                        <!-- drag handle -->
                                        <span class="handle ui-sortable-handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <!-- todo text -->
                                        <span class="text">Nothing here, only pain and sorrow.</span>
                                        <!-- Emphasis label -->
                                        <small class="badge badge-danger"><i class="far fa-clock"></i> 9999 mins</small>

                                    </li>
                                @else

                                    {{-- If records found --}}
                                    @foreach ($atData as $atdata)
                                        <li>
                                            <!-- drag handle -->
                                            <span class="handle ui-sortable-handle">
                                                <i class="fas fa-ellipsis-v"></i>
                                                <i class="fas fa-ellipsis-v"></i>
                                            </span>

                                            <!-- Asset Type -->
                                            <span class="text">{{ $atdata->assettype }}</span>
                                            <!-- Emphasis label -->
                                            <small class="badge badge-danger"><i class="fas fa-arrow-right"></i>
                                            </small>

                                            {{-- Asset Description --}}
                                            <span class="text">{{ $atdata->assetdesc }}</span>

                                            <!-- General tools such as edit or delete-->
                                            <div class="tools">
                                                {{-- Edit button --}}
                                                <a href="javascript:void(0)" atid="{{ $atdata->id }}"
                                                    class="text-info mr-2 edit" data-toggle="modal"
                                                    data-target="#editModal">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                {{-- Delete Button --}}
                                                <a href="javascript:void(0)" atid="{{ $atdata->id }}"
                                                    class="text-danger mr-2 del" data-toggle="modal"
                                                    data-target="#delModal">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer clearfix">

                            <a href="/createat" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Create
                                asset type</a>
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
                    asset type, all assets under this asset type
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

    <!-- editModal -->
    <!-- Modal HTML Markup -->
    <div id="editModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Asset Type</h3>
                </div>
                <div class="modal-body">
                    {{-- <form role="form" method="POST" action="">
                        <input type="hidden" name="_token" value="">
                        <div class="form-group">
                            <label class="control-label">E-Mail Address</label>
                            <div>
                                <input type="email" class="form-control input-lg" name="email" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Password</label>
                            <div>
                                <input type="password" class="form-control input-lg" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-success">Login</button>

                                <a class="btn btn-link" href="">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form> --}}
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Transform to Epic !</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        {{-- Error and success messages will be shown here --}}
                        <div id="formResult"></div>

                        {{-- Edit Form --}}
                        <form id="editForm">
                            @csrf()
                            <div class="card-body">
                                {{-- Asset Type --}}
                                <div class="form-group">
                                    <label for="assettype">Asset Type</label>
                                    <input type="text" class="form-control" id="assettype" placeholder="Asset Type"
                                        name="assettype">
                                </div>

                                {{-- Asset Description --}}
                                <div class="form-group">
                                    <label for="assetdesc">Asset Description</label>

                                    <textarea name="assetdesc" id="assetdesc" class="form-control" cols="30" rows="10"
                                        placeholder="Asset Description" style="resize: none;"></textarea>
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

@endsection

@section('extrajs')
    <script>
        $(document).ready(function() {

            // Delete Asset Type
            $('.del').click(function() {
                atid = $(this).attr('atid');
                $("#confirmDel").click(function() {
                    $.ajax({
                        url: "{{ url('/delat') }}",
                        method: 'post',
                        data: {
                            _token: '{{ csrf_token() }}',
                            atid: atid
                        },
                        success: function(response) {
                            $("#atmain").load(location.href + " #atmain");
                        }
                    });
                });
            });

            // Edit Asset Type
            $('.edit').click(function() {
                atid = $(this).attr('atid');
                $.ajax({
                    url: "{{ url('/editat') }}",
                    method: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        atid: atid
                    },
                    success: function(response) {
                        $("#assettype").attr('placeholder', response.assettype);
                        $("#assetdesc").attr('placeholder', response.assetdesc);
                        $("#confirmEdit").attr('atid', atid);
                        $("#assettype").val(response.assettype);
                        $("#assetdesc").val(response.assetdesc);

                        $("#confirmEdit").click(function() {
                            assettype = $("#assettype").val();
                            assetdesc = $("#assetdesc").val();
                        });
                    }
                });
            });

            // Update button in Edit modal
            $("#editForm").on("submit", function(event) {
                event.preventDefault();
                atid = $("#confirmEdit").attr('atid');
                assettype = $("#assettype").val();
                assetdesc = $("#assetdesc").val();
                $.ajax({
                    url: "{{ url('/editat_check') }}",
                    method: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        atid: atid,
                        assettype: assettype,
                        assetdesc: assetdesc
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
                            $("#atmain").load(
                                location.href +
                                " #atmain");

                            $("#assettype").attr(
                                'placeholder',
                                assettype);
                            $("#assetdesc").attr(
                                'placeholder',
                                assetdesc);
                            $("#confirmEdit").attr(
                                'atid', atid);
                            $("#assettype").val(
                                assettype);
                            $("#assetdesc").val(
                                assetdesc);
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
