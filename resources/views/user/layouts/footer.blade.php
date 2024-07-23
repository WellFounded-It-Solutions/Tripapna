<style>
    .footer-area {
        background-color: var(--whiteColor);
    }

    .single-footer-widget {
        margin-bottom: 30px;
    }

    .single-footer-widget .logo {
        margin-bottom: 20px;
    }

    .single-footer-widget h3 {
        font-size: 18px;
        position: relative;
        padding-bottom: 8px;
        margin-bottom: 25px;
    }

    .single-footer-widget h3::before {
        left: 0;
        bottom: 0;
        height: 2px;
        width: 40px;
        content: '';
        position: absolute;
        background-color: var(--mainColor);
    }

    .single-footer-widget .links-list {
        padding-left: 0;
        margin-bottom: 0;
        list-style-type: none;
    }

    .single-footer-widget .links-list li {
        margin-bottom: 12px;
    }

    .single-footer-widget .links-list li:last-child {
        margin-bottom: 0;
    }

    .single-footer-widget .links-list li a {
        position: relative;
        display: inline-block;
        color: var(--optionalColor);
    }

    .single-footer-widget .links-list li a:hover {
        color: var(--mainColor);
    }

    .single-footer-widget .links-list li a::before {
        left: 0;
        width: 0;
        bottom: 0;
        content: '';
        height: 1px;
        position: absolute;
        transition: var(--transition);
        background-color: var(--mainColor);
    }

    .single-footer-widget .links-list li a:hover::before {
        width: 100%;
    }

    .single-footer-widget .footer-contact-info {
        padding-left: 0;
        margin-bottom: 0;
        list-style-type: none;
    }

    .single-footer-widget .footer-contact-info li {
        margin-bottom: 12px;
        color: var(--optionalColor);
    }

    .single-footer-widget .footer-contact-info li:last-child {
        margin-bottom: 0;
    }

    .single-footer-widget .footer-contact-info li a {
        color: var(--optionalColor);
    }

    .single-footer-widget .footer-contact-info li a:hover {
        color: var(--mainColor);
    }

    .single-footer-widget .social-links {
        padding-left: 0;
        list-style-type: none;
        margin-bottom: 0;
        margin-top: 20px;
    }

    .single-footer-widget .social-links li {
        display: inline-block;
        margin-right: 9px;
    }

    .single-footer-widget .social-links li a {
        width: 33px;
        height: 33px;
        display: block;
        font-size: 17px;
        border-radius: 2px;
        position: relative;
        text-align: center;
        color: var(--whiteColor);
        background-color: #373737;
    }

    .single-footer-widget .social-links li a i {
        left: 0;
        right: 0;
        top: 50%;
        position: absolute;
        transform: translateY(-50%);
    }

    .single-footer-widget .social-links li a:hover {
        color: var(--whiteColor);
        background-color: var(--mainColor);
    }

    .single-footer-widget .social-links li:last-child {
        margin-right: 0;
    }

    .copyright-area {
        margin-top: 60px;
        border-top: 1px solid #e1e2e6;
        padding-top: 25px;
        padding-bottom: 25px;
    }

    .copyright-area p strong {
        font-weight: 600;
        color: var(--mainColor);
    }

    .copyright-area p a {
        font-weight: 600;
    }

    .copyright-area ul {
        padding-left: 0;
        margin-bottom: 0;
        text-align: right;
        list-style-type: none;
    }

    .copyright-area ul li {
        position: relative;
        display: inline-block;
        color: var(--optionalColor);
        margin-left: 13px;
        margin-right: 13px;
    }

    .copyright-area ul li::before {
        top: 13px;
        content: '';
        width: 10px;
        height: 1px;
        left: -20px;
        position: absolute;
        background-color: #e1e2e6;
    }

    .copyright-area ul li a {
        display: block;
        color: var(--optionalColor);
    }

    .copyright-area ul li a:hover {
        color: var(--mainColor);
    }

    .copyright-area ul li:first-child {
        margin-left: 0;
    }

    .copyright-area ul li:first-child::before {
        display: none;
    }

    .copyright-area ul li:last-child {
        margin-right: 0;
    }

    /* Max width 767px */
    @media only screen and (max-width: 767px) {

        .single-footer-widget.pl-4,
        .single-footer-widget.px-4 {
            padding-left: 0 !important;
        }

        .single-footer-widget .logo {
            margin-bottom: 20px;
        }

        .single-footer-widget .social-links {
            margin-top: 15px;
        }

        .single-footer-widget h3 {
            font-size: 15px;
        }

        .copyright-area {
            margin-top: 30px;
            text-align: center;
        }

        .copyright-area ul {
            text-align: center;
            margin-top: 15px;
        }

        .copyright-area ul li::before {
            top: 11px;
        }
    }

    /* Min width 576px to Max width 767px */
    @media only screen and (min-width: 576px) and (max-width: 767px) {
        .copyright-area {
            text-align: left;
        }

        .copyright-area ul {
            text-align: right;
            margin-top: 0;
        }
    }

    /* Min width 768px to Max width 991px */
    @media only screen and (min-width: 768px) and (max-width: 991px) {
        .single-footer-widget h3 {
            font-size: 16px;
        }

        .copyright-area {
            margin-top: 50px;
        }
    }

    /* Min width 992px to Max width 1199px */
    /* Min width 1200px to Max width 1355px */
    /* Min width 1550px */
