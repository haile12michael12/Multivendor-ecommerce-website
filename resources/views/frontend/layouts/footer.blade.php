@php
    $footerInfo = Cache::rememberForever('footer_info', function(){
            return \App\Models\FooterInfo::first();
    });
    $footerSocials = Cache::rememberForever('footer_socials', function(){
        return \App\Models\FooterSocial::where('status', 1)->get();
    });
    $footerGridTwoLinks = Cache::rememberForever('footer_grid_two', function(){
        return \App\Models\FooterGridTwo::where('status', 1)->get();
    });
    $footerTitle = \App\Models\FooterTitle::first();
    $footerGridThreeLinks =Cache::rememberForever('footer_grid_three', function(){
        return \App\Models\FooterGridThree::where('status', 1)->get();
    });
@endphp
<style>
    /* Footer styling */
    .footer_2 {
        background-color: var(--secondary-color);
        padding: 60px 0 0;
        color: #fff;
    }
    
    .wsus__footer_content {
        margin-bottom: 30px;
    }
    
    .wsus__footer_2_logo {
        display: block;
        margin-bottom: 20px;
    }
    
    .wsus__footer_2_logo img {
        max-height: 50px;
        filter: brightness(0) invert(1);
    }
    
    .wsus__footer_content a.action {
        display: block;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 10px;
        transition: all 0.3s ease;
        font-size: 15px;
    }
    
    .wsus__footer_content a.action:hover {
        color: var(--accent-color);
    }
    
    .wsus__footer_content a.action i {
        margin-right: 10px;
        color: var(--accent-color);
        width: 20px;
        text-align: center;
    }
    
    .wsus__footer_content p {
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 20px;
        font-size: 15px;
    }
    
    .wsus__footer_content p i {
        margin-right: 10px;
        color: var(--accent-color);
        width: 20px;
        text-align: center;
    }
    
    .wsus__footer_social {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }
    
    .wsus__footer_social li a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        border-radius: 50%;
        transition: all 0.3s ease;
    }
    
    .wsus__footer_social li a:hover {
        background-color: var(--primary-color);
        transform: translateY(-3px);
    }
    
    /* Footer headings */
    .wsus__footer_content h5 {
        color: #fff;
        font-size: 18px;
        margin-bottom: 25px;
        font-weight: 600;
        position: relative;
        padding-bottom: 10px;
    }
    
    .wsus__footer_content h5:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 2px;
        background-color: var(--primary-color);
    }
    
    /* Footer menu */
    .wsus__footer_menu li {
        margin-bottom: 12px;
    }
    
    .wsus__footer_menu li a {
        color: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
        font-size: 15px;
    }
    
    .wsus__footer_menu li a:hover {
        color: var(--accent-color);
        padding-left: 5px;
    }
    
    .wsus__footer_menu li a i {
        color: var(--accent-color);
        margin-right: 8px;
        font-size: 12px;
    }
    
    /* Newsletter section */
    .wsus__footer_content_2 h3 {
        color: #fff;
        font-size: 20px;
        margin-bottom: 15px;
        font-weight: 600;
    }
    
    .wsus__footer_content_2 p {
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 20px;
        font-size: 15px;
    }
    
    #newsletter {
        display: flex;
        margin-bottom: 20px;
    }
    
    .newsletter_email {
        flex: 1;
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 10px 15px;
        color: #fff;
        border-radius: 30px 0 0 30px;
        outline: none;
    }
    
    .newsletter_email::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }
    
    .subscribe_btn {
        background-color: var(--primary-color);
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 0 30px 30px 0;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .subscribe_btn:hover {
        background-color: var(--accent-color);
    }
    
    /* Footer bottom */
    .wsus__footer_bottom {
        background-color: rgba(0, 0, 0, 0.2);
        padding: 20px 0;
        margin-top: 30px;
    }
    
    .wsus__copyright p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 14px;
        margin: 0;
    }
</style>

<footer class="footer_2">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-3 col-sm-7 col-md-6 col-lg-3">
                <div class="wsus__footer_content">
                    <a class="wsus__footer_2_logo" href="{{url('/')}}">
                        <img src="{{asset(@$footerInfo->logo)}}" alt="logo">
                    </a>
                    <a class="action" href="callto:{{@$footerInfo->phone}}"><i class="fas fa-phone-alt"></i>{{@$footerInfo->phone}}</a>
                    <a class="action" href="mailto:{{@$footerInfo->email}}"><i class="far fa-envelope"></i>{{@$footerInfo->email}}</a>
                    <p><i class="fal fa-map-marker-alt"></i> {{@$footerInfo->address}}</p>
                    <ul class="wsus__footer_social">
                        @foreach ($footerSocials as $link)
                        <li><a class="behance" href="{{$link->url}}"><i class="{{$link->icon}}"></i></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-sm-5 col-md-4 col-lg-2">
                <div class="wsus__footer_content">
                    <h5>{{$footerTitle->footer_grid_two_title}}</h5>
                    <ul class="wsus__footer_menu">
                        @foreach ($footerGridTwoLinks as $link)
                            <li><a href="{{$link->url}}"><i class="fas fa-caret-right"></i> {{$link->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-sm-5 col-md-4 col-lg-2">
                <div class="wsus__footer_content">
                    <h5>{{$footerTitle->footer_grid_three_title}}</h5>
                    <ul class="wsus__footer_menu">
                        @foreach ($footerGridThreeLinks as $link)
                            <li><a href="{{$link->url}}"><i class="fas fa-caret-right"></i> {{$link->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-4 col-sm-7 col-md-8 col-lg-5">
                <div class="wsus__footer_content wsus__footer_content_2">
                    <h3>Subscribe To Our Newsletter</h3>
                    <p>Get all the latest information on Events, Sales and Offers.
                        Get all the latest information on Events.</p>
                    <form action="" method="POST" id="newsletter">
                        @csrf
                        <input type="text" placeholder="Email" name="email" class="newsletter_email">
                        <button type="submit" class="common_btn subscribe_btn">subscribe</button>
                    </form>
                    <div class="footer_payment">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wsus__footer_bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__copyright d-flex justify-content-center">
                        <p>{{@$footerInfo->copyright}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


