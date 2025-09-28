@php
    $categories = \App\Models\Category::where('status', 1)
        ->with(['subCategories' => function($query) {
            $query->where('status', 1);
        }])
        ->get();


@endphp

<style>
    /* Styling for the search bar */
    .search-bar {
        display: flex;
        align-items: center;
        max-width: 650px; /* Increased max-width */
        background: #fff;
        border-radius: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid #ddd; /* Added border */
    }

    /* Styling for the search input container */
    .search-input-container {
        display: flex;
        align-items: center;
        flex: 1;
        width: 100%; /* Added full width */
    }

    /* Styling for the search input */
    .search-input {
        flex: 1;
        padding: 12px 20px;
        border: none;
        outline: none;
        font-size: 16px;
        background: transparent;
        width: 100%; /* Added full width */
        min-width: 300px; /* Minimum width for the input */
    }

    /* Styling for the category dropdown */
    .category-dropdown {
        position: relative;
        display: inline-block;
        margin-right: 10px;
        min-width: 160px; /* Increased minimum width */
    }

    /* Styling for the dropdown button */
    .dropbtn {
        padding: 10px 15px;
        background-color: #f8f8f8;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        font-size: 14px;
        color: #333;
        width: 100%; /* Full width dropdown */
    }

    /* Styling for the search button */
    .search-bar button[type="submit"] {
        padding: 12px 20px;
        background-color: #ff6b6b;
        color: white;
        border: none;

        font-size: 16px;
        transition: all 0.3s;
        min-width: 40px; /* Minimum width for button */
    }

    .search-bar button[type="submit"]:hover {
        background-color: #ff5252;
    }
</style>

<header>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-2 col-md-1 d-lg-none">
                <div class="wsus__mobile_menu_area">
                    <span class="wsus__mobile_menu_icon"><i class="fal fa-bars"></i></span>
                </div>
            </div>
            <div class="col-xl-2 col-7 col-md-8 col-lg-2" style="padding-left: 0; margin-left: 0;">
                <div class="wsus_logo_area d-flex align-items-left" style="padding-left: 0; margin-left: 0;">
                    <a class="wsus__header_logo" href="{{url('/')}}">
                        <img src="{{asset($logoSetting->logo)}}" alt="huluband gebeya" class="img-fluid w-100">
                    </a>

               <span class="site-name ms-2"> Huluband Gebeya</span>
                </div>
            </div>
          <div class="col-xl-6 col-md-6 col-lg-6 d-none d-lg-block">
    <div class="wsus__search">
        <form action="{{route('products.index')}}" method="GET" class="search-bar">
            <div class="search-input-container">
                <div class="category-dropdown">
                    <select name="category" class="dropbtn">
                        <option value="">{{ \App\Helpers\TranslationHelper::translate('categories') }}</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->slug }}" {{ request()->category == $category->slug ? 'selected' : '' }}>
                            {{ $category->name }}

                        </option>
                        @endforeach

                    </select>
                </div>
                <input type="text" class="search-input" placeholder="{{ \App\Helpers\TranslationHelper::translate('search') }}..." name="search" value="{{ request()->search }}">
            </div>
            <button type="submit" class="search-button" type="submit"><i class="far fa-search"></i></button>
        </form>
    </div>
</div>

            <div class="col-xl-4 col-3 col-md-3 col-lg-4"> <!-- Adjusted column size -->
                <div class="wsus__call_icon_area">
                    <ul class="wsus__icon_area">
                        <li><a href="{{route('user.wishlist.index')}}">
                            <i class="fal fa-heart"></i>
                            <span id="wishlist_count">
                                @if (auth()->check())
                                {{\App\Models\Wishlist::where('user_id', auth()->user()->id)->count()}}
                                @else
                                0
                                @endif
                            </span></a></li>
                        <li><a class="wsus__cart_icon" href="#"><i class="fal fa-shopping-bag"></i>
                            <span id="cart-count">{{Cart::content()->count()}}</span>
                        </a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="wsus__mini_cart">
        <h4>{{ \App\Helpers\TranslationHelper::translate('cart') }} <span class="wsus_close_mini_cart"><i class="far fa-times"></i></span></h4>
        <ul class="mini_cart_wrapper">
            @foreach (Cart::content() as $sidebarProduct)
                <li id="mini_cart_{{$sidebarProduct->rowId}}">
                    <div class="wsus__cart_img">
                        <a href="#"><img src="{{asset($sidebarProduct->options->image)}}" alt="product" class="img-fluid w-100"></a>
                        <a class="wsis__del_icon remove_sidebar_product" data-id="{{$sidebarProduct->rowId}}" href="#" ><i class="fas fa-minus-circle"></i></a>
                    </div>
                    <div class="wsus__cart_text">
                        <a class="wsus__cart_title" href="{{route('product-detail', $sidebarProduct->options->slug)}}">{{$sidebarProduct->name}}</a>
                        <p>
                            {{$settings->currency_icon}}{{$sidebarProduct->price}}
                        </p>
                        <small>Variants total: {{$settings->currency_icon}}{{$sidebarProduct->options->variants_total}}</small>
                        <br>
                        <small>Qty: {{$sidebarProduct->qty}}</small>
                    </div>
                </li>
            @endforeach
            @if (Cart::content()->count() === 0)
                <li class="text-center">Cart Is Empty!</li>
            @endif
        </ul>
        <div class="mini_cart_actions {{Cart::content()->count() === 0 ? 'd-none': ''}}">
            <h5>sub total <span id="mini_cart_subtotal">{{$settings->currency_icon}}{{getCartTotal()}}</span></h5>
            <div class="wsus__minicart_btn_area">
                <a class="common_btn" href="{{route('cart-details')}}">view cart</a>
                <a class="common_btn" href="{{route('user.checkout')}}">checkout</a>
            </div>
        </div>
    </div>
</header>
