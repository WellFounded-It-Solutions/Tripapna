<style>
    .single-blog-post {
        margin-bottom: 30px;
    }

    .single-blog-post .post-image {
        border-radius: 5px;
    }

    .single-blog-post .post-image a {
        border-radius: 5px;
    }

    .single-blog-post .post-image a img {
        border-radius: 5px;
    }

    .single-blog-post .post-content {
        margin-top: 25px;
    }

    .single-blog-post .post-content .meta {
        padding-left: 0;
        margin-bottom: 14px;
        list-style-type: none;
    }

    .single-blog-post .post-content .meta li {
        color: var(--optionalColor);
        display: inline-block;
        position: relative;
        margin-right: 15px;
        padding-left: 21px;
        font-size: 14px;
        font-weight: 600;
    }

    .single-blog-post .post-content .meta li i {
        left: 0;
        top: 3px;
        font-size: 15px;
        position: absolute;
        color: var(--mainColor);
    }

    .single-blog-post .post-content .meta li a {
        display: block;
        color: var(--optionalColor);
    }

    .single-blog-post .post-content .meta li a:hover {
        color: var(--mainColor);
    }

    .single-blog-post .post-content h3 {
        font-size: 18px;
        line-height: 1.6;
        margin-bottom: 10px;
    }

    .single-blog-post .post-content h3 a {
        display: inline-block;
    }

    .single-blog-post .post-content .link-btn {
        display: inline-block;
        padding-right: 22px;
        position: relative;
        font-weight: 600;
        margin-top: 5px;
    }

    .single-blog-post .post-content .link-btn i {
        right: 0;
        top: 3px;
        font-size: 20px;
        position: absolute;
    }

    .single-blog-post .post-content .link-btn:hover {
        padding-right: 25px;
    }

    /* Max width 767px */
    @media only screen and (max-width: 767px) {
        .single-blog-post .post-content .meta li {
            margin-right: 10px;
            font-size: 13px;
        }

        .single-blog-post .post-content .meta li i {
            top: 1.5px;
            font-size: 15px;
        }

        .single-blog-post .post-content h3 {
            font-size: 15px;
        }

        .single-blog-post .post-content .link-btn i {
            top: 2px;
            font-size: 17px;
        }
    }

    /* Min width 576px to Max width 767px */
    /* Min width 768px to Max width 991px */
    @media only screen and (min-width: 768px) and (max-width: 991px) {
        .single-blog-post .post-content h3 {
            font-size: 16px;
        }

        .single-blog-post .post-content .link-btn i {
            font-size: 18px;
        }
    }

    /* Min width 992px to Max width 1199px */
    @media only screen and (min-width: 992px) and (max-width: 1199px) {
        .single-blog-post .post-content h3 {
            font-size: 17px;
        }
    }

    /* Min width 1200px to Max width 1355px */
    /* Min width 1550px */
</style>

<div class="container mt-5">
    <div class="section-title" *ngFor="let Title of sectionTitle;">
        <h2>Our Latest News</h2>
        <p>Discover the hottest deal on hotel packages, and Grab the best deal with us at the best price, make every day awesome with us.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6" *ngFor="let Content of singleBlogPost;">
            <div class="single-blog-post">
                <div class="post-image">
                    <a href="/Content.detailsLink}}" class="d-block">
                        <img src="https://tripapna.in/assets/img/TripApna/bl1.jpg" alt="image">
                    </a>
                </div>
                <div class="post-content">
                    <ul class="meta">
                        <li><i class="bx bx-purchase-tag"></i> <a href="/Content.tagLink}}">Travel</a></li>
                    </ul>
                    <h3>
                        <a href="/Content.detailsLink}}">
                            The top 5 destinations for travel in July 2020: New edition
                        </a>
                    </h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                    <a href="/Content.detailsLink}}" class="link-btn">Read More <i class='bx bx-right-arrow-alt'></i></a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6" *ngFor="let Content of singleBlogPost;">
            <div class="single-blog-post">
                <div class="post-image">
                    <a href="/Content.detailsLink}}" class="d-block">
                        <img src="https://tripapna.in/assets/img/TripApna/bl1.jpg" alt="image">
                    </a>
                </div>
                <div class="post-content">
                    <ul class="meta">
                        <li><i class="bx bx-purchase-tag"></i> <a href="/Content.tagLink}}">Travel</a></li>
                    </ul>
                    <h3>
                        <a href="/Content.detailsLink}}">
                            The top 5 destinations for travel in July 2020: New edition
                        </a>
                    </h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                    <a href="/Content.detailsLink}}" class="link-btn">Read More <i class='bx bx-right-arrow-alt'></i></a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6" *ngFor="let Content of singleBlogPost;">
            <div class="single-blog-post">
                <div class="post-image">
                    <a href="/Content.detailsLink}}" class="d-block">
                        <img src="https://tripapna.in/assets/img/TripApna/bl1.jpg" alt="image">
                    </a>
                </div>
                <div class="post-content">
                    <ul class="meta">
                        <li><i class="bx bx-purchase-tag"></i> <a href="/Content.tagLink}}">Travel</a></li>
                    </ul>
                    <h3>
                        <a href="/Content.detailsLink}}">
                            The top 5 destinations for travel in July 2020: New edition
                        </a>
                    </h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                    <a href="/Content.detailsLink}}" class="link-btn">Read More <i class='bx bx-right-arrow-alt'></i></a>
                </div>
            </div>
        </div>


    </div>
</div>
<?php /**PATH E:\client\tripapna\admin\resources\views/user/comp/blog.blade.php ENDPATH**/ ?>