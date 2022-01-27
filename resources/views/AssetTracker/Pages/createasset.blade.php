{{-- View for Create Asset --}}

{{-- Extending the master template. --}}
@extends('AssetTracker.master')

{{-- Title of the document. --}}
@section('title')
    <title>Create Asset</title>
@endsection

{{-- Header, consisting of a heading and breadcrumb. --}}
@section('header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Assets</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/createasset">Create Assets</a></li>
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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add something amazing !</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->


                        {{-- Error and success message. --}}
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif

                        {{-- Create Asset form. --}}
                        <form action="/createasset_check" method="post" enctype="multipart/form-data">
                            @csrf()
                            <div class="card-body">

                                {{-- Asset name. --}}
                                <div class="form-group">
                                    <label for="assetname">Asset Name</label>
                                    <input type="text" class="form-control" id="assetname" placeholder="Asset Name"
                                        name="assetname">
                                    @if ($errors->has('assetname'))
                                        <label for="assetname"
                                            class="alert alert-danger">{{ $errors->first('assetname') }}</label>
                                    @endif
                                </div>

                                {{-- Asset Type. --}}
                                <div class="form-group">
                                    <label for="assettype_id">Asset Type</label>
                                    <select class="custom-select rounded-0" id="assettype_id" name="assettype_id">
                                        @if (empty($atData))
                                            <option hidden disabled selected>Create an Asset type first</option>
                                        @else
                                            <option hidden disabled selected>Asset Type</option>
                                            @foreach ($atData as $atData)
                                                <option value="{{ $atData->id }}" name="assettype_id">
                                                    {{ $atData->assettype }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('assettype_id'))
                                        <label for="cid"
                                            class="alert alert-danger">{{ $errors->first('assettype_id') }}</label>
                                    @endif
                                </div>

                                {{-- Asset Image. --}}
                                <div class="form-group">
                                    <label for="assetimage">Asset Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="assetimage[]" id="assetimage"
                                                multiple>
                                            <label class="custom-file-label" for="assetimage">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    @if ($errors->has('assetimage[]'))
                                        <label for="assetimage"
                                            class="alert alert-danger">{{ $errors->first('assetimage[]') }}</label>
                                    @endif
                                </div>

                                {{-- Asset Status. --}}
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="hidden" name="assetstatus" value="0">
                                    <input type="checkbox" class="custom-control-input" name="assetstatus" id="assetstatus"
                                        value="1" checked>
                                    <label class="custom-control-label" for="assetstatus">Status</label>
                                    @if ($errors->has('assetstatus'))
                                        <label for="assetstatus"
                                            class="alert alert-danger">{{ $errors->first('assetstatus') }}</label>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


{{-- Scripts related to the specific page goes here. --}}
@section('extrajs')
    <script>
        $(document).ready(function() {
            // For uploading images
            $(function() {
                bsCustomFileInput.init();
            });
        });
    </script>
@endsection
