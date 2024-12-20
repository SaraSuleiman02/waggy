<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/autoload.php'; // Autoloader for controllers
$cart = new CartController();
$count = $cart->getCartItemsCount();

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Waggy</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/vendor.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <link href="https://fonts.googleapis.com/css2?family=Chilanka&family=Montserrat:wght@300;400;500&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/profileStyle.css">

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Chilanka&family=Montserrat:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css">
        
    </script>

    <!-- Cart Style -->
    <link rel="stylesheet" href="../css/cart_style.css">


    <style>
        .heart-icon {
            cursor: pointer;
            font-size: 1.5em;
            color: red;
        }

        .heart-icon.filled {
            color: red;
        }

        .heart-icon.outline {
            color: gray;
        }

        .alert-position {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            display: none;
        }

        .rounded-sweetalert {
            border-radius: 20px !important;
        }

        /* Container styling */
        .section {
            padding-top: 2rem;
            background-color: #f8f9fa;
        }

        /* Card styling */
        .card1 {
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .card1 h5 {
            font-weight: bold;
        }

        .card1 img {
            width: 100%;
            height: auto;
        }

        /* Footer button */
        .card-footer button {
            background-color: #dfb074;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            width: 100%;
            font-weight: bold;
        }

        .card-footer button:hover {
            background-color: #c6a56b;
        }

        .main-logo {
            margin-right: 15px;
            /* Adjust this value as needed */
        }

        .icon-cart {
            display: flex;
            align-items: center;
        }

        #cart_page .title {
            margin-bottom: 5vh;
        }

        #cart_page .card {
            margin: auto;
            max-width: 950px;
            width: 90%;
            box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 1rem;
            border: transparent;
        }

        @media(max-width:767px) {
            #cart_page .card {
                margin: 3vh auto;
            }
        }

        #cart_page .cart {
            background-color: #fff;
            padding: 4vh 5vh;
            border-bottom-left-radius: 1rem;
            border-top-left-radius: 1rem;
        }

        @media(max-width:767px) {
            #cart_page .cart {
                padding: 4vh;
                border-bottom-left-radius: unset;
                border-top-right-radius: 1rem;
            }
        }

        #cart_page .summary {
            background-color: #f9f3ec;
            border-top-right-radius: 1rem;
            border-bottom-right-radius: 1rem;
            padding: 4vh;
            color: rgb(65, 65, 65);
        }

        @media(max-width:767px) {
            #cart_page .summary {
                border-top-right-radius: unset;
                border-bottom-left-radius: 1rem;
            }
        }

        #cart_page .summary .col-2 {
            padding: 0;
        }

        #cart_page .summary .col-10 {
            padding: 0;
        }

        #cart_page .border-top,
        #cart_page .title .border-bottom {
            border-top: var(--bs-border-width) var(--bs-border-style) #000 !important;
            border-bottom: var(--bs-border-width) var(--bs-border-style) #000 !important;
        }

        #cart_page .row {
            margin: 0;
        }

        #cart_page .title b {
            font-size: 1.5rem;
        }

        #cart_page .main {
            margin: 0;
            padding: 2vh 0;
            width: 100%;
        }

        #cart_page .col-2,
        #cart_page .col {
            padding: 0 1vh;
        }

        #cart_page a {
            padding: 0 1vh;
        }

        #cart_page .close {
            margin-left: auto;
            font-size: 0.7rem;
        }

        #cart_page img {
            width: 3.5rem;
        }

        #cart_page .back-to-shop {
            margin-top: 4.5rem;
        }

        #cart_page h5 {
            margin-top: 4vh;
        }

        #cart_page hr {
            margin-top: 1.25rem;
        }

        #cart_page form {
            padding: 2vh 0;
        }

        #cart_page select {
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1.5vh 1vh;
            margin-bottom: 4vh;
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247);
        }

        #cart_page input {
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1vh;
            margin-bottom: 4vh;
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247);
        }

        #cart_page input:focus::-webkit-input-placeholder {
            color: transparent;
        }

        #cart_page .btn {
            background-color: #000;
            border-color: #000;
            color: white;
            width: 100%;
            font-size: 0.7rem;
            margin-top: 4vh;
            padding: 1vh;
            border-radius: 0;
        }

        #cart_page .btn:focus {
            box-shadow: none;
            outline: none;
            box-shadow: none;
            color: white;
            -webkit-box-shadow: none;
            user-select: none;
            transition: none;
        }

        #cart_page .btn:hover {
            color: white;
        }

        #cart_page a {
            color: black;
        }

        #cart_page a:hover {
            color: black;
            text-decoration: none;
        }

        #cart_page #code {
            background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
            background-repeat: no-repeat;
            background-position-x: 95%;
            background-position-y: center;
        }

        @media (max-width: 576px) {
            .icon-container {
                justify-content: flex-start;
                width: 100%;
            }

            .icon-container li {
                margin-right: 10px;
            }
        }
        #cart_page #code {
        background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
        background-repeat: no-repeat;
        background-position-x: 95%;
        background-position-y: center;
        }

        /* Navbar Styling */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 10px 20px;
        }

        #logo, #links, #icons {
            display: flex;
            align-items: center;
        }

        #icons {
            flex-direction: row;
            gap: 10px;
        }

        #logo img {
            max-width: 120px;
        }

        .navbar-toggler {
            margin-right: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            #cart_page .card {
                margin: 3vh auto;
            }

            #cart_page .cart {
                padding: 4vh;
                border-bottom-left-radius: unset;
                border-top-right-radius: 1rem;
            }

            #cart_page .summary {
                border-top-right-radius: unset;
                border-bottom-left-radius: 1rem;
            }
        }
    </style>
    

