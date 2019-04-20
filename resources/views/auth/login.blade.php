<!DOCTYPE html>
<html lang="en">
    @include('partials.header')
    <body class="login">
        <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>
        <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <div class="image-container">
                    <img src="{{asset('images/iconos-dashboard/logoPrincipal.png')}}" class="img img-responsive" alt="">
                </div>

                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf
                    <h4>Bienvenido al centro de salud Caminal</h4>
                    <h6>Para utilizar el sistema inicia sesión</h6>

                    <div class="m-top-5vh"></div>
                    <input id="email" placeholder="Ingresa tu usuario" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    <input placeholder="Contraseña" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <div class="m-top-5vh"></div>
                <div>
                    <a class="forgot-password" href="javascript:void(0)">Olvidaste tu contraseña?</a>
                    <button type="submit" class="btn btn-login">
                            {{ __('Iniciar sesion') }}
                    </button>

                </div>

                <div class="m-top-5vh"></div>

                <div class="separator">

                    <div class="m-top-5vh"></div>
                <br />

                <div class="login-footer">
                    <span> <img class="img img-responsive loginferior" src="" alt="" srcset=""> </span>
                    <p>©2019 hecho por BV 69. <a>Terminos de uso y privcidad</a></p>
                </div>
                </div>
            </form>
            </section>
        </div>
    </body>
</html>
