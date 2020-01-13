@extends('layouts.dashboard.app')

@section('content')

    <h2>Dashboard</h2>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>

    <div class="row">

        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4>Users</h4>
                    <p><b>{{ $users_count }}</b></p>
                </div>
            </div>
        </div><!-- end of col -->

        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-list fa-3x"></i>
                <div class="info">
                    <h4>Categories</h4>
                    <p><b>{{ $categories_count }}</b></p>
                </div>
            </div>
        </div><!-- end of col -->

        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-play fa-3x"></i>
                <div class="info">
                    <h4>Movies</h4>
                    <p><b>{{ $movies_count }}</b></p>
                </div>
            </div>
        </div><!-- end of col -->


    </div><!-- end of row -->

@endsection