<?php

include("function.php");

//echo date('F');

$search = isset($_GET['search']) ? $_GET['search'] : null;

$months = isset($_GET['months']) ? $_GET['months'] : date('F');
//changing months to numbers
$get_month = getMonthNumberById($months);

$user_id = null;

if($loggedInUser = isLoggedin()){
    $user = findUserById($loggedInUser['id']);
    $user_id = $loggedInUser['id'];
}




if($search != null){
    flash(['search' => $search]);
}

if($months != null){
    flash(['months' => $months]);
}



$cost_list = getPostByMonth($get_month,$user_id,$search);


$id = isset($_GET['id']) ? $_GET['id'] : null;

if($id){
    if(deletePost($id)){
        header("Location: index.php?months=" . $months);
        //printf($months);
    }else{
        header("Location: index.php?delete-success=false");
    }
}



?>



<?php 

//include header.php file
include('./include/header.php');

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


<!-- when the user loogedin -->
<?php if(isset($_SESSION['loggedin'])): ?>
    <!--start main-->
    <main class="main-section">
       <div class="d-flex flex-row justify-content-around navbar-margin">


            <nav class="col-md-4 col-lg-3 d-md-block sidebar collapse shadow" id="sidebarMenu">

                <div class="sidebar-sticky font-abel">
                    <!-- user profile -->
                    <div class="user-profile pt-3">
                        <div class="d-flex justify-content-center col-md-12">
                            <div class="user-img img-border">
                                <img src="./uploads/users/<?php echo $user['photo'] ?? 'user1.png'; ?>" alt="user1" class="img-fluid">
                            </div>
                        </div>

                        <div class="user-name text-center custom-font font-weight-500">
                            <a href="#"><?php echo $user['name'] ?? 'unknown'; ?></a>
                            <span class="text-muted"><?php echo $user['bio'] ?? ''; ?></span>
                        </div>

                        

                        <div class="logout-button d-flex justify-content-around mt-3">
                            <a href="./account.php?months=<?php echo $months; ?>" class='btn btn-dark btn-sm badge-pill'>Edit profile <img src="./assets/img/local-icon/edit-profile.ico" alt="edit" style="width:15px;"></a>
                            <form action="logout.php" method="POST">
                                <button onclick="return confirm('Are you sure to logout?');" name="logout" class='btn btn-danger btn-sm badge-pill'>Logout <img src="./assets/img/local-icon/logout.ico" alt="logout" style="width: 20px;"></button>
                            </form>
                        </div>

                        
                    </div>

                    <!-- user profile -->


                    <!-- search form -->

                    <form action="" method="GET" class="pt-md-5 pt-5 pb-5">
                        <input type="search"  id="search-form-control" placeholder="Search by name" name="search" value="<?php echo old('search'); ?>">
                        <select name="months" class="my-3" id="option-form-control">
                            <option value="">Filter By Months</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="Aprial">Aprial</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="Novenber">November</option>
                            <option value="December">December</option>
                        </select>
                        <div class="form-group d-flex justify-content-center">
                            <button type="submit" class="btn btn-dark badge-pill px-5 my-3">Search</button>
                        </div>
                    </form>

                <!-- search form -->
                </div>

            </nav>

       

            <!-- cost item list -->

            <div class="col-md-8 col-lg-9 d-flex flex-column justify-content-left d-md-block">
                <h4 class="font-abel mt-3 font-weight-300 custom-font"><?php echo $months ?? "Choose Months From Filter"; ?><img src="./assets/img/local-icon/calender.png" alt="calender" style="width:20px; margin-left: 5px;"/></h4>
                <hr>
                <?php if(count($cost_list) == 0): ?>
                    <p class="alert alert-warning">There has no item to show!</p>
                <?php endif; ?>
                <table class="table font-roboto">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Cost</th>
                    </tr>

                    <?php 
                        $i = 1;
                        $sum = 0;
                    ?>

                    <?php foreach($cost_list as $cost): ?>
                    <tr id="table-data">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $cost['name']; ?></td>
                        <td><?php echo $cost['cost']; ?> kyats</td>
                        <td>
                            <a href="?id=<?php echo $cost['id']; ?>&months=<?php echo $months; ?>" class="btn-sm" title="delete" onclick="return confirm('Are you sure to delete this post?');"><img src="./assets/img/local-icon/delete.png" alt="del" style="width: 18px;"></a>
                            <a href="edit.php?id=<?php echo $cost['id']; ?>&months=<?php echo $months; ?>" class="btn-sm" title="edit"><img src="./assets/img/local-icon/edit.png" alt="edit" style="width: 18px;"></a>
                        </td>
                    </tr>
                    
                    <?php 
                        $i++;
                        $sum += $cost['cost'];
                    ?>
                    <?php endforeach; ?>
                    <tr class="bg-dark text-light">
                        <td colspan="1"></td>
                        <td colspan="1" style="color: #fb0101; font-weight: 800;">Total</td>
                        <td colspan="3"><?php echo $sum; ?> kyats</td>
                    </tr>
                </table>


            </div>

            <!-- cost item list -->
       </div>
    </main>
    <!--end main-->

<?php endif; ?>

<!-- when the user loggedin -->



<?php  
//include footer.php file
include("./include/footer.php");
?>