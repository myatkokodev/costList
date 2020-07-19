<?php 

require("function.php");
$errors = array();

if(isset($_POST['submit'])){

    //validate  name
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "please , provide a valid email address!";
    }

    if(empty($password)){
        $errors['password'] = "Password must not be empty!";
    }

    if(count($errors) == 0){
        if(checkLogin($email,$password)){
            header("Location:index.php");
        }else{
            $errors['login'] = "Email and password do not match!";
        }
    }

    
}

?>





<?php  include("./include/header.php"); ?>
 
<div class="container mt-2 shadow loggedin-section" >
    <div class="loggedin-container col-md-5 col-12 shadow">
            <h3 class="text-center custom-font pt-5">Sign In</h3>
            <form action="" method="POST" class="p-md-5 pt-3">
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
                    <button type="submit" name="submit" class="btn btn-red form-control">Submit</button>
                </div>
                <?php if(isset($errors['login'])): ?>
                    <p class="alert text-danger p-0"><?php echo $errors['login']; ?></p>
                <?php endif; ?>
            </form>
    </div>
</div>

<?php include("./include/footer.php"); ?>