@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update',$user->user_id)}} " enctype = "multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label for="dept_name" class="col-md-4 col-form-label text-md-right">{{ __('Department Name') }}</label>

                            <div class="col-md-6">
                                <input id="dept_name" type="text" class="form-control @error('dept_name') is-invalid @enderror" name="dept_name" value="{{$user->dept_name}}" required autocomplete="dept_name" autofocus>

                                @error('dept_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hall_name" class="col-md-4 col-form-label text-md-right">{{ __('Hall Name') }}</label>

                            <div class="col-md-6">
                                <input id="hall_name" type="text" class="form-control @error('hall_name') is-invalid @enderror" name="hall_name" value="{{ $user->hall_name }}" required autocomplete="hall_name" autofocus>

                                @error('hall_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Provost -->
                        @if(Auth::user()->user_type == 1)
                            <div class="form-group row">
                                <label for="dept_post" class="col-md-4 col-form-label text-md-right">{{ __('Post in Department') }}</label>

                                <div class="col-md-6">
                                    <input id="dept_post" type="text" class="form-control @error('dept_post') is-invalid @enderror" name="dept_post" value="{{ $user->dept_post }}" required autocomplete="dept_post" autofocus>

                                    @error('dept_post')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hall_post" class="col-md-4 col-form-label text-md-right">{{ __('Post in Hall') }}</label>

                                <div class="col-md-6">
                                    <input id="hall_post" type="text" class="form-control @error('hall_post') is-invalid @enderror" name="hall_post" value="{{ $user->hall_post }}" required autocomplete="hall_post" autofocus>

                                    @error('hall_post')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        <!-- Student -->
                        @else
                            <div class="form-group row">
                                <label for="reg_number" class="col-md-4 col-form-label text-md-right">{{ __('Registration Number') }}</label>

                                <div class="col-md-6">
                                    <input id="reg_number" type="text" required pattern="[0-9]{10}" class="form-control @error('reg_number') is-invalid @enderror" name="reg_number" value="{{ $user->reg_number }}" required autocomplete="reg_number" autofocus>

                                    @error('reg_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hall_id" class="col-md-4 col-form-label text-md-right">{{ __('Hall Id') }}</label>

                                <div class="col-md-6">
                                    <input id="hall_id" type="text" class="form-control @error('hall_id') is-invalid @enderror" name="hall_id" value="{{ $user->hall_id }}" required autocomplete="hall_id" autofocus>

                                    @error('hall_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        @endif

                        <div class="form-group row">
                            <label for="blood_group" class="col-md-4 col-form-label text-md-right">{{ __('Blood Group') }}</label>

                            <div class="col-md-6">
                                <input id="blood_group" type="text" class="form-control @error('blood_group') is-invalid @enderror" name="blood_group" value="{{ $user->blood_group }}" required autocomplete="blood_group" autofocus>

                                @error('blood_group')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phn_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phn_number" type="tel"  class="form-control @error('phn_number') is-invalid @enderror" name="phn_number" value="{{ $user->phn_number }}" required autocomplete="phn_number" autofocus pattern="[0-9]{11}" required>

                                @error('phn_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profile_image" class="col-md-4 col-form-label text-md-right">{{ __('Profile Image') }}</label>

                            <div class="col-md-6">
                                <input type="file" name = "profile_image">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
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
