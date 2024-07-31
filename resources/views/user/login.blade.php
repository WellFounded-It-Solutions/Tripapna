@extends('user.layouts.app_layout')

@section('content')

<style>
    .login-form {
        padding: 40px;
        border-radius: 5px;
        margin-right: 30px;
        background-color: var(--whiteColor);

        h2 {
            font-size: 30px;
            margin-bottom: 25px;
        }

        form {
            .form-group {
                margin-bottom: 25px;

                label {
                    display: block;
                    margin-bottom: 13px;
                    color: var(--blackColor);
                    font-weight: 600;
                }

                .form-control {
                    background-color: #f5f5f5 !important;
                }
            }

            .remember-me-wrap {
                margin-bottom: 0;

                [type="checkbox"]:checked,
                [type="checkbox"]:not(:checked) {
                    display: none;
                }

                [type="checkbox"]:checked+label,
                [type="checkbox"]:not(:checked)+label {
                    position: relative;
                    padding-left: 28px;
                    cursor: pointer;
                    line-height: 20px;
                    display: inline-block;
                    margin-bottom: 0;
                    color: var(--optionalColor);
                }

                [type="checkbox"]:checked+label:before,
                [type="checkbox"]:not(:checked)+label:before {
                    content: '';
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 19px;
                    height: 19px;
                    transition: all 0.2s ease;
                    border: 1px solid #f5f5f5;
                    border-radius: 3px;
                    background: #f5f5f5;
                }

                [type="checkbox"]:checked+label:after,
                [type="checkbox"]:not(:checked)+label:after {
                    content: '';
                    width: 8px;
                    height: 8px;
                    background: var(--mainColor);
                    position: absolute;
                    top: 5.5px;
                    left: 6px;
                    transition: all 0.2s ease;
                }

                [type="checkbox"]:not(:checked)+label:after {
                    opacity: 0;
                    transform: scale(0);
                }

                [type="checkbox"]:checked+label:after {
                    opacity: 1;
                    transform: scale(1);
                }

                [type="checkbox"]:hover+label:before {
                    border-color: var(--mainColor);
                }

                [type="checkbox"]:checked+label:before {
                    border-color: var(--mainColor);
                }
            }

            .register-view {
                margin-top: 15px;
            }

            .lost-your-password-wrap {
                // text-align: right;

                a {
                    display: inline-block;
                    position: relative;
                    line-height: 1.3;

                    &::before {
                        width: 100%;
                        height: 1px;
                        position: absolute;
                        left: 0;
                        bottom: 0;
                        content: '';
                        transition: var(--transition);
                        background-color: #eeeeee;
                    }

                    &::after {
                        width: 0;
                        height: 1px;
                        position: absolute;
                        left: 0;
                        transition: var(--transition);
                        bottom: 0;
                        content: '';
                        background-color: var(--mainColor);
                    }

                    &:hover {
                        &::before {
                            width: 0;
                        }

                        &::after {
                            width: 100%;
                        }
                    }
                }
            }

            button {
                margin-top: 22px;
                border: none;
                display: block;
                text-align: center;
                overflow: hidden;
                color: var(--whiteColor);
                background-color: var(--mainColor);
                transition: var(--transition);
                width: 100%;
                border-radius: 5px;
                padding: 15px 30px 16px;
                font-weight: 700;

                &:hover {
                    background-color: var(--blackColor);
                    color: var(--whiteColor);
                }
            }
        }
    }

    .register-form {
        padding-left: 30px;

        h2 {
            font-size: 30px;
            margin-bottom: 25px;
        }

        form {
            .form-group {
                margin-bottom: 25px;

                label {
                    display: block;
                    margin-bottom: 13px;
                    color: var(--blackColor);
                    font-weight: 600;
                }
            }

            .description {
                font-style: italic;

                margin: {
                    top: -10px;
                    bottom: 0;
                }

                ;
            }

            button {
                margin-top: 22px;
                border: none;
                display: block;
                text-align: center;
                overflow: hidden;
                color: var(--whiteColor);
                background-color: var(--mainColor);
                transition: var(--transition);
                width: 100%;
                border-radius: 5px;
                padding: 15px 30px 16px;
                font-weight: 700;

                &:hover {
                    background-color: var(--blackColor);
                    color: var(--whiteColor);
                }
            }
        }
    }

    /* Max width 767px */
    @media only screen and (max-width: 767px) {

        .login-form {
            padding: 20px 15px;
            margin-right: 0;

            h2 {
                margin-bottom: 20px;
                text-align: center;
                font-size: 20px;
            }

            form {
                .lost-your-password-wrap {
                    text-align: left;
                    margin-top: 15px;
                }

                button {
                    padding: 13px 30px 14px;
                    font-size: 14px;
                }
            }
        }

        .register-form {
            margin-top: 40px;
            border-top: 1px solid #e3e3e3;

            padding: {
                left: 0;
                top: 30px;
            }

            ;

            h2 {
                margin-bottom: 20px;
                text-align: center;
                font-size: 20px;
            }

            form {
                .lost-your-password-wrap {
                    text-align: left;
                    margin-top: 15px;
                }

                button {
                    padding: 13px 30px 14px;
                    font-size: 14px;
                }
            }
        }

    }

    /* Min width 576px to Max width 767px */
    @media only screen and (min-width: 576px) and (max-width: 767px) {}

    /* Min width 768px to Max width 991px */
    @media only screen and (min-width: 768px) and (max-width: 991px) {

        .login-form {
            margin-right: 0;

            h2 {
                font-size: 22px;
            }
        }

        .register-form {
            margin-top: 40px;
            border-top: 1px solid #e3e3e3;

            padding: {
                left: 0;
                top: 30px;
            }

            ;

            h2 {
                font-size: 22px;
            }
        }

    }

    /* Min width 992px to Max width 1199px */
    @media only screen and (min-width: 992px) and (max-width: 1199px) {

        .login-form {
            padding: 35px;
            margin-right: 15px;

            h2 {
                font-size: 22px;
            }
        }

        .register-form {
            padding-left: 15px;

            h2 {
                font-size: 22px;
            }
        }

    }

    /* Min width 1200px to Max width 1355px */
    @media only screen and (min-width: 1200px) and (max-width: 1355px) {}

    /* Min width 1550px */
    @media only screen and (min-width: 1550px) {}
