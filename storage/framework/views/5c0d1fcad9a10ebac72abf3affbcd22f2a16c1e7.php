<style>
    .banner-wrapper-area {
        background-color: var(--blackColor);
        padding-top: 60px;
        padding-bottom: 60px;
    }

    .banner-wrapper-area .container-fluid {
        padding-left: 30px;
        padding-right: 15px;
    }

    .banner-wrapper-content {
        padding-right: 40px;
    }

    .banner-wrapper-content h1 {
        font-size: 32px;
        margin-bottom: 15px;
        color: var(--whiteColor);
    }

    .banner-wrapper-content p {
        color: var(--whiteColor);
        line-height: initial;
        font-size: 16px;
        margin: 0;
    }

    .banner-wrapper-content form {
        margin-top: 30px;
        border-radius: 5px;
        background-color: var(--whiteColor);
        padding-left: 20px;
        padding-right: 6px;
    }

    .banner-wrapper-content form .form-group {
        margin: 0;
        margin-left: 12px;
        position: relative;
        border-right: 1px solid #eee;
    }

    .banner-wrapper-content form .form-group label {
        margin-bottom: 0;
        position: absolute;
        left: 0;
        top: 19px;
        line-height: 1;
        font-size: 23px;
        color: var(--mainColor);
        z-index: 2;
    }

    .banner-wrapper-content form .form-group.category-select {
        border-right: none;
        padding-right: 20px;
    }

    .banner-wrapper-content form .form-group .form-control {
        border: none !important;
        color: var(--blackColor);
        box-shadow: unset !important;
        background-color: transparent !important;
        height: 60px;
        line-height: 60px;
        font-size: var(--fontSize);
        font-weight: 400;
        padding-top: 2px;
        padding-bottom: 0;
        padding-left: 30px;
        padding-right: 15px;
    }

    .banner-wrapper-content form .form-group .form-control::placeholder {
        transition: var(--transition);
        color: var(--optionalColor);
    }

    .banner-wrapper-content form .form-group .form-control:focus::placeholder {
        color: transparent;
    }

    .banner-wrapper-content form .form-group select {
        display: block;
        width: 100%;
        height: 60px;
        border: none;
        cursor: pointer;
        padding-left: 28px;
        padding-right: 15px;
        padding-top: 2px;
        padding-bottom: 0;
    }

    .banner-wrapper-content form .col-lg-4 .form-group {
        margin-left: 0;
    }

    .banner-wrapper-content form .submit-btn {
        padding-left: 5px;
    }

    .banner-wrapper-content form .submit-btn button {
        display: block;
        width: 100%;
        border: none;
        color: var(--whiteColor);
        padding: 13px 10px;
        border-radius: 5px;
        transition: var(--transition);
        background-color: var(--mainColor);
        font-size: 14px;
        font-weight: 600;
    }

    .banner-wrapper-content form .submit-btn button:hover {
        background-color: var(--blackColor);
        color: var(--whiteColor);
    }

    .banner-wrapper-content .popular-search-list {
        padding-left: 0;
        list-style-type: none;
        margin-bottom: 0;
        margin-top: 25px;
    }

    .banner-wrapper-content .popular-search-list li {
        margin-right: 20px;
        display: inline-block;
        color: var(--whiteColor);
    }

    .banner-wrapper-content .popular-search-list li a {
        position: relative;
        padding-left: 30px;
        display: inline-block;
        color: var(--whiteColor);
    }

    .banner-wrapper-content .popular-search-list li a i {
        left: 0;
        top: 0;
        font-size: 20px;
        position: absolute;
        color: var(--mainColor);
    }

    .banner-wrapper-content .popular-search-list li a::before {
        left: 0;
        bottom: 0;
        width: 0;
        height: 1px;
        content: '';
        position: absolute;
        transition: var(--transition);
        background-color: var(--mainColor);
    }

    .banner-wrapper-content .popular-search-list li a:hover::before {
        width: 100%;
    }

    .banner-wrapper-content .popular-search-list li:last-child {
        margin-right: 0;
    }

    /* Max width 767px */
    @media only screen and (max-width: 767px) {
        .banner-wrapper-area .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }

        .banner-wrapper-content {
            padding-right: 0;
            text-align: center;
        }

        .banner-wrapper-content h1 {
            font-size: 20px;
            line-height: 1.4;
        }

        .banner-wrapper-content p {
            font-size: 13px;
        }

        .banner-wrapper-content form {
            margin-top: 25px;
            border-radius: 0;
            padding: 15px;
        }

        .banner-wrapper-content form .form-group {
            border-right: none;
            margin-left: 0;
            margin-bottom: 10px;
        }

        .banner-wrapper-content form .form-group label {
            left: 10px;
            top: 16px;
            font-size: 18px;
        }

        .banner-wrapper-content form .form-group label .flaticon-category {
            position: relative;
            top: 1px;
        }

        .banner-wrapper-content form .form-group .form-control {
            height: 50px;
            line-height: 50px;
            font-size: 13px;
            border: 1px solid #eee !important;
            padding-left: 35px;
            padding-right: 10px;
        }

        .banner-wrapper-content form .form-group select {
            height: 50px;
            font-size: 13px;
            line-height: 46px;
            border: 1px solid #eee;
            padding-left: 35px;
            padding-right: 10px;
        }

        .banner-wrapper-content form .form-group.category-select {
            padding-right: 0;
        }

        .banner-wrapper-content form .submit-btn {
            padding-left: 0;
            margin-top: 5px;
        }

        .banner-wrapper-content form .submit-btn button {
            padding: 12px 25px;
            font-size: 13px;
        }

        .banner-wrapper-content .popular-search-list {
            margin-top: 20px;
        }

        .banner-wrapper-content .popular-search-list li {
            margin-top: 10px;
        }

        .banner-wrapper-content .popular-search-list li a {
            padding-left: 24px;
        }

        .banner-wrapper-content .popular-search-list li a i {
            font-size: 17px;
        }

        .banner-wrapper-image {
            text-align: center;
            margin-top: 35px;
        }
    }

    /* Min width 576px to Max width 767px */
    @media only screen and (min-width: 576px) and (max-width: 767px) {
        .banner-wrapper-area .container-fluid {
            max-width: 540px;
        }
    }

    /* Min width 768px to Max width 991px */
    @media only screen and (min-width: 768px) and (max-width: 991px) {
        .banner-wrapper-area {
            padding-top: 80px;
            padding-bottom: 80px;
        }

        .banner-wrapper-area .container-fluid {
            max-width: 720px;
            padding-left: 15px;
            padding-right: 15px;
        }

        .banner-wrapper-content {
            padding-right: 0;
            text-align: center;
        }

        .banner-wrapper-content h1 {
            font-size: 26px;
        }

        .banner-wrapper-content p {
            font-size: 14px;
        }

        .banner-wrapper-content form {
            border-radius: 0;
            padding: 25px;
            margin-top: 30px;
        }

        .banner-wrapper-content form .form-group {
            border-right: none;
            margin-left: 0;
            margin-bottom: 15px;
        }

        .banner-wrapper-content form .form-group label {
            left: 12px;
            top: 18px;
            font-size: 20px;
        }

        .banner-wrapper-content form .form-group .form-control {
            height: 55px;
            font-size: 14px;
            line-height: 55px;
            border: 1px solid #eee !important;
            padding-left: 40px;
            padding-right: 10px;
        }

        .banner-wrapper-content form .form-group select {
            border: 1px solid #eee;
            height: 55px;
            line-height: 54px;
            font-size: 14px;
            padding-left: 40px;
            padding-right: 10px;
        }

        .banner-wrapper-content form .form-group.category-select {
            padding-right: 0;
            margin-left: 15px;
        }

        .banner-wrapper-content form .submit-btn {
            padding-left: 0;
            margin-top: 5px;
        }

        .banner-wrapper-content form .submit-btn button {
            display: inline-block;
            width: auto;
            font-size: 14px;
            padding: 12px 30px;
        }

        .banner-wrapper-content .popular-search-list {
            margin-top: 15px;
        }

        .banner-wrapper-content .popular-search-list li {
            margin-top: 10px;
        }

        .banner-wrapper-image {
            text-align: center;
            margin-top: 35px;
        }
    }

    /* Min width 992px to Max width 1199px */
    @media only screen and (min-width: 992px) and (max-width: 1199px) {
        .banner-wrapper-area {
            padding-top: 100px;
            padding-bottom: 100px;
        }

        .banner-wrapper-area .container-fluid {
            max-width: 960px;
            padding-left: 15px;
            padding-right: 15px;
        }

        .banner-wrapper-area .col-lg-7,
        .banner-wrapper-area .col-lg-5 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .banner-wrapper-image {
            text-align: center;
            margin-top: 40px;
        }
    }

    /* Min width 1200px to Max width 1355px */
    @media only screen and (min-width: 1200px) and (max-width: 1355px) {
        .banner-wrapper-content {
            padding-right: 0;
        }

        .banner-wrapper-content h1 {
            font-size: 30px;
        }

        .banner-wrapper-content form .col-lg-4:nth-child(1) {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .banner-wrapper-content form .col-lg-4:nth-child(1) .form-group {
            border-right: none;
            border-bottom: 1px solid #eee;
        }

        .banner-wrapper-content form .col-lg-3 {
            flex: 0 0 37%;
            max-width: 37%;
        }

        .banner-wrapper-content form .col-lg-3 .form-group {
            margin-left: 0;
        }

        .banner-wrapper-content form .form-group.category-select {
            margin-left: 15px;
        }

        .banner-wrapper-content form .col-lg-2 {
            flex: 0 0 25%;
            max-width: 25%;
        }

        .banner-wrapper-content .popular-search-list {
            margin-top: 20px;
        }

        .banner-wrapper-content .popular-search-list li {
            margin-top: 12px;
        }
    }

    /* Min width 1550px */
    @media only screen and (min-width: 1550px) {
        .banner-wrapper-area .container-fluid {
            padding-left: 80px;
        }
    }
</style>


<div class="banner-wrapper-area">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-12">
                <div class="banner-wrapper-content" *ngFor="let Content of bannerWrapperContent;">
                    <h1>Find Flight, Hotel, Taxi & Hotel Package</h1>
                    <p>Get best deal on everything you buy.........</p>
                    <form>
                        <div class="row m-0 align-items-center">
                            <!-- <div class="col-lg-4 col-md-12 p-0">
                                <div class="form-group">
                                    <label><i class='bx bx-search-alt'></i></label>
                                    <input type="text" class="form-control" placeholder="What are you looking for?" disabled>
                                </div>
                            </div> -->
                            <div class="col-lg-8 col-md-8 p-0">
                                <div class="form-group">
                                    <label><i class='bx bx-map'></i></label>
                                    <input type="text" class="form-control" placeholder="Location" (input)="changeLocation($event)">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 p-0">
                                <div class="submit-btn">
                                    <button type="submit" (click)="search()">Search Now</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- <ul class="popular-search-list">
                        <li>Popular:</li>
                        <li><a routerLink="/search-page"><i class="bx bx-hotel"></i> Flight</a></li>
                        <li><a routerLink="/search-page"><i class="bx bxs-hotel"></i> Hotel</a></li>
                        <li><a routerLink="/search-page"><i class="bx bxs-car-mechanic"></i> Taxi</a></li>
                        <li><a routerLink="/all-store"><i class="bx bx-hotel"></i> Hotel Package</a></li>
                    </ul> -->
                </div>
            </div>

            <div class="col-lg-5 col-md-12">
                <div class="banner-wrapper-image" *ngFor="let Image of bannerWrapperImage;">
                    <!-- <img [src]="Image.img" alt="image"> -->
                    <video controls autoplay width="510" height="330">
                        <source [src]="Image.img" type="video/mp4">
                    </video>
                </div>

            </div>
        </div>
    </div>
</div>
<?php /**PATH E:\client\tripapna\admin\resources\views/user/comp/homebanner.blade.php ENDPATH**/ ?>