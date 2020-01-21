@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><strong>{{ __('2fa.Two Factor Authentication') }}</strong></div>
                    <div class="card-body">
                        <p>{{__('2fa.description 2fa')}}</p>
                        <br/>
                        <p>{{__('2fa.enabled steps')}}</p>
                        <strong>
                            <ol>
                                <li>{{__('2fa.1step2fa')}}</li>
                                <li>{{__('2fa.2step2fa')}}</li>
                            </ol>
                        </strong>
                        <br/>

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif


                        @if(!$data['user']->passwordSecurity || $data['user']->passwordSecurity == null)
                            <form class="form-horizontal" method="POST" action="{{ route('generate2faSecret') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Generate Secret Key to Enable 2FA
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @elseif(!$data['user']->passwordSecurity->google2fa_enable)
                            <strong>1. Scan this barcode with your Google Authenticator App:</strong><br/>
                            <img src="{{$data['google2fa_url'] }}" alt="">
                            <br/><br/>
                            <strong>2.Enter the pin the code to Enable 2FA</strong><br/><br/>
                            <form class="form-horizontal" method="POST" action="{{ route('enable2fa') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('verify-code') ? ' has-error' : '' }}">
                                    <label for="verify-code" class="col-md-4 control-label">Authenticator Code</label>

                                    <div class="col-md-6">
                                        <input id="verify-code" type="password" class="form-control" name="verify-code" required>

                                        @if ($errors->has('verify-code'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('verify-code') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Enable 2FA
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @elseif($data['user']->passwordSecurity->google2fa_enable)
                            <div class="alert alert-success">
                                {!! __('2fa.2fa enabled noty',['status'=>__('2fa.Enabled')]) !!}
                            </div>
                            <p>{{ __('2fa.disable 2fa message') }}</p>
                            <form class="form-horizontal" method="POST" action="{{ route('disable2fa') }}">
                                <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                    <label for="change-password" class="col-md-4 control-label">{{ __('2fa.your password') }}</label>

                                    <div class="col-md-6">
                                        <input id="current-password" type="password" class="form-control" name="current-password" required>

                                        @if ($errors->has('current-password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-md-offset-5">

                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary ">{{ __('2fa.disable 2fa button') }}</button>
                                </div>
                            </form>
                            @endif
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection