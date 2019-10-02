<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
	<script src="https://kit.fontawesome.com/5c36625618.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        var $j = jQuery.noConflict();
        let cartTotal = 0;
        let cartArray = [];
        let cartQuantity = 0;
        function addItem(itemid, itemprice, itemname)
        {
            if (! cartArray.includes(itemid) )
            {

                let cartElement = "<a href='#' id='i"+itemid+"' class='dropdown-item'>"+itemname+" - <span id='p"+itemid+"'>"+itemprice+"</span> gp (<span id='q"+itemid+"'>1</span>)</a>";
                $j("#cart").append(cartElement);
                cartArray.push({itemid, itemprice, itemname});
                
            } else {
                document.getElementById("p"+itemid).innerHTML = Number(document.getElementById("p"+itemid).innerHTML)+Number(itemprice);
                document.getElementById("q"+itemid).innerHTML++;
            }
            cartTotal = Number(cartTotal)+Number(itemprice);
            cartQuantity++;
            $j("#cartQuantity").text(cartQuantity);
            $j("#cartTotal").text(cartTotal);
        }

        function removeItem ()
        {
            cartQuantity--;
        }

    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css" >

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
    body {
        background-image:url('images/bg.png');
        background-repeat:no-repeat;
        background-position:top center;
        background-attachment: fixed;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md sticky-top navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span> 
                                </a>
								
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
							<li class="nav-item dropdown">
								<a href="#" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									<i class="fas fa-shopping-cart"></i><span id="cartQuantity">0</span>
								</a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" id="cart">
                                    <a class="dropdown-item" href="#">
										Cart Items
                                    </a>
                                </div>
							</li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" id="cartTotal">0</a> gp
                            </li>
                            <li class="nav-item">
                                <form method="get" action="order/" id="checkout">
                                    @csrf
                                    
                                    <input id="cartJSON" name="cartJSON" type="hidden" value="" />

                                    <a href="#" onclick="goToCheckout()" class="nav-link">Checkout</a>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
		
            @yield('content')
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<script>
    function goToCheckout ()
    {

        cartArray.push({'quantity': document.getElementById("cartQuantity").innerHTML});
        cartArray.push({'total': document.getElementById("cartTotal").innerHTML});
        
        document.getElementById("cartJSON").value = JSON.stringify (cartArray, null, '');
        $j('#checkout').submit();
    }
</script>
</body>
</html>
