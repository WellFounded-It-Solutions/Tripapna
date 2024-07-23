<div class="container">
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="section-title text-start">
                <h2>Today´s Hottest Discount Coupons</h2>
                <p>Buy the best hotel coupons at the best price</p>
            </div>

            @foreach($HotelCoupons as $coupon)
            <div class="single-deals-coupon-box">
                <div class="row">


                    <div class="col-lg-4 col-md-4">
                        <div class="deals-coupon-image" style="background-image: url({{$coupon->image}});">
                            <img src="{{$coupon->image}}" class="main-image" alt="image">
                            <!-- <div class="content">
                                <img [src]="{{$coupon->logo}}" alt="image">
                            <a routerLink="/{{$coupon->logoLink}}" class="link-btn">{{$coupon->logoText}}</a>
                        </div> -->
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8">
                        <div class="deals-coupon-content">
                            <h3><a routerLink="/{{$coupon->detailsLink}}">{{$coupon->title}}</a></h3>
                            <p>{{$coupon->description}}</p>
                            <div class="show-coupon-code">
                                <span>Coupon Code:</span>
                                <p class="code-btn" (click)="AddtoCart(Content)">Buy now<i class="bx bx-chevron-right"></i></p>

                                <!-- <a routerLink="/{{$coupon->id}}" class="code-btn" target="_blank" ngxClipboard [cbContent]="[{{$coupon->couponCode]" [container]="container" tooltip="Click to Copy" placement="right" show-delay="100">Buy now<i class="bx bx-chevron-right"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-lg-3 col-md-12">
            <aside class="widget-area">
                <div class="widget widget_categories">
                    <h3 class="widget-title">Popular Categories</h3>
                    <ul>
                        <li><a routerLink="/search-page"><i class='bx bx-glasses-alt'></i> Flight</a></li>
                        <li><a routerLink="/search-page"><i class='bx bx-female'></i> Hotel</a></li>
                        <li><a routerLink="/search-page"><i class='bx bx-bowling-ball'></i> Taxi</a></li>
                        <li><a routerLink="/search-page"><i class='bx bx-happy-beaming'></i> Hotel Package</a></li>

                    </ul>
                </div>
                <div class="widget widget_custom_ads">
                    <a href="#" class="d-block" target="_blank">
                        <img src="https://tripapna.in/assets/img/TripApna/flight.jpg" alt="image">
                    </a>
                </div>
                <!-- <div class="widget widget_custom_ads">
                    <a href="#" class="d-block" target="_blank">
                        <img src="assets/img/custom-ads2.jpg" alt="image">
                    </a>
                </div> -->
            </aside>
        </div>
    </div>
</div>
