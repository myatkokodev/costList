<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Cost List</title>

    <!--bootstrap css file-->
    <!-- <link rel="stylesheet" href="./assets/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!--custom css file-->
    <link rel="stylesheet" href="./assets/css/style.css">

</head>
<body>
    
    <!--Start Header-->
    <header class="header-area">
        <!--Start Navigation-->
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
           <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="./index.php?months=<?php echo $months; ?>"><?php echo isset($_SESSION['loggedin']) ? "HOME": "COSTNOTE";  ?></a>
           <?php if(isset($_SESSION['loggedin'])): ?>
                <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
           <?php endif; ?>
            <?php if(!isset($_SESSION['loggedin'])): ?>
                <!--To get Space -->
                <div class=" d-none d-md-block  w-100">
                    <a class="m-0 px-3" style="opacity: 0;">sign up</a>
                </div>
                <div class=" d-none d-md-block  w-100">
                    <a class="m-0 px-3" style="opacity: 0;">sign up</a>
                </div>
                <div class=" d-none d-md-block  w-100">
                    <a class="m-0 px-3" style="opacity: 0;">sign up</a>
                </div>
                <div class=" d-none d-md-block  w-100">
                    <a class="m-0 px-3" style="opacity: 0;">sign up</a>
                </div>
                <div class="d-none d-md-block w-100">
                    <a class="m-0 px-3" style="opacity: 0;">sign up</a>
                </div>
                <div class="d-none d-md-block w-100">
                    <a class="m-0 px-3" style="opacity: 0;">sign up</a>
                </div>
                <div class="d-none d-md-block w-100">
                    <a class="m-0 px-3" style="opacity: 0;">sign up</a>
                </div>
                <!--To get space -->
                <div class="d-flex w-100 p-md-0 p-2">
                    <a href="signup.php" class="m-0 px-3  custom-font text-light">sign up</a>
                </div>
                <div class="d-flex w-100 p-md-0 p-2">
                    <a href="signin.php" class="m-0 px-3 custom-font text-light">sign In</a>
                </div>
            <?php endif; ?>
            <ul class="navbar-nav px-3 py-0">
                <?php if(isset($_SESSION['loggedin'])): ?>
                    <li class="nav-item text-nowrap">
                    <a class="nav-link text-light font-weight-bold" href="new_cost.php?months=<?php echo $months; ?>" style="font-size: 35px;padding: 0;"> 
                    <img src="./assets/img/local-icon/add-note.ico" alt="addnote" style="width:20px;">
                    <p style="font-size: 15px;display: inline-block;position: relative;top: -5px;">
                    Add New Cost</p></a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- End Navigation -->
    </header>
    <!--End Header-->