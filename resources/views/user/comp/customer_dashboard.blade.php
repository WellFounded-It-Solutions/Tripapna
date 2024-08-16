<style>
    .logout {
        cursor: pointer;
    }

    .profileImageView {
        height: 300px;
        width: 300px;
        overflow: hidden;
    }

    .dashboard-tabs-list {
        margin-bottom: 30px;
    }

    .dashboard-tabs-list ul {
        padding-left: 0;
        margin-bottom: 0;
        list-style-type: none;
        display: flex;
        justify-content: space-between;
        background-color: var(--whiteColor);
        text-align: center;
    }

    .dashboard-tabs-list ul li {
        width: 100%;
    }

    .dashboard-tabs-list ul li a {
        display: block;
        color: var(--blackColor);
        border-right: 1px solid #eee;
        padding-top: 14px;
        padding-bottom: 14px;
        padding-left: 10px;
        padding-right: 10px;
        font-size: 16px;
        font-weight: 700;
        font-family: var(--headingFontFamily);
    }

    .dashboard-tabs-list ul li a:hover {
        background-color: #ebebeb;
    }

    .dashboard-tabs-list ul li a.active {
        color: var(--whiteColor);
        border-color: var(--mainColor);
        background-color: var(--mainColor);
    }

    .dashboard-tabs-list ul li:last-child a {
        border-right: 0;
    }

    .dashboard-profile-box {
        padding: 50px 30px;
        text-align: center;
        background-color: var(--whiteColor);
    }

    .dashboard-profile-box .image {
        margin-bottom: 25px;
        position: relative;
        display: inline-block;
    }

    .dashboard-profile-box .image img {
        border-radius: 5px;
        border: 5px solid #eee;
    }

    .dashboard-profile-box .image span {
        position: absolute;
        left: 15px;
        bottom: 15px;
        padding: 6px 15px;
        border-radius: 5px;
        background-color: var(--whiteColor);
        font-weight: 700;
        font-family: var(--headingFontFamily);
    }

    .dashboard-profile-box p a {
        color: var(--mainColor);
        text-decoration: underline;
    }

    .dashboard-profile-box p a:hover {
        text-decoration: none;
    }

    .dashboard-profile-box .logout {
        color: red;
        display: inline-block;
        font-weight: 600;
    }

    .dashboard-profile-box .logout:hover {
        text-decoration: underline;
    }

    .dashboard-stats {
        padding: 30px;
        background-color: var(--whiteColor);
    }

    .dashboard-stats .stats {
        list-style-type: none;
        padding-left: 0;
        margin-bottom: 0;
        margin-top: 30px;
    }

    .dashboard-stats .stats li {
        margin-bottom: 18px;
        position: relative;
        background-color: #f1f1f1;
        font-size: var(--fontSize);
        font-weight: 600;
        font-family: var(--headingFontFamily);
        padding-top: 20px;
        padding-bottom: 20px;
        padding-left: 60px;
        padding-right: 20px;
    }

    .dashboard-stats .stats li:last-child {
        margin-bottom: 0;
    }

    .dashboard-stats .stats li .icon {
        left: 20px;
        top: 50%;
        width: 30px;
        height: 30px;
        text-align: center;
        border-radius: 50%;
        position: absolute;
        color: var(--whiteColor);
        transform: translateY(-50%);
        background-color: var(--mainColor);
    }

    .dashboard-stats .stats li .icon i {
        position: absolute;
        left: 0;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
    }

    .dashboard-stats .stats li .badge {
        float: right;
        font-size: var(--fontSize);
    }

    .dashboard-stats .stats li:nth-child(2) .icon {
        background-color: green;
    }

    .dashboard-stats .stats li:nth-child(3) .icon {
        background-color: violet;
    }

    .dashboard-stats .stats li:nth-child(4) .icon {
        background-color: blue;
    }

    .dashboard-stats .stats li:nth-child(5) .icon {
        background-color: red;
    }

    .dashboard-stats .stats li:nth-child(6) .icon {
        background-color: green;
    }

    .dashboard-stats form label {
        display: block;
        margin-bottom: 10px;
        font-size: 14px;
        font-weight: 700;
        font-family: var(--headingFontFamily);
    }

    .dashboard-stats form label span {
        color: red;
    }

    .dashboard-stats form .form-control {
        background-color: #f5f5f5 !important;
    }

    .dashboard-stats form .form-group {
        margin-bottom: 20px;
    }

    .dashboard-stats form input[type="file"] {
        cursor: pointer;
        display: inline-block;
    }

    .dashboard-stats form select {
        background: #f5f5f5;
        display: block;
        padding: 0 0 0 12px;
        width: 100%;
        color: var(--blackColor);
        cursor: pointer;
        height: 50px;
        border: none;
        line-height: 50px;
        font-size: var(--fontSize);
        font-weight: 600;
    }

    .dashboard-stats form iframe {
        width: 100%;
        height: 300px;
        border: none;
    }

    .dashboard-stats table {
        margin-bottom: 0;
        margin-top: 30px;
    }

    .dashboard-stats table thead th {
        border-bottom-width: 0;
        border-color: #eee;
        font-size: var(--fontSize);
        vertical-align: middle;
        padding-left: 20px;
        padding-right: 20px;
    }

    .dashboard-stats table tbody td {
        border-color: #eee;
        vertical-align: middle;
        color: var(--optionalColor);
        font-size: 14px;
        padding-left: 20px;
        padding-right: 20px;
    }

    .dashboard-stats table tbody td .edit {
        width: 35px;
        height: 35px;
        background-color: #f5f5f5;
        border-radius: 50%;
        display: inline-block;
        position: relative;
        color: green;
        text-align: center;
        margin-right: 10px;
        font-size: 18px;
    }

    .dashboard-stats table tbody td .edit i {
        left: 0;
        right: 0;
        top: 50%;
        position: absolute;
        transform: translateY(-50%);
    }

    .dashboard-stats table tbody td .edit:hover {
        color: var(--whiteColor);
        background-color: green;
    }

    .dashboard-stats table tbody td .view {
        width: 35px;
        height: 35px;
        background-color: #f5f5f5;
        border-radius: 50%;
        display: inline-block;
        position: relative;
        color: green;
        text-align: center;
        margin-right: 10px;
        font-size: 18px;
    }

    .dashboard-stats table tbody td .view i {
        left: 0;
        right: 0;
        top: 50%;
        position: absolute;
        transform: translateY(-50%);
    }

    .dashboard-stats table tbody td .view:hover {
        color: var(--whiteColor);
        background-color: green;
    }

    .dashboard-stats table tbody td .remove {
        width: 35px;
        height: 35px;
        background-color: #f5f5f5;
        border-radius: 50%;
        display: inline-block;
        position: relative;
        color: red;
        text-align: center;
        font-size: 20px;
    }

    .dashboard-stats table tbody td .remove i {
        left: 0;
        right: 0;
        top: 50%;
        position: absolute;
        transform: translateY(-50%);
    }

    .dashboard-stats table tbody td .remove:hover {
        color: var(--whiteColor);
        background-color: red;
    }

    .dashboard-stats .alert {
        margin-bottom: 25px;
    }

    .dashboard-stats .description {
        margin-top: 5px;
        font-size: 13px;
        font-style: italic;
        color: var(--optionalColor);
    }

    /* Max width 767px */
    @media only screen and (max-width: 767px) {
        .dashboard-tabs-list ul {
            display: flex;
            flex-wrap: wrap;
            justify-content: unset;
        }

        .dashboard-tabs-list ul li {
            width: auto;
            flex: 0 0 50%;
            max-width: 50%;
        }

        .dashboard-tabs-list ul li a {
            font-size: 13px;
            border-bottom: 1px solid #eee;
            padding-top: 12px;
            padding-bottom: 12px;
        }

        .dashboard-profile-box {
            padding: 15px;
            margin-bottom: 30px;
        }

        .dashboard-stats {
            padding: 15px;
        }

        .dashboard-stats .stats {
            margin-top: 15px;
        }

        .dashboard-stats .stats li {
            font-size: 13px;
            margin-bottom: 10px;
            padding-right: 15px;
            padding-left: 55px;
        }

        .dashboard-stats .stats li .icon {
            left: 15px;
        }

        .dashboard-stats .stats li .badge {
            font-size: 13px;
        }

        .dashboard-stats form label {
            font-size: 13px;
        }

        .dashboard-stats table {
            margin-top: 20px;
        }

        .dashboard-stats table thead th {
            font-size: 13px;
        }

        .dashboard-stats table tbody td {
            font-size: 13px;
        }
    }

    /* Min width 576px to Max width 767px */
    /* Min width 768px to Max width 991px */
    @media only screen and (min-width: 768px) and (max-width: 991px) {
        .dashboard-tabs-list ul li a {
            font-size: 13px;
        }

        .dashboard-profile-box {
            margin-bottom: 30px;
            padding: 30px;
        }

        .dashboard-stats .stats {
            margin-top: 25px;
        }

        .dashboard-stats .stats li {
            font-size: 14px;
        }

        .dashboard-stats .stats li .badge {
            font-size: 14px;
        }
    }

    /* Min width 992px to Max width 1199px */
    @media only screen and (min-width: 992px) and (max-width: 1199px) {
        .dashboard-tabs-list ul li a {
            font-size: 15px;
        }
    }

    /* Min width 1200px to Max width 1355px */
    /* Min width 1550px */
</style>
