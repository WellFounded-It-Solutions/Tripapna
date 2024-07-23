<style>
    .top-header-area {
        background-color: var(--blackColor);
        padding-top: 12px;
        padding-bottom: 12px;
    }

    .top-header-area .container-fluid {
        padding-left: 30px;
        padding-right: 30px;
    }

    .top-header-area .container-fluid.container {
        padding-left: 15px;
        padding-right: 15px;
    }

    .top-header-contact-info {
        padding-left: 0;
        margin-bottom: 0;
        list-style-type: none;
    }

    .top-header-contact-info li {
        display: inline-block;
        margin-right: 20px;
        position: relative;
        padding-left: 22px;
        color: var(--whiteColor);
    }

    .top-header-contact-info li i {
        left: 0;
        top: 3px;
        font-size: 16px;
        position: absolute;
    }

    .top-header-contact-info li i.bx-envelope {
        top: 2.5px;
    }

    .top-header-contact-info li a {
        display: block;
        color: var(--whiteColor);
    }

    .top-header-contact-info li:last-child {
        margin-right: 0;
    }

    .top-header-right {
        text-align: right;
    }

    .top-header-right ul {
        list-style-type: none;
        padding-left: 0;
        margin-bottom: 0;
    }

    .top-header-right ul li {
        margin-right: 20px;
        position: relative;
        padding-left: 22px;
        color: var(--whiteColor);
    }

    .top-header-right ul li i {
        position: absolute;
        left: 0;
        top: 3.5px;
        font-size: 16px;
    }

    .top-header-right ul li a {
        display: block;
        color: var(--whiteColor);
    }

    .top-header-right ul li:last-child {
        margin-right: 0;
    }

    .top-header-right ul li .language-switcher {
        margin-right: -3px;
    }

    .top-header-right ul li .language-switcher .dropdown-toggle {
        padding: 0;
        border: none;
        color: var(--whiteColor);
        background-color: transparent;
    }

    .top-header-right ul li .language-switcher .dropdown-toggle::after {
        display: none;
    }

    .top-header-right ul li .language-switcher .dropdown-toggle img {
        width: 25px;
        top: -1px;
        position: relative;
    }

    .top-header-right ul li .language-switcher .dropdown-toggle span {
        display: inline-block;
        margin-left: 7px;
    }

    .top-header-right ul li .language-switcher .dropdown-toggle span i {
        top: 4px;
        font-size: 18px;
        margin-left: -3px;
        position: relative;
    }

    .top-header-right ul li .language-switcher .dropdown-menu {
        opacity: 0;
        float: unset;
        border: none;
        padding: 15px;
        display: block;
        min-width: 7rem;
        border-radius: 0;
        margin-top: 12px;
        visibility: hidden;
        transform: scaleX(0);
        transition: var(--transition);
        box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.1);
    }

    .top-header-right ul li .language-switcher .dropdown-menu .dropdown-item {
        padding: 0;
        color: var(--blackColor);
        margin-bottom: 10px;
    }

    .top-header-right ul li .language-switcher .dropdown-menu .dropdown-item:last-child {
        margin-bottom: 0;
    }

    .top-header-right ul li .language-switcher .dropdown-menu .dropdown-item img {
        width: 30px;
        border-radius: 5px;
        border: 2px solid var(--whiteColor);
    }

    .top-header-right ul li .language-switcher .dropdown-menu .dropdown-item span {
        display: inline-block;
        margin-left: 8px;
    }

    .top-header-right ul li .language-switcher .dropdown-menu .dropdown-item:hover,
    .top-header-right ul li .language-switcher .dropdown-menu .dropdown-item:focus {
        background-color: transparent !important;
    }

    .top-header-right ul li .language-switcher .dropdown-menu .dropdown-item:active,
    .top-header-right ul li .language-switcher .dropdown-menu .dropdown-item.active {
        color: var(--blackColor);
        background-color: transparent;
    }

    .top-header-right ul li .language-switcher.active .dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: scaleX(1);
    }

    .top-header-right ul li:nth-child(1) {
        padding-left: 0;
    }

    /* Max width 767px */
    @media only screen and (max-width: 767px) {
        .top-header-area {
            text-align: center;
        }

        .top-header-area .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }

        .top-header-contact-info {
            margin-bottom: -8px;
        }

        .top-header-contact-info li {
            margin-left: 5px;
            margin-right: 5px;
            margin-bottom: 8px;
        }

        .top-header-contact-info li:firat-child {
            margin-left: 0;
        }

        .top-header-contact-info li i {
            font-size: 16px;
            top: 0.5px;
        }

        .top-header-contact-info li i.bx-envelope {
            top: 1px;
        }

        .top-header-right {
            text-align: center;
            margin-top: 10px;
        }

        .top-header-right .justify-content-end {
            justify-content: unset !important;
            display: block !important;
        }

        .top-header-right ul li {
            display: inline-block;
            margin-left: 5px;
            margin-right: 5px;
            margin-bottom: 8px;
        }

        .top-header-right ul li:firat-child {
            margin-left: 0;
        }

        .top-header-right ul li i {
            font-size: 16px;
            top: 1.5px;
        }
    }

    /* Min width 576px to Max width 767px */
    @media only screen and (min-width: 576px) and (max-width: 767px) {
        .top-header-area .container-fluid {
            max-width: 540px;
        }
    }

    /* Min width 768px to Max width 991px */
    @media only screen and (min-width: 768px) and (max-width: 991px) {
        .top-header-area .container-fluid {
            max-width: 720px;
            padding-left: 15px;
            padding-right: 15px;
        }
    }

    /* Min width 992px to Max width 1199px */
    @media only screen and (min-width: 992px) and (max-width: 1199px) {
        .top-header-area .container-fluid {
            max-width: 960px;
            padding-left: 15px;
            padding-right: 15px;
        }
    }

    /* Min width 1200px to Max width 1355px */
    @media only screen and (min-width: 1200px) and (max-width: 1355px) {
        .top-header-area .container-fluid {
            max-width: 1140px;
            padding-left: 15px;
            padding-right: 15px;
        }
    }

    /* Min width 1550px */
    @media only screen and (min-width: 1550px) {
        .top-header-area .container-fluid {
            padding-left: 80px;
            padding-right: 80px;
        }
    }
