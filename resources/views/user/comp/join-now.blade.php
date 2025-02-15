<style>
    .join-now-area {
        background-color: var(--mainColor);
    }

    .join-now-content {
        max-width: 720px;
        text-align: center;
        position: relative;
        margin-left: auto;
        margin-right: auto;
    }

    .join-now-content h2 {
        font-size: 26px;
        margin-bottom: 15px;
        color: var(--whiteColor);
    }

    .join-now-content p {
        opacity: 0.9;
        color: var(--whiteColor);
    }

    .join-now-content .default-btn {
        margin-top: 15px;
        color: var(--whiteColor);
        background-color: var(--blackColor);
    }

    .join-now-content .default-btn:hover {
        color: var(--blackColor);
        background-color: var(--whiteColor);
    }

    /* Max width 767px */
    @media only screen and (max-width: 767px) {
        .join-now-content h2 {
            font-size: 19px;
        }

        .join-now-content .default-btn {
            margin-top: 5px;
        }
    }

    /* Min width 576px to Max width 767px */
    /* Min width 768px to Max width 991px */
    @media only screen and (min-width: 768px) and (max-width: 991px) {
        .join-now-content h2 {
            font-size: 23px;
        }

        .join-now-content .default-btn {
            margin-top: 10px;
        }
    }

    /* Min width 992px to Max width 1199px */
    /* Min width 1200px to Max width 1355px */
    /* Min width 1550px */
</style>


<!-- Start Join Now Area -->
<div class="join-now-area ptb-100">
    <div class="container">
        <div class="join-now-content" *ngFor="let Content of joinNowContent;">
            <h2>Join Tripapna and Get Discounts on Flight, Hotel, taxi & Hotel Membership!</h2>
            <p>
                We are pleased to introduce ourselves as Tripapna, founded by Tripapna Holiday Private Limited. We are head-quartered in New Delhi since2010 and have pioneered a concept of providing Membership Cards to our customers which would provide our clientele with services in the field of Hotel & Restaurant Industry across India.
            </p>
            <a routerLink="/Content.contact}}" class="default-btn">Join Now</a>
        </div>
    </div>
</div>
<!-- End Join Now Area -->
