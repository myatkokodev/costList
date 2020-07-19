<?php 
    require("function.php");
    $months = isset($_GET['months']) ? $_GET['months'] : null;
    $errors = array();

    if($loggedInUser = isLoggedin()){
        $user = findUserById($loggedInUser['id']);
    }
    
    //pretty_print($user);

    if(isset($_POST['save'])){
        $new_info = array();

        if(empty($_POST['name'])){
            $errors['name'] = $_POST['name'];
        }else{
            $new_info['name'] = $_POST['name'];
        }

        if(isset($_POST['bio'])){
            $new_info['bio'] = $_POST['bio'];
        }

        $id = $_POST['edited_id'];

        if(count($errors) == 0){
            if(!empty($_FILES['photo']['name'])){
                $filename = time()."-".rand(111111,999999)."-".$_FILES['photo']['name'];
                move_uploaded_file($_FILES['photo']['tmp_name'],"uploads/users/".$filename);
                $new_info['photo'] = $filename;
            }
            if(updateInfo($id,$new_info)){
                header("Location:index.php?months=$months");
            }else{
                $errors['save'] = "Something went wrong while saving this post.Please try again!";
            }
        }
    }


?>

<?php include("./include/header.php"); ?>

<!-- if the user did not loggedin -->
<?php if(!isset($_SESSION['loggedin'])): ?>

<div class="container-fluid p-0 m-0">
    <div class="font-abel logout-section p-0 m-0 text-center d-flex align-items-center justify-content-center" style="width: 100vw; height: 90vh;">
        <h1 class="text-dark"><span class="text-danger">Write</span> your daily notes<br>Please <a href="signup.php">signup</a> Sir...</h1>
    </div>
</div>

<?php endif; ?>
<!-- if the user did not loggedin -->


<!-- when the user loogedin -->
<?php if(isset($_SESSION['loggedin'])): ?>
<div class="container-fluid" style="background: #e9ecef;height: 100vh;">
    <div class="d-flex justify-content-center">
        <div class="col-md-4 mt-5 custom-font">
            <form action="" method="POST" enctype="multipart/form-data">

                <div class="d-flex justify-content-center cursor-pointer">
                    <div class="d-flex justify-content-center" style="overflow: hidden; width: 200px;height: 200px;">
                        <img src="./uploads/users/<?php echo $user['photo'] ?? "user1.png"; ?>" alt="user1" class="img-border rounded-circle" style="width: 100%;" id="upload_profile">
                    </div>
                    <input type="file" id="profile_uploader" name="photo" class="d-none">
                </div>
                <input type="hidden" name="edited_id" value="<?php echo $user['id']; ?>">
                <div class="form-group mt-3">
                    <label class="pl-4 text-muted">Name:</label>
                    <input type="text" name="name"  id="search-form-control" value="<?php echo $user['name']; ?>">
                    <?php if(isset($errors['photo'])): ?>
                        <p class="text-danger"><?php echo $errors['photo']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group mt-3">
                    <label class="pl-4 text-muted">Email:</label>
                    <input type="text" name="email"  id="search-form-control" value="<?php echo $user['email'];?>" readonly/>
                </div>
                <div class="form-group mt-3">
                    <label class="pl-4 text-muted">BIOGRAPHY:</label>
                    <textarea name="bio"  id="search-form-control"><?php echo $user['bio'] ?? ""; ?></textarea>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <button name="save" type="submit" class="first-button badge-pill shadow my-3">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<!-- when the user loggedin -->

<?php include("./include/footer.php"); ?>

<script>

    var imgEl = $("#upload_profile");
    var fileEl = $("#profile_uploader");
    //handle onclick event on image
    imgEl.on("click",function(event){
        fileEl.trigger("click");
    });

    //handle on file change
    fileEl.on("change",function(event){
        readURL(this);
    });

    function readURL(input){
        //check if any file is chosen
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                imgEl.attr('src',e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>