</style>

<div class="page-title-area" *ngFor="let Content of pageTitle;" style="background-image: url();">
    <!-- <div class="page-title-area"  style="background-color: #ff9500 !important;"> -->
    <div class="container">
        <h1>Login</h1>
    </div>
</div>

<div class="profile-authentication-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6" style="float:none;margin:auto;">
                <div class="login-form">
                    <h2 style="text-align: center;">Login</h2>

                    @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                    </div>
                    @endif

                    <form class=" form-horizontal ajax_form " action="{{ route('custmor_login_post') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" type="text" formControlName="email" class="form-control">
                            @error('email')
                            <span class="invalid-feedback text-danger " role="alert">
                                <strong>{{ $message }} </strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input name="password" type="password" formControlName="password" class="form-control">
                            @error('password')
                            <span class="invalid-feedback text-danger " role="alert">
                                <strong>{{ $message }} </strong>
                            </span>
                            @enderror
                        </div>

                        <div class="row align-items-center">
                            <!-- <div class="col-lg-6 col-md-6 col-sm-6 remember-me-wrap">
                                    <p>
                                        <input type="checkbox" id="test2">
                                        <label for="test2">Remember me</label>
                                    </p>
                                </div> -->
                            <div class="col-lg-6 col-md-6 col-sm-6 lost-your-password-wrap">
                                <a routerLink="/forgot-password" class="lost-your-password">Lost your password?</a>
                            </div>
                        </div>
                        <button type="submit" (click)="onLogin()">Log In</button>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 register-view">
                                <a routerLink="/profile-authentication" class="lost-your-password">Don't have account register now</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
