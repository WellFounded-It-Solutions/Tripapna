<style>
    .why-choose-area {
        background-color: var(--mainColor);
    }

    .why-choose-area .section-title h2 {
        color: var(--whiteColor);
        margin-bottom: 15px;
    }

    .why-choose-area .section-title p {
        opacity: 0.9;
        color: var(--whiteColor);
    }

    .single-why-choose-box {
        margin-bottom: 30px;
        border-radius: 5px;
        position: relative;
        border: 1px solid #d47658;
        transition: var(--transition);
        padding: 40px 40px 40px 120px;
    }

    .single-why-choose-box i {
        top: 50%;
        left: 40px;
        font-size: 65px;
        margin-top: -1px;
        position: absolute;
        color: var(--whiteColor);
        transform: translateY(-50%);
    }

    .single-why-choose-box h3 {
        font-size: 18px;
        margin-bottom: 10px;
        color: var(--whiteColor);
    }

    .single-why-choose-box span {
        display: block;
        font-size: 14px;
        color: var(--whiteColor);
    }

    .single-why-choose-box:hover {
        border-color: var(--whiteColor);
    }

    .why-choose-content {
        text-align: center;
        margin-top: 30px;
    }

    .why-choose-content h3 {
        font-size: 18px;
        display: inline-block;
        color: var(--whiteColor);
        margin-bottom: 0;
        margin-right: 15px;
    }

    .why-choose-content .default-btn {
        margin-left: 15px;
        color: var(--whiteColor);
        background-color: var(--blackColor);
    }

    .why-choose-content .default-btn:hover {
        color: var(--blackColor);
        background-color: var(--whiteColor);
    }

    /* Max width 767px */
    @media only screen and (max-width: 767px) {
        .single-why-choose-box {
            padding: 25px 15px 24px 80px;
        }

        .single-why-choose-box i {
            left: 15px;
            font-size: 53px;
            margin-top: -1px;
        }

        .single-why-choose-box h3 {
            font-size: 15px;
            margin-bottom: 8px;
        }

        .why-choose-content {
            margin-top: 0;
        }

        .why-choose-content h3 {
            font-size: 15px;
            margin-bottom: 20px;
            margin-right: 0;
        }
    }

    /* Min width 576px to Max width 767px */
    /* Min width 768px to Max width 991px */
    @media only screen and (min-width: 768px) and (max-width: 991px) {
        .single-why-choose-box {
            padding: 30px 30px 30px 100px;
        }

        .single-why-choose-box i {
            left: 30px;
            font-size: 60px;
        }

        .single-why-choose-box h3 {
            font-size: 16px;
            margin-bottom: 8px;
        }

        .why-choose-content {
            margin-top: 10px;
        }

        .why-choose-content h3 {
            font-size: 16px;
        }
    }

    /* Min width 992px to Max width 1199px */
    @media only screen and (min-width: 992px) and (max-width: 1199px) {
        .single-why-choose-box {
            padding: 30px 25px 30px 95px;
        }

        .single-why-choose-box i {
            left: 25px;
            font-size: 60px;
            margin-top: 0;
        }
    }

    /* Min width 1200px to Max width 1355px */
    /* Min width 1550px */
</style>


<div class="why-choose-area ptb-100">
    <div class="container">
        <div class="section-title" *ngFor="let Title of sectionTitle;">
            <h2>Why Buy on TripApna?</h2>
            <p>On this platform we will provide you the membership cards of popular hotels & restaurants to our customers. We will promise of lowest price on listed properties.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-6 col-md-6" *ngFor="let Content of singleWhyChooseBox;">
                <div class="single-why-choose-box">
                    <i class='bx bx-money'></i>
                    <h3>Money Back</h3>
                    <span>Refund in 30 days</span>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 col-md-6" *ngFor="let Content of singleWhyChooseBox;">
                <div class="single-why-choose-box">
                    <i class='bx bx-credit-card'></i>
                    <h3>Secure Payment</h3>
                    <span>No transaction fees</span>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 col-md-6" *ngFor="let Content of singleWhyChooseBox;">
                <div class="single-why-choose-box">
                    <i class='bx bxs-discount'></i>
                    <h3>Beat Hotel Package</h3>
                    <span>Top Hotel in India</span>
                </div>
            </div>
        </div>

        <div class="why-choose-content" *ngFor="let Content of whyChooseContent;">
            <h3>Exciting Coupons for More Saving</h3>
            <a routerLink="/contact" class="default-btn">Join Now</a>
        </div>
    </div>
</div>
