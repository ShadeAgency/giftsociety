@extends('frontend.layouts.app')

@section('content')
    <section class="gry-bg py-5">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8 mx-auto">
                        <div class="card">
                            <div class="text-center pt-4">
                                <h1 class="h4 fw-600">
                                    {{ translate('Login to your account.')}}
                                </h1>
                            </div>
			    <div class="px-4 py-3 py-lg-4" id="showphone">
                                	<div class="">
                                	 <form  class="form-default" role="form" action="{{ route('mobile.login') }}" method="POST">
                                	   @csrf
                                	    <div class="form-group phone-form-group mb-1">
                                                <input type="tel"  class="form-control lo" name="mobile" placeholder="Enter Phone Number">
                                                <input style="display:none;" type="text" id="otp" maxlength="4" class="form-control" name="otp" placeholder="Enter Otpcode" >
                                        </div>
                                       </div>
                                       <div class="mb-5">
                                       	    <br>	
                                       	    <div id="some_div"></div>
             <button id="ch" type="button" style="float:right;display:none;"  onclick="otplogin()" class="btn btn-warning btn-block fw-600">{{  translate('Resend Code') }}</button>
             <button type="submit" id="otpverify" style="display:none;" class="btn btn-primary btn-block fw-600">{{  translate('Verify Account') }}</button>
             <button type="button" onclick="otplogin()" class="btn btn-primary lo btn-block fw-600">{{  translate('Login') }}</button>
                                        </div>
                                        </form>
                                         <div class="separator mb-3">
                                            <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                                        </div>
                                        <div class="mb-5">
                                            <button type="button" onclick="show(1)" class="btn btn-primary btn-block fw-600">{{  translate('Email ID & Password') }}</button>
                                        </div>
                             </div>          	
                            <div class="px-4 py-3 py-lg-4">
                                <div class="">
                                    <form  id="showemail" style="display:none;" class="form-default" role="form" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        @if (addon_is_activated('otp_system') && env("DEMO_MODE") != "On")
                                            <div class="form-group phone-form-group mb-1">
                                                <input type="tel" id="phone-code" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="" name="phone" autocomplete="off">
                                            </div>

                                            <input type="hidden" name="country_code" value="">

                                            <div class="form-group email-form-group mb-1 d-none">
                                                <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email" id="email" autocomplete="off">
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group text-right">
                                                <button class="btn btn-link p-0 opacity-50 text-reset" type="button" onclick="toggleEmailPhone(this)">{{ translate('Use Email Instead') }}</button>
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email" id="email" autocomplete="off">
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ translate('Password')}}" name="password" id="password">
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-6">
                                                <label class="aiz-checkbox">
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <span class=opacity-60>{{  translate('Remember Me') }}</span>
                                                    <span class="aiz-square-check"></span>
                                                </label>
                                            </div>
                                            <div class="col-6 text-right">
                                                <a href="{{ route('password.request') }}" class="text-reset opacity-60 fs-14">{{ translate('Forgot password?')}}</a>
                                            </div>
                                        </div>

                                        <div class="mb-5">
                                            <button type="submit" class="btn btn-primary btn-block fw-600">{{  translate('Login') }}</button>
                                        </div>
                                        <div class="separator mb-3">
                                            <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                                        </div>
                                        <div class="mb-5">
                                            <button type="button" onclick="show(2)" class="btn btn-primary btn-block fw-600">{{  translate('Phone Number') }}</button>
                                        </div>
                                    </form>

                                    @if (env("DEMO_MODE") == "On")
                                        <div class="mb-5">
                                            <table class="table table-bordered mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>{{ translate('Seller Account')}}</td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm" onclick="autoFillSeller()">{{ translate('Copy credentials') }}</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ translate('Customer Account')}}</td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm" onclick="autoFillCustomer()">{{ translate('Copy credentials') }}</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ translate('Delivery Boy Account')}}</td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm" onclick="autoFillDeliveryBoy()">{{ translate('Copy credentials') }}</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                    @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1)
                                        <div class="separator mb-3">
                                            <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                                        </div>
                                        <ul class="list-inline social colored text-center mb-5">
                                            @if (get_setting('facebook_login') == 1)
                                                <li class="list-inline-item">
                                                    <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                                        <i class="lab la-facebook-f"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if(get_setting('google_login') == 1)
                                                <li class="list-inline-item">
                                                    <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                                        <i class="lab la-google"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (get_setting('twitter_login') == 1)
                                                <li class="list-inline-item">
                                                    <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                                        <i class="lab la-twitter"></i>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <p class="text-muted mb-0">{{ translate('Dont have an account?')}}</p>
                                    <a href="{{ route('user.registration') }}">{{ translate('Register Now')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        var isPhoneShown = true,
            countryData = window.intlTelInputGlobals.getCountryData(),
            input = document.querySelector("#phone-code");

        for (var i = 0; i < countryData.length; i++) {
            var country = countryData[i];
            if(country.iso2 == 'bd'){
                country.dialCode = '88';
            }
        }

        var iti = intlTelInput(input, {
            separateDialCode: true,
            utilsScript: "{{ static_asset('assets/js/intlTelutils.js') }}?1590403638580",
            onlyCountries: @php echo json_encode(\App\Models\Country::where('status', 1)->pluck('code')->toArray()) @endphp,
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                if(selectedCountryData.iso2 == 'bd'){
                    return "01xxxxxxxxx";
                }
                return selectedCountryPlaceholder;
            }
        });

        var country = iti.getSelectedCountryData();
        $('input[name=country_code]').val(country.dialCode);

        input.addEventListener("countrychange", function(e) {
            // var currentMask = e.currentTarget.placeholder;

            var country = iti.getSelectedCountryData();
            $('input[name=country_code]').val(country.dialCode);

        });

        function toggleEmailPhone(el){
            if(isPhoneShown){
                $('.phone-form-group').addClass('d-none');
                $('.email-form-group').removeClass('d-none');
                $('input[name=phone]').val(null);
                isPhoneShown = false;
                $(el).html('{{ translate('Use Phone Instead') }}');
            }
            else{
                $('.phone-form-group').removeClass('d-none');
                $('.email-form-group').addClass('d-none');
                $('input[name=email]').val(null);
                isPhoneShown = true;
                $(el).html('{{ translate('Use Email Instead') }}');
            }
        }



        function autoFillSeller(){
            $('#email').val('seller@example.com');
            $('#password').val('123456');
        }
        function autoFillCustomer(){
            $('#email').val('customer@example.com');
            $('#password').val('123456');
        }
        function autoFillDeliveryBoy(){
            $('#email').val('deliveryboy@example.com');
            $('#password').val('123456');
        }
        function show(id){
        	if(id==1){
        		$('#showemail').css("display","block");
        		$('#showphone').css("display","none");
        	}else{
        		$('#showphone').css("display","block");
        		$('#showemail').css("display","none");
        	}
        }
        function otplogin(){
        	var mobile = $('[name="mobile"]').val();
        	//alert(mobile);	
        	var bs ="{{url('/')}}";
        	//alert(bs); 
        	if(mobile.length >=10){
        	$.get("{{url('/')}}/sendOtpcode/"+mobile.toString(), function(data, status){
        			//alert(JSON.stringify(data));
        			if(data=='No Found'){
        				alert("Please Enter Correct Mobile Number");
        				window.location.href = "{{url('/users/registration?mobile=')}}"+mobile;
        			}
        			else{
        				$('#ch').css("display","block");
        				$('#ch').prop("disabled",true);
	        			$('.lo').css("display","none");
	        			$('#otp').css("display","block");
	        			$('#otpverify').css("display","block");
	        			var timeLeft = 30;
					    var elem = document.getElementById('some_div');
					    
					    var timerId = setInterval(countdown, 1000);
					    
					    function countdown() {
					      if (timeLeft == -1) {
					        clearTimeout(timerId);
					        $('#ch').prop("disabled",false);
					        $('#some_div').hide();
					      } else {
					     	$('#some_div').show();
					        elem.innerHTML = timeLeft + ' seconds remaining';
					        timeLeft--;
					      }
					    }
        			}
        	})
        	}else{
        		alert("Please Enter 10 Digit Mobile Number");
        	}
        }
    </script>
@endsection
