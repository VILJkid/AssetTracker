{{-- View for Create Asset Type --}}

{{-- Extending the master template. --}}
@extends('AssetTracker.master')

{{-- Title of the document. --}}
@section('title')
    <title>Create Asset Type</title>
@endsection

{{-- Header, consisting of a heading and breadcrumb. --}}
@section('header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Asset Types</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/createat">Create Asset Types</a></li>
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

                        {{-- Create Asset Type form. --}}
                        <form action="/createat_check" method="post">
                            @csrf()
                            <div class="card-body">
                                {{-- Asset Type. --}}
                                <div class="form-group">
                                    <label for="assettype">Asset Type</label>
                                    <input type="text" class="form-control" id="assettype" placeholder="Asset Type"
                                        name="assettype">
                                    @if ($errors->has('assettype'))
                                        <label for="assettype"
                                            class="alert alert-danger">{{ $errors->first('assettype') }}</label>
                                    @endif
                                </div>

                                {{-- Asset Description. --}}
                                <div class="form-group">
                                    <label for="assetdesc">Asset Description</label>
                                    {{-- <input type="password" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password"> --}}
                                    <textarea name="assetdesc" id="assetdesc" class="form-control" cols="30" rows="10"
                                        placeholder="Asset Description" style="resize: none;"></textarea>
                                    @if ($errors->has('assetdesc'))
                                        <label for="assetdesc"
                                            class="alert alert-danger">{{ $errors->first('assetdesc') }}</label>
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
