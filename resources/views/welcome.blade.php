@extends('layouts.app')

@section('content')

    <section id="banner">

        @include('layouts._nav')

        <div class="movies owl-carousel owl-theme">

            @foreach ($latest_movies as $latest_movie)

                <div class="movie text-white d-flex justify-content-center align-items-center">

                    <div class="movie__bg" style="background: linear-gradient(rgba(0,0,0, 0.6), rgba(0,0,0, 0.6)), url({{$latest_movie->image_path}}) center/cover no-repeat;"></div>

                    <div class="container">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="d-flex justify-content-between">
                                    <h1 class="movie__name fw-300">{{ $latest_movie->name }}</h1>
                                    <span class="movie__year align-self-center">{{ $latest_movie->year }}</span>
                                </div>

                                <div class="d-flex movie__rating my-1">
                                    <div class="d-flex">
                                        @for ($i = 0; $i < $latest_movie->rating; $i++)
                                            <span class="fas fa-star text-primary mr-2"></span>
                                        @endfor
                                    </div>
                                    <span class="align-self-center">{{ $latest_movie->rating }}</span>
                                </div>

                                <p class="movie__description my-2">
                                    {{ $latest_movie->description }}
                                </p>

                                <div class="movie__cta my-4">
                                    <a href="{{ route('movies.show', $latest_movie->id) }}" class="btn btn-primary text-capitalize mr-0 mr-md-2"><span class="fas fa-play"></span> watch now</a>
                                    @auth
                                        <a href="#" class="btn btn-outline-light text-capitalize movie__fav-btn">
                                            <span class="far fa-heart movie__fav-icon movie-{{ $latest_movie->id }} {{ $latest_movie->is_favored ? 'fw-900' : '' }}"
                                                  data-movie-id="{{ $latest_movie->id }}"
                                                  data-url="{{ route('movies.toggle_favorite', $latest_movie->id) }}"
                                            >
                                            </span>
                                            add to favorite
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-outline-light text-capitalize"><span class="far fa-heart"></span> add to favorite</a>
                                    @endauth
                                </div>
                            </div><!-- end of col -->

                            <div class="col-6 mt-2 mx-auto col-md-4 col-lg-3  ml-md-auto mr-md-0">
                                <img src="{{ $latest_movie->poster_path }}" class="img-fluid" alt="">
                            </div>
                        </div><!-- end of row -->

                    </div><!-- end of container -->

                </div><!-- end of movie -->

            @endforeach

        </div><!-- end of movies -->

    </section><!-- end of banner section-->

    @foreach ($categories as $category)

        <section class="listing py-2">

            <div class="container">

                <div class="row my-4">
                    <div class="col-12 d-flex justify-content-between">
                        <h3 class="listing__title text-white fw-300">{{ $category->name }}</h3>
                        <a href="{{ route('movies.index', ['category_name' => $category->name]) }}" class="align-self-center text-capitalize text-primary">see all</a>
                    </div>
                </div><!-- end of row -->

                <div class="movies owl-carousel owl-theme">

                    @foreach ($category->movies as $movie)

                        <div class="movie p-0">
                            <img src="{{ $movie->poster_path }}" class="img-fluid" alt="">

                            <div class="movie__details text-white">

                                <div class="d-flex justify-content-between">
                                    <p class="mb-0 movie__name">{{ $movie->name }}</p>
                                    <p class="mb-0 movie__year align-self-center">{{ $movie->year }}</p>
                                </div>

                                <div class="d-flex movie__rating">
                                    <div class="mr-2">
                                        @for ($i = 0; $i < $movie->rating; $i++)
                                            <i class="fas fa-star text-primary mr-1"></i>
                                        @endfor
                                    </div>
                                    <span>{{ $movie->rating }}</span>
                                </div>

                                <div class="movie___views">
                                    <p>Views: {{ $movie->views }}</p>
                                </div>

                                <div class="d-flex movie__cta">
                                    <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-primary text-capitalize flex-fill mr-2"><i class="fas fa-play"></i> watch now</a>
                                    @auth
                                        <i class="far fa-heart {{ $movie->is_favored ? 'fw-900' : ''}} fa-1x align-self-center movie__fav-icon movie-{{ $movie->id }}"
                                           data-movie-id="{{ $movie->id }}"
                                           data-url="{{ route('movies.toggle_favorite', $movie->id) }}"
                                        >

                                        </i>
                                    @else
                                        <a href="{{ route('login') }}" class="text-white align-self-center"><i class="far fa-heart fa-1x align-self-center movie__fav-icon"></i></a>
                                    @endauth
                                </div>

                            </div><!-- end of movie details -->

                        </div><!-- end of col -->

                    @endforeach

                </div><!-- end of row -->

            </div><!-- end of container -->

        </section><!-- end of listing section -->

    @endforeach

    @include('layouts._footer')

@endsection