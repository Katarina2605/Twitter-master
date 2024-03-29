<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="https://zupimages.net/up/23/09/wd8s.png">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col pt-6 bg-gray-100 dark:bg-gray-900">
        <div class="container mx-auto flex flex-col space-y-10 px-3">
            <header>
                <nav class="flex justify-between items-center py-2 bg-white shadow-md px-4 rounded-md">
                    <div>
                        <a href="{{ url('/') }}"
                            class="group font-bold text-3xl flex items-center space-x-2 hover:text-red-700 transition ">
                            <svg class="h-10 fill-current text-red-500"
                                 xmlns="http://www.w3.org/2000/svg" xml:space="preserve"
                                 viewBox="0 0 248 204">
                    <path
                        d="M221.95 51.29c.15 2.17.15 4.34.15 6.53 0 66.73-50.8 143.69-143.69 143.69v-.04c-27.44.04-54.31-7.82-77.41-22.64 3.99.48 8 .72 12.02.73 22.74.02 44.83-7.61 62.72-21.66-21.61-.41-40.56-14.5-47.18-35.07 7.57 1.46 15.37 1.16 22.8-.87-23.56-4.76-40.51-25.46-40.51-49.5v-.64c7.02 3.91 14.88 6.08 22.92 6.32C11.58 63.31 4.74 33.79 18.14 10.71c25.64 31.55 63.47 50.73 104.08 52.76-4.07-17.54 1.49-35.92 14.61-48.25 20.34-19.12 52.33-18.14 71.45 2.19 11.31-2.23 22.15-6.38 32.07-12.26-3.77 11.69-11.66 21.62-22.2 27.93 10.01-1.18 19.79-3.86 29-7.95-6.78 10.16-15.32 19.01-25.2 26.16z" />
                </svg>
                            <span>Mini Twitter</span>
                        </a>
                    </div>
                    <div class="flex items-center space-x-8 justify-end">
                        <a class="font hover:text-red-700 transition"
                            href="{{ route('front.articles.index') }}">Tweets</a>

                        <a class="font hover:text-red-700 transition" href="{{ route('about.index') }}">À
                            propos</a>

                        <a class="font hover:text-red-700 transition" href="{{ route('members.index') }}">Membres</a>
                        @guest()
                        <a class="font-bold hover:text-red-700 transition" href="{{ route('login') }}">Se connecter</a>

                        <a class="font-bold hover:text-red-700 transition" href="{{ route('register') }}">S'inscrire</a>
                        @endguest()

                        @auth()
                                <a class="font-bold hover:text-red-700 transition" href="{{route('profile.edit')}}">
                                    {{ __('Profil') }}
                                </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a class="font-bold hover:text-red-700 transition" href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Se déconnecter') }}
                                </a>
                            </form>
                        @endauth()
                    </div>
                </nav>
            </header>

            <main>
                {{ $slot }}
            </main>
        </div>
        <footer class="flex justify-center items-center space-x-4 py-5">
            <a class="hover:text-red-700" href="#" >Instagram</a>
            <a class="hover:text-red-700" href="#" >Twitter</a>
            <a class="hover:text-red-700" href="#" >Facebook</a>
        </footer>
    </div>
</body>

</html>
