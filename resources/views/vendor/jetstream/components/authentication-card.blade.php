<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        <a href="{{route('home')}}" class="flex justify-center items-center">
            <img src="{{asset('uploads/logo-text.png')}}" alt="Logo" class="rounded-full md:w-4/5 md:h-4/5 sm:w-3/4 sm:3/4 w-3/5 h-3/5">
        </a>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