</style>


<footer class="footer-area pt-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="single-footer-widget" *ngFor="let Content of singleFooterWidget;">
                    <a routerLink="/" class="logo d-inline-block">
                        <img src="{{asset('img/logo.png')}}" alt="image">
                    </a>
                    <p>Our company is providing our members with the promise of Lowest Price Guarantee across our listed properties along with 24x7 Customer Support.</p>
                    <ul class="social-links">
                        <li><a href="#" target="_blank"><i class="bx bxl-facebook"></i></a></li>
                        <li><a href="#" target="_blank"><i class="bx bxl-twitter"></i></a></li>
                        <li><a href="#" target="_blank"><i class="bx bxl-linkedin"></i></a></li>
                        <li><a href="#" target="_blank"><i class="bx bxl-instagram"></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="single-footer-widget pl-4">
                    <h3>Useful Links</h3>
                    <ul class="links-list">
                        <li><a routerLink="/about-us">About Us</a></li>
                        <li><a routerLink="/how-it-works">Rule of Use</a></li>
                        <li><a routerLink="/privacypolicy">Privacy Policy</a></li>
                        <li><a routerLink="/cancellationandrefund">Cancellation & Refund</a></li>
                        <li><a routerLink="/termsandcondition">Terms & Conditions</a></li>


                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="single-footer-widget">
                    <h3>Quick link</h3>
                    <ul class="links-list">
                        <li><a routerLink="/coming-soon">Hotel Booking</a></li>
                        <li><a routerLink="/coming-soon">Flight Booking</a></li>
                        <li><a routerLink="/coming-soon">Taxi Booking</a></li>
                        <li><a routerLink="/all-stores">Hotel Package</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="single-footer-widget">
                    <h3>Contact Info</h3>
                    <ul class="footer-contact-info">
                        <li>Address: 20 Lakshmi Lotus, Subhas road, Kumbhan Khan Pada, Dombivali (Thane), Maharastra - 421202</li>
                        <li>Email: <a href="mailto:info@tripapna.in">info@tripapna.in</a></li>
                        <li>Phone: <a href="tel:+4458895456">8882060409</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <p>Copyright @{{ marxaYear }} <strong>Tripapna</strong> is Proudly Powered by Tripapna</p>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <ul>
                        <li><a routerLink="/customer-service">Privacy Policy</a></li>
                        <li><a routerLink="/customer-service">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
