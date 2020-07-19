    <?php

        require("function.php");
        $errors = array();
        $months = isset($_GET['months']) ? $_GET['months'] : null;

        if($loggedInUser = isLoggedin()){
            $user = $loggedInUser['id'];
        }
       

        if(isset($_POST['submit'])){
            $new_cost = array();

            //save in session
            flash($_POST);


            //validate name
            if(empty($_POST['name'])){
                 $errors['name'] = "you must fill this field";
             }else{
                 $new_cost['name'] = $_POST['name'];
             }


             //validate cost
            if(empty($_POST['cost'])){
                $errors['cost'] = "you must fill this field";
            }else{
                $new_cost['cost'] = $_POST['cost'];
            }

            $new_cost['user_id'] = $_POST['user'];

            if(count($errors) == 0){
                if(insertCost($new_cost)){
                    header("Location:index.php?months=" . $months);
                }else{
                    $errors['save'] = "Something went wrong while saving this post.Please try again.";
                }
                //print_r($new_cost);
            }


        }


    ?>

            <?php
            //include header.php file
            include("./include/header.php");
            ?>    
              
<!-- if the user did not loggedin -->
<?php if(!isset($_SESSION['loggedin'])): ?>

<div class="container-fluid p-0 m-0">
    <div class="font-abel logout-section p-0 m-0 text-center d-flex align-items-center justify-content-center" style="width: 100vw; height: 90vh;">
        <h1 class="text-dark"><span class="text-danger">Write</span> your daily notes<br>Please <a href="signup.php">signup</a> Sir...</h1>
    </div>
</div>

<?php endif; ?>
<!-- if the user did not loggedin -->

<?php if(isset($_SESSION['loggedin'])): ?>

<?php if(isset($errors['save'])): ?>
    <p class="text-danger"><?php echo $errors['save']; ?></p>
<?php endif; ?>

                
<div class="container-fluid d-flex justify-content-center font-abel">
    <div class="col-md-6 new-cost shadow">
        <h5 class="font-weight-500 text-center py-5">Enter New List</h5>
        <form action="" method="POST" class="mb-5">
            <input type="hidden" name="user" value="<?php echo $user; ?>">
                <div class="form-group">
                    <input type="text" name="name" id="search-form-control" value="<?php echo old('name'); ?>" placeholder="product name">
                        <?php if(isset($errors['name'])): ?>
                            <p class="text-danger pl-5"><?php echo $errors['name']; ?></p>
                        <?php endif; ?>
                </div>
                <div class="form-group">
                    <input type="text" name="cost" id="search-form-control" placeholder="cost" value="<?php echo old('cost'); ?>">
                        <?php if(isset($errors['cost'])): ?>
                            <p class="text-danger pl-5"><?php echo $errors['cost']; ?></p>
                        <?php endif; ?>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <button name="submit" class="first-button">Submit</button>
                </div>
        </form>
    </div>
</div>

<?php endif; ?>

<?php
    //include footer.php file
    include("./include/footer.php");
?>