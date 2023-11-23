<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/app.js')}}"></script>

   
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])



</head>







<body  style="background-color: #11BBAB" class="body">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand " style="font-size: 25px;"  href="{{ url('/') }}">
                  EBOOK
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                    <a  class="nav-link "  style="font-size: 18px;"  href="/">Home</a></li>    
                            </li>

                   @auth
                 
                
                   <?php $role = Auth::user()->role; ?>
                   @if($role == 'admin')
                    <li class="nav-item">
                    <a  class="nav-link "  style="font-size: 18px;"  href="{!! route('admin.show', Auth::user()->id) !!}">{{__('My Account')   }}</a></li>    
                    </li>
                  
                    @endif  
                   
                    @if($role == 'user')
                    <li class="nav-item">
                    <a  class="nav-link "  style="font-size: 18px;"  href="{!! route('user.show', Auth::user()->id) !!}">{{__('My Account')   }}</a></li>    
                    </li>
                    @endif
                    @if($role == 'user')
                    <li class="nav-item">
                        <a  class="nav-link "  style="font-size: 18px;"  href="{!! route('user.books', Auth::user()->id) !!}">{{__('My books')   }}   </a></li>    
                                </li> 
                    <li class="nav-item">
                    <a  class="nav-link "  style="font-size: 18px;"  href="{!! route('user.credits', Auth::user()->id) !!}">{{__('My Credits')   }}   </a></li>    
                    </li>   
                                
                    @endif
                    @endauth
            
    
                   <li class="nav-item">
                    <a  class="nav-link "  style="font-size: 18px;"  href="/authors">Authors</a></li>    
                            </li> 
                        </div>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item ">
                               
                                    <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
            @yield('content')

    </div>
</body>
</html>
