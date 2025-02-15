<style>
    .navbar-area {
        padding: 0;
        position: relative;
        background-color: var(--whiteColor);
    }

    .navbar-area.sticky-box-shadow {
        top: 0;
        left: 0;
        width: 100%;
        z-index: 999;
        position: fixed;
        box-shadow: 0 2px 28px 0 rgba(0, 0, 0, 0.09);
        background-color: var(--whiteColor) !important;
        animation: 500ms ease-in-out 0s normal none 1 running fadeInDown;
    }

    .navbar-area.navbar-style-two .navbar .navbar-nav {
        margin-left: auto;
    }

    .navbar-area.navbar-style-two .navbar .others-option {
        margin-left: 25px;
    }

    .navbar-area.navbar-style-two.bg-black {
        border-top: 1px solid #352a4b;
        background-color: var(--blackColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item a {
        color: var(--whiteColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item a:hover,
    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item a:focus,
    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item a.active {
        color: var(--mainColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item:hover a,
    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item.active a {
        color: var(--mainColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li a {
        color: var(--blackColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li a:hover,
    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li a:focus,
    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li a.active {
        color: var(--mainColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li a {
        color: var(--blackColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li a:hover,
    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li a:focus,
    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li a.active {
        color: var(--mainColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li a {
        color: var(--blackColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li a:hover,
    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li a:focus,
    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li a.active {
        color: var(--mainColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a {
        color: var(--blackColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:hover,
    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:focus,
    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a.active {
        color: var(--mainColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a {
        color: var(--blackColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:hover,
    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:focus,
    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a.active {
        color: var(--mainColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a {
        color: var(--blackColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:hover,
    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:focus,
    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a.active {
        color: var(--mainColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a {
        color: var(--blackColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:hover,
    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:focus,
    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a.active {
        color: var(--mainColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li.active a {
        color: var(--mainColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li.active a {
        color: var(--mainColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li.active a {
        color: var(--mainColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li.active a {
        color: var(--mainColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li.active a {
        color: var(--mainColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li.active a {
        color: var(--mainColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .others-option .option-item .cart-btn {
        color: var(--whiteColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .others-option .option-item .cart-btn:hover {
        color: var(--mainColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .others-option .option-item .wishlist-btn {
        color: var(--whiteColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .others-option .option-item .wishlist-btn:hover {
        color: var(--mainColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .others-option .option-item .search-icon {
        color: var(--whiteColor);
    }

    .navbar-area.navbar-style-two.bg-black .navbar .others-option .option-item .search-icon:hover {
        color: var(--mainColor);
    }

    .navbar-area.navbar-style-two.bg-black.sticky-box-shadow {
        background-color: var(--blackColor) !important;
        border-top-width: 0;
    }

    .navbar-area .container-fluid {
        padding-left: 30px;
        padding-right: 30px;
    }

    .navbar-area .navbar {
        padding: 0;
        position: inherit;
        background-color: transparent !important;
    }

    .navbar-area .navbar .navbar-brand {
        font-size: inherit;
        position: relative;
        line-height: 1;
        padding: 0;
        top: -3px;
    }

    .navbar-area .navbar ul {
        padding-left: 0;
        list-style-type: none;
        margin-bottom: 0;
    }

    .navbar-area .navbar .navbar-nav {
        margin-left: 65px;
        position: relative;
    }

    .navbar-area .navbar .navbar-nav .nav-item {
        position: relative;
        margin-left: 13px;
        margin-right: 13px;
    }

    .navbar-area .navbar .navbar-nav .nav-item a {
        position: relative;
        color: var(--blackColor);
        font-weight: 600;
        font-size: 14.5px;
        font-family: var(--headingFontFamily);
        padding-left: 0;
        padding-right: 0;
        padding-top: 30px;
        padding-bottom: 30px;
    }

    .navbar-area .navbar .navbar-nav .nav-item a:hover,
    .navbar-area .navbar .navbar-nav .nav-item a:focus,
    .navbar-area .navbar .navbar-nav .nav-item a.active {
        color: var(--mainColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-toggle {
        padding-right: 17px;
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-toggle::after {
        display: none;
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-toggle::before {
        content: "\ea4a";
        position: absolute;
        right: -4px;
        top: 26px;
        font-weight: 300;
        font-size: 20px;
        font-family: 'boxicons';
    }

    .navbar-area .navbar .navbar-nav .nav-item:last-child {
        margin-right: 0;
    }

    .navbar-area .navbar .navbar-nav .nav-item:first-child {
        margin-left: 0;
    }

    .navbar-area .navbar .navbar-nav .nav-item:hover a,
    .navbar-area .navbar .navbar-nav .nav-item.active a {
        color: var(--mainColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu {
        top: 81px;
        opacity: 0;
        left: 0;
        z-index: 99;
        border: none;
        width: 250px;
        display: block;
        border-radius: 0;
        padding: 10px 0;
        margin-top: 15px;
        position: absolute;
        visibility: hidden;
        background: var(--whiteColor);
        transition: all 0.2s ease-in-out;
        box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.1);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li {
        margin: 0;
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li a {
        padding: 8px 20px;
        position: relative;
        display: block;
        color: var(--blackColor);
        font-size: 14px;
        font-weight: 600;
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li a i {
        margin: 0;
        position: absolute;
        top: 50%;
        font-size: 20px;
        transform: translateY(-50%);
        right: 15px;
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li a:hover,
    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li a:focus,
    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li a.active {
        color: var(--mainColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu {
        top: 0;
        opacity: 0;
        left: auto;
        right: 250px;
        margin-top: 15px;
        visibility: hidden;
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li a {
        color: var(--blackColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li a:hover,
    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li a:focus,
    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li a.active {
        color: var(--mainColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu {
        top: 0;
        opacity: 0;
        right: -250px;
        visibility: hidden;
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li a {
        color: var(--blackColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li a:hover,
    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li a:focus,
    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li a.active {
        color: var(--mainColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu {
        top: 0;
        opacity: 0;
        right: 250px;
        visibility: hidden;
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a {
        color: var(--blackColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:hover,
    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:focus,
    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a.active {
        color: var(--mainColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu {
        top: 0;
        opacity: 0;
        right: -250px;
        visibility: hidden;
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a {
        color: var(--blackColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:hover,
    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:focus,
    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a.active {
        color: var(--mainColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu {
        top: 0;
        opacity: 0;
        right: 250px;
        visibility: hidden;
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a {
        color: var(--blackColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:hover,
    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:focus,
    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a.active {
        color: var(--mainColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu {
        top: 0;
        opacity: 0;
        right: -250px;
        visibility: hidden;
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a {
        color: var(--blackColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:hover,
    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:focus,
    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a.active {
        color: var(--mainColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li.active a {
        color: var(--mainColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li.active a {
        color: var(--mainColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li.active a {
        color: var(--mainColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li.active a {
        color: var(--mainColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li.active a {
        color: var(--mainColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li.active a {
        color: var(--mainColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu li:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
        margin-top: 0;
    }

    .navbar-area .navbar .navbar-nav .nav-item:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
        margin-top: 0;
    }

    .navbar-area .navbar .navbar-nav .nav-item.megamenu {
        position: unset;
    }

    .navbar-area .navbar .navbar-nav .nav-item.megamenu .dropdown-menu {
        width: 100%;
        margin-top: 0;
        position: absolute;
        top: auto;
        left: 0;
        padding: 20px;
        transform: unset !important;
    }

    .navbar-area .navbar .navbar-nav .nav-item.megamenu .dropdown-menu .submenu-title {
        color: var(--blackColor);
        position: relative;
        border-bottom: 1px solid #eee;
        padding-bottom: 8px;
        text-transform: uppercase;
        margin-bottom: 20px;
        margin-top: 25px;
        font-size: 15px;
        font-weight: 600;
    }

    .navbar-area .navbar .navbar-nav .nav-item.megamenu .dropdown-menu .submenu-title::before {
        width: 30px;
        height: 1px;
        content: '';
        position: absolute;
        left: 0;
        bottom: -1px;
        background-color: var(--mainColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item.megamenu .dropdown-menu .submenu-title:first-child {
        margin-top: 0;
    }

    .navbar-area .navbar .navbar-nav .nav-item.megamenu .dropdown-menu a {
        border-bottom: none !important;
    }

    .navbar-area .navbar .navbar-nav .nav-item.megamenu .dropdown-menu .megamenu-submenu li a {
        padding: 0;
        font-size: 14px;
        margin-top: 10px;
        overflow: hidden;
    }

    .navbar-area .navbar .navbar-nav .nav-item.megamenu .dropdown-menu .megamenu-submenu li a .count {
        float: right;
        width: 20px;
        height: 20px;
        display: block;
        text-align: center;
        border-radius: 5px;
        font-size: 12px;
        line-height: 20px;
        transition: var(--transition);
        background-color: #f4f4f4;
    }

    .navbar-area .navbar .navbar-nav .nav-item.megamenu .dropdown-menu .megamenu-submenu li a:hover,
    .navbar-area .navbar .navbar-nav .nav-item.megamenu .dropdown-menu .megamenu-submenu li a.active {
        color: var(--mainColor);
    }

    .navbar-area .navbar .navbar-nav .nav-item.megamenu .dropdown-menu .megamenu-submenu li a:hover .count,
    .navbar-area .navbar .navbar-nav .nav-item.megamenu .dropdown-menu .megamenu-submenu li a.active .count {
        color: var(--whiteColor);
        background-color: var(--mainColor);
    }

    .navbar-area .navbar .search-box {
        width: 330px;
        margin-left: 60px;
        position: relative;
    }

    .navbar-area .navbar .search-box label {
        display: block;
        margin-bottom: 0;
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--mainColor);
        font-size: 20px;
        margin-top: 1px;
    }

    .navbar-area .navbar .search-box .input-search {
        display: block;
        width: 100%;
        background-color: #f2f2f2;
        height: 45px;
        border: none;
        font-size: 14px;
        color: var(--blackColor);
        padding-left: 45px;
        border-radius: 3px;
    }

    .navbar-area .navbar .search-box .input-search::placeholder {
        transition: var(--transition);
        color: var(--optionalColor);
    }

    .navbar-area .navbar .search-box .input-search:focus::placeholder {
        color: transparent;
    }

    .navbar-area .navbar .others-option {
        margin-left: auto;
    }

    .navbar-area .navbar .others-option .option-item {
        margin-left: 25px;
    }

    .navbar-area .navbar .others-option .option-item:first-child {
        margin-left: 0;
    }

    .navbar-area .navbar .others-option .option-item .cart-btn {
        color: var(--blackColor);
        line-height: 1;
        display: inline-block;
        font-size: 22px;
        position: relative;
        top: 2px;
    }

    .navbar-area .navbar .others-option .option-item .cart-btn:hover {
        color: var(--mainColor);
    }

    .navbar-area .navbar .others-option .option-item .wishlist-btn {
        color: var(--blackColor);
        line-height: 1;
        display: inline-block;
        font-size: 22px;
        position: relative;
        top: 2px;
    }

    .navbar-area .navbar .others-option .option-item .wishlist-btn:hover {
        color: var(--mainColor);
    }

    .navbar-area .navbar .others-option .option-item .search-icon {
        cursor: pointer;
        color: var(--blackColor);
        transition: var(--transition);
        line-height: 1;
        display: inline-block;
        font-size: 22px;
        position: relative;
        margin-right: -5px;
        top: 2px;
    }

    .navbar-area .navbar .others-option .option-item .search-icon:hover {
        color: var(--mainColor);
    }

    .navbar-area .navbar .others-option .option-item .search-box {
        width: 325px;
        margin-left: 0;
        position: relative;
    }

    .navbar-area .navbar .others-option .option-item .search-box label {
        display: block;
        margin-bottom: 0;
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--mainColor);
        font-size: 20px;
        margin-top: 1px;
    }

    .navbar-area .navbar .others-option .option-item .search-box .input-search {
        display: block;
        width: 100%;
        background-color: #f2f2f2;
        height: 45px;
        border: none;
        font-size: 14px;
        color: var(--blackColor);
        padding-left: 45px;
        border-radius: 3px;
    }

    .navbar-area .navbar .others-option .option-item .search-box .input-search::placeholder {
        transition: var(--transition);
        color: var(--optionalColor);
    }

    .navbar-area .navbar .others-option .option-item .search-box .input-search:focus::placeholder {
        color: transparent;
    }

    .search-overlay {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 99999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease-in-out;
        overflow: hidden;
    }

    .search-overlay .search-overlay-layer {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
        transform: translateX(100%);
    }

    .search-overlay .search-overlay-layer:nth-child(1) {
        left: 0;
        background-color: rgba(0, 0, 0, 0.5);
        transition: all 0.3s ease-in-out 0s;
    }

    .search-overlay .search-overlay-layer:nth-child(2) {
        left: 0;
        background-color: rgba(0, 0, 0, 0.4);
        transition: all 0.3s ease-in-out 0.3s;
    }

    .search-overlay .search-overlay-layer:nth-child(3) {
        left: 0;
        background-color: rgba(0, 0, 0, 0.7);
        transition: all 0.9s ease-in-out 0.6s;
    }

    .search-overlay .search-overlay-close {
        position: absolute;
        top: 40px;
        right: 40px;
        width: 50px;
        z-index: 2;
        text-align: center;
        cursor: pointer;
        padding: 10px;
        transition: all 0.9s ease-in-out 1.5s;
        opacity: 0;
        visibility: hidden;
    }

    .search-overlay .search-overlay-close .search-overlay-close-line {
        width: 100%;
        height: 3px;
        float: left;
        margin-bottom: 5px;
        background-color: var(--whiteColor);
        transition: all 500ms ease;
    }

    .search-overlay .search-overlay-close .search-overlay-close-line:nth-child(1) {
        transform: rotate(45deg);
    }

    .search-overlay .search-overlay-close .search-overlay-close-line:nth-child(2) {
        margin-top: -7px;
        transform: rotate(-45deg);
    }

    .search-overlay .search-overlay-close:hover .search-overlay-close-line {
        background: var(--mainColor);
        transform: rotate(180deg);
    }

    .search-overlay .search-overlay-form {
        transition: all 0.9s ease-in-out 1.4s;
        opacity: 0;
        visibility: hidden;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translateY(-50%) translateX(-50%);
        z-index: 2;
        max-width: 500px;
        width: 500px;
    }

    .search-overlay .search-overlay-form form {
        position: relative;
    }

    .search-overlay .search-overlay-form form .input-search {
        display: block;
        width: 100%;
        height: 60px;
        border: none;
        border-radius: 30px;
        color: var(--blackColor);
        padding: 2px 0 0 25px;
    }

    .search-overlay .search-overlay-form form .input-search::placeholder {
        transition: var(--transition);
        letter-spacing: 0.5px;
        color: var(--blackColor);
    }

    .search-overlay .search-overlay-form form .input-search:focus::placeholder {
        color: transparent;
    }

    .search-overlay .search-overlay-form form button {
        position: absolute;
        right: 5px;
        top: 5px;
        width: 50px;
        color: var(--whiteColor);
        height: 50px;
        border-radius: 50%;
        background-color: var(--mainColor);
        transition: var(--transition);
        border: none;
        font-size: 20px;
        line-height: 50px;
    }

    .search-overlay .search-overlay-form form button:hover {
        background-color: var(--blackColor);
        color: var(--whiteColor);
    }

    .search-overlay.active.search-overlay {
        opacity: 1;
        visibility: visible;
    }

    .search-overlay.active.search-overlay .search-overlay-layer {
        transform: translateX(0);
    }

    .search-overlay.active.search-overlay .search-overlay-close {
        opacity: 1;
        visibility: visible;
    }

    .search-overlay.active.search-overlay .search-overlay-form {
        opacity: 1;
        visibility: visible;
    }

    /* Max width 767px */
    @media only screen and (max-width: 767px) {
        .navbar-area {
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .navbar-area .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }

        .navbar-area .navbar .search-box {
            width: 100%;
            margin-left: 0;
            margin-top: 15px;
        }

        .navbar-area .navbar .navbar-nav {
            margin-left: 0;
            display: block;
            overflow-y: scroll;
            height: 400px;
            margin-top: 15px;
            flex-direction: unset;
            background-color: #fafafa;
            padding-top: 18px;
            padding-left: 18px;
            padding-right: 18px;
            padding-bottom: 18px;
        }

        .navbar-area .navbar .navbar-nav .nav-item {
            margin-left: 0;
            margin-right: 0;
            margin-top: 18px;
            margin-bottom: 18px;
        }

        .navbar-area .navbar .navbar-nav .nav-item .nav-link {
            padding-top: 0;
            padding-bottom: 0;
        }

        .navbar-area .navbar .navbar-nav .nav-item .dropdown-toggle::before {
            right: 0;
            top: -5px;
        }

        .navbar-area .navbar .navbar-nav .nav-item:first-child {
            margin-top: 0;
        }

        .navbar-area .navbar .navbar-nav .nav-item:last-child {
            margin-bottom: 0;
        }

        .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu {
            position: relative;
            top: 0 !important;
            box-shadow: unset;
            width: 100%;
            padding: 15px;
            margin-top: 12px !important;
            opacity: 1;
            visibility: visible;
        }

        .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu .nav-item {
            margin-left: 0;
            margin-right: 0;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu .nav-item:first-child {
            margin-top: 0;
        }

        .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu .nav-item:last-child {
            margin-bottom: 0;
        }

        .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu .nav-item .nav-link {
            margin: 0;
            padding: 0;
        }

        .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu .nav-item .dropdown-menu {
            left: 0;
            right: 0;
            top: 0;
            width: auto;
            opacity: 1;
            visibility: visible;
            background-color: #fafafa;
            margin: 15px 0 0 !important;
        }

        .navbar-area .navbar .navbar-nav .nav-item.megamenu .dropdown-menu {
            position: relative;
            top: 0;
            margin-top: 12px;
            left: 0;
            padding: 15px;
        }

        .navbar-area .navbar .navbar-nav .nav-item.megamenu .dropdown-menu .row {
            display: block;
            flex-wrap: unset;
        }

        .navbar-area .navbar .navbar-nav .nav-item.megamenu .dropdown-menu .submenu-title {
            font-size: 13.5px;
        }

        .navbar-area .navbar .navbar-nav .nav-item.megamenu .dropdown-menu .col {
            margin-bottom: 25px;
        }

        .navbar-area .navbar .navbar-nav .nav-item.megamenu .dropdown-menu .col:last-child {
            margin-bottom: 0;
        }

        .navbar-area .navbar .others-option {
            display: block !important;
            text-align: center;
            margin-top: 15px;
        }

        .navbar-area .navbar .others-option .option-item {
            display: inline-block;
            margin-left: 8px;
            margin-top: 15px;
            margin-right: 8px;
        }

        .navbar-area .navbar .others-option .option-item .search-box {
            width: auto;
        }

        .navbar-area .navbar .others-option .option-item:first-child {
            display: block;
            margin-left: 0;
            margin-top: 0;
            margin-right: 0;
        }

        .navbar-area.navbar-style-two .navbar .others-option {
            margin-left: 0;
        }

        .navbar-area.navbar-style-two .navbar .others-option .option-item {
            display: inline-block !important;
            margin-top: 0 !important;
            margin-left: 8px !important;
            margin-right: 8px !important;
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item a {
            color: var(--blackColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item a:hover,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item a:focus,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item a.active {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item:hover a,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item.active a {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li a {
            color: var(--blackColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li a:hover,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li a:focus,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li a.active {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li a {
            color: var(--blackColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li a:hover,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li a:focus,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li a.active {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li a {
            color: var(--blackColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li a:hover,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li a:focus,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li a.active {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a {
            color: var(--blackColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:hover,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:focus,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a.active {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a {
            color: var(--blackColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:hover,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:focus,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a.active {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a {
            color: var(--blackColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:hover,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:focus,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a.active {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a {
            color: var(--blackColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:hover,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:focus,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a.active {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li.active a {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li.active a {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li.active a {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li.active a {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li.active a {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li.active a {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .others-option .option-item .cart-btn {
            color: var(--whiteColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .others-option .option-item .cart-btn:hover {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .others-option .option-item .wishlist-btn {
            color: var(--whiteColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .others-option .option-item .wishlist-btn:hover {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .others-option .option-item .search-icon {
            color: var(--whiteColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .others-option .option-item .search-icon:hover {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar-toggler {
            color: var(--whiteColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar-toggler .burger-menu span {
            background: var(--whiteColor);
        }

        .navbar-light .navbar-toggler {
            color: var(--blackColor);
            font-size: inherit;
            border: none;
            padding: 0;
            box-shadow: unset;
        }

        .navbar-light .navbar-toggler .burger-menu {
            cursor: pointer;
        }

        .navbar-light .navbar-toggler .burger-menu span {
            height: 2px;
            width: 30px;
            margin: 6px 0;
            display: block;
            background: var(--blackColor);
        }

        .navbar-light.active .navbar-toggler .burger-menu span.top-bar {
            transform: rotate(45deg);
            transform-origin: 10% 10%;
        }

        .navbar-light.active .navbar-toggler .burger-menu span.middle-bar {
            opacity: 0;
        }

        .navbar-light.active .navbar-toggler .burger-menu span.bottom-bar {
            transform: rotate(-45deg);
            transform-origin: 10% 90%;
            margin-top: 5px;
        }

        .navbar-light.active .collapse:not(.show) {
            display: block;
        }

        .search-overlay .search-overlay-form {
            max-width: 290px;
            width: 290px;
        }
    }

    /* Min width 768px to Max width 991px */
    @media only screen and (min-width: 768px) and (max-width: 991px) {
        .navbar-area {
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .navbar-area .container-fluid {
            max-width: 720px;
            padding-left: 15px;
            padding-right: 15px;
        }

        .navbar-area .navbar .search-box {
            width: 100%;
            margin-left: 0;
            margin-top: 15px;
        }

        .navbar-area .navbar .navbar-nav {
            margin-left: 0;
            display: block;
            overflow-y: scroll;
            height: 400px;
            margin-top: 15px;
            flex-direction: unset;
            background-color: #fafafa;
            padding-top: 18px;
            padding-left: 18px;
            padding-right: 18px;
            padding-bottom: 18px;
        }

        .navbar-area .navbar .navbar-nav .nav-item {
            margin-left: 0;
            margin-right: 0;
            margin-top: 18px;
            margin-bottom: 18px;
        }

        .navbar-area .navbar .navbar-nav .nav-item .nav-link {
            padding-top: 0;
            padding-bottom: 0;
        }

        .navbar-area .navbar .navbar-nav .nav-item .dropdown-toggle::before {
            right: 0;
            top: -5px;
        }

        .navbar-area .navbar .navbar-nav .nav-item:first-child {
            margin-top: 0;
        }

        .navbar-area .navbar .navbar-nav .nav-item:last-child {
            margin-bottom: 0;
        }

        .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu {
            position: relative;
            top: 0 !important;
            box-shadow: unset;
            width: 100%;
            padding: 15px;
            margin-top: 12px !important;
            opacity: 1;
            visibility: visible;
        }

        .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu .nav-item {
            margin-left: 0;
            margin-right: 0;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu .nav-item:first-child {
            margin-top: 0;
        }

        .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu .nav-item:last-child {
            margin-bottom: 0;
        }

        .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu .nav-item .nav-link {
            margin: 0;
            padding: 0;
        }

        .navbar-area .navbar .navbar-nav .nav-item .dropdown-menu .nav-item .dropdown-menu {
            left: 0;
            right: 0;
            top: 0;
            width: auto;
            opacity: 1;
            visibility: visible;
            background-color: #fafafa;
            margin: 15px 0 0 !important;
        }

        .navbar-area .navbar .navbar-nav .nav-item.megamenu .dropdown-menu {
            position: relative;
            top: 0;
            margin-top: 12px;
            left: 0;
            padding: 15px;
        }

        .navbar-area .navbar .navbar-nav .nav-item.megamenu .dropdown-menu .submenu-title {
            font-size: 13.5px;
        }

        .navbar-area .navbar .navbar-nav .nav-item.megamenu .dropdown-menu .col {
            margin-bottom: 25px;
        }

        .navbar-area .navbar .navbar-nav .nav-item.megamenu .dropdown-menu .col:last-child {
            margin-bottom: 0;
        }

        .navbar-area .navbar .others-option {
            display: block !important;
            text-align: center;
            margin-top: 15px;
        }

        .navbar-area .navbar .others-option .option-item {
            display: inline-block;
            margin-left: 8px;
            margin-top: 15px;
            margin-right: 8px;
        }

        .navbar-area .navbar .others-option .option-item .search-box {
            width: auto;
        }

        .navbar-area .navbar .others-option .option-item:first-child {
            display: block;
            margin-left: 0;
            margin-top: 0;
            margin-right: 0;
        }

        .navbar-area.navbar-style-two .navbar .others-option {
            margin-left: 0;
        }

        .navbar-area.navbar-style-two .navbar .others-option .option-item {
            display: inline-block !important;
            margin-top: 0 !important;
            margin-left: 8px !important;
            margin-right: 8px !important;
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item a {
            color: var(--blackColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item a:hover,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item a:focus,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item a.active {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item:hover a,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item.active a {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li a {
            color: var(--blackColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li a:hover,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li a:focus,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li a.active {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li a {
            color: var(--blackColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li a:hover,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li a:focus,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li a.active {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li a {
            color: var(--blackColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li a:hover,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li a:focus,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li a.active {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a {
            color: var(--blackColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:hover,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:focus,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a.active {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a {
            color: var(--blackColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:hover,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:focus,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a.active {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a {
            color: var(--blackColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:hover,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:focus,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a.active {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a {
            color: var(--blackColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:hover,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a:focus,
        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li a.active {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li.active a {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li.active a {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li .dropdown-menu li.active a {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li .dropdown-menu li.active a {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li .dropdown-menu li.active a {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .navbar-nav .nav-item .dropdown-menu li.active a {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .others-option .option-item .cart-btn {
            color: var(--whiteColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .others-option .option-item .cart-btn:hover {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .others-option .option-item .wishlist-btn {
            color: var(--whiteColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .others-option .option-item .wishlist-btn:hover {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .others-option .option-item .search-icon {
            color: var(--whiteColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar .others-option .option-item .search-icon:hover {
            color: var(--mainColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar-toggler {
            color: var(--whiteColor);
        }

        .navbar-area.navbar-style-two.bg-black .navbar-toggler .burger-menu span {
            background: var(--whiteColor);
        }

        .navbar-light .navbar-toggler {
            color: var(--blackColor);
            font-size: inherit;
            border: none;
            box-shadow: unset;
            padding: 0;
        }

        .navbar-light .navbar-toggler .burger-menu {
            cursor: pointer;
        }

        .navbar-light .navbar-toggler .burger-menu span {
            height: 2px;
            width: 30px;
            margin: 6px 0;
            display: block;
            background: var(--blackColor);
        }

        .navbar-light.active .navbar-toggler .burger-menu span.top-bar {
            transform: rotate(45deg);
            transform-origin: 10% 10%;
        }

        .navbar-light.active .navbar-toggler .burger-menu span.middle-bar {
            opacity: 0;
        }

        .navbar-light.active .navbar-toggler .burger-menu span.bottom-bar {
            transform: rotate(-45deg);
            transform-origin: 10% 90%;
            margin-top: 5px;
        }

        .navbar-light.active .collapse:not(.show) {
            display: block;
        }
    }

    /* Min width 992px to Max width 1199px */
    @media only screen and (min-width: 992px) and (max-width: 1199px) {
        .navbar-area .container-fluid {
            max-width: 960px;
            padding-left: 15px;
            padding-right: 15px;
        }

        .navbar-area .navbar .navbar-nav {
            margin-left: 20px;
        }

        .navbar-area .navbar .navbar-nav .nav-item {
            margin-left: 12px;
            margin-right: 12px;
        }

        .navbar-area .navbar .search-box {
            width: 180px;
            margin-left: 20px;
        }

        .navbar-area .navbar .others-option .option-item {
            margin-left: 20px;
        }

        .navbar-area .navbar .others-option .option-item .search-box {
            width: 180px;
        }
    }

    /* Min width 1200px to Max width 1355px */
    @media only screen and (min-width: 1200px) and (max-width: 1355px) {
        .navbar-area .container-fluid {
            max-width: 1140px;
            padding-left: 15px;
            padding-right: 15px;
        }

        .navbar-area .navbar .search-box {
            width: 300px;
        }

        .navbar-area .navbar .others-option .option-item .search-box {
            width: 300px;
        }
    }

    /* Min width 1550px */
    @media only screen and (min-width: 1550px) {
        .navbar-area .container-fluid {
            padding-left: 80px;
            padding-right: 80px;
        }

        .navbar-area .navbar .navbar-nav .nav-item .dropdown-toggle::before {
            top: 25px;
        }
    }
</style>

<div class="navbar-area navbar-style-two" ngStickyNav stickyClass="sticky-box-shadow" ngStickyNav>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" [class.active]="classApplied">
            <a class="navbar-brand" href="/"><img src="{{ asset('user/img/logo.png') }}" alt="logo"></a>
            <button class="navbar-toggler" type="button" (click)="toggleClass()">
                <span class="burger-menu">
                    <span class="top-bar"></span>
                    <span class="middle-bar"></span>
                    <span class="bottom-bar"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- <form class="search-box">
                    <label><i class='bx bx-search'></i></label>
                    <input type="text" class="input-search" placeholder="Search Hotel,Deals & coupons">
                </form> -->
                <ul class="navbar-nav">
                    <!-- <li class="nav-item"><a href="javascript:void(0)" class="dropdown-toggle nav-link">Home</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a href="/" class="nav-link" >Home Demo - 1</a></li>
                            <li class="nav-item"><a href="/index-2" class="nav-link" >Home Demo - 2</a></li>
                            <li class="nav-item"><a href="/index-3" class="nav-link" >Home Demo - 3</a></li>
                        </ul>
                    </li> -->
                    <!-- <li class="nav-item"><a href="/dashboard" class="nav-link" >Dashboard</a></li> -->
                    <li class="nav-item"><a href="/coming-soon" class="nav-link"  >Flight</a></li>
                    <li class="nav-item"><a href="/coming-soon" class="nav-link"  >Hotel </a></li>
                    <li class="nav-item"><a href="/coming-soon" class="nav-link"  >Taxi </a></li>
                    <li class="nav-item"><a href="{{url('all-stores')}}" class="nav-link"  >Hotel Package </a></li>
                    <!-- <li class="nav-item megamenu"><a href="javascript:void(0)" class="dropdown-toggle nav-link">Deals</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="submenu-title">Top Locations</h6>
                                        <ul class="megamenu-submenu">
                                            <li><a href="/search-page">Hotel & Resorts<span class="count">6</span></a></li>
                                            <li><a href="/search-page">Restaurants <span class="count">5</span></a></li>
                                            <li><a href="/search-page">Bora Bora <span class="count">4</span></a></li>
                                            <li><a href="/search-page">London <span class="count">3</span></a></li>
                                            <li><a href="/search-page">Maui <span class="count">2</span></a></li>

                                        </ul>
                                    </div>
                                    <div class="col">
                                        <h6 class="submenu-title">Top Categories</h6>
                                        <ul class="megamenu-submenu">
                                            <li><a href="/search-page">Hotel & Resorts <span class="count">1</span></a></li>
                                            <li><a href="/search-page">Restaurants <span class="count">2</span></a></li>

                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li> -->
                    <!-- <li class="nav-item"><a href="javascript:void(0)" class="dropdown-toggle nav-link">Hotel</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a href="/all-stores" class="nav-link" >Hotel</a></li>
                            <li class="nav-item"><a href="/stores-details" class="nav-link" >Hotel Details</a></li>
                            <li class="nav-item"><a href="/coupons" class="nav-link" >Coupons</a></li>
                        </ul>
                    </li> -->
                    <!-- <li class="nav-item"><a href="javascript:void(0)" class="dropdown-toggle nav-link">Pages</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a href="/locations" class="nav-link" >Locations</a></li>
                            <li class="nav-item"><a href="/categories" class="nav-link" >Categories</a></li>
                            <li class="nav-item"><a href="/how-it-works" class="nav-link" >How It Works</a></li>
                            <li class="nav-item"><a href="/gallery" class="nav-link" >Gallery</a></li>
                            <li class="nav-item"><a href="javascript:void(0)" class="nav-link">Shop <i class='bx bx-chevron-right'></i></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="/products-list" class="nav-link" >Products List</a></li>
                                    <li class="nav-item"><a href="/cart" class="nav-link" >Cart</a></li>
                                    <li class="nav-item"><a href="/checkout" class="nav-link" >Checkout</a></li>
                                    <li class="nav-item"><a href="/products-details" class="nav-link" >Products Details</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a href="/faq" class="nav-link" >FAQ</a></li>
                            <li class="nav-item"><a href="/profile-authentication" class="nav-link" >Login/Register</a></li>
                            <li class="nav-item"><a href="/customer-service" class="nav-link" >Customer Service</a></li>
                            <li class="nav-item"><a href="/error-404" class="nav-link" >404 Error Page</a></li>
                            <li class="nav-item"><a href="/coming-soon" class="nav-link" >Coming Soon</a></li>
                            <li class="nav-item"><a href="javascript:void(0)" class="nav-link">Blog <i class='bx bx-chevron-right'></i></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="/blog-grid" class="nav-link" >Blog Grid</a></li>
                                    <li class="nav-item"><a href="/blog-right-sidebar" class="nav-link" >Blog Right Sidebar</a></li>
                                    <li class="nav-item"><a href="/blog-details" class="nav-link" >Blog Details</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a href="javascript:void(0)" class="nav-link">My Account <i class='bx bx-chevron-right'></i></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="/dashboard" class="nav-link" >My Dashboard</a></li>
                                    <li class="nav-item"><a href="/dashboard-profile" class="nav-link" >My Profile</a></li>
                                    <li class="nav-item"><a href="/dashboard-store" class="nav-link" >My Store</a></li>
                                    <li class="nav-item"><a href="/dashboard-coupons" class="nav-link" >My Coupons</a></li>
                                    <li class="nav-item"><a href="/dashboard-deals" class="nav-link" >My Deals</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="/contact" class="nav-link" >Contact</a></li> -->
                </ul>
                <div class="others-option d-flex align-items-center">
                    <div class="option-item">
                        <a href="/cart" class="wishlist-btn"></a>
                    </div>
                    <div class="option-item">
                        <a href="/cart" class="cart-btn"><i class='bx bx-shopping-bag'></i></a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
