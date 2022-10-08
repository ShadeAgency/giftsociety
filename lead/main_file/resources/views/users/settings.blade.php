@php
$color = isset($settings['color']) ? $settings['color'] : 'theme-4';
    $SITE_RTL = env('SITE_RTL');
    if($SITE_RTL == ''){
        $SITE_RTL == 'off';
    }
@endphp
@push('script')
    <script>
        $(document).ready(function () {
            if ($('.gdpr_fulltime').is(':checked') ) {

                $('.fulltime').show();
            } else {

                $('.fulltime').hide();
            }

            $('#gdpr_cookie').on('change', function() {
                if ($('.gdpr_fulltime').is(':checked') ) {

                    $('.fulltime').show();
                } else {

                    $('.fulltime').hide();
                }
            });
        });

    </script>
     <script>
       var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300,

    })
   $(".list-group-item").click(function(){
          $('.list-group-item').filter(function(){
                return this.href == id;
        }).parent().removeClass('text-primary');
    });

    function check_theme(color_val) {
            $('.theme-color').prop('checked', false);
            $('input[value="'+color_val+'"]').prop('checked', true);
            $('#color_value').val(color_val);
        }

</script>
    @endpush
@extends('layouts.admin')

@section('title')
    {{ __('Site Settings') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">{{__('Settings')}}</li>
@endsection

@section('content')

<div class="row">
     <div class="col-sm-12">
        <div class="row">
            <div class="col-xl-3">
                <div class="card sticky-top" style="top:30px">
                    <div class="list-group list-group-flush" id="useradd-sidenav">
                        <a href="#site-setting" class="list-group-item list-group-item-action border-0">{{__('Site Settings')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                        <a href="#payment-setting" class="list-group-item list-group-item-action border-0">{{__('Payment Settings')}}<div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                        <a href="#recaptcha-setting" class="list-group-item list-group-item-action border-0">{{__('ReCaptcha Setting')}}<div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <div class="card" id="site-setting">
                    
                    <div class="card-body">
                        <h4 class="header-title mb-3">{{__('Site Settings')}}</h4>
                        <form method="post" action="{{route('settings.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h5>{{('System Setting')}}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mt-4">
                                        <div class="col-md-6 form-group">
                                            <label for="logo" class="col-form-label text-dark">{{ __('Favicon') }}</label>
                                            <div class="choose-files mt-5 ">
                                                <label for="favicon">
                                                    <div class=" bg-primary favicon_update"> <i class="ti ti-upload px-1"></i>{{__('Choose file here')}}</div>
                                                    <input type="file" class="form-control file" name="favicon" id="favicon" data-filename="favicon_update">
                                                </label>
                                            </div>
                                            <p class="favicon_update text-xs"></p>
                                            @if ($errors->has('favicon'))
                                                <span class="invalid-feedback text-xs text-danger">{{ $errors->first('favicon') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 text-center my-auto">
                                            <img src="{{asset(Storage::url('logo/favicon.png'))}}" class="setting-img"/>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="dark_logo" class="col-form-label text-dark">{{ __('Dark Logo') }}</label>
                                                 <div class="choose-files mt-5 ">
                                                    <label for="dark_logo">
                                                        <div class=" bg-primary logo_update"> <i class="ti ti-upload px-1"></i>{{__('Choose file here')}}</div>
                                                        <input type="file" class="form-control file" name="dark_logo" id="dark_logo" data-filename="logo_update">
                                                    </label>
                                                </div>

                                                <p class="logo_update text-xs"></p>
                                                @if ($errors->has('dark_logo'))
                                                    <span class="invalid-feedback text-xs text-danger">{{ $errors->first('dark_logo') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-center my-auto">
                                            <img src="{{asset(Storage::url('logo/logo-dark.png'))}}" class="setting-img"/>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-6 form-group">
                                            <label for="light_logo" class="col-form-label text-dark">{{ __('Light Logo') }}</label>
                                            <div class="choose-files mt-5 ">
                                                <label for="landing_logo_update">
                                                    <div class=" bg-primary landing_logo_update"> <i class="ti ti-upload px-1"></i>{{__('Choose file here')}}</div>
                                                    <input type="file" class="form-control file" name="light_logo" id="landing_logo_update" data-filename="landing_logo_update">
                                                </label>
                                            </div>
                                            <p class="landing_logo_update text-xs"></p>
                                            @if ($errors->has('landing_logo'))
                                                <span class="invalid-feedback text-xs text-danger">{{ $errors->first('landing_logo') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 text-center my-auto">
                                            <img src="{{asset(Storage::url('logo/logo-light.png'))}}" class="setting-img img_setting"/>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{Form::label('header_text',__('Title Text'),['class'=>'col-form-label text-dark']) }}
                                                {{Form::text('header_text',Utility::getValByName('header_text'),array('class'=>'form-control','placeholder'=>__('Enter Header Title Text')))}}
                                                @error('header_text')
                                                <span class="invalid-header_text" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{Form::label('footer_text',__('Footer Text'),['class'=>'col-form-label text-dark']) }}
                                                {{Form::text('footer_text',Utility::getValByName('footer_text'),array('class'=>'form-control','placeholder'=>__('Enter Footer Text')))}}
                                                @error('footer_text')
                                                <span class="invalid-footer_text" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                {{Form::label('default_language',__('Default Language'),['class'=>'col-form-label text-dark']) }}
                                                <select name="default_language" id="default_language" class="form-control select2">
                                                    @foreach(Utility::languages() as $language)
                                                        <option @if(Utility::getValByName('default_language') == $language) selected @endif value="{{$language}}">{{Str::upper($language)}}</option>
                                                    @endforeach
                                                </select>
                                                @error('default_language')
                                                <span class="invalid-default_language" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-2 my-auto">
                                            <div class="form-group">
                                                 <label class="text-dark mb-1 mt-3" for="SITE_RTL">{{ __('RTL') }}</label>
                                                <div class="">
                                                    <input type="checkbox" name="SITE_RTL" id="SITE_RTL" data-toggle="switchbutton" {{ env('SITE_RTL') == 'on' ? 'checked="checked"' : '' }} data-onstyle="primary">
                                                    <label class="form-check-labe" for="SITE_RTL"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4 my-auto">

                                            <div class="form-group text-end mt-4">
                                                <label class=" text-dark " for="enable_landing">{{ __('Enable Landing Page') }}</label>
                                                <div class="form-check form-switch d-inline-block">
                                                    <input type="checkbox" value="yes" name="enable_landing" class="form-check-input" id="enable_landing" data-toggle="switchbutton" {{ (Utility::getValByName('enable_landing') == 'yes') ? 'checked' : '' }} data-onstyle="primary">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 my-auto">
                                            
                                                <div class="form-group">
                                                     <label class="text-dark mb-1 mt-3" for="signup_button">{{ __('Sign Up') }}</label>
                                                    <div class="">
                                                        <input type="checkbox" name="signup_button" id="signup_button" data-toggle="switchbutton" {{ Utility::getValByName('signup_button') == 'on' ? 'checked="checked"' : '' }} data-onstyle="primary">
                                                        <label class="form-check-labe" for="signup_button"></label>
                                                    </div>
                                                </div>
                                            
                                        </div>
                                        <div class="col-3 my-auto">
                                            <div class="form-group text-end">
                                                 <label class="text-dark mb-1 mt-3" for="gdpr_cookie">{{ __('GDPR Cookie') }}</label>
                                                <div class="">
                                                    <input type="checkbox" class="gdpr_fulltime gdpr_type" name="gdpr_cookie" id="gdpr_cookie" data-toggle="switchbutton" {{ isset($settings['gdpr_cookie']) && $settings['gdpr_cookie'] == 'on' ? 'checked="checked"' : '' }} data-onstyle="primary">
                                                    <label class="form-check-labe" for="gdpr_cookie"></label>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group col-6">
                                            {{Form::label('cookie_text',__('GDPR Cookie Text'),array('class'=>'fulltime') )}}
                                            {!! Form::textarea('cookie_text',isset($settings['cookie_text']) && $settings['cookie_text'] ? $settings['cookie_text'] : '', ['class'=>'form-control fulltime','style'=>'display: hidden;resize: none;','rows'=>'4']) !!}
                                        </div>

                                    </div>
                                    <h4 class="small-title">{{__('Theme Customizer')}}</h4>
                                    <div class="setting-card setting-logo-box p-3">
                                        <div class="row">
                                            <div class="col-4 my-auto">
                                                <h6 class="mt-3">
                                                    <i data-feather="credit-card" class="me-2"></i>{{ __('Primary color settings') }}
                                                  </h6>
                                                  <hr class="my-2" />
                                                  <div class="theme-color themes-color">
                                                    <input type="hidden" name="color" id="color_value" value="{{ $settings['color'] }}">
                                                    <a href="#!" class="{{($color =='theme-1') ? 'active_color' : ''}}" data-value="theme-1" onclick="check_theme('theme-1')"></a>
                                                    <input type="radio" class="color" name="color" value="theme-1" style="display: none;">
                                                    <a href="#!" class="{{($color =='theme-2') ? 'active_color' : ''}}" data-value="theme-2" onclick="check_theme('theme-2')"></a>
                                                    <input type="radio" class="color" name="color" value="theme-2" style="display: none;">
                                                    <a href="#!" class="{{($color =='theme-3') ? 'active_color' : ''}}" data-value="theme-3" onclick="check_theme('theme-3')"></a>
                                                    <input type="radio" class="color" name="color" value="theme-3" style="display: none;">
                                                    <a href="#!" class="{{($color =='theme-4') ? 'active_color' : ''}}" data-value="theme-4" onclick="check_theme('theme-4')"></a>
                                                    <input type="radio" class="color" name="color" value="theme-4" style="display: none;">
                                                </div>  
                                            </div>
                                            <div class="col-4 my-auto">
                                                <h6>
                                                    <i data-feather="layout" class="me-2"></i>{{__('Sidebar settings')}}
                                                  </h6>
                                                  <hr class="my-2" />
                                                  <div class="form-check form-switch">
                                                    <input type="checkbox" class="form-check-input" id="cust-theme-bg" name="cust_theme_bg" {{ Utility::getValByName('cust_theme_bg') == 'on' ? 'checked' : '' }} />
                                                    <label class="form-check-label f-w-600 pl-1" for="cust-theme-bg"
                                                      >{{__('Transparent layout')}}</label
                                                    >
                                                  </div>
                                            </div>
                                            <div class="col-4 my-auto">
                                                <h6 >
                                                  <i data-feather="sun" class="me-2"></i>{{__('Layout settings')}}
                                                </h6>
                                                <hr class="my-2" />
                                                <div class="form-check form-switch mt-2">
                                                    <input type="checkbox" class="form-check-input" id="cust-darklayout" name="cust_darklayout"{{ Utility::getValByName('cust_darklayout') == 'on' ? 'checked' : '' }} />
                                                    <label class="form-check-label f-w-600 pl-1" for="cust-darklayout">{{ __('Dark Layout') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                     
                                </div>
                                <hr>
                            </div>
                           
                            <div class="card">
                                <div class="card-header">
                                    <h5>{{('Mailer Setting')}}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mail_driver" class="col-form-label text-dark">{{ __('Mail Driver') }}</label>
                                                <input type="text" name="mail_driver" id="mail_driver" class="form-control {{ ($errors->has('mail_driver')) ? 'is-invalid' : '' }}" value="{{env('MAIL_DRIVER')}}" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_placeholder') }}"/>
                                                @if ($errors->has('mail_driver'))
                                                    <span class="invalid-feedback text-danger text-xs">
                                                    {{ $errors->first('mail_driver') }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mail_host" class="col-form-label text-dark">{{ __('Mail Host') }}</label>
                                                <input type="text" name="mail_host" id="mail_host" class="form-control {{ ($errors->has('mail_host')) ? 'is-invalid' : '' }}" value="{{env('MAIL_HOST')}}" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_host_placeholder') }}"/>
                                                @if ($errors->has('mail_host'))
                                                    <span class="invalid-feedback text-danger text-xs">
                                                    {{ $errors->first('mail_host') }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mail_port" class="col-form-label text-dark">{{ __('Mail Port') }}</label>
                                                <input type="number" name="mail_port" id="mail_port" class="form-control {{ ($errors->has('mail_port')) ? 'is-invalid' : '' }}" value="{{env('MAIL_PORT')}}" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_port_placeholder') }}"/>
                                                @if ($errors->has('mail_port'))
                                                    <span class="invalid-feedback text-danger text-xs">
                                                    {{ $errors->first('mail_port') }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mail_username" class="col-form-label text-dark">{{ __('Mail Username') }}</label>
                                                <input type="text" name="mail_username" id="mail_username" class="form-control {{ ($errors->has('mail_username')) ? 'is-invalid' : '' }}" value="{{env('MAIL_USERNAME')}}" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_username_placeholder') }}"/>
                                                @if ($errors->has('mail_username'))
                                                    <span class="invalid-feedback text-danger text-xs">
                                                    {{ $errors->first('mail_username') }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mail_password" class="col-form-label text-dark">{{ __('Mail Password') }}</label>
                                                <input type="text" name="mail_password" id="mail_password" class="form-control {{ ($errors->has('mail_password')) ? 'is-invalid' : '' }}" value="{{env('MAIL_PASSWORD')}}" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_password_placeholder') }}"/>
                                                @if ($errors->has('mail_password'))
                                                    <span class="invalid-feedback text-danger text-xs">
                                                    {{ $errors->first('mail_password') }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mail_encryption" class="col-form-label text-dark">{{ __('Mail Encryption') }}</label>
                                                <input type="text" name="mail_encryption" id="mail_encryption" class="form-control {{ ($errors->has('mail_encryption')) ? 'is-invalid' : '' }}" value="{{env('MAIL_ENCRYPTION')}}" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_placeholder') }}"/>
                                                @if ($errors->has('mail_encryption'))
                                                    <span class="invalid-feedback text-danger text-xs">
                                                {{ $errors->first('mail_encryption') }}
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mail_from_address" class="col-form-label text-dark">{{ __('Mail From Address') }}</label>
                                                <input type="text" name="mail_from_address" id="mail_from_address" class="form-control {{ ($errors->has('mail_from_address')) ? 'is-invalid' : '' }}" value="{{env('MAIL_FROM_ADDRESS')}}" placeholder="{{ __('Enter Mail From Address') }}"/>
                                                @if ($errors->has('mail_from_address'))
                                                    <span class="invalid-feedback text-danger text-xs">
                                                            {{ $errors->first('mail_from_address') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mail_from_name" class="col-form-label text-dark">{{ __('Mail From Name') }}</label>
                                                <input type="text" name="mail_from_name" id="mail_from_name" class="form-control {{ ($errors->has('mail_from_name')) ? 'is-invalid' : '' }}" value="{{env('MAIL_FROM_NAME')}}" placeholder="{{ __('Enter Mail From Name') }}"/>
                                                @if ($errors->has('mail_from_name'))
                                                    <span class="invalid-feedback text-danger text-xs">
                                                        {{ $errors->first('mail_from_name') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <a href="#" class="btn btn-print-invoice  btn-primary m-r-10" data-ajax-popup="true" data-title="{{__('Send Test Mail')}}" data-url="{{route('test.email')}}">
                                                {{__('Send Test Mail')}}
                                            </a>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>



                            <div class="card">
                                <div class="card-header">
                                    <h5>{{('Mailer Setting')}}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="">
                                                    <label class="text-dark mb-1 mt-3" for="enable_chat">{{ __('Enable Chat') }}</label>
                                                    <input type="checkbox" name="enable_chat" id="enable_chat" data-toggle="switchbutton" @if(env('CHAT_MODULE') =='yes') checked @endif value="yes" data-onstyle="primary">
                                                    <label class="form-check-labe" for="enable_chat"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pusher_app_id" class="col-form-label text-dark">{{ __('Pusher App Id') }}</label>
                                                <input type="text" name="pusher_app_id" id="pusher_app_id" class="form-control {{ ($errors->has('pusher_app_id')) ? 'is-invalid' : '' }}" value="{{env('PUSHER_APP_ID')}}" placeholder="{{ __('Pusher App Id') }}"/>
                                                @if ($errors->has('pusher_app_id'))
                                                    <span class="invalid-feedback text-danger text-xs">
                                                            {{ $errors->first('pusher_app_id') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pusher_app_key" class="col-form-label text-dark">{{ __('Pusher App Key') }}</label>
                                                <input type="text" name="pusher_app_key" id="pusher_app_key" class="form-control {{ ($errors->has('pusher_app_key')) ? 'is-invalid' : '' }}" value="{{env('PUSHER_APP_KEY')}}" placeholder="{{ __('Pusher App Key') }}"/>
                                                @if ($errors->has('pusher_app_key'))
                                                    <span class="invalid-feedback text-danger text-xs">
                                                            {{ $errors->first('pusher_app_key') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pusher_app_secret" class="col-form-label text-dark">{{ __('Pusher App Secret') }}</label>
                                                <input type="text" name="pusher_app_secret" id="pusher_app_secret" class="form-control {{ ($errors->has('pusher_app_secret')) ? 'is-invalid' : '' }}" value="{{env('PUSHER_APP_SECRET')}}" placeholder="{{ __('Pusher App Secret') }}"/>
                                                @if ($errors->has('pusher_app_secret'))
                                                    <span class="invalid-feedback text-danger text-xs">
                                                            {{ $errors->first('pusher_app_secret') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pusher_app_cluster" class="col-form-label text-dark">{{ __('Pusher App Cluster') }}</label>
                                                <input type="text" name="pusher_app_cluster" id="pusher_app_cluster" class="form-control {{ ($errors->has('pusher_app_cluster')) ? 'is-invalid' : '' }}" value="{{env('PUSHER_APP_CLUSTER')}}" placeholder="{{ __('Pusher App Cluster') }}"/>
                                                @if ($errors->has('pusher_app_cluster'))
                                                    <span class="invalid-feedback text-danger text-xs">
                                                            {{ $errors->first('pusher_app_cluster') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-xs">
                                            <a href="https://pusher.com/channels" target="_blank">{{__('You can Make Pusher channel Account from here and Get your App Id and Secret key')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    <div class="text-sm text-end">
                                        <input type="submit" value="{{__('Save Changes')}}" class="btn btn-print-invoice  btn-primary m-r-10">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card" id="payment-setting">
                    <div class="card-header">
                        <h5>{{('Payment Settings')}}</h5>
                    </div>
                    <div class="card-body">
                            <small class="text-dark font-weight-bold">{{__("This detail will use for collect payment on invoice from clients. On invoice client will find out pay now button based on your below configuration.")}}</small></br></br>
                        
                            <form id="setting-form" method="post" action="{{route('payment.settings')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                        <label class="col-form-label">{{__('Currency')}} *</label>
                                                        <input type="text" name="currency" class="form-control" id="currency" value="{{(!isset($payment['currency']) || is_null($payment['currency'])) ? '' : $payment['currency']}}" required>
                                                        <small class="text-xs">
                                                            {{ __('Note: Add currency code as per three-letter ISO code') }}.
                                                            <a href="https://stripe.com/docs/currencies" target="_blank">{{ __('you can find out here..') }}</a>
                                                        </small>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                        <label for="currency_symbol" class="col-form-label">{{__('Currency Symbol')}}</label>
                                                        <input type="text" name="currency_symbol" class="form-control" id="currency_symbol" value="{{(!isset($payment['currency_symbol']) || is_null($payment['currency_symbol'])) ? '' : $payment['currency_symbol']}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="faq justify-content-center">
                                    <div class="col-sm-12 col-md-10 col-xxl-12">
                                        <div class="accordion accordion-flush" id="accordionExample">

                                            <!-- Strip -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-2">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('Stripe') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse1" class="accordion-collapse collapse"aria-labelledby="heading-2-2"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Stripe') }}</h5>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">

                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_stripe_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_stripe_enabled" id="is_stripe_enabled" {{(isset($payment['is_stripe_enabled']) && $payment['is_stripe_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-control-label" for="is_stripe_enabled">{{__('Enable Stripe')}}</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="stripe_key" class="col-form-label">{{__('Stripe Key')}}</label>
                                                                    <input class="form-control" placeholder="{{__('Stripe Key')}}" name="stripe_key" type="text" value="{{(!isset($payment['stripe_key']) || is_null($payment['stripe_key'])) ? '' : $payment['stripe_key']}}" id="stripe_key">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="stripe_secret" class="col-form-label">{{__('Stripe Secret')}}</label>
                                                                    <input class="form-control " placeholder="{{ __('Stripe Secret') }}" name="stripe_secret" type="text" value="{{(!isset($payment['stripe_secret']) || is_null($payment['stripe_secret'])) ? '' : $payment['stripe_secret']}}" id="stripe_secret">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="stripe_secret" class="col-form-label">{{__('Stripe_Webhook_Secret')}}</label>
                                                                    <input class="form-control " placeholder="{{ __('Enter Stripe Webhook Secret') }}" name="stripe_webhook_secret" type="text" value="{{(!isset($payment['stripe_webhook_secret']) || is_null($payment['stripe_webhook_secret'])) ? '' : $payment['stripe_webhook_secret']}}" id="stripe_webhook_secret">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Paypal -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-3">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('Paypal') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse2" class="accordion-collapse collapse"aria-labelledby="heading-2-3"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Paypal') }}</h5>
                                                            </div>
                                                            

                                                            
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_paypal_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_paypal_enabled" id="is_paypal_enabled" {{(isset($payment['is_paypal_enabled']) && $payment['is_paypal_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-control-label" for="is_paypal_enabled">{{__('Enable Paypal')}}</label>
                                                                </div>
                                                            </div>
                                                           
                                                            <div class="col-md-12 pb-4">
                                                                <label class="paypal-label col-form-label" for="paypal_mode">{{__('Paypal Mode')}}</label> <br>
                                                                <div class="d-flex">
                                                                    <div class="mr-2" style="margin-right: 15px;">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio" name="paypal_mode" value="sandbox" class="form-check-input" {{ !isset($payment['paypal_mode']) || $payment['paypal_mode'] == '' || $payment['paypal_mode'] == 'sandbox' ? 'checked="checked"' : '' }}>
                                                                                
                                                                                    {{__('Sandbox')}}  
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mr-2">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio" name="paypal_mode" value="live" class="form-check-input" {{ isset($payment['paypal_mode']) && $payment['paypal_mode'] == 'live' ? 'checked="checked"' : '' }}>
                                                                                
                                                                                    {{__('Live')}}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paypal_client_id" class="col-form-label">{{ __('Client ID') }}</label>
                                                                    <input type="text" name="paypal_client_id" id="paypal_client_id" class="form-control" value="{{(!isset($payment['paypal_client_id']) || is_null($payment['paypal_client_id'])) ? '' : $payment['paypal_client_id']}}" placeholder="{{ __('Client ID') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paypal_secret_key" class="col-form-label">{{ __('Secret Key') }}</label>
                                                                    <input type="text" name="paypal_secret_key" id="paypal_secret_key" class="form-control" value="{{(!isset($payment['paypal_secret_key']) || is_null($payment['paypal_secret_key'])) ? '' : $payment['paypal_secret_key']}}" placeholder="{{ __('Secret Key') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Paystack -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-4">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('Paystack') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse3" class="accordion-collapse collapse"aria-labelledby="heading-2-4"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Paystack') }}</h5>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_paystack_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_paystack_enabled" id="is_paystack_enabled" {{(isset($payment['is_paystack_enabled']) && $payment['is_paystack_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-control-label" for="is_paystack_enabled">{{__('Enable Paystack')}}</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paypal_client_id" class="col-form-label">{{ __('Public Key')}}</label>
                                                                    <input type="text" name="paystack_public_key" id="paystack_public_key" class="form-control" value="{{(!isset($payment['paystack_public_key']) || is_null($payment['paystack_public_key'])) ? '' : $payment['paystack_public_key']}}" placeholder="{{ __('Public Key')}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paystack_secret_key" class="col-form-label">{{ __('Secret Key') }}</label>
                                                                    <input type="text" name="paystack_secret_key" id="paystack_secret_key" class="form-control" value="{{(!isset($payment['paystack_secret_key']) || is_null($payment['paystack_secret_key'])) ? '' : $payment['paystack_secret_key']}}" placeholder="{{ __('Secret Key') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                             <!-- FLUTTERWAVE -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-5">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('Flutterwave') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse4" class="accordion-collapse collapse"aria-labelledby="heading-2-5"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Flutterwave') }}</h5>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_flutterwave_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_flutterwave_enabled" id="is_flutterwave_enabled" {{(isset($payment['is_flutterwave_enabled']) && $payment['is_flutterwave_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-control-label" for="is_flutterwave_enabled">{{__('Enable Flutterwave')}}</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paypal_client_id" class="col-form-label">{{ __('Public Key')}}</label>
                                                                    <input type="text" name="flutterwave_public_key" id="flutterwave_public_key" class="form-control" value="{{(!isset($payment['flutterwave_public_key']) || is_null($payment['flutterwave_public_key'])) ? '' : $payment['flutterwave_public_key']}}" placeholder="Public Key">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paystack_secret_key" class="col-form-label">{{ __('Secret Key') }}</label>
                                                                    <input type="text" name="flutterwave_secret_key" id="flutterwave_secret_key" class="form-control" value="{{(!isset($payment['flutterwave_secret_key']) || is_null($payment['flutterwave_secret_key'])) ? '' : $payment['flutterwave_secret_key']}}" placeholder="Secret Key">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Razorpay -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-6">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('Razorpay') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse5" class="accordion-collapse collapse"aria-labelledby="heading-2-6"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Razorpay') }}</h5>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_razorpay_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_razorpay_enabled" id="is_razorpay_enabled" {{(isset($payment['is_razorpay_enabled']) && $payment['is_razorpay_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-control-label" for="is_razorpay_enabled">{{__('Enable Razorpay')}}</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paypal_client_id" class="col-form-label">Public Key</label>

                                                                    <input type="text" name="razorpay_public_key" id="razorpay_public_key" class="form-control" value="{{(!isset($payment['razorpay_public_key']) || is_null($payment['razorpay_public_key'])) ? '' : $payment['razorpay_public_key']}}" placeholder="Public Key">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paystack_secret_key" class="col-form-label">Secret Key</label>
                                                                    <input type="text" name="razorpay_secret_key" id="razorpay_secret_key" class="form-control" value="{{(!isset($payment['razorpay_secret_key']) || is_null($payment['razorpay_secret_key'])) ? '' : $payment['razorpay_secret_key']}}" placeholder="Secret Key">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Paytm -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-7">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('Paytm') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse6" class="accordion-collapse collapse"aria-labelledby="heading-2-7"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Paytm') }}</h5>
                                                            </div>

                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_paytm_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_paytm_enabled" id="is_paytm_enabled" {{(isset($payment['is_paytm_enabled']) && $payment['is_paytm_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-control-label" for="is_paytm_enabled">{{__('Enable Paytm')}}</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 pb-4">
                                                                <label class="paypal-label col-form-label" for="paypal_mode">Paytm Environment</label> <br>
                                                                <div class="d-flex">
                                                                    <div class="mr-2" style="margin-right: 15px;">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">

                                                                                    <input type="radio" name="paytm_mode" value="local" class="form-check-input" {{ !isset($payment['paytm_mode']) || $payment['paytm_mode'] == '' || $payment['paytm_mode'] == 'local' ? 'checked="checked"' : '' }}>
                                                                                
                                                                                    {{__('Local')}}  
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mr-2">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio" name="paytm_mode" value="production" class="form-check-input" {{ isset($payment['paytm_mode']) && $payment['paytm_mode'] == 'production' ? 'checked="checked"' : '' }}>
                                                                                
                                                                                    {{__('Production')}}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="paytm_public_key" class="col-form-label">Merchant ID</label>
                                                                    <input type="text" name="paytm_merchant_id" id="paytm_merchant_id" class="form-control" value="{{(!isset($payment['paytm_merchant_id']) || is_null($payment['paytm_merchant_id'])) ? '' : $payment['paytm_merchant_id']}}" placeholder="Merchant ID">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="paytm_secret_key" class="col-form-label">Merchant Key</label>
                                                                    <input type="text" name="paytm_merchant_key" id="paytm_merchant_key" class="form-control" value="{{(!isset($payment['paytm_merchant_key']) || is_null($payment['paytm_merchant_key'])) ? '' : $payment['paytm_merchant_key']}}" placeholder="Merchant Key">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="paytm_industry_type" class="col-form-label">Industry Type</label>
                                                                    <input type="text" name="paytm_industry_type" id="paytm_industry_type" class="form-control" value="{{(!isset($payment['paytm_industry_type']) || is_null($payment['paytm_industry_type'])) ? '' : $payment['paytm_industry_type']}}" placeholder="Industry Type">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Mercado Pago-->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-8">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="true" aria-controls="collapse7">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('Mercado Pago') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse7" class="accordion-collapse collapse"aria-labelledby="heading-2-8"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Mercado Pago') }}</h5>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_mercado_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_mercado_enabled" id="is_mercado_enabled" {{(isset($payment['is_mercado_enabled']) && $payment['is_mercado_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-control-label" for="is_mercado_enabled">{{__('Enable Mercado Pago')}}</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 pb-4">
                                                                <label class="coingate-label col-form-label" for="mercado_mode">{{__('Mercado Mode')}}</label> <br>
                                                                <div class="d-flex">
                                                                    <div class="mr-2" style="margin-right: 15px;">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio" name="mercado_mode" value="sandbox" class="form-check-input" {{ isset($payment['mercado_mode']) && $payment['mercado_mode'] == '' || isset($payment['mercado_mode']) && $payment['mercado_mode'] == 'sandbox' ? 'checked="checked"' : '' }}>
                                                                                    {{__('Sandbox')}}  
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mr-2">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio" name="mercado_mode" value="live" class="form-check-input" {{ isset($payment['mercado_mode']) && $payment['mercado_mode'] == 'live' ? 'checked="checked"' : '' }}>
                                                                                    {{__('Live')}}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="mercado_access_token" class="col-form-label">{{ __('Access Token') }}</label>
                                                                    <input type="text" name="mercado_access_token" id="mercado_access_token" class="form-control" value="{{isset($payment['mercado_access_token']) ? $payment['mercado_access_token']:''}}" placeholder="{{ __('Access Token') }}"/>                                                        
                                                                    @if ($errors->has('mercado_secret_key'))
                                                                        <span class="invalid-feedback d-block">
                                                                            {{ $errors->first('mercado_access_token') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Mollie -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-9">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="true" aria-controls="collapse8">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('Mollie') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse8" class="accordion-collapse collapse"aria-labelledby="heading-2-9"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Mollie') }}</h5>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_mollie_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_mollie_enabled" id="is_mollie_enabled" {{(isset($payment['is_mollie_enabled']) && $payment['is_mollie_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-control-label" for="is_mollie_enabled">{{__('Enable Mollie')}}</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="mollie_api_key" class="col-form-label">Mollie Api Key</label>
                                                                    <input type="text" name="mollie_api_key" id="mollie_api_key" class="form-control" value="{{(!isset($payment['mollie_api_key']) || is_null($payment['mollie_api_key'])) ? '' : $payment['mollie_api_key']}}" placeholder="Mollie Api Key">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="mollie_profile_id" class="col-form-label">Mollie Profile Id</label>
                                                                    <input type="text" name="mollie_profile_id" id="mollie_profile_id" class="form-control" value="{{(!isset($payment['mollie_profile_id']) || is_null($payment['mollie_profile_id'])) ? '' : $payment['mollie_profile_id']}}" placeholder="Mollie Profile Id">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="mollie_partner_id" class="col-form-label">Mollie Partner Id</label>
                                                                    <input type="text" name="mollie_partner_id" id="mollie_partner_id" class="form-control" value="{{(!isset($payment['mollie_partner_id']) || is_null($payment['mollie_partner_id'])) ? '' : $payment['mollie_partner_id']}}" placeholder="Mollie Partner Id">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Skrill -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-10">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="true" aria-controls="collapse9">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('Skrill') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse9" class="accordion-collapse collapse"aria-labelledby="heading-2-10"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('Skrill') }}</h5>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_skrill_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_skrill_enabled" id="is_skrill_enabled" {{(isset($payment['is_skrill_enabled']) && $payment['is_skrill_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-control-label" for="is_skrill_enabled">{{__('Enable Skrill')}}</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="mollie_api_key" class="col-form-label">Skrill Email</label>
                                                                    <input type="text" name="skrill_email" id="skrill_email" class="form-control" value="{{(!isset($payment['skrill_email']) || is_null($payment['skrill_email'])) ? '' : $payment['skrill_email']}}" placeholder="Enter Skrill Email">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- CoinGate -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-11">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('CoinGate') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse10" class="accordion-collapse collapse"aria-labelledby="heading-2-11"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('CoinGate') }}</h5>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_coingate_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_coingate_enabled" id="is_coingate_enabled" {{(isset($payment['is_coingate_enabled']) && $payment['is_coingate_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-control-label" for="is_coingate_enabled">{{__('Enable CoinGate')}}</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 pb-4">
                                                                <label class="col-form-label" for="coingate_mode">CoinGate Mode</label> <br>
                                                                <div class="d-flex">
                                                                    <div class="mr-2" style="margin-right: 15px;">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">

                                                                                    <input type="radio" name="coingate_mode" value="sandbox" class="form-check-input" {{ !isset($payment['coingate_mode']) || $payment['coingate_mode'] == '' || $payment['coingate_mode'] == 'sandbox' ? 'checked="checked"' : '' }}>

                                                                                    {{__('Sandbox')}}  
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mr-2">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio" name="coingate_mode" value="live" class="form-check-input" {{ isset($payment['coingate_mode']) && $payment['coingate_mode'] == 'live' ? 'checked="checked"' : '' }}>
                                                                                    {{__('Live')}}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="coingate_auth_token" class="col-form-label">CoinGate Auth Token</label>
                                                                    <input type="text" name="coingate_auth_token" id="coingate_auth_token" class="form-control" value="{{(!isset($payment['coingate_auth_token']) || is_null($payment['coingate_auth_token'])) ? '' : $payment['coingate_auth_token']}}" placeholder="CoinGate Auth Token">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- PaymentWall -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-12">
                                                    <button class="accordion-button"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="true" aria-controls="collapse11">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i> {{ __('PaymentWall') }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse11" class="accordion-collapse collapse"aria-labelledby="heading-2-12"data-bs-parent="#accordionExample" >
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                <h5 class="h5">{{ __('PaymentWall') }}</h5>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch d-inline-block">
                                                                    <input type="hidden" name="is_paymentwall_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input" name="is_paymentwall_enabled" id="is_paymentwall_enabled" {{(isset($payment['is_paymentwall_enabled']) && $payment['is_paymentwall_enabled'] == 'on') ? 'checked' : ''}}>
                                                                    <label class="custom-control-label form-control-label" for="is_paymentwall_enabled">{{__('Enable PaymentWall')}}</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paymentwall_public_key" class="col-form-label">{{ __('Public Key')}}</label>
                                                                    <input type="text" name="paymentwall_public_key" id="paymentwall_public_key" class="form-control" value="{{(!isset($payment['paymentwall_public_key']) || is_null($payment['paymentwall_public_key'])) ? '' : $payment['paymentwall_public_key']}}" placeholder="{{ __('Public Key')}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paymentwall_private_key" class="col-form-label">{{ __('Private Key') }}</label>
                                                                    <input type="text" name="paymentwall_private_key" id="paymentwall_private_key" class="form-control" value="{{(!isset($payment['paymentwall_private_key']) || is_null($payment['paymentwall_private_key'])) ? '' : $payment['paymentwall_private_key']}}" placeholder="{{ __('Private Key') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <div class="form-group">
                                        <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="{{__('Save Changes')}}">
                                    </div>
                                </div>
                            </form>
                        </div>
                    
                </div>
                
                <div class="card" id="recaptcha-setting">
                
                    <div class="card-header">
                        <h5>{{('ReCaptcha Setting')}}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('recaptcha.settings.store') }}" accept-charset="UTF-8">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                             
                                        <div class="">
                                            
                                            <input type="checkbox" name="recaptcha_module" id="recaptcha_module" data-toggle="switchbutton" {{ env('RECAPTCHA_MODULE') == 'yes' ? 'checked="checked"' : '' }} value="yes" data-onstyle="primary">
                                            <label class="form-check-labe" for="recaptcha_module"></label>
                                            <label class="text-dark mb-1 mt-3" for="recaptcha_module">{{ __('Google Recaptcha') }}<a href="https://phppot.com/php/how-to-get-google-recaptcha-site-and-secret-key/" target="_blank" class="text-blue">
                                                <small>({{__('How to Get Google reCaptcha Site and Secret key')}})</small>
                                            </a></label>
                                        </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                    <label for="google_recaptcha_key" class="col-form-label">{{ __('Google Recaptcha Key') }}</label>
                                    <input class="form-control" placeholder="{{ __('Enter Google Recaptcha Key') }}" name="google_recaptcha_key" type="text" value="{{env('NOCAPTCHA_SITEKEY')}}" id="google_recaptcha_key">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                    <label for="google_recaptcha_secret" class="col-form-label">{{ __('Google Recaptcha Secret') }}</label>
                                    <input class="form-control " placeholder="{{ __('Enter Google Recaptcha Secret') }}" name="google_recaptcha_secret" type="text" value="{{env('NOCAPTCHA_SECRET')}}" id="google_recaptcha_secret">
                                </div>
                            </div>
                            <div class="col-lg-12  text-end">
                                <input type="submit" value="{{ __('Save Changes') }}" class="btn btn-print-invoice  btn-primary m-r-10">
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  

    

    
@endsection
