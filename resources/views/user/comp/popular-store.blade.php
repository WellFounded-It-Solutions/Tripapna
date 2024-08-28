<style>
    .popular-store-inner .row {
        margin-left: 0;
        margin-right: 0;
    }

    .popular-store-inner .row .col-lg-8,
    .popular-store-inner .row .col-lg-4,
    .popular-store-inner .row .col-lg-4 {
        padding-left: 0;
        padding-right: 0;
    }

    .popular-store-content {
        z-index: 1;
        height: 100%;
        position: relative;
        text-align: center;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .popular-store-content::before {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        z-index: -1;
        background-color: #000;
        opacity: 0.7;
    }

    .popular-store-content .content {
        position: absolute;
        left: 0;
        right: 0;
        z-index: 1;
        top: 50%;
        transform: translateY(-50%);
        padding-left: 30px;
        padding-right: 30px;
    }

    .popular-store-content .content h2 {
        color: var(--whiteColor);
        font-size: 26px;
        margin-bottom: 15px;
    }

    .popular-store-content .content p {
        color: var(--whiteColor);
        opacity: 0.85;
    }

    .popular-store-content .content .default-btn {
        margin-top: 10px;
    }

    .popular-store-content .content .default-btn:hover {
        color: var(--blackColor);
        background-color: var(--whiteColor);
    }

    .popular-store-list {
        background-color: var(--whiteColor);
    }

    .popular-store-list .item {
        text-align: center;
        padding: 30px;
        border-right: 1px solid #eee;
        border-bottom: 1px solid #eee;
    }

    .popular-store-list .item a {
        display: inline-block;
    }

    .popular-store-list .item a img {
        transition: var(--transition);
    }

    .popular-store-list .item a:hover img {
        transform: scale(1.03);
    }

    .popular-store-list .row {
        margin-left: 0;
        margin-right: 0;
    }

    .popular-store-list .row .col-lg-3 {
        padding-left: 0;
        padding-right: 0;
    }

    .popular-store-list .col-lg-4:nth-child(3) .item,
    .popular-store-list .col-lg-4:nth-child(6) .item,
    .popular-store-list .col-lg-4:nth-child(9) .item,
    .popular-store-list .col-lg-4:nth-child(12) .item {
        border-right-width: 0;
    }

    .popular-store-list .col-lg-4:nth-child(10) .item,
    .popular-store-list .col-lg-4:nth-child(11) .item,
    .popular-store-list .col-lg-4:nth-child(12) .item {
        border-bottom-width: 0;
    }

    .filter-block {
        padding: 20px 25px;
        margin-bottom: 40px;
        background-color: var(--whiteColor);
    }

    .filter-block ul {
        padding-left: 0;
        margin-bottom: 0;
        list-style-type: none;
    }

    .filter-block ul li {
        margin-right: 17px;
        position: relative;
        display: inline-block;
    }

    .filter-block ul li::before {
        content: '';
        position: absolute;
        right: -10px;
        top: 4px;
        height: 15px;
        width: 1px;
        background-color: #e9e6e6;
    }

    .filter-block ul li a {
        display: block;
        font-weight: 700;
    }

    .filter-block ul li a:hover,
    .filter-block ul li a.active {
        color: var(--mainColor);
    }

    .filter-block ul li:last-child {
        margin-right: 0;
    }

    .filter-block ul li:last-child::before {
        display: none;
    }

    .filter-block form {
        position: relative;
    }

    .filter-block form .form-control {
        border-radius: 5px;
        background-color: #f5f5f5 !important;
    }

    .filter-block form button {
        position: absolute;
        right: 3px;
        top: 2px;
        height: 45px;
        width: 45px;
        padding: 0;
        line-height: 50px;
        border: none;
        background-color: var(--whiteColor);
        color: var(--blackColor);
        border-radius: 5px;
        transition: var(--transition);
        font-size: 20px;
    }

    .filter-block form button:hover {
        color: var(--whiteColor);
        background-color: var(--mainColor);
    }

    /* Max width 767px */
    @media only screen and (max-width: 767px) {
        .filter-block {
            padding: 20px 15px;
            margin-bottom: 30px;
            text-align: center;
        }

        .filter-block ul {
            margin-bottom: 15px;
        }

        .filter-block ul li::before {
            height: 12px;
        }

        .popular-store-content {
            height: auto;
            padding-top: 60px;
            padding-bottom: 60px;
        }

        .popular-store-content .content {
            position: relative;
            left: 0;
            right: 0;
            z-index: 1;
            top: 0;
            transform: unset;
            padding-left: 15px;
            padding-right: 15px;
        }

        .popular-store-content .content h2 {
            font-size: 19px;
            margin-bottom: 15px;
        }

        .popular-store-content .content .default-btn {
            margin-top: 5px;
        }

        .popular-store-list .item {
            padding: 15px;
        }

        .popular-store-list .col-lg-4:nth-child(3) .item,
        .popular-store-list .col-lg-4:nth-child(6) .item,
        .popular-store-list .col-lg-4:nth-child(9) .item,
        .popular-store-list .col-lg-4:nth-child(12) .item {
            border-right-width: 1px;
        }

        .popular-store-list .col-lg-4:nth-child(10) .item,
        .popular-store-list .col-lg-4:nth-child(11) .item,
        .popular-store-list .col-lg-4:nth-child(12) .item {
            border-bottom-width: 1px;
        }
    }

    /* Min width 576px to Max width 767px */
    /* Min width 768px to Max width 991px */
    @media only screen and (min-width: 768px) and (max-width: 991px) {
        .popular-store-content {
            height: auto;
            padding-top: 80px;
            padding-bottom: 80px;
        }

        .popular-store-content .content {
            position: relative;
            left: 0;
            right: 0;
            z-index: 1;
            top: 0;
            transform: unset;
            padding-left: 15px;
            padding-right: 15px;
        }

        .popular-store-content .content h2 {
            font-size: 23px;
            margin-bottom: 15px;
        }

        .popular-store-content .content .default-btn {
            margin-top: 5px;
        }

        .popular-store-list .item {
            padding: 20px;
        }

        .popular-store-list .col-lg-4:nth-child(3) .item,
        .popular-store-list .col-lg-4:nth-child(6) .item,
        .popular-store-list .col-lg-4:nth-child(9) .item,
        .popular-store-list .col-lg-4:nth-child(12) .item {
            border-right-width: 1px;
        }

        .popular-store-list .col-lg-4:nth-child(10) .item,
        .popular-store-list .col-lg-4:nth-child(11) .item,
        .popular-store-list .col-lg-4:nth-child(12) .item {
            border-bottom-width: 1px;
        }
    }

    /* Min width 992px to Max width 1199px */
    @media only screen and (min-width: 992px) and (max-width: 1199px) {
        .popular-store-list .item {
            padding: 20px;
        }
    }

    /* Min width 1200px to Max width 1355px */
    /* Min width 1550px */
</style>


<div class="container mt-4">
    <div class="popular-store-inner">
        <div class="row">


            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="popular-store-content" style="background-image: url('{{asset('user/img/TripApna/hotel.jpg')}}')">
                    <div class="content">
                        <h2>Popular Hotel</h2>
                        <p>Find top hotel Membership here!!!</p>
                        <a routerLink="/Content.buttonLink}}" class="default-btn">View All Hotels</a>
                    </div>
                </div>
            </div>


            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="popular-store-list">
                    <div class="row">

                        @foreach($HotelList as $hotel)
                        <div class="col-lg-4 col-sm-4 col-6 col-md-4">
                            <div class="item">
                                <a routerLink="stores-details/{{$hotel->id}}">
                                    <img src="{{$hotel->logo}}" alt="image">
                                </a>
                                <span class="location"><i class='bx bxs-map'></i>{{$hotel->location}}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
