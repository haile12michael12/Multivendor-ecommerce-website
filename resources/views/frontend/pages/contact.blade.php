@extends('frontend.layouts.master')

@section('title')
{{$settings->site_name}} - Contact Us
@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('frontend/css/contact-page.css')}}">
@endpush

@section('content')
   
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Contact Us</h4>
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><a href="{{route('contact')}}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
   


    <!--============================
        CONTACT PAGE START
    ==============================-->
    <section id="wsus__contact">
        <div class="container">
            <div class="wsus__contact_area">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="row">
                            @if ($settings->contact_email)

                            <div class="col-xl-12">
                                <div class="wsus__contact_single">
                                    <i class="fal fa-envelope"></i>
                                    <h5>mail address</h5>
                                    <a href="mailto:example@gmail.com">{{@$settings->contact_email}}</a>
                                    <span><i class="fal fa-envelope"></i></span>
                                </div>
                            </div>
                            @endif
                            @if ($settings->contact_phone)
                            <div class="col-xl-12">
                                <div class="wsus__contact_single">
                                    <i class="far fa-phone-alt"></i>
                                    <h5>phone number</h5>
                                    <a href="macallto:{{@$settings->contact_phone}}">{{@$settings->contact_phone}}</a>
                                    <span><i class="far fa-phone-alt"></i></span>
                                </div>
                            </div>
                            @endif
                            @if ($settings->contact_address)

                            <div class="col-xl-12">
                                <div class="wsus__contact_single">
                                    <i class="fal fa-map-marker-alt"></i>
                                    <h5>contact address</h5>
                                    <a href="javascript:;">{{@$settings->contact_address}}</a>
                                    <span><i class="fal fa-map-marker-alt"></i></span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="wsus__contact_question">
                            <h5>Send Us a Message</h5>
                            <form id="contact-form">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="wsus__con_form_single">
                                            <input type="text" placeholder="Your Name" name="name">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__con_form_single">
                                            <input type="email" placeholder="Email" name="email">
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="wsus__con_form_single">
                                            <input type="text" placeholder="Subject" name="subject">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__con_form_single">
                                            <textarea cols="3" rows="5" placeholder="Message" name="message"></textarea>
                                        </div>
                                        <button type="submit" class="common_btn" id="form-submit">send now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="wsus__con_map">
                            <iframe
                                src="{{$settings->map}}"
                                width="1600" height="450" style="border:0;" allowfullscreen="100"
                                loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--============================
        FAQ SECTION START
    ==============================-->
    <section id="wsus__faq" class="py-5 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_heading mb-5">
                        <h2>Frequently Asked Questions</h2>
                        <p>Find answers to common questions about our products and services</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__faq_area">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne" aria-expanded="false"
                                        aria-controls="flush-collapseOne">
                                        How do I place an order?
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Browse our products, add items to your cart, proceed to checkout, and follow the payment instructions. Once your payment is confirmed, we'll process your order for shipping.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                        aria-controls="flush-collapseTwo">
                                        What payment methods do you accept?
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">We accept credit/debit cards, PayPal, and bank transfers. All payments are processed securely through our payment gateway.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseThree" aria-expanded="false"
                                        aria-controls="flush-collapseThree">
                                        What is your return policy?
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">We offer a 30-day return policy for most items. Products must be returned in their original condition and packaging. Please contact our customer service team to initiate a return.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseFour" aria-expanded="false"
                                        aria-controls="flush-collapseFour">
                                        How long does shipping take?
                                    </button>
                                </h2>
                                <div id="flush-collapseFour" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Shipping times vary depending on your location. Domestic orders typically arrive within 3-5 business days, while international orders may take 7-14 business days. You'll receive a tracking number once your order ships.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        FAQ SECTION END
    ==============================-->

    <!--============================
        BUSINESS HOURS START
    ==============================-->
    <section id="wsus__business_hours" class="mb-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__business_hours_content">
                        <h3>Business Hours</h3>
                        <p>Our team is available to assist you during the following hours:</p>
                        <ul class="wsus__business_hour_list">
                            <li>
                                <span>Monday - Friday:</span>
                                <span>9:00 AM - 6:00 PM</span>
                            </li>
                            <li>
                                <span>Saturday:</span>
                                <span>10:00 AM - 4:00 PM</span>
                            </li>
                            <li>
                                <span>Sunday:</span>
                                <span>Closed</span>
                            </li>
                        </ul>
                        <p class="mt-3">For urgent inquiries outside business hours, please email us and we'll respond as soon as possible.</p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__business_hours_content">
                        <h3>Connect With Us</h3>
                        <p>Follow us on social media for updates, promotions, and more:</p>
                        <div class="wsus__social_link">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                        <div class="wsus__newsletter mt-4">
                            <h5>Subscribe to our newsletter</h5>
                            <form id="newsletter-form">
                                <input type="email" placeholder="Your Email" name="newsletter_email">
                                <button type="submit" class="common_btn">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BUSINESS HOURS END
    ==============================-->
    
    <!--============================
        CONTACT PAGE END
    ==============================-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            // Contact form submission
            $('#contact-form').on('submit', function(e){
                e.preventDefault();
                let data = $(this).serialize();
                $.ajax({
                    method: 'POST',
                    url: "{{route('handle-contact-form')}}",
                    data: data,
                    beforeSend: function(){
                        $('#form-submit').text('sending..');
                        $('#form-submit').attr('disabled', true);
                    },
                    success: function(data){
                        if(data.status == 'success'){
                            toastr.success(data.message);
                            $('#contact-form')[0].reset();
                            $('#form-submit').text('send now')
                            $('#form-submit').attr('disabled', false);
                        }
                    },
                    error: function(data){
                        let errors = data.responseJSON.errors;

                        $.each(errors, function(key, value){
                            toastr.error(value);
                        })

                        $('#form-submit').text('send now');
                        $('#form-submit').attr('disabled', false);
                    }
                })
            });

            // Newsletter subscription
            $('#newsletter-form').on('submit', function(e){
                e.preventDefault();
                let data = $(this).serialize();
                $.ajax({
                    method: 'POST',
                    url: "{{route('newsletter-subscribe')}}",
                    data: data,
                    success: function(data){
                        if(data.status == 'success'){
                            toastr.success(data.message);
                            $('#newsletter-form')[0].reset();
                        } else {
                            toastr.error(data.message);
                        }
                    },
                    error: function(data){
                        let errors = data.responseJSON.errors;
                        $.each(errors, function(key, value){
                            toastr.error(value);
                        })
                    }
                })
            });
        })
    </script>
@endpush
