@extends('layouts.app')

@section('content')

    <section id="show">

        @include('layouts._nav')

        <div class="movie">

            <div class="movie__bg" style="background: linear-gradient(rgba(0,0,0, 0.6), rgba(0,0,0, 0.6)), url({{ $movie->image_path }}) center/cover no-repeat;"></div>

            <div class="container">

                <div class="row">

                    <div class="col-md-8 ">

                        <div id="player"></div>

                    </div><!-- end of col -->

                    <div class="col-md-4 text-white">
                        <h3 class="movie__name fw-300">{{ $movie->name }}</h3>

                        <div class="d-flex movie__rating my-1">
                            <div class="d-flex mr-2">
                                @for ($i = 0; $i < $movie->rating; $i++)
                                    <span class="fas fa-star text-primary mr-2"></span>
                                @endfor
                            </div>
                            <span class="align-self-center">{{ $movie->rating }}</span>
                        </div>

                        <p>Views: <span id="movie__views">{{ $movie->views }}</span></p>

                        <p class="movie__description my-3">
                            {{ $movie->description }}
                        </p>

                        @auth
                            <a href="#" class="btn btn-primary text-capitalize movie__fav-btn">
                                            <span class="far fa-heart movie__fav-icon movie-{{ $movie->id }} {{ $movie->is_favored ? 'fw-900' : '' }}"
                                                  data-movie-id="{{ $movie->id }}"
                                                  data-url="{{ route('movies.toggle_favorite', $movie->id) }}"
                                            >
                                            </span>
                                add to favorite
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary text-capitalize my-3"><i class="far fa-heart"></i> add to favorites</a>
                        @endauth

                    </div><!-- end of col -->

                </div><!-- end of row -->

            </div><!-- end of container -->

        </div><!-- end of movie -->

    </section><!-- end of banner section-->

    <section class="listing py-2">

        <div class="container">

            <div class="row my-4">
                <div class="col-12 d-flex justify-content-between">
                    <h3 class="listing__title text-white fw-300">Related Movies</h3>
                </div>
            </div><!-- end of row -->

            <div class="movies owl-carousel owl-theme">

                @foreach ($related_movies as $related_movie)

                    <div class="movie p-0">
                        <img src="{{ $related_movie->poster_path }}" class="img-fluid" alt="">

                        <div class="movie__details text-white">

                            <div class="d-flex justify-content-between">
                                <p class="mb-0 movie__name">{{ $related_movie->name }}</p>
                                <p class="mb-0 movie__year align-self-center">{{ $related_movie->year }}</p>
                            </div>

                            <div class="d-flex movie__rating">
                                <div class="mr-2">
                                    @for ($i = 0; $i < $related_movie->rating; $i++)
                                        <i class="fas fa-star text-primary mr-1"></i>
                                    @endfor
                                </div>
                                <span>{{ $related_movie->rating }}</span>
                            </div>

                            <div class="movie___views">
                                <p>Views: {{ $related_movie->views }}</p>
                            </div>

                            <div class="d-flex movie__cta">
                                <a href="{{ route('movies.show', $related_movie->id) }}" class="btn btn-primary text-capitalize flex-fill mr-2"><i class="fas fa-play"></i> watch now</a>
                                @auth
                                    <i class="far fa-heart {{ $related_movie->is_favored ? 'fw-900' : ''}} fa-1x align-self-center movie__fav-icon movie-{{ $related_movie->id }}"
                                       data-movie-id="{{ $related_movie->id }}"
                                       data-url="{{ route('movies.toggle_favorite', $related_movie->id) }}"
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

    @include('layouts._footer')

@endsection

@push('scripts')

    <script>
        var file =
            "[Auto]{{ Storage::url('movies/' . $movie->id . '/' . $movie->id . '.m3u8') }}," +
            "[360]{{ Storage::url('movies/' . $movie->id . '/' . $movie->id . '_100.m3u8') }}," +
            "[480]{{ Storage::url('movies/' . $movie->id . '/' . $movie->id . '_250.m3u8') }}," +
            "[720]{{ Storage::url('movies/' . $movie->id . '/' . $movie->id . '_500.m3u8') }}";

        var player = new Playerjs({
            id: "player",
            file: file,
            poster: "{{ $movie->image_path }}",
            default_quality: "Auto",
        });

        let viewsCounted = false;

        function PlayerjsEvents(event, id, data) {
            if (event == "duration") {
                duration = data;
            }

            if (event == "time") {
                time = data;
            }

            let percent = (time / duration) * 100;

            if (percent > 10 && !viewsCounted) {

                $.ajax({
                    url: "{{ route('movies.increment_views', $movie->id) }}",
                    method: 'POST',
                    success: function () {

                        let views = parseInt($('#movie__views').html());
                        $('#movie__views').html(views + 1);

                    },

                });//end of ajax call

                viewsCounted = true;

            } //end of if

        }//end of player event function

    </script>

@endpush