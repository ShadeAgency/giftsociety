@extends('frontend.layouts.app')

@section('content')
<style>
    .form-control{
        border-radius: 20px !important;
    }
</style>
<section class="pt-4 bg-white border-bottom">
    <div class="container text-center">
        <div class="row">
              <div class="col-lg-6 text-center text-lg-left">
                <h1 class="fw-600 h4">{{translate('Contact Us') }}</h1>
            </div>
            <div class="col-lg-6">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item opacity-50">
                        <a class="text-reset" href="{{ route('home') }}">{{ translate('Home')}}</a>
                    </li>
                    <li class="text-dark fw-600 breadcrumb-item">
                        <a class="text-reset p-2" href="#" style="background: #800080;color: white !important;height: 21px;
justify-content: center;display: flex;align-items: center;width: 100%;">"{{translate('Contact Us') }}"</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </section>


<section class="py-4 gry-bg pt-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto d-flex-justify-content-center">
               <h4 class="pb-2">Send Us A Message</h4>
               <form action="">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Your name</label>
                    <input type="text" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Your email</label>
                    <input type="email" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Subject</label>
                    <input type="subj" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Your message (optional)</label>
                    <textarea type="msg" class="form-control"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                          <h5>Address</h5>
                    </div>
                    <div class="col-md-2">
                        <i class="las la-home fs-20 d-flex justify-content-center align-items-center" style="background: #f4f4f7;height: 50px;width: 50px;border-radius: 31px;"></i>
                    </div>
                    <div class="col-md-10 d-flex align-items-center">
                        <p class="pr-4 pl-4">
                            The Gift Society, OFFICE NO. 203, 2ND FLOOR, SCF NO.28, CUE URBAN ESTATE, HUDA COMPLEX, OPPOSITE PALIKA BAZAR,, Rohtak, Haryana, 124001 
                        </p>
                    </div>
                    <div class="col-md-12 mt-3">
                          <h5>Hotline : </h5>
                    </div>
                    <div class="col-md-2">
                        <i class="las la-phone-volume fs-20 d-flex justify-content-center align-items-center" style="background: #f4f4f7;height: 50px;width: 50px;border-radius: 31px;"></i>
                    </div>
                    <div class="col-md-10 d-flex align-items-center">
                        <p class="pr-4 pl-4">
                           +91 - 9518234515 
                        </p>
                    </div>
                    <div class="col-md-12 mt-3">
                          <h5>Opening Time: </h5>
                    </div>
                    <div class="col-md-2">
                        <i class="las la-clock fs-20 d-flex justify-content-center align-items-center" style="background: #f4f4f7;height: 50px;width: 50px;border-radius: 31px;"></i>
                    </div>
                    <div class="col-md-10 d-flex align-items-center">
                        <p class="pr-4 pl-4">
                           Monday – Friday 10 AM – 8 PM 
                        </p>
                    </div>
                    <div class="col-md-12 mt-3">
                          <h5>Email Us : </h5>
                    </div>
                    <div class="col-md-2">
                        <i class="las la-mail-bulk fs-20 d-flex justify-content-center align-items-center" style="background: #f4f4f7;height: 50px;width: 50px;border-radius: 31px;"></i>
                    </div>
                    <div class="col-md-10 d-flex align-items-center">
                        <p class="pr-4 pl-4">
                          support@thegiftsociety.in
                        </p>
                    </div>
                </div>
            </div>
     
        </div>
    </div>
    <div class="container-fluid p-0">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d447257.8826207756!2d76.614643!3d28.862603!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d85a52a49a89d%3A0x27f0c3030d946028!2sHUDA%20Complex%2C%20Rohtak%2C%20Haryana%20124001%2C%20India!5e0!3m2!1sen!2sus!4v1664541145611!5m2!1sen!2sus"  height="450" style="border:0;width:100%" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

@endsection

@section('script')
    <script type="text/javascript">
        function display_option(key){

        }
        function show_pickup_point(el,type) {
        	var value = $(el).val();
        	var target = $(el).data('target');

            // console.log(value);

        	if(value == 'home_delivery' || value == 'carrier'){
                if(!$(target).hasClass('d-none')){
                    $(target).addClass('d-none');
                }
                $('.carrier_id_'+type).removeClass('d-none');
        	}else{
        		$(target).removeClass('d-none');
        		$('.carrier_id_'+type).addClass('d-none');
        	}
        }

    </script>
@endsection
