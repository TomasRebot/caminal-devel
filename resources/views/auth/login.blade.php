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
                <div>
                <img src="" alt="">
                </div>
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf
                <h3>Inicio de sesion </h3>

                    <input id="email" placeholder="Ingresa tu email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

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
                <div>
                <button type="submit" class="btn btn-login">
                        {{ __('Iniciar sesion') }}
                </button>
                <a class="reset_pass" href="javascript:void(0)">Olvidaste tu contraseña?</a>
                </div>

                <div class="clearfix"></div>

                <div class="separator">

                <div class="clearfix"></div>
                <br />

                <div>
                    <span> <img class="img img-responsive loginferior" src="" alt="" srcset=""> </span>
                    <p>©2019 hecho por BV 69. <a>Terminos de uso y privcidad</a></p>
                </div>
                </div>
            </form>
            </section>
        </div>
    </body>
</html>
