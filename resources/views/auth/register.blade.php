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
                                <input id="id_num" type="text" class="form-control{{ $errors->has('id_num') ? ' is-invalid' : '' }}" name="id_num" value="{{ old('id_num') }}" required autofocus>

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
                                <select type="text" id="year_level" name="year_level"  class="form-control{{ $errors->has('yearlevel') ? ' is-invalid' : '' }}" required="" >
                                        <option value="">Please select year level*</option>
                                        <option value="First Year">First Year</option>
                                        <option value="Second Year">Second Year</option>
                                        <option value="Third Year">Third Year</option>
                                        <option value="Fourth Year">Fourth Year</option>
                                </select>
                                </div>
                                <div class="col-md-3">
                                <select type="text" id="section" name="section" class="form-control{{ $errors->has('section') ? ' is-invalid' : '' }}"required="" >
                                        <option value="">Please select section*</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="Executive">Executive</option>
                                </select>
                                </div>
                           
                        </div>
                        <div class="form-group row">
                                <label for="acad_program" class="col-md-4 col-form-label text-md-right">{{ __('Program') }}</label>
                                <div class="col-md-6">
                                <select type="text" id="acad_program" name="acad_program" class="form-control{{ $errors->has('acad_program') ? ' is-invalid' : '' }}" required="">
                                        <option value="">Please select your program*</option>
                                        <option value="ABA">Associate in Business Administration</option>
                                        <option value="COA">Certificate in Office Administration</option>
                                        <option value="CCS">Certificate in Computer Science</option>
                                        <option value="CHRM">Certificate in Hotel and Restaurant Management</option>
                                        <option value="BSIT">Bachelor of Science in Information Technology</option>
                                        <option value="BSOA">Bachelor of Science in Office Administration</option>
                                        <option value="BSIT-EXEC">Executive - Bachelor of Science in Information Technology</option>
                                        <option value="BSOA-EXEC">Executive - Bachelor of Science in Office Administration </option>
                                </select>
                                </div>
                                                         
                        </div>
                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required autofocus>

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
                                <input id="middlename" type="text" class="form-control{{ $errors->has('middlename') ? ' is-invalid' : '' }}" name="middlename" value="{{ old('middlename') }}"  autofocus>

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
                                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required autofocus>

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
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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
