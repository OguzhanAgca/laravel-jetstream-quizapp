<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Quiz App</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased bg-gray-100">
        <div>
            <section class="flex md:flex-row md:justify-between flex-col md:mt-20 my-10 gap-10">
                {{-- Image --}}
                <div class="relative md:w-3/5 w-full">
                    <img src="{{asset('uploads/hero-bg.png')}}" alt="Hero Image" class="sm:mx-8 mt-10 mx-auto lg:w-4/5 lg:h-5/6 md:w-5/6 md:h-5/6 sm:w-3/5 sm:h-3/5 w-4/5 h-4/5">
                    <div class="lg:h-72 md:h-60 sm:h-60 md:w-full sm:w-4/5 hidden sm:block bg-blue-600 rounded-r-full absolute top-2/4 left-0 -z-10"></div>
                </div>
                {{-- Content --}}
                <div class="md:w-2/5 w-full flex flex-col justify-center items-center gap-y-6">
                    <h4 class="lg:text-5xl md:text-4xl sm:text-3xl text-2xl">Quiz App</h4>
                    <div class="sm:text-lg text-current">Try yourself and your knowledge.</div>
                    @if (Route::has('login'))
                    <div class="">
                        @auth
                            <a href="{{ route('quizzes') }}" class="btn btn-dark">Quizzes</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
    
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 btn btn-purple">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
                </div>
            </section>
        </div>
    </body>
</html>
