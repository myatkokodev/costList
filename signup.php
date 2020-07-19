<?php 

require("function.php");
$errors = array();

if(isset($_POST['submit'])){

    //validate  name
    $new_user = array();
    //save in session
    flash($_POST);
    if(empty($_POST['name']) || strlen($_POST['name']) < 3){
        $errors['name'] = "Name must be at least 3characters in length.";
    }else{
        $new_user['name'] = $_POST['name'];
    }

    //validate email address
    if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "please provide a valid email address!";
    }else{
        $new_user['email'] = $_POST['email'];
        if(checkEmail($_POST['email'])){
            $errors['email'] = "Email address already in use!";
        }
    }

    //validate password
    if(empty($_POST['password']) || strlen($_POST['password']) < 8){
        $errors['password'] = "Password must be at least 8 characters in length!";
    }else{
        $new_user['password'] = $_POST['password'];
    }

    //validate confirm password

    if($_POST['password'] != $_POST['confirm_password']){
        $errors['confirm_password'] = "Password do not match!";
    }else{
        $new_user['confirm_password'] = $_POST['confirm_password'];
    }


    //validate error
    if(count($errors) == 0){
        if(createUser($new_user)){
            header("Location:signin.php");
        }else{
            $errors['save'] = "Something went wrong.Please try again!";
        }
    }


}

?>





<?php  include("./include/header.php"); ?>
 
<div class="container mt-2 shadow loggedin-section" >
    <div class="loggedin-container col-md-5 col-12 shadow">
            <h3 class="text-center custom-font pt-5">Sign Up</h3>
            <form action="" method="POST" class="p-md-5 pt-3" style="opacity: 1;">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Enter Your Name" value="<?php echo old('name'); ?>">
                    <?php if(isset($errors['name'])): ?>
                        <p class="alert text-danger p-0 font-abel" style="font-size: 14px;"><?php echo $errors['name']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Enter Your Email" value="<?php echo old('email'); ?>">
                    <?php if(isset($errors['email'])): ?>
                        <p class="alert text-danger p-0 font-abel" style="font-size: 14px;"><?php echo $errors['email']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Enter Your Password" value="<?php echo old('password'); ?>">
                    <?php if(isset($errors['password'])): ?>
                        <p class="alert text-danger p-0 font-abel" style="font-size: 14px;"><?php echo $errors['password']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm password" value="<?php echo old('confirm_password'); ?>">
                    <?php if(isset($errors['confirm_password'])): ?>
                        <p class="alert text-danger p-0 font-abel" style="font-size: 14px;"><?php echo $errors['confirm_password']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-red form-control">Submit</button>
                </div>
            </form>
    </div>
</div>

<?php include("./include/footer.php"); ?>