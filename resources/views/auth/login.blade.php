@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
       
                <div class="login-box">
                    <div class="login-logo">
                        <a href="#" class="brand-link">
                            <img src="./img/logo.png" alt="PTC Logo" 
                                 style="opacity: .8" height="200px" width="200px">
                          </a>
                    </div>
                    <!-- /.login-logo -->
                    <div class="card">
                      <div class="card-body login-card-body">
                        <p class="login-box-msg">Sign in to start your session</p>
                  {{-- form --}}
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group row">

                        <div class="col-md-12">
                            <input id="id_num" placeholder="ID Number" type="id_num" class="form-control{{ $errors->has('id_num') ? ' is-invalid' : '' }}" name="id_num" value="{{ old('id_num') }}" required>

                            @if ($errors->has('id_num'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('id_num') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-md-12">
                            <input id="password" placeholder="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                          <div class="row">
                            <div class="col-8">
                              <div class="checkbox icheck">
                                
                                    <div class="col-md-12 ">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                
                              </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <div class="form-group row mb-0">
                                    <div class="col-md-10 offset-md-2">
                                        <button type="submit" class="btn btn-success">
                                            {{ __('Login') }}
                                        </button>
        
                                       
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                          </div>

                  
                                         
                        <p class="mb-1">
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a><br>
                            <a class="btn btn-link" href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        </p>
                        
                      </div>
                    </form>
                    {{-- form end --}}
                    </div>
                  </div>
        </div>
    </div>
</div>
@endsection
