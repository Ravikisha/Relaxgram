<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Title --}}
    <title>{{ config('app.name', 'Relax') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/add.css') }}">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />


</head>

<body>
    <div id="app">

        <!-- Header section -->
        {{-- <nav class="navbar fixed-top navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <a href="{{ url('/') }}" class="navbar-brand">
                    <img src="{{asset('img/cleanlogo.png')}}" alt="InstaClone Logo" >
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar5">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse collapse justify-content-stretch" id="navbar5">

                    <form action="/search" method="POST" role="search" class="m-auto d-inline w-80">
                        @csrf
                        <div class="input-group">
                            <input class="form-control" name="q" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit" style="border-color: #ced4da"><i class="fas fa-search"></i></button>
                        </div>
                    </form>

                    <ul class="navbar-nav">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item px-2 {{ Route::is('post.index') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/') }}">
                                    <i class="fas fa-home fa-2x"></i>
                                </a>
                            </li>
                            <li class="nav-item px-2 {{ Route::is('post.explore') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/explore') }}">
                                    <i class="far fa-compass fa-2x"></i>
                                </a>
                            </li>
                            <li class="nav-item px-2 {{ Route::is('chatify') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/chatify') }}">
                                    <i class="far fa-message fa-2x"></i>
                                </a>
                            </li>

                            <li class="nav-item pl-2">
                                <a href="/profile/{{Auth::user()->username}}" class="nav-link" style="width: 42px; height: 22px; padding-top: 6px;" >
                                    <img src="{{ asset(Auth::user()->profile->getProfileImage())  }}" class="rounded-circle w-100">

                                </a>
                            </li>



                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre></a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                        @can('update', Auth::user()->profile)
                                            <a class="dropdown-item" href="/p/create" role="button">
                                                Add New Post
                                            </a>
                                        @endcan

                                        @can('update', Auth::user()->profile)
                                            <a class="dropdown-item" href="/stories/create" role="button">
                                                Add New Story
                                            </a>
                                        @endcan

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>


                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}
        <div class="content">
            <div class="sidebar ">
                <header class="sidebar-header">
                    <img class="logo-img" src="/public/imgs/logo.svg" />
                    <i class="logo-icon uil uil-instagram"></i>
                </header>
                <nav>
                    <button class="h-[60px] bg-transparent b-0  p-0 cursor-pointer text-inherit">
                        <span>
                            <i class="uil uil-estate"></i>
                            <span>Home</span>
                        </span>
                    </button>
                    <button class="h-[60px] bg-transparent b-0  p-0 cursor-pointer text-inherit"
                        onclick="onClkSearchBtn()">
                        <span>
                            <i class="uil uil-search"></i>
                            <span>Search</span>
                        </span>
                    </button>
                    <button class="h-[60px] bg-transparent b-0  p-0 cursor-pointer text-inherit">
                        <span>
                            <i class="uil uil-compass"></i>
                            <span>Explore</span>
                        </span>
                    </button>

                    <button class="h-[60px] bg-transparent b-0  p-0 cursor-pointer text-inherit" type="button"
                        data-modal-toggle="defaultModal">
                        <span>
                            <i class="uil uil-plus-circle"> </i>
                            <span>Create</span>
                        </span>
                    </button>

                    <div id="defaultModal" tabindex="-1" aria-hidden="true"
                        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                        <div class="relative w-full h-full max-w-2xl md:h-auto">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <div class="flex justify-center">
                                    <span class="text-black text-base py-3 font-medium">Create New Post</span>
                                </div>

                                <hr>

                                <div class="drag-area flex flex-col justify-center items-center h-[400px] gap-4">
                                    <i class="fa-solid fa-photo-film text-black text-[100px]"></i>
                                    <span>Drag photos and videos here</span>
                                    <input type="file" hidden>
                                    <button
                                        class="m-0 bg-slate-800 text-white rounded-md p-2 text-[0.8rem] font-normal transition-all hover:bg-slate-600">Select
                                        from computer</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="h-[60px] bg-transparent b-0  p-0 cursor-pointer text-inherit">
                        <span>
                            <i class="uil uil-location-arrow">
                                <span>13</span>
                            </i>
                            <span>Messages</span>
                        </span>
                    </button>
                    <button class="h-[60px] bg-transparent b-0  p-0 cursor-pointer text-inherit">
                        <span>
                            <i class="uil uil-heart">
                                <em></em>
                            </i>
                            <span>Notifications</span>
                        </span>
                    </button>
                    <button class="h-[60px] bg-transparent b-0  p-0 cursor-pointer text-inherit">
                        <span>
                            <img class="rounded-full object-cover" src="/public/imgs/logo.jpg" />
                            <span>Profile</span>
                        </span>
                    </button>
                    <button id="actions-modal"
                        class="relative h-[60px] bg-transparent b-0 p-0 mt-auto cursor-pointer text-inherit"
                        onclick="onClkMoreActionBtn()" data-modal-toggle="crypto-modal">

                        <div id="crypto-modal" tabindex="-1" aria-hidden="true"
                            class="absolute bottom-16 hidden w-[110%] cypto-modal-slidedown-animation  overflow-visible">
                            <div class="relative w-[400px] max-w-md md:h-auto">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-xl modal-shadow dark:bg-gray-700">

                                    <!-- Modal body -->
                                    <ul class="my-4 z-10">
                                        <li>
                                            <a href="#"
                                                class="flex items-center justify-between px-3 py-[0.4rem] text-base font-normal text-gray-900 bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white border-b">
                                                <p class="ml-3 whitespace-nowrap">Settings</p>
                                                <p class="uil uil-setting text-[24px]"></p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex items-center justify-between px-3 py-[0.4rem] text-base font-normal text-gray-900 bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white border-b">
                                                <p class="ml-3 whitespace-nowrap">Saved</p>
                                                <p class="uil uil-bookmark text-[24px]"></p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex items-center justify-between px-3 py-[0.4rem] text-base font-normal text-gray-900 bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white border-b">
                                                <p class="ml-3 whitespace-nowrap">Switch appearance</p>
                                                <p class="uil uil-moon text-[24px]"></p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex items-center justify-between px-3 py-[0.4rem] text-base font-normal text-gray-900 bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white border-b">
                                                <p class="ml-3 whitespace-nowrap">Your activiy</p>
                                                <p class="uil uil-clock text-[24px]"></p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex items-center justify-between px-3 py-[0.4rem] text-base font-normal text-gray-900 bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white border-b">
                                                <p class="ml-3 whitespace-nowrap">Report a problem</p>
                                                <p class="uil uil-bug text-[24px]"></p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex items-center px-3 py-[0.4rem] text-base font-normal text-gray-900 bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white border-b">
                                                <p class="ml-3 whitespace-nowrap">Switch accounts</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex items-center px-3 py-[0.4rem] text-base font-normal text-gray-900 bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white border-b">
                                                <p class="ml-3 whitespace-nowrap">Log out</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <span>
                            <i class="uil uil-bars"> </i>
                            <span>More</span>
                        </span>

                    </button>
                </nav>
            </div>

            <div
                class="searchbar hide-searchBar fixed rounded-r-2xl h-full transition-all border-r bg-white translate-x-[4.5rem] z-10">

                <div class="py-7 space-y-7 px-3">
                    <span class="text-xl px-3  fetween px-5 my-3 font-semibold">

                        <span>Recent</span>
                        <span class="text-blue-500">Clear all</span>
                </div>

                <div class="box">
                    <div class="list">
                        <div class="imgBx">
                            <img src="/public/" alt="">
                        </div>
                        <div class="content">
                            <h2 class="rank"><small>#</small>1</h2>
                            <h4>Pawan Gupta</h4>
                            <p>React Front End Developer</p>
                        </div>
                    </div>
                    <div class="list">
                        <div class="imgBx">
                            <img src="/public/imgs/shruti.jpg" alt="">
                        </div>
                        <div class="content">
                            <h2 class="rank"><small>#</small>2</h2>
                            <h4>Shruti Jha</h4>
                            <p>Assistent Backend Support</p>
                        </div>
                    </div>
                    <div class="list">
                        <div class="imgBx">
                            <img src="/public/imgs/divya.jpg" alt="">
                        </div>
                        <div class="content">
                            <h2 class="rank"><small>#</small>3</h2>
                            <h4>Divya</h4>
                            <p>UI / UX Designer</p>
                        </div>
                    </div>
                    <div class="list">
                        <div class="imgBx">
                            <img src="/public/imgs/ravi.jpg" alt="">
                        </div>
                        <div class="content">
                            <h2 class="rank"><small>#</small>4</h2>
                            <h4>Ravi Kishan</h4>
                            <p>Full Stack Developer</p>
                        </div>
                    </div>

                    <div class="list">
                        <div class="imgBx">
                            <img src="/public/imgs/mayur.jpg" alt="">
                        </div>
                        <div class="content">
                            <h2 class="rank"><small>#</small>5</h2>
                            <h4>Mayur Gupta</h4>
                            <p>Gandu</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="holding">
                <div class="blank-section"></div>
                <div class="post-section ">
                    <div class="flex flex-col gap-5 items-center justify-center">

                        <div class="max-w-[500px] pt-4 bg-white border rounded-md border-gray-300 shadow-md">

                            <section>
                                <!-- Post Header Section -->
                                <div class="px-3 pb-3 flex items-center justify-between border-b rounded-b-md">
                                    <div class="flex items-center space-x-3">
                                        <img class="rounded-full  h-[35px] w-[35px] object-cover"
                                            src="/public/imgs/logo.jpg" alt="avatar" />
                                        <p class="text-sm font-semibold">pawan_13g</p>
                                    </div>
                                    <i class="fa-solid fa-ellipsis-vertical rotate-90 text-lg mx-1"></i>
                                </div>

                                <!-- Post IMG Section -->
                                <div class="flex justify-center">
                                    <img class="rounded-[2px] object-cover" src="/public/imgs/post.jpeg"
                                        alt="">
                                </div>

                                <!-- Actions Section -->
                                <div class="px-2 text-xs space-y-2">

                                    <!-- Like Share Comment Icon Section -->
                                    <section class="flex my-2 items-center justify-between text-[20px]">
                                        <div class="space-x-2">
                                            <i class="fa-regular fa-heart hover:text-gray-500"></i>
                                            <i class="fa-regular fa-comment hover:text-gray-500"></i>
                                            <i class="fa-solid fa-share hover:text-gray-500"></i>
                                        </div>
                                        <i class="fa-regular fa-bookmark hover:text-gray-500 mx-1"></i>
                                    </section>

                                    <!-- Liked By -->
                                    <section class="flex items-center space-x-2 text-[#131616]">
                                        <img class="h-[20px] w-[20px] rounded-full" src="/public/imgs/logo.jpg"
                                            alt="">
                                        <span class="flex">Liked by <p class="font-bold">&nbsp;Ravi Kishan&nbsp;</p>
                                            and 1,687 others</span>
                                    </section>

                                    <!-- View Caption Section  -->
                                    <section class="">
                                        <span class="flex items-center">
                                            <span class="font-bold">Pawan Gupta&nbsp;</span>
                                            Ladki pat gyi yay 😍
                                        </span>
                                    </section>

                                    <!-- View Comment Section  -->
                                    <section class="space-y-2">
                                        <p class="text-gray-400 cursor-pointer">View all 96 comments</p>

                                        <div class="space-y-1">
                                            <span class="flex">
                                                <p class="font-bold">Ravi Kishan&nbsp; </p>
                                                <p>Oye Hoye Nikal Padi 😛</p>
                                            </span>
                                            <span class="flex">
                                                <p class="font-bold">Mayur Gupta&nbsp; </p>
                                                <p>Teri bhe gf bngyi 😭</p>
                                            </span>
                                        </div>

                                        <p class="text-gray-400 text-[10px]">4 HOURS AGO</p>
                                    </section>

                                </div>

                            </section>


                            <!-- Add Comment Comment Section -->
                            <section class="my-2">
                                <hr>
                                <div class="p-3 text-[20px] flex items-center justify-between">
                                    <i class="fa-regular fa-face-smile hover:text-gray-500"></i>
                                    <input
                                        class="comment-input outline-none appearance-none border-none mx-2 w-[100%] text-base"
                                        type="text" value="" placeholder="Add a comment">

                                    <p class="text-blue-500 font-semibold text-sm cursor-default">Post</p>

                                </div>
                            </section>

                        </div>
                        <div class="max-w-[500px] pt-4 bg-white border rounded-md">

                            <section>

                                <!-- Post Header Section -->

                                <div class="px-3 pb-3 flex items-center justify-between border-b rounded-b-md">
                                    <div class="flex items-center space-x-3">
                                        <img class="rounded-full  h-[35px] w-[35px] object-cover"
                                            src="/public/imgs/logo.jpg" alt="avatar" />
                                        <p class="text-sm font-semibold">pawan_13g</p>
                                    </div>
                                    <i class="fa-solid fa-ellipsis-vertical rotate-90 text-lg mx-1"></i>
                                </div>

                                <!-- Post IMG Section -->
                                <div class="flex justify-center">
                                    <img class="rounded-[2px] object-cover" src="/public/imgs/post.jpeg"
                                        alt="">
                                </div>

                                <!-- Actions Section -->
                                <div class="px-2 text-xs space-y-2">

                                    <!-- Like Share Comment Icon Section -->
                                    <section class="flex my-2 items-center justify-between text-[20px]">
                                        <div class="space-x-2">
                                            <i class="fa-regular fa-heart hover:text-gray-500"></i>
                                            <i class="fa-regular fa-comment hover:text-gray-500"></i>
                                            <i class="fa-solid fa-share hover:text-gray-500"></i>
                                        </div>
                                        <i class="fa-regular fa-bookmark hover:text-gray-500 mx-1"></i>
                                    </section>

                                    <!-- Liked By -->
                                    <section class="flex items-center space-x-2 text-[#131616]">
                                        <img class="h-[20px] w-[20px] rounded-full" src="/public/imgs/logo.jpg"
                                            alt="">
                                        <span class="flex">Liked by <p class="font-bold">&nbsp;Ravi Kishan&nbsp;</p>
                                            and 1,687 others</span>
                                    </section>

                                    <!-- View Caption Section  -->
                                    <section class="">
                                        <span class="flex items-center">
                                            <span class="font-bold">Pawan Gupta&nbsp;</span>
                                            Ladki pat gyi yay 😍
                                        </span>
                                    </section>

                                    <!-- View Comment Section  -->
                                    <section class="space-y-2">
                                        <p class="text-gray-400 cursor-pointer">View all 96 comments</p>

                                        <div class="space-y-1">
                                            <span class="flex">
                                                <p class="font-bold">Ravi Kishan&nbsp; </p>
                                                <p>Oye Hoye Nikal Padi 😛</p>
                                            </span>
                                            <span class="flex">
                                                <p class="font-bold">Mayur Gupta&nbsp; </p>
                                                <p>Teri bhe gf bngyi 😭</p>
                                            </span>
                                        </div>

                                        <p class="text-gray-400 text-[10px]">4 HOURS AGO</p>
                                    </section>

                                </div>

                            </section>


                            <!-- Add Comment Comment Section -->
                            <section class="my-2">
                                <hr>
                                <div class="p-3 text-[20px] flex items-center justify-between">
                                    <i class="fa-regular fa-face-smile hover:text-gray-500"></i>
                                    <input
                                        class="comment-input outline-none appearance-none border-none mx-2 w-[100%] text-base"
                                        type="text" value="" placeholder="Add a comment">

                                    <p class="text-blue-500 font-semibold text-sm cursor-default">Post</p>

                                </div>
                            </section>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content section -->
        <div class="pt-3 mt-5">
            @yield('content')
        </div>

    </div>

    @yield('exscript')

</body>

</html>
