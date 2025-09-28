<!-- resources/views/partials/topbar.blade.php -->
@php
    $footerSocials = Cache::rememberForever('footer_socials', function(){
        return \App\Models\FooterSocial::where('status', 1)->get();
    });
@endphp

<style>
    /* General Styles */
    .topbar {
        background-color: var(--secondary-color);
        padding: 10px 0;
        min-height: 50px;
        color: #fff;
        font-size: 14px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .topbar a {
        color: #fff;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .topbar a:hover {
        color: var(--accent-color);
    }

    .topbar .container {
        padding: 0 15px;
    }

    .topbar .row {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* Left Section */
    .topbar-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .topbar-left .topbar-text {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .topbar-left .topbar-text i {
        font-size: 16px;
        color: var(--accent-color);
    }

    .topbar-left .badge {
        background-color: var(--success-color);
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 500;
    }

    /* Right Section */
    .topbar-right {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .topbar-right .topbar-link {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .topbar-right .topbar-link a {
        display: flex;
        align-items: center;
        gap: 5px;
        position: relative;
    }
    
    .topbar-right .topbar-link a:after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 0;
        height: 2px;
        background-color: var(--accent-color);
        transition: width 0.3s ease;
    }
    
    .topbar-right .topbar-link a:hover:after {
        width: 100%;
    }

    .topbar-right .topbar-link a i {
        font-size: 16px;
        color: var(--accent-color);
    }

    .topbar-currency select,
    .topbar-language select {
        background-color: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 4px;
        padding: 5px 10px;
        font-size: 12px;
        color: #fff;
        transition: all 0.3s ease;
    }
    
    .topbar-currency select:hover,
    .topbar-language select:hover {
        background-color: rgba(255,255,255,0.2);
    }

    .topbar-currency select option,
    .topbar-language select option {
        color: #000; /* Ensure options are visible */
        background-color: #fff;
    }

    /* Cart Icon */
    .cart-icon {
        position: relative;
    }

    .cart-count {
        position: absolute;
        top: -10px;
        right: -10px;
        background-color: #ff3860;
        color: #fff;
        font-size: 10px;
        padding: 2px 6px;
        border-radius: 50%;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .topbar-left,
        .topbar-right {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .topbar-left .topbar-text,
        .topbar-right .topbar-link {
            flex-direction: column;
            gap: 5px;
        }

        .topbar-currency select,
        .topbar-language select {
            width: 100%;
        }
    }
</style>

<!-- Navbar Top -->
<div class="topbar d-none d-sm-block">
    <div class="container">
        <div class="row">
            <!-- Left Section -->
            <div class="col-sm-6 col-md-8">
                <div class="topbar-left">
                    <!-- Customer Support -->
                    <div class="topbar-text">
                        <i class="fas fa-envelope"></i>
                        {{ __('Need Help?') }} {{ $settings->contact_email }}
                    </div>

                    <!-- Promotional Banner -->
                    <div class="topbar-text">
                        <span class="badge">Special Offer!</span> Get 20% off on all products.
                    </div>

                    <!-- Date -->
                    <div class="topbar-text">
                        {{ date('l, F j, Y') }}
                    </div>
                </div>
            </div>

            <!-- Right Section -->
            <div class="col-sm-6 col-md-4">
                <div class="topbar-right">
                    <!-- Currency Selector -->
                    <div class="topbar-currency">
                        <select name="currency_name" class="form-control select2">
                            <option value="">Birr</option>
                            @foreach (config('settings.currecy_list') as $currency)
                                <option {{ @$generalSettings->currency_name == $currency ? 'selected' : '' }} value="{{ $currency }}">{{ $currency }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Language Selector -->
                    <div class="topbar-language">
                        @php
                            $languages = \App\Helpers\TranslationHelper::getActiveLanguages();
                        @endphp
                        <form action="{{ route('language.switch') }}" method="POST" class="language-switcher">
                            @csrf
                            <select class="form-select form-select-sm" name="locale" onchange="this.form.submit()">
                                @foreach($languages as $language)
                                    <option value="{{ $language->lang }}" {{ app()->getLocale() === $language->lang ? 'selected' : '' }}>
                                        <span class="fi fi-{{ $language->country_code }}"></span>
                                        {{ $language->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
        
                    <!-- Track Order -->
                    <div class="topbar-link">
                        <a href="{{ route('product-traking.index') }}">
                            <i class="fas fa-map-marker-alt"></i> {{ __('Track Order') }}
                        </a>
                    </div>

                    <!-- Vendor Dashboard -->
                   

                  
                </div>
            </div>
        </div>
    </div>
</div>