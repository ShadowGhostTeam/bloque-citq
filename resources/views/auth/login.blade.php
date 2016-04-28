@extends('app')

@section('content')
<!DOCTYPE html>
<html lang="en-us">
    <meta charset="utf-8" />
        <head>
            <title>Iniciar Sesión | CITQ</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href='{{ asset('assets/img/icon.ico') }}' rel='shortcut icon'>
            <!-- BOOTSTRAP -->
            <link rel="stylesheet" href=" {{ asset('assets/css/login.css') }}">
            <link rel="stylesheet" href=" {{ asset('assets/font-awesome/css/font-awesome.css') }}">
        </head>

        <body>
            <div class="bg-login">
                 <div  style="text-align: center;">
                    <img class="logo" src="{{ asset('assets/img/citq.png') }}" alt="CITQ"><br>
                </div>

                <div class="bg-login2">
                    <div  class="headerIS" ><h4>Iniciar Sesión</h4></div>
                    <div style="width:98%; margin: auto; margin-top: 2%">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Error:</strong>

                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="login">
                        <form class="form" role="form" method="POST" action="{{ route('login') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <ul>
                                <li>
                                    <span class="un"><i class="fa fa-user fa-lg"></i></span><input type="email" class="text" name="email" value="{{ old('email') }}" placeholder="E-mail">
                                </li>

                                <li>
                                    <span class="un"><i class="fa fa-lock  fa-lg"></i></span><input type="password" class="text" name="password" placeholder="Password">
                                </li>

                                <li>
                                    <input type="submit" style="width:100%;" class="btn" value="Ingresar">
                                </li>

                                <li>
                                    <div class="span">
                                        <span class="ch"><input type="checkbox" name="remember" id="r">Recuérdame <label for="r"></label></span>
                                        <span class="ch"> <a class="letras" href="{{ url('/password/email') }}">¿Olvidaste la contraseña?</a></span>
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </body>
    </html>
@endsection
