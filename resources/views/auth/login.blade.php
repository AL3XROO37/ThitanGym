@extends('layouts.app')

@section('content')
 <!--Screen-->     
 
 <section class="screen">

    
    <div class="izq2">
        <img src="{{ asset('media/login.webp') }}" alt="">
    
    </div>

    <div class="derecha">
        <form  id="envio" class="form-registro" method="POST" action="{{ route('login') }}" >
            @csrf
            <section id="seccion-form2" >
                <h4>Ingresá</h4>
                
                <div class="box-form">
                    <h5>Escribe tu correo electrónico</h5>
                    <input type="email" name="email" id="controls" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        
                    <h5>Escribe tu contraseña</h5>
                    
                    <input type="password" name="password" id="controls" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password" >
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <a href="{{ route('login') }}">
                
                    <input type="submit" id="boton" value="Ingresar" name="boton" class="boton "  > 
                    </a>
                    <!--<p>
                        <a href="{{ route('register') }}">{{ __('¿Aún no has creado tu cuenta? Crear ') }}</a> 
                        @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}" >
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    
                    </p>   -->       
                </div>
                    
            </section>
        </form>
    </div>

</section>  


@endsection
