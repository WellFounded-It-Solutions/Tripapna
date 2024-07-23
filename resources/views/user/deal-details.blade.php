@extends('user.layouts.app_layout')

@section('content')

<style>
    .terms-section-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
    }

    .terms-section-head span {
        margin-top: 7px;
    }

    .deals-details-content {
        padding: 30px;
        margin-bottom: 30px;
        background-color: var(--whiteColor);
    }

    .deals-details-content h3 {
        font-size: 20px;
        margin-bottom: 15px;
    }

    .deals-details-content .rating {
        margin-bottom: 5px;
    }

    .deals-details-content .rating .bx {
        font-size: 17px;
        color: #cecfd2;
        margin-right: 2px;
    }

    .deals-details-content .rating .bx.checked {
        color: #efc02f;
    }

    .deals-details-content .rating .rating-count {
        font-weight: 600;
    }

    .deals-details-content ul {
        padding-left: 0;
        list-style-type: none;
        margin-bottom: 0;
        margin-top: 15px;
    }

    .deals-details-content ul li {
        display: inline-block;
        margin-right: 20px;
    }

    .deals-details-content ul li:last-child {
        margin-right: 0;
    }

    .deals-details-content ul li.phone-number a {
        background-color: var(--mainColor);
        color: var(--whiteColor);
        border-radius: 30px;
        position: relative;
        display: block;
        padding-left: 60px;
        padding-right: 25px;
        padding-top: 12px;
        padding-bottom: 13px;
        font-weight: 700;
        font-size: var(--fontSize);
    }

    .deals-details-content ul li.phone-number a i {
        left: 25px;
        top: 50%;
        font-size: 25px;
        position: absolute;
        transform: translateY(-50%);
    }

    .deals-details-content ul li.location {
        position: relative;
        color: var(--mainColor);
        padding-left: 55px;
    }

    .deals-details-content ul li.location span {
        display: block;
        color: var(--blackColor);
        margin-bottom: 4px;
        font-size: 17px;
        font-weight: 700;
    }

    .deals-details-content ul li.location i {
        left: 0;
        top: 0;
        color: #a2a1a1;
        font-size: 48px;
        position: absolute;
    }

    .deals-details-desc {
        padding: 30px;
        background-color: var(--whiteColor);
    }

    .deals-details-desc .cart-table .coupon-desc-second {
        font-size: 14px;
        color: var(--blackColor);
        font-family: var(--headingFontFamily);
    }

    .deals-details-desc h3 {
        font-size: 20px;
        margin-bottom: 15px;
        margin-top: 20px;
    }

    .deals-details-desc ul li {
        margin-bottom: 12px;
        color: var(--optionalColor);
    }

    .deals-details-desc ul li:last-child {
        margin-bottom: 0;
    }

    .deals-details-desc .blockquote,
    .deals-details-desc blockquote {
        background-color: #f5f5f5 !important;
    }

    .deals-details-review-comments {
        margin-top: 30px;
        padding: 10px 30px;
        background-color: var(--whiteColor);
    }

    .deals-details-review-comments .user-review {
        border-bottom: 1px solid #e7e7e7;
        padding: 20px 0 20px 110px;
        position: relative;
    }

    .deals-details-review-comments .user-review img {
        left: 0;
        top: 20px;
        width: 90px;
        height: 90px;
        border-radius: 5px;
        position: absolute;
    }

    .deals-details-review-comments .user-review .sub-comment {
        margin-bottom: 8px;
        font-weight: 600;
    }

    .deals-details-review-comments .user-review .review-rating {
        display: block;
        margin-bottom: 8px;
    }

    .deals-details-review-comments .user-review .review-rating .review-stars {
        display: inline-block;
    }

    .deals-details-review-comments .user-review .review-rating .review-stars i {
        font-size: 18px;
        color: #cecfd2;
        margin-right: 1px;
        display: inline-block;
    }

    .deals-details-review-comments .user-review .review-rating .review-stars i.checked {
        color: orange;
    }

    .deals-details-review-comments .user-review .review-rating span {
        color: var(--blackColor);
        position: relative;
        font-weight: 600;
        margin-left: 5px;
        top: -2px;
    }

    .deals-details-review-comments .user-review:last-child {
        border-bottom: none;
    }

    .deals-details-review-form {
        padding: 30px;
        margin-top: 30px;
        background-color: var(--whiteColor);
    }

    .deals-details-review-form h3 {
        margin-bottom: 10px;
        font-size: 20px;
    }

    .deals-details-review-form .comment-notes span {
        color: red;
    }

    .deals-details-review-form form {
        margin-top: 20px;
    }

    .deals-details-review-form form .form-group {
        margin-bottom: 25px;
        text-align: left;
    }

    .deals-details-review-form form .form-group .form-control {
        background-color: #f5f5f5 !important;
    }

    .deals-details-review-form form .rating {
        text-align: left;
        overflow: hidden;
        max-width: 115px;
        margin-top: -5px;
        margin-bottom: 20px;
    }

    .deals-details-review-form form .rating label {
        width: 23px;
        height: 23px;
        float: right;
        cursor: pointer;
        position: relative;
    }

    .deals-details-review-form form .rating label:not(:first-of-type) {
        padding-right: 5px;
    }

    .deals-details-review-form form .rating label:before {
        content: "\2605";
        transition: var(--transition);
        font-size: 27px;
        color: #ccc;
        line-height: 1;
    }

    .deals-details-review-form form .rating input {
        display: none;
    }

    .deals-details-review-form form .rating input:checked~label:before,
    .deals-details-review-form form .rating:not(:checked)>label:hover:before,
    .deals-details-review-form form .rating:not(:checked)>label:hover~label:before {
        color: #f6b500;
    }

    .deals-details-review-form form .comment-form-cookies-consent {
        text-align: left;
        margin-bottom: 0;
    }

    .deals-details-review-form form .comment-form-cookies-consent [type="checkbox"]:checked,
    .deals-details-review-form form .comment-form-cookies-consent [type="checkbox"]:not(:checked) {
        display: none;
    }

    .deals-details-review-form form .comment-form-cookies-consent [type="checkbox"]:checked+label,
    .deals-details-review-form form .comment-form-cookies-consent [type="checkbox"]:not(:checked)+label {
        cursor: pointer;
        margin-bottom: 0;
        font-weight: 500;
        line-height: 20px;
        position: relative;
        padding-left: 28px;
        display: inline-block;
        color: var(--optionalColor);
    }

    .deals-details-review-form form .comment-form-cookies-consent [type="checkbox"]:checked+label:before,
    .deals-details-review-form form .comment-form-cookies-consent [type="checkbox"]:not(:checked)+label:before {
        top: 0;
        left: 0;
        width: 19px;
        content: '';
        height: 19px;
        border-radius: 3px;
        position: absolute;
        background: #f5f5f5;
        transition: all 0.2s ease;
        border: 1px solid #f5f5f5;
    }

    .deals-details-review-form form .comment-form-cookies-consent [type="checkbox"]:checked+label:after,
    .deals-details-review-form form .comment-form-cookies-consent [type="checkbox"]:not(:checked)+label:after {
        left: 6px;
        top: 5.5px;
        width: 8px;
        height: 8px;
        content: '';
        position: absolute;
        transition: all 0.2s ease;
        background: var(--mainColor);
    }

    .deals-details-review-form form .comment-form-cookies-consent [type="checkbox"]:not(:checked)+label:after {
        opacity: 0;
        transform: scale(0);
    }

    .deals-details-review-form form .comment-form-cookies-consent [type="checkbox"]:checked+label:after {
        opacity: 1;
        transform: scale(1);
    }

    .deals-details-review-form form .comment-form-cookies-consent [type="checkbox"]:hover+label:before {
        border-color: var(--mainColor);
    }

    .deals-details-review-form form .comment-form-cookies-consent [type="checkbox"]:checked+label:before {
        border-color: var(--mainColor);
    }

    .deals-details-review-form form button {
        border: none;
        margin-top: 22px;
        overflow: hidden;
        border-radius: 5px;
        padding: 12px 40px;
        text-align: center;
        display: inline-block;
        color: var(--whiteColor);
        transition: var(--transition);
        background-color: var(--mainColor);
        font-weight: 700;
        font-size: var(--fontSize);
    }

    .deals-details-review-form form button:hover {
        color: var(--whiteColor);
        background-color: var(--blackColor);
    }

    blockquote,
    .blockquote {
        overflow: hidden;
        background-color: #fafafa;
        padding: 40px 50px !important;
        position: relative;
        z-index: 1;
        margin-bottom: 20px;
        margin-top: 20px;
    }

    blockquote p,
    .blockquote p {
        color: var(--blackColor);
        line-height: 1.6;
        margin-bottom: 0;
        font-weight: 700;
        font-style: italic;
        font-size: 18px !important;
    }

    blockquote cite,
    .blockquote cite {
        display: none;
    }

    blockquote::before,
    .blockquote::before {
        color: #efefef;
        position: absolute;
        animation: fade-up 1.5s infinite linear;
        left: 50px;
        top: -50px;
        z-index: -1;
        content: "\ee81";
        font-family: 'boxicons';
        font-size: 135px;
    }

    blockquote::after,
    .blockquote::after {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background-color: var(--mainColor);
        margin-top: 20px;
        margin-bottom: 20px;
    }

    /* Max width 767px */
    @media only screen and (max-width: 767px) {
        .deals-details-content {
            padding: 20px;
        }

        .deals-details-content h3 {
            font-size: 15px;
        }

        .deals-details-content .rating .bx {
            font-size: 15px;
        }

        .deals-details-content ul {
            display: block !important;
        }

        .deals-details-content ul li {
            margin-right: 0;
        }

        .deals-details-content ul li.phone-number a {
            font-size: 14px;
            padding-left: 50px;
            padding-right: 20px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .deals-details-content ul li.phone-number a i {
            left: 20px;
            font-size: 20px;
        }

        .deals-details-content ul li.location {
            margin-top: 20px;
            padding-left: 45px;
            display: block;
        }

        .deals-details-content ul li.location span {
            font-size: 14px;
        }

        .deals-details-content ul li.location i {
            font-size: 40px;
        }

        .deals-details-desc {
            padding: 20px;
        }

        .deals-details-desc h3 {
            font-size: 15px;
        }

        .deals-details-review-comments {
            padding: 0 20px;
        }

        .deals-details-review-comments .user-review {
            padding: 20px 0 20px 0;
        }

        .deals-details-review-comments .user-review img {
            position: relative;
            left: 0;
            top: 0;
            margin-bottom: 15px;
        }

        .deals-details-review-form {
            padding: 20px;
        }

        .deals-details-review-form h3 {
            font-size: 15px;
        }

        .deals-details-review-form form button {
            font-size: 13px;
        }

        blockquote,
        .blockquote {
            padding: 20px !important;
        }

        blockquote p,
        .blockquote p {
            font-size: 14px !important;
        }

        blockquote::before,
        .blockquote::before {
            left: 25px;
            top: -10px;
            font-size: 60px;
        }
    }

    /* Min width 576px to Max width 767px */
    /* Min width 768px to Max width 991px */
    @media only screen and (min-width: 768px) and (max-width: 991px) {
        .deals-details-content h3 {
            font-size: 16px;
        }

        .deals-details-content ul li.location span {
            font-size: 15px;
        }

        .deals-details-desc h3 {
            font-size: 17px;
        }

        .deals-details-review-form h3 {
            font-size: 17px;
        }

        blockquote,
        .blockquote {
            padding: 30px 40px !important;
        }

        blockquote p,
        .blockquote p {
            font-size: 16px !important;
        }
    }

    /* Min width 992px to Max width 1199px */
    @media only screen and (min-width: 992px) and (max-width: 1199px) {
        .deals-details-content h3 {
            font-size: 18px;
        }

        .deals-details-desc h3 {
            font-size: 18px;
        }

        .deals-details-author .author-profile .author-profile-title h4 {
            font-size: 17px;
        }

        .deals-details-review-form h3 {
            font-size: 18px;
        }
    }

    /* Min width 1200px to Max width 1355px */
    /* Min width 1550px */
</style>

<div class="page-title-area" style="background-image: url({{$productdata->image}});">
    <div class="container">
        <h1>{{$productdata->title}}</h1>
    </div>
</div>

<section class="deals-details-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="deals-details-image-slides">
                    <owl-carousel-o [options]="dealsDetailsImageSlides">
                        <ng-template carouselSlide>
                            <div class="article-image">
                                <img src="{{$productdata->image}}" alt="image">
                            </div>
                        </ng-template>
                        <div class="single-slider owl-carousel owl-theme">
                            @foreach($productdata->hotel->images as $imgs)
                            <div class="article-image">
                                <img src="{{asset($imgs->images)}}" alt="image">
                            </div>
                            @endforeach
                        </div>
                    </owl-carousel-o>
                </div>
                <div class="deals-details-content">
                    <h3>{{$productdata->title}}</h3>
                    <div class="rating d-flex align-items-center">
                        <span class="bx bxs-star checked"></span>
                        <span class="bx bxs-star checked"></span>
                        <span class="bx bxs-star checked"></span>
                        <span class="bx bxs-star checked"></span>
                        <span class="bx bxs-star checked"></span>
                        <span class="rating-count">({{$productdata->rating || 0}})</span>
                    </div>
                    <ul class="d-flex align-items-center">
                        <li class="phone-number">
                            <a href="tel:+2122791456"><i class="bx bx-phone-call"></i>
                                {{$productdata->hotel->mobile}}</a>
                        </li>
                        <li class="location">
                            <i class="bx bx-map"></i>
                            <span>Location</span>
                            {{$productdata->hotel->location}}
                        </li>
                        <a href="https://google.com/maps?q={{$productdata->hotel->lat}},{{$productdata->hotel->long}}" target="_blank"> <i class="fa fa-map"></i></a>

                    </ul>
                </div>
                <div class="deals-details-desc">
                    <p [innerHTML]="$productdata->description"></p>
                    <!-- <p><strong>1.</strong> Complimentary ground shipping within 1 to 7 business days<br>
                        <strong>2.</strong> In-store collection available within 1 to 7 business days<br>
                        <strong>3.</strong> Next-day and Express delivery options also available<br>
                        <strong>4.</strong> Purchases are delivered in an orange box tied with a Bolduc ribbon, with the exception<br>
                        <strong>5.</strong> See the delivery FAQs for details on shipping methods, costs and delivery times
                    </p> -->

                    <!-- <ul>
                        <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                        <li><strong>Marxa</strong> features a Fast Checkout option, allowing you to securely save your credit card details so that you don't have to re-enter them for future purchases.</li>
                        <li>PayPal: Shop easily online without having to enter your credit card details on the website.Your account will be charged once the order is completed. To register for a PayPal account, visit the website <a href="#" target="_blank">paypal.com.</a></li>
                    </ul> -->
                    <div class="cart-table table-responsive">
                        <h3>Package Includes ({{ isset($productdata->PackageItem) ? count($productdata->PackageItem) : 0 }})</h3>
                        <table class="table table-bordered">
                            <!-- <th>Image</th> -->
                            <!-- <th>Title</th>
                            <th>Description</th> -->
                            @foreach($productdata->PackageItem as $item)
                            <tr>
                                <td> <img src="{{asset($item->coupondata->image)}}" alt="image"></td>
                                <td>
                                    <div>
                                        <h6>{{$item->coupondata->title}}</h6>
                                        <p >
                                            {{$item->coupondata->description}}
                                        </p>
                                        <p class="coupon-desc-second">

                                        </p>
                                    </div>

                                </td>
                                <!-- <td [innerHTML]="item.coupondata.description"></td> -->
                                <!-- <td></td> -->


                            </tr>
                            @endforeach

                        </table>

                    </div>
                    <div class="terms-section">
                        <div class="terms-section-head" (click)="changeTermsStatus()">
                            <h3>Terms and condition</h3>
                            <span *ngIf="!termsStatus"><i class="fa fa-plus"></i></span>
                            <span *ngIf="termsStatus"><i class="fa fa-minus"></i></span>
                        </div>
                        <p>
                            {{$productdata->term_conditions}}
                        </p>
                    </div>
                </div>

                <!-- <div class="deals-details-review-comments">
                    <div class="user-review">
                        <img src="assets/img/user5.jpg" alt="image">
                        <div class="review-rating">
                            <div class="review-stars">
                                <i class="bx bxs-star checked"></i>
                                <i class="bx bxs-star checked"></i>
                                <i class="bx bxs-star checked"></i>
                                <i class="bx bxs-star checked"></i>
                                <i class="bx bxs-star checked"></i>
                            </div>
                            <span class="d-inline-block">James Anderson</span>
                        </div>
                        <span class="d-block sub-comment">Excellent</span>
                        <p>Very well built theme, couldn't be happier with it. Can't wait for future updates to see what else they add in.</p>
                    </div>
                    <div class="user-review">
                        <img src="assets/img/user2.jpg" alt="image">
                        <div class="review-rating">
                            <div class="review-stars">
                                <i class="bx bxs-star checked"></i>
                                <i class="bx bxs-star checked"></i>
                                <i class="bx bxs-star checked"></i>
                                <i class="bx bxs-star"></i>
                                <i class="bx bxs-star"></i>
                            </div>
                            <span class="d-inline-block">Sarah Taylor</span>
                        </div>
                        <span class="d-block sub-comment">Video Quality!</span>
                        <p>Was really easy to implement and they quickly answer my additional questions!</p>
                    </div>
                    <div class="user-review">
                        <img src="assets/img/user3.jpg" alt="image">
                        <div class="review-rating">
                            <div class="review-stars">
                                <i class="bx bxs-star checked"></i>
                                <i class="bx bxs-star checked"></i>
                                <i class="bx bxs-star checked"></i>
                                <i class="bx bxs-star checked"></i>
                                <i class="bx bxs-star checked"></i>
                            </div>
                            <span class="d-inline-block">David Warner</span>
                        </div>
                        <span class="d-block sub-comment">Perfect Coding!</span>
                        <p>Stunning design, very dedicated crew who welcome new ideas suggested by customers, nice support.</p>
                    </div>
                    <div class="user-review">
                        <img src="assets/img/user4.jpg" alt="image">
                        <div class="review-rating">
                            <div class="review-stars">
                                <i class="bx bxs-star checked"></i>
                                <i class="bx bxs-star checked"></i>
                                <i class="bx bxs-star checked"></i>
                                <i class="bx bxs-star checked"></i>
                                <i class="bx bxs-star"></i>
                            </div>
                            <span class="d-inline-block">King Kong</span>
                        </div>
                        <span class="d-block sub-comment">Perfect Video!</span>
                        <p>Stunning design, very dedicated crew who welcome new ideas suggested by customers, nice support.</p>
                    </div>
                </div>
                <div class="deals-details-review-form">
                    <h3>Add a review</h3>
                    <p class="comment-notes">Your email address will not be published. Required fields are marked <span>*</span></p>
                    <form>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="rating">
                                    <input type="radio" id="star5" name="rating" value="5"><label for="star5"></label>
                                    <input type="radio" id="star4" name="rating" value="4"><label for="star4"></label>
                                    <input type="radio" id="star3" name="rating" value="3"><label for="star3"></label>
                                    <input type="radio" id="star2" name="rating" value="2"><label for="star2"></label>
                                    <input type="radio" id="star1" name="rating" value="1"><label for="star1"></label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Name *">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email *">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <textarea placeholder="Your review" class="form-control" cols="30" rows="6" spellcheck="false"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <p class="comment-form-cookies-consent">
                                    <input type="checkbox" id="test1">
                                    <label for="test1">Save my name, email, and website in this browser for the next time I comment.</label>
                                </p>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <button type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div> -->
            </div>
            <div class="col-lg-4 col-md-12">
                <aside class="widget-area">
                    <div class="widget widget_deals_sidebar">
                        <div class="price">
                            <span class="new-price"><i class="fa fa-rupee"></i>{{$productdata->amount}}</span>
                            <!-- <span class="old-price">$330.00</span> -->
                        </div>
                        <div class="buy-now-btn">
                            <!-- <a *ngIf="logindetails==null" routerLink="/login" class="default-btn" style="cursor: pointer;">Buy Now</a> -->
                            <!-- <a *ngIf="logindetails!=null ||logindetails!=undefined" (click)="AddtoCart()" style="cursor: pointer;"class="default-btn">Buy Now</a> -->
                            <a (click)="AddtoCart()" style="cursor: pointer;" class="default-btn">Buy Now</a>


                            <span><i class='bx bx-cart bx-flashing'></i> 247+ bought</span>
                        </div>
                        <!-- <ul class="deals-value">
                            <li>Value <span>$330.00</span></li>
                            <li>Discount <span>50%</span></li>
                            <li>You Save <span>$165.00</span></li>
                        </ul> -->
                        <!-- <div class="offer-timer">
                            <p>Time Left - Limited Offer!</p>
                            <div id="timer" class="flex-wrap d-flex justify-content-center">
                                <div id="days" class="align-items-center flex-column d-flex justify-content-center">days}} <span>Days</span></div>
                                <div id="hours" class="align-items-center flex-column d-flex justify-content-center">hours}} <span>Hours</span></div>
                                <div id="minutes" class="align-items-center flex-column d-flex justify-content-center">minutes}} <span>Minutes</span></div>
                                <div id="seconds" class="align-items-center flex-column d-flex justify-content-center">seconds}} <span>Seconds</span></div>
                            </div>
                        </div> -->
                    </div>
                    <div class="widget widget_maps">
                        <h3 class="widget-title">About TripApna</h3>
                        <div class="content">
                            <p>We are pleased to introduce ourselves as Tripapna, founded by Tripapna Holiday Private
                                Limited. We are head-quartered in New Delhi since2010 and have pioneered a concept of
                                providing Membership Cards to our customers which would provide our clientele with
                                services in the field of Hotel & Restaurant Industry across India.</p>
                            <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.9476519598093!2d-73.99185268459418!3d40.74117737932881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a3f81d549f%3A0xb2a39bb5cacc7da0!2s175%205th%20Ave%2C%20New%20York%2C%20NY%2010010%2C%20USA!5e0!3m2!1sen!2sbd!4v1588746137032!5m2!1sen!2sbd"></iframe> -->
                        </div>
                    </div>
                    <!-- <div class="widget widget_author">
                        <h3 class="widget-title">About Author</h3>
                        <div class="content">
                            <img src="assets/img/user1.jpg" alt="image">
                            <h4>Chris Orwig</h4>
                            <span>Photographer, Author, Writer</span>
                            <a routerLink="/contact" class="default-btn">Contact With Me</a>
                        </div>
                    </div> -->
                    <div class="widget widget_socials_link">
                        <h3 class="widget-title">Stay Connected</h3>
                        <ul>
                            <li><a href="#" target="_blank"><i class='bx bxl-facebook'></i> Facebook</a></li>
                            <li><a href="#" target="_blank"><i class='bx bxl-twitter'></i> Twitter</a></li>
                            <li><a href="#" target="_blank"><i class='bx bxl-linkedin'></i> Linkedin</a></li>
                        </ul>
                    </div>
                    <div class="widget widget_about_store">
                        <div class="content">
                            <a routerLink="/stores-details" class="d-inline-block"><img class="m-0" src="assets/img/TripApna/flight.jpg" alt="image"></a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

@endsection
