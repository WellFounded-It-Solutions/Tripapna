<style>
    .single-deals-box {
        border-radius: 5px;
        margin-bottom: 30px;
        background-color: var(--whiteColor);
    }

    .single-deals-box .deals-image {
        overflow: hidden;
        position: relative;
        border-radius: 5px 5px 0 0;
        text-align: center;
    }

    .single-deals-box .deals-image a {
        border-radius: 5px 5px 0 0;
    }

    .single-deals-box .deals-image a img {
        border-radius: 5px 5px 0 0;
        transition: var(--transition);
    }

    .single-deals-box .deals-image .bookmark-save {
        top: 15px;
        right: 15px;
        z-index: 3;
        width: 35px;
        height: 35px;
        font-size: 18px;
        text-align: center;
        position: absolute;
        line-height: 38px;
        border-radius: 50%;
        display: inline-block;
        color: var(--whiteColor);
        background-color: rgba(0, 0, 0, 0.55);
    }

    .single-deals-box .deals-image .bookmark-save:hover {
        color: var(--whiteColor);
        background-color: var(--mainColor);
    }

    .single-deals-box .deals-image .discount {
        left: 0;
        bottom: 0;
        position: absolute;
        color: var(--whiteColor);
        padding: 5px 25px 5px 12px;
        background-image: url(../../../../assets/img/ribbon-bg.png);
        background-position: right center;
        background-size: cover;
        background-repeat: no-repeat;
        font-size: 13.5px;
        font-weight: 600;
        font-family: var(--headingFontFamily);
    }

    .single-deals-box .deals-image .show-coupon-code {
        position: absolute;
        color: var(--mainColor);
        display: inline-block;
        left: 13px;
        top: 13px;
        padding: 8px 20px;
        background-color: transparent;
        transition: var(--transition);
        border: 1px dashed var(--whiteColor);
        color: var(--whiteColor);
        font-size: 13px;
        font-weight: 600;
        font-family: var(--headingFontFamily);
    }

    .single-deals-box .deals-image .show-coupon-code:hover {
        color: var(--whiteColor);
        border-color: var(--mainColor);
        background-color: var(--mainColor);
    }

    .single-deals-box .deals-content {
        padding: 20px;
    }

    .single-deals-box .deals-content .rating i {
        line-height: 1;
        color: #c44118;
        font-size: 13.5px;
        margin-right: 2px;
    }

    .single-deals-box .deals-content .rating i:last-child {
        margin-right: 0;
    }

    .single-deals-box .deals-content .rating .count {
        display: inline-block;
        color: var(--optionalColor);
        font-size: 13.5px;
        font-weight: 500;
        font-family: var(--headingFontFamily);
    }

    .single-deals-box .deals-content .status span {
        color: #1c610e;
        position: relative;
        padding-left: 20px;
        font-size: 13.5px;
        font-weight: 500;
        font-family: var(--headingFontFamily);
    }

    .single-deals-box .deals-content .status span i {
        position: absolute;
        font-size: 16px;
        left: 0;
        top: 1px;
    }

    .single-deals-box .deals-content h3 {
        font-size: 16px;
        margin-top: 13px;
        margin-bottom: 13px;
    }

    .single-deals-box .deals-content h3 a {
        display: inline-block;
    }

    .single-deals-box .deals-content .location {
        display: block;
        position: relative;
        padding-left: 19px;
        color: var(--optionalColor);
        font-size: 13.5px;
        font-weight: 500;
        font-family: var(--headingFontFamily);
    }

    .single-deals-box .deals-content .location i {
        top: 2px;
        font-size: 16px;
        left: 0;
        position: absolute;
    }

    .single-deals-box .box-footer {
        padding: 20px 20px 18px;
        border-top: 1px solid #ececec;
    }

    .single-deals-box .box-footer .price span {
        display: inline-block;
        line-height: 1;
        font-size: 18px;
        font-weight: 700;
        font-family: var(--headingFontFamily);
    }

    .single-deals-box .box-footer .price span.old-price {
        margin-left: 5px;
        font-weight: 400;
        color: var(--optionalColor);
        text-decoration: line-through;
    }

    .single-deals-box .box-footer .details-btn {
        top: -2px;
        position: relative;
        display: inline-block;
        color: var(--mainColor);
        font-size: 14px;
        font-weight: 600;
        font-family: var(--headingFontFamily);
    }

    .single-deals-box .box-footer .details-btn::before {
        right: 0;
        bottom: 0;
        width: 100%;
        height: 1px;
        content: '';
        position: absolute;
        background-color: var(--mainColor);
        transition: var(--transition);
    }

    .single-deals-box .box-footer .details-btn:hover::before {
        width: 0;
    }

    .single-deals-box:hover .deals-image a img {
        transform: scale(1.07);
    }

    .single-deals-coupon-box {
        margin-bottom: 30px;
    }

    .single-deals-coupon-box .deals-coupon-image {
        position: relative;
        z-index: 1;
        height: 100%;
        text-align: center;
        border-radius: 10px;
        background-position: center center;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .single-deals-coupon-box .deals-coupon-image .main-image {
        display: none;
    }

    .single-deals-coupon-box .deals-coupon-image::before {
        left: 0;
        right: 0;
        top: 0;
        border-radius: 10px;
        bottom: 0;
        z-index: -1;
        content: '';
        transition: var(--transition);
        opacity: 0;
        visibility: hidden;
        position: absolute;
        background-color: #000;
    }

    .single-deals-coupon-box .deals-coupon-image .content {
        left: 0;
        right: 0;
        z-index: 1;
        top: 50%;
        transition: var(--transition);
        opacity: 0;
        visibility: hidden;
        position: absolute;
        transform: translateY(-50%);
        padding-left: 20px;
        padding-right: 20px;
    }

    .single-deals-coupon-box .deals-coupon-image .content img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .single-deals-coupon-box .deals-coupon-image .content .link-btn {
        display: inline-block;
        color: var(--whiteColor);
        margin-top: 15px;
        position: relative;
        font-size: 14px;
        font-weight: 600;
        font-family: var(--headingFontFamily);
    }

    .single-deals-coupon-box .deals-coupon-image .content .link-btn::before {
        content: '';
        position: absolute;
        left: 0;
        width: 100%;
        height: 1px;
        transition: var(--transition);
        background-color: var(--whiteColor);
        bottom: 0;
    }

    .single-deals-coupon-box .deals-coupon-image .content .link-btn:hover {
        color: var(--mainColor);
    }

    .single-deals-coupon-box .deals-coupon-image .content .link-btn:hover::before {
        background-color: var(--mainColor);
    }

    .single-deals-coupon-box .deals-coupon-content {
        padding: 30.3px;
        border-radius: 10px;
        background-color: var(--whiteColor);
    }

    .single-deals-coupon-box .deals-coupon-content h3 {
        font-size: 16px;
        margin-bottom: 12px;
    }

    .single-deals-coupon-box .deals-coupon-content p {
        color: var(--blackColor);
    }

    .single-deals-coupon-box .deals-coupon-content .show-coupon-code {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #e9e9e9;
    }

    .single-deals-coupon-box .deals-coupon-content .show-coupon-code span {
        margin-right: 8px;
        display: inline-block;
        color: var(--optionalColor);
        font-size: 14px;
        font-weight: 600;
        font-family: var(--headingFontFamily);
    }

    .single-deals-coupon-box .deals-coupon-content .show-coupon-code .code-btn {
        cursor: pointer;
        border: 1px dashed var(--mainColor);
        position: relative;
        transition: var(--transition);
        color: var(--mainColor);
        display: inline-block;
        padding: 10px 38px 10px 20px;
        background-color: transparent;
        font-size: 14px;
        font-weight: 600;
        font-family: var(--headingFontFamily);
    }

    .single-deals-coupon-box .deals-coupon-content .show-coupon-code .code-btn i {
        position: absolute;
        right: 20px;
        font-size: 20px;
        margin-top: 1px;
        top: 50%;
        transform: translateY(-50%);
    }

    .single-deals-coupon-box .deals-coupon-content .show-coupon-code .code-btn:hover {
        color: var(--whiteColor);
        background-color: var(--mainColor);
    }

    .single-deals-coupon-box:hover .deals-coupon-image::before {
        opacity: 0.75;
        visibility: visible;
    }

    .single-deals-coupon-box:hover .deals-coupon-image .content {
        opacity: 1;
        visibility: visible;
    }

    .single-deals-coupon-box:last-child {
        margin-bottom: 0;
    }

    /* Max width 767px */
    @media only screen and (max-width: 767px) {
        .single-deals-box .deals-image .bookmark-save {
            width: 30px;
            height: 30px;
            font-size: 15px;
            line-height: 30px;
        }

        .single-deals-box .deals-image .discount {
            font-size: 13px;
        }

        .single-deals-box .deals-content {
            padding: 15px;
        }

        .single-deals-box .deals-content .rating i {
            font-size: 13px;
        }

        .single-deals-box .deals-content .rating .average-rating {
            font-size: 13px;
        }

        .single-deals-box .deals-content .rating .count {
            font-size: 13px;
        }

        .single-deals-box .deals-content .status span {
            font-size: 13px;
        }

        .single-deals-box .deals-content .status span i {
            font-size: 15px;
            top: 1px;
        }

        .single-deals-box .deals-content h3 {
            font-size: 14px;
        }

        .single-deals-box .deals-content .location {
            font-size: 13px;
        }

        .single-deals-box .deals-content .location i {
            top: 2px;
            font-size: 15px;
            left: 0;
        }

        .single-deals-box .box-footer {
            padding: 15px;
        }

        .single-deals-box .box-footer .price span {
            font-size: 15px;
        }

        .single-deals-box .box-footer .details-btn {
            font-size: 13px;
        }

        .single-deals-coupon-box .deals-coupon-image {
            height: auto;
            background-image: unset !important;
        }

        .single-deals-coupon-box .deals-coupon-image .main-image {
            display: inline-block;
        }

        .single-deals-coupon-box .deals-coupon-image::before {
            z-index: 1;
        }

        .single-deals-coupon-box .deals-coupon-image .content .link-btn {
            font-size: 13px;
        }

        .single-deals-coupon-box .deals-coupon-content {
            padding: 20px 15px;
            border-top-right-radius: 0;
            border-top-left-radius: 0;
        }

        .single-deals-coupon-box .deals-coupon-content h3 {
            font-size: 15px;
        }

        .single-deals-coupon-box .deals-coupon-content .show-coupon-code {
            margin-top: 15px;
            padding-top: 15px;
        }

        .single-deals-coupon-box .deals-coupon-content .show-coupon-code span {
            font-size: 13px;
            display: block;
            margin-right: 0;
            margin-bottom: 8px;
        }

        .single-deals-coupon-box .deals-coupon-content .show-coupon-code .code-btn {
            font-size: 13px;
            padding: 9px 35px 9px 15px;
            cursor: pointer;
        }

        .single-deals-coupon-box .deals-coupon-content .show-coupon-code .code-btn i {
            right: 15px;
            font-size: 20px;
        }
    }

    /* Min width 576px to Max width 767px */
    /* Min width 768px to Max width 991px */
    /* Min width 992px to Max width 1199px */
    /* Min width 1200px to Max width 1355px */
    /* Min width 1550px */
</style>

<div class="container-fluid">
    <div class="section-title text-start" style="
    padding-top: 40px;">
        <h2>Best Deals In This Month</h2>
        <p>Grab the best deals on popular hotels at the best price</p>
    </div>

    <div class="deals-slides">
            <div class="responsive-slider owl-carousel owl-theme" >
                @foreach($latestDeal as $Content)
                <div class="single-deals-box">
                    <div class="deals-image">
                        <a href="{{url('deals-details')}}/{{$Content->id}}" class="d-block">
                            <img src="{{asset($Content->image)}}" alt="image">
                        </a>
                        <!-- <a href="javascript:void(0)" class="bookmark-save"></a> -->
                        <div class="discount" *ngIf="Content.discount">discount</div>
                    </div>
                    <div class="deals-content">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="rating">
                                <i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star"></i>
                                <span class="count"></span>
                            </div>
                            <!-- <div class="status">
                                <span *ngIf="Content.trending"><i class='bx bx-trending-up'></i> .trending}}</span>
                            </div> -->
                        </div>
                        <h3><a href="{{url('deals-details')}}/{{$Content->id}}">{{ $Content->title }}</a></h3>
                        <span class="location"><i class='bx bxs-map'></i> {{ $Content->location }}</span>
                    </div>
                    <div class="box-footer">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="price">
                                <span class="new-price"><i class="fa fa-rupee"></i>{{number_format($Content->amount)}}</span>
                                <!-- <span class="old-price" *ngIf="Content.oldPrice">.oldPrice}}</span> -->
                            </div>
                            <a href="{{url('deals-details')}}/{{$Content->id}}" class="details-btn">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
    </div>
</div>
