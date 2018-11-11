@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="id_num" class="col-md-4 col-form-label text-md-right">{{ __('ID Number') }}</label>

                            <div class="col-md-6">
                                <input id="id_num" type="text" class="form-control{{ $errors->has('id_num') ? ' is-invalid' : '' }}" name="id_num" value="{{ old('id_num') }}" required >

                                @if ($errors->has('id_num'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('id_num') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="yearlevel" class="col-md-4 col-form-label text-md-right">{{ __('Year Level and Section') }}</label>
                                <div class="col-md-3">
                            @if(count(App\YearLevel::get()) > 0)

                                <select type="text" id="year_level" name="year_level"  class="form-control{{ $errors->has('yearlevel') ? ' is-invalid' : '' }}" required="" >
                                        <option value="">Please select your year level*</option>
                                        @foreach (App\YearLevel::get() as $yearlevel) 
                                            <option value='{{$yearlevel->id}}'>{{$yearlevel->title}}</option>
                                        @endforeach
                                </select>

                            @endif
                                </div>
                                <div class="col-md-3">
                            @if(count(App\Section::get()) > 0)

                                <select type="text" id="section" name="section" class="form-control{{ $errors->has('section') ? ' is-invalid' : '' }}"required="" >
                                        <option value="">Please select your year level*</option>
                                        @foreach (App\Section::get() as $section) 
                                            <option value='{{$section->id}}'>{{$section->title}}</option>
                                        @endforeach
                                </select>

                            @endif
                                </div>
                           
                        </div>
                        <div class="form-group row">
                                <label for="program_id" class="col-md-4 col-form-label text-md-right">{{ __('Program') }}</label>
                                <div class="col-md-6">
                            @if(count(App\Program::get()) > 0)
                                <select type="text" id="program_id" name="program_id" class="form-control{{ $errors->has('program_id') ? ' is-invalid' : '' }}" required="">
                                    <option value="">Please select your program*</option>
                                    @foreach (App\Program::get() as $program) 
                                        <option value='{{$program->id}}'>{{$program->program_code}} - {{$program->descriptive_title}}</option>
                                    @endforeach

                                </select>
                            @endif
                                </div>
                                                         
                        </div>
                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required >

                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="middlename" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>

                            <div class="col-md-6">
                                <input id="middlename" type="text" class="form-control{{ $errors->has('middlename') ? ' is-invalid' : '' }}" name="middlename" value="{{ old('middlename') }}"  >

                                @if ($errors->has('middlename'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('middlename') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required >

                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required style="text-transform: lowercase">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}

                            <div class="col-md-6">
                                <input value="123456" id="password" type="hidden" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label> --}}

                            <div class="col-md-6">
                                <input value="123456" id="password-confirm" type="hidden" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
