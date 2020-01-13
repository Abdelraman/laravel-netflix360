@extends('layouts.dashboard.app')

@section('content')

    <div>
        <h2>Settings</h2>
    </div>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Social Login</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">

                <form method="post" action="{{ route('dashboard.settings.store') }}">
                    @csrf
                    @method('post')

                    @include('dashboard.partials._errors')

                    @php
                        $social_sites = ['facebook', 'google', 'youtube'];
                    @endphp

                    @foreach ($social_sites as $social_site)

                        <div class="form-group">
                            <label class="text-capitalize">{{ $social_site }} link</label>
                            <input type="text" name="{{ $social_site }}_link" class="form-control" value="{{ setting($social_site . '_link') }}">
                        </div>

                    @endforeach

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->

@endsection