<?php 

require("function.php");
if(isset($_POST['logout'])){
    //clear all section
    unset($_SESSION['loggedin']);
    //session_destroy();
    header("Location:signin.php");
}



?>