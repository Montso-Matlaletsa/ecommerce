<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Team Light Blue</title>

    <!-- Scripts -->
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{ asset('css/materialize.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet" />

    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{ asset('js/materialize.min.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="navbar-fixed ">
            <nav>
                <div class="nav-wrapper black" style="opacity: 0.9">

                    <a class="brand-logo" href="{{ url('/') }}">
                        {{ config('app.name', 'Chop Shop') }}
                    </a>


                    

                    <ul class="right hide-on-med-and-down">
                        <li><a href="/">Home</a></li>

                        @guest
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="modal-trigger" href="#modal3">Register</a>
                            </li>
                        @endif

                        @if (Route::has('login'))
                        <li class="nav-item">
                           <a class="modal-trigger btn pink" href="#modal2">Login</a>
                        </li>
                    @endif
                    @else
                    <li><a href="/">Home</a></li>
                    <li><a href="/myorders">Orders</a></li>
                    <li><a href="/cart/{{Auth::user()->id}}"><i class="fa fa-2 fa-shopping-cart"></i>1</a></li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" class="grey-text" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    
                      </ul>

                </div>

            </nav>
        </div>

        <main class="py-4">
            @yield('content')
        </main>


          <!-- Modal Structure -->
  <div id="modal1" class="modal" style="">
    <div class="modal-content">
        <div class="row">
            <h6 class="col m6" id="pname"><h6>
                <h6 class="col m6 right-align" >M <span id="pri"></span ><h6>
        </div>
        <hr />


        <div class="row">
            <div class="col m6">
                <img class="blog-img" src="" id="img" width="100%" />
            </div>

            <div class="col m6">
                <p class="col m12" id="desc">

                </p>


                <div class="col m12">
                    {{ Form::open(array('url' => '/add', 'method' => 'post', 'encytype' =>'multipart/form-data' ,'files'=>'true')) }}
                        <div class="row">
                            <div class="input-field col s6" >
                                <input id="q" type="number" name="quantity" class="validate" >
                                <label for="last_name">Quantity</label>
                            </div>

                            <input type="hidden" id="p_id" value="" name="product_id" />
                            <div class="col s6 input-field">
                                @auth
                                <button class="btn pink">Add to Cart</button>
                                @endauth
                                
                                @guest
                                    Login To Purchase
                                @endguest
                            </div>
                        </div>
                    {{{ Form::close() }}}
                </div>

            </div>
        </div>
       
    </div>

</div>


  <!-- Modal Structure -->
  <div id="modal2" class="modal" style="">
    <div class="modal-content">
        <div class="row">
            <h5 class="center">Log In<h5>
       
        </div>
        <hr />


        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-field col s12">
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" autocomplete="email" required>
                <label for="email" class="col-md-4 col-form-label text-md-right">
                    {{ __('E-Mail Address') }}</label>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>


              <div class="input-field col s12">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>


        
                    
                <label>
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                    <span>Remember Me</span>
                  </label>
                  <br />
         

                  <div class="row">
                    <button type="submit" class="btn pink col m6" style="margin-top: 30px">
                        {{ __('Login') }}
                    </button>



                  </div>

                  @if (Route::has('password.request'))
                  <a class=" col m6 " href="{{ route('password.request') }}" style="margin-top: 30px;
                  margin-bottom: 30px; margin -left: 20px">
                      {{ __('Forgot Your Password?') }}
                  </a>
                  @endif


        </form>
       
    </div>

</div>



  <!-- Modal Structure -->
  <div id="modal3" class="modal" style="">
    <div class="modal-content">
        <div class="row">
            <h5 class="center">Register<h5>
       
        </div>
        <hr />


        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-field">
                <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name"  required  >
                <label for="name">{{ __('Name') }}</label>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="input-field">
            
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"  required >
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>


            <div class="input-field">
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required >
                <label for="password">{{ __('Password') }}</label>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-field">
                <input id="password-confirm" type="password" name="password_confirmation" required />
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
            </div>

            <button type="submit" class="btn col s12 purple" style="margin-bottom: 50px">
                {{ __('Register') }}
            </button>

        </form>
       
    </div>

</div>


    </div>
</body>
</html>
