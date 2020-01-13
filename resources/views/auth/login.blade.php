@extends('layouts.app')

@section('content')

    <div class="login">

        <div class="login__bg"></div>

        <div class="container">

            <div class="row">

                <div class="col-10 mx-auto col-md-6 bg-white mx-auto p-3">
                    <h2 class="text-center">Netflix<span class="text-primary">ify</span></h2>

                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        @method('post')

                        @include('dashboard.partials._errors')

                        {{--email--}}
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email">
                        </div>

                        {{--password--}}
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>

                        {{--remember me--}}
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Remember Me</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-block">Login</button>
                        </div>

                        <p class="text-center">Create new account<a href="{{ route('register') }}"> Register</a></p>

                        <hr>
                        <a href="/login/facebook" class="btn btn-block btn-primary" style="background:#3b5998;">Login by Facebook</a>
                        <a href="/login/google" class="btn btn-block btn-primary" style="background:#ea4335;">Login by Gmail</a>

                    </form><!-- end of form -->
                </div><!-- end of col -->

            </div><!-- end of row -->

        </div><!-- end of container -->
    </div><!-- end of login -->

@endsection

