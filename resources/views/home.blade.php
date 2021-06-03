@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <h1>Hello {{ Auth::user()->firstname }} have a good day!</h1>
            </div>
        </div>
        <div class="row justify-content-center my-5">
            <div class="col-5">
                <a class="weatherwidget-io" href="https://forecast7.com/en/43d0825d62/veliko-tarnovo/"
                    data-label_1="VELIKO TARNOVO" data-label_2="WEATHER" data-theme="original">VELIKO TARNOVO WEATHER</a>
                <script>
                    ! function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (!d.getElementById(id)) {
                            js = d.createElement(s);
                            js.id = id;
                            js.src = 'https://weatherwidget.io/js/widget.min.js';
                            fjs.parentNode.insertBefore(js, fjs);
                        }
                    }(document, 'script', 'weatherwidget-io-js');

                </script>
            </div>
        </div>
    </div>
    </div>
@endsection
