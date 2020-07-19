<?php

require("./function.php");

$cost_id = isset($_GET['id']) ? $_GET['id'] : null;
$current_months = isset($_GET['months']) ? $_GET['months'] : null;

$months = isset($_GET['months']) ? $_GET['months'] : null;
//printf($cost_id);
$n_cost = findPostById($cost_id);

$errors = array();
if(isset($_POST['submit'])){
    $new_cost = array();

    if(empty($_POST['name'])){
        $errors['name'] = "you must fill this field";
    }else{
        $new_cost['name'] = $_POST['name'];
    }

    if(empty($_POST['cost'])){
        $errors['cost'] = "you must fill this field";
    }else{
        $new_cost['cost'] = $_POST['cost'];
    }

    if(count($errors) == 0){
        if(updatePost($cost_id,$new_cost)){
            header("Location:index.php?months=" . $months);
        }else{
            $errors['save'] = "There has something wrong while updating this post.Please try again";
        }
    }
    
}

?>

<?php 
//include header file
include("./include/header.php");
?>
<!-- if the user did not loggedin-->
<?php if(!isset($_SESSION['loggedin'])): ?>

<div class="container-fluid p-0 m-0">
    <div class="font-abel logout-section p-0 m-0 text-center d-flex align-items-center justify-content-center" style="width: 100vw; height: 90vh;">
        <h1 class="text-dark"><span class="text-danger">Write</span> your daily notes<br>Please <a href="signup.php">signup</a> Sir...</h1>
    </div>
</div>

<?php endif; ?>
<!-- if the user did not loggedin -->

<!-- when the user loggedin -->
<?php if(isset($_SESSION['loggedin'])): ?>

<?php if(isset($errors['save'])): ?>
    <p><?php echo $errors['save']; ?></p>
<?php endif; ?>

<div class="container-fluid d-flex justify-content-center font-abel">
    <div class="col-md-6 edit-cost">
        <h5 class="font-weight-500 text-center py-5">Update List</h5>
        <!-- update form -->
        <form action="" method="POST" class="mb-5">
            <div class="form-group">
                <input type="text" name="name" id="search-form-control" value="<?php echo $n_cost['name']; ?>">
                    <?php if(isset($errors['name'])): ?>
                        <p class="text-danger"><?php echo $errors['name']; ?></p>
                    <?php endif; ?>
            </div>
            <div class="form-group">
            <input type="text" name="cost" id="search-form-control" value="<?php echo $n_cost['cost']; ?>">
                <?php if(isset($errors['cost'])): ?>
                    <p class="alert alert-danger"><?php echo $errors['cost']; ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group d-flex justify-content-center">
                <button name="submit" class="first-button">Submit</button>
            </div>
        </form>

        <!-- update form -->
    </div>
</div>
<?php endif; ?>

<!-- when the user loogedin -->

<?php
//include footer file
include("./include/footer.php");

?>