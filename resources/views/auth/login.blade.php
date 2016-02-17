@extends('app')

@section('content')
<!DOCTYPE html>
<html lang="en-us">
    <meta charset="utf-8" />
        <head>
            <title>Iniciar Sesión | DocumentaQro</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!-- BOOTSTRAP -->
            <link rel="stylesheet" href=" {{ asset('assets/css/login.css') }}">
            <link rel="stylesheet" href=" {{ asset('assets/font-awesome/css/font-awesome.css') }}">
        </head>

        <body>
                @if (count($errors) > 0)
                    <div class="alert alert-danger" style="text-align: center">
                        <strong>Error!</strong> {{trans('validation.attributes.errores')  }} <br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                 <div>
                    <div  style="text-align: center;">
                        <img class="logo" src="{{ asset('assets/img/DQ.png') }}" alt="DocumentaQro"><br>
                    </div>



                    <div style="width:400px; margin:auto; background:#221E1F; margin-top:25px;">
                       <div  class="headerIS" ><h4>Login</h4></div>
                         <div class="login">

					  <form class="form" role="form" method="POST" action="{{ route('login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <ul>
                            <li>
                                <span class="un"><i class="fa fa-user fa-lg"></i></span><input type="email" class="text" name="email" value="{{ old('email') }}" placeholder="E-mail">
                            </li>

                            <li>
                                <span class="un"><i class="fa fa-lock  fa-lg"></i></span><input type="password" class="text" name="password" placeholder="{{trans('validation.attributes.contrasena')  }}">
                            </li>

                            <li>
                                <input type="submit" style="width:100%;" class="btn" value="{{trans('validation.attributes.ingresar')  }}">
                            </li>

                            <li><div class="span"><span class="ch"><input type="checkbox" name="remember" id="r">{{trans('validation.attributes.recuerdame')  }} <label for="r"></label></span>
                                    <span class="ch"> <a class="letras" href="{{ url('/password/email') }}">{{trans('validation.attributes.olvidastecontrasena')  }} </a></span></div></li>
                        </ul>
					</form>

				</div>
			</div>
           </div>
        </body>
    </html>
@endsection