</head>

<body>
    <!-- <div class="preloader-wrapper">
        <div class="preloader">
        </div>
    </div> -->

    <!-- NAVBAR -->
    <header>
        <div class="container py-1">
            <nav class="navbar navbar-expand-lg justify-content-center fixed-top p-2 px-5"
                style="background-color: rgba(255, 255, 255, 0.8);">
                <div id="logo" class="col-sm-4 col-lg-3 text-center text-sm-start d-flex align-items-center justify-content-start"
                    >
                    <!-- Logo aligned left -->
                    <div class="main-logo me-3">
                        <a href="index.php">
                            <img src="../images/logo.png" alt="logo" class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-sm-8 col-lg-6">
                    <!-- Center the navigation links -->
                    <nav class="navbar navbar-expand-lg justify-content-center">
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                            aria-labelledby="offcanvasNavbarLabel">
                            <div class="offcanvas-header justify-content-center">
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>


                            <div class="offcanvas-body justify-content-center">
                                <?php
                                // Get the current file name from the URL
                                $currentPage = basename($_SERVER['PHP_SELF']);
                                ?>

                                <ul class="navbar-nav menu-list list-unstyled d-flex justify-content-center gap-md-3 mb-0">
                                    <li class="nav-item">
                                        <a href="index.php"
                                            class="nav-link <?php echo $currentPage == 'index.php' ? 'active' : ''; ?>">Home</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" role="button" id="pages"
                                            data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                                        <ul class="dropdown-menu" aria-labelledby="pages">
                                            <li><a href="shop2.php?categ-id=1" class="dropdown-item">All</a></li>
                                            <li><a href="shop2.php?categ-id=2" class="dropdown-item">Cats</a></li>
                                            <li><a href="shop2.php?categ-id=3" class="dropdown-item">Dogs</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="about-us.php"
                                            class="nav-link <?php echo $currentPage == 'about-us.php' ? 'active' : ''; ?>">About
                                            Us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="contact_us.php"
                                            class="nav-link <?php echo $currentPage == 'contact_us.php' ? 'active' : ''; ?>">Contact
                                            Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </nav>
                </div>

                <div class="col-sm-4 col-lg-3 d-flex justify-content-end"> <!-- Adjusted to allow icons to align right -->
                    <ul class="d-flex list-unstyled mb-0 align-items-center">
                        <div class="d-flex align-items-center icon-container"> <!-- Added class for icon container -->
                            <?php if ($isLoggedIn): ?>
                                <li class="dropdown">
                                    <a href="#" class="mx-2" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <iconify-icon icon="healthicons:person" class="fs-4"></iconify-icon>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="userProfile.php">Profile</a>
                                        <a class="dropdown-item" href="../controllers/LogoutController.php">Logout</a>
                                    </ul>
                                </li>
                            <?php else: ?>
                                <li class="dropdown">
                                    <a href="#" class="mx-2" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <iconify-icon icon="healthicons:person" class="fs-4"></iconify-icon>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="register.php">Register</a>
                                        <a class="dropdown-item" href="login.php">Login</a>
                                    </ul>
                                </li>
                            <?php endif; ?>

                            <li>
                                <a href="wishlist.php" class="mx-3">
                                    <iconify-icon icon="mdi:heart" class="fs-4"></iconify-icon>
                                </a>
                            </li>

                            <li>
                                <a href="./cart.php" class="icon-cart">
                                    <svg style="margin-top:-15px;" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="filled" viewBox="0 0 18 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1" />
                                    </svg>
                                    <span class="mb-2 ms-2 translate-middle badge rounded-circle bg-primary pt-2">
                                        <?= $count ?>
                                    </span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</body>

</html>