</style>


<div class="top-header-area">
    <div class="container-fluid container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <ul class="top-header-contact-info">
                    <li><a href="tel:+44458895456"><i class='bx bx-phone-call'></i> 8882060409</a></li>
                    <li><a href="mailto:info@tripapna.in"><i class='bx bx-envelope'></i> info@tripapna.in</a></li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="top-header-right">
                    <ul class="d-flex align-items-center justify-content-end">
                        <!-- <li>
                            <div class="dropdown language-switcher d-inline-block" [class.active]="classApplied">
                                <button class="dropdown-toggle" type="button" (click)="toggleClass()">
                                    <img src="assets/img/flag/us.jpg" class="shadow" alt="image">
                                    <span>Eng <i class='bx bx-chevron-down'></i></span>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item d-flex align-items-center">
                                        <img src="assets/img/flag/germany.jpg" class="shadow-sm" alt="flag">
                                        <span>Ger</span>
                                    </a>
                                    <a href="#" class="dropdown-item d-flex align-items-center">
                                        <img src="assets/img/flag/france.jpg" class="shadow-sm" alt="flag">
                                        <span>Fre</span>
                                    </a>
                                    <a href="#" class="dropdown-item d-flex align-items-center">
                                        <img src="assets/img/flag/spain.jpg" class="shadow-sm" alt="flag">
                                        <span>Spa</span>
                                    </a>
                                    <a href="#" class="dropdown-item d-flex align-items-center">
                                        <img src="assets/img/flag/russia.jpg" class="shadow-sm" alt="flag">
                                        <span>Rus</span>
                                    </a>
                                    <a href="#" class="dropdown-item d-flex align-items-center">
                                        <img src="assets/img/flag/italy.jpg" class="shadow-sm" alt="flag">
                                        <span>Ita</span>
                                    </a>
                                </div>
                            </div>
                        </li> -->
                        <li class="nav-item"><a routerLink="/blog-grid"> Blog</a></li>
                        <li><a routerLink="/faq"><i class='bx bx-log-in'></i> FAQ</a></li>
                        <li><a routerLink="/contact"><i class='bx bx-phone-call'></i> Contact</a></li>
                        <li *ngIf="user==undefined"><a routerLink="/login"><i class='bx bx-log-in'></i> Sign In</a></li>
                        <li *ngIf="user==undefined"><a routerLink="/profile-authentication"><i class='bx bx-user'></i> Sign Up </a></li>
                        <li *ngIf="user!=undefined"><a routerLink="/dashboard"><i class='bx bx-log-in'></i><span class="userName" id="userName"> Somendra</span></a></li>
                        <li *ngIf="user!=undefined"><a href="javascript:void(0)" (click)="logout()"><i class='bx bx-log-in'></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH E:\client\tripapna\admin\resources\views/user/layouts/topheader.blade.php ENDPATH**/ ?>