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

        ul {
            padding-left: 0;
            margin-bottom: 0;
            list-style-type: none;
            display: flex;
            justify-content: space-between;
            background-color: var(--whiteColor);
            text-align: center;

            li {
                width: 100%;

                a {
                    display: block;
                    color: var(--blackColor);
                    border-right: 1px solid #eeeeee;

                    padding: {
                        top: 14px;
                        bottom: 14px;
                        left: 10px;
                        right: 10px;
                    }

                    ;

                    font: {
                        size: 16px;
                        weight: 700;
                        family: var(--headingFontFamily);
                    }

                    ;

                    &:hover {
                        background-color: #ebebeb;
                    }

                    &.active {
                        color: var(--whiteColor);
                        border-color: var(--mainColor);
                        background-color: var(--mainColor);
                    }
                }

                &:last-child {
                    a {
                        border-right: 0;
                    }
                }
            }
        }
    }

    .dashboard-profile-box {
        padding: 50px 30px;
        text-align: center;
        background-color: var(--whiteColor);

        .image {
            margin-bottom: 25px;
            position: relative;
            display: inline-block;

            img {
                border-radius: 5px;
                border: 5px solid #eeeeee;
            }

            span {
                position: absolute;
                left: 15px;
                bottom: 15px;
                padding: 6px 15px;
                border-radius: 5px;
                background-color: var(--whiteColor);

                font: {
                    weight: 700;
                    family: var(--headingFontFamily);
                }

                ;
            }
        }

        p {
            a {
                color: var(--mainColor);
                text-decoration: underline;

                &:hover {
                    text-decoration: none;
                }
            }
        }

        .logout {
            color: red;
            display: inline-block;
            font-weight: 600;

            &:hover {
                text-decoration: underline;
            }
        }
    }

    .dashboard-stats {
        padding: 30px;
        background-color: var(--whiteColor);

        .stats {
            list-style-type: none;
            padding-left: 0;

            margin: {
                bottom: 0;
                top: 30px;
            }

            ;

            li {
                margin-bottom: 18px;
                position: relative;
                background-color: #f1f1f1;

                font: {
                    size: var(--fontSize);
                    weight: 600;
                    family: var(--headingFontFamily);
                }

                ;

                padding: {
                    top: 20px;
                    bottom: 20px;
                    left: 60px;
                    right: 20px;
                }

                ;

                &:last-child {
                    margin-bottom: 0;
                }

                .icon {
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

                    i {
                        position: absolute;
                        left: 0;
                        right: 0;
                        top: 50%;
                        transform: translateY(-50%);
                    }
                }

                .badge {
                    float: right;

                    font: {
                        size: var(--fontSize);
                    }

                    ;
                }

                &:nth-child(2) {
                    .icon {
                        background-color: green;
                    }
                }

                &:nth-child(3) {
                    .icon {
                        background-color: violet;
                    }
                }

                &:nth-child(4) {
                    .icon {
                        background-color: blue;
                    }
                }

                &:nth-child(5) {
                    .icon {
                        background-color: red;
                    }
                }

                &:nth-child(6) {
                    .icon {
                        background-color: green;
                    }
                }
            }
        }

        form {
            label {
                display: block;
                margin-bottom: 10px;

                font: {
                    size: 14px;
                    weight: 700;
                    family: var(--headingFontFamily);
                }

                ;

                span {
                    color: red;
                }
            }

            .form-control {
                background-color: #f5f5f5 !important;
            }

            .form-group {
                margin-bottom: 20px;
            }

            input[type="file"] {
                cursor: pointer;
                display: inline-block;
            }

            select {
                background: #f5f5f5;
                display: block;
                padding: 0 0 0 12px;
                width: 100%;
                color: var(--blackColor);
                cursor: pointer;
                height: 50px;
                border: none;
                line-height: 50px;

                font: {
                    size: var(--fontSize);
                    weight: 600;
                }

                ;
            }

            iframe {
                width: 100%;
                height: 300px;
                border: none;
            }
        }

        table {
            margin: {
                bottom: 0;
                top: 30px;
            }

            ;

            thead {
                th {
                    border-bottom-width: 0;
                    border-color: #eeeeee;
                    font-size: var(--fontSize);
                    vertical-align: middle;

                    padding: {
                        left: 20px;
                        right: 20px;
                    }

                    ;
                }
            }

            tbody {
                td {
                    border-color: #eeeeee;
                    vertical-align: middle;
                    color: var(--optionalColor);
                    font-size: 14px;

                    padding: {
                        left: 20px;
                        right: 20px;
                    }

                    ;

                    .edit {
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

                        i {
                            left: 0;
                            right: 0;
                            top: 50%;
                            position: absolute;
                            transform: translateY(-50%);
                        }

                        &:hover {
                            color: var(--whiteColor);
                            background-color: green;
                        }
                    }

                    .view {
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

                        i {
                            left: 0;
                            right: 0;
                            top: 50%;
                            position: absolute;
                            transform: translateY(-50%);
                        }

                        &:hover {
                            color: var(--whiteColor);
                            background-color: green;
                        }
                    }

                    .remove {
                        width: 35px;
                        height: 35px;
                        background-color: #f5f5f5;
                        border-radius: 50%;
                        display: inline-block;
                        position: relative;
                        color: red;
                        text-align: center;
                        font-size: 20px;

                        i {
                            left: 0;
                            right: 0;
                            top: 50%;
                            position: absolute;
                            transform: translateY(-50%);
                        }

                        &:hover {
                            color: var(--whiteColor);
                            background-color: red;
                        }
                    }
                }
            }
        }

        .alert {
            margin-bottom: 25px;
        }

        .description {
            margin-top: 5px;
            font-size: 13px;
            font-style: italic;
            color: var(--optionalColor);
        }
    }

    /* Max width 767px */
    @media only screen and (max-width: 767px) {

        .dashboard-tabs-list {
            ul {
                display: flex;
                flex-wrap: wrap;
                justify-content: unset;

                li {
                    width: auto;
                    flex: 0 0 50%;
                    max-width: 50%;

                    a {
                        font-size: 13px;
                        border-bottom: 1px solid #eeeeee;

                        padding: {
                            top: 12px;
                            bottom: 12px;
                        }

                        ;
                    }
                }
            }
        }

        .dashboard-profile-box {
            padding: 15px;
            margin-bottom: 30px;
        }

        .dashboard-stats {
            padding: 15px;

            .stats {
                margin-top: 15px;

                li {
                    font-size: 13px;
                    margin-bottom: 10px;

                    padding: {
                        right: 15px;
                        left: 55px;
                    }

                    ;

                    .icon {
                        left: 15px;
                    }

                    .badge {
                        font-size: 13px;
                    }
                }
            }

            form {
                label {
                    font-size: 13px;
                }
            }

            table {
                margin-top: 20px;

                thead {
                    th {
                        font-size: 13px;
                    }
                }

                tbody {
                    td {
                        font-size: 13px;
                    }
                }
            }
        }

    }

    /* Min width 576px to Max width 767px */
    @media only screen and (min-width: 576px) and (max-width: 767px) {}

    /* Min width 768px to Max width 991px */
    @media only screen and (min-width: 768px) and (max-width: 991px) {

        .dashboard-tabs-list {
            ul {
                li {
                    a {
                        font-size: 13px;
                    }
                }
            }
        }

        .dashboard-profile-box {
            margin-bottom: 30px;
            padding: 30px;
        }

        .dashboard-stats {
            .stats {
                margin-top: 25px;

                li {
                    font-size: 14px;

                    .badge {
                        font-size: 14px;
                    }
                }
            }
        }

    }

    /* Min width 992px to Max width 1199px */
    @media only screen and (min-width: 992px) and (max-width: 1199px) {

        .dashboard-tabs-list {
            ul {
                li {
                    a {
                        font-size: 15px;
                    }
                }
            }
        }

    }

    /* Min width 1200px to Max width 1355px */
    @media only screen and (min-width: 1200px) and (max-width: 1355px) {}

    /* Min width 1550px */
    @media only screen and (min-width: 1550px) {}
</style>
