<?php

session_start();
//pretty print function
function pretty_print($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
//save into section for form data (temporary)
function flash($array){
    $_SESSION['formdata'] = $array;
}
//output form value stored in secction (just one time)
function old($key){
    $value = isset($_SESSION['formdata'][$key]) ? $_SESSION['formdata'][$key] : null;
    if($value){
        unset($_SESSION['formdata'][$key]);
    }

    return $value;
}


$dbname = "student_cost";
$servername = "localhost";
$username = "phpdev";
$password = "123456";

try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);//where the connection 
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
die("Connection failed: " . $e->getMessage());
}

//changing months to number
function getMonthNumberById($name){
    switch($name){
        case "January":
            return 1;
        break;
        case "February":
            return 2;
        break;
        case "March":
            return 3;
        break;
        case "Aprial":
            return 4;
        break;
        case "May":
            return 5;
        break;
        case "June":
            return 6;
        break;
        case "July":
            return 7;
        break;
        case "August":
            return 8;
        break;
        case "September":
            return 9;
        break;
        case "October":
            return 10;
        break;
        case "November":
            return 11;
        break;
        case "December":
            return 12;
        break;

        default:
        return 1;
        break;
    }
}

//get post by month

function getPostByMonth($month,$user_id,$search){
    global $conn;
    //$query = "SELECT * FROM `cost` WHERE MONTH(`created_at`) = :month AND `user_id` = :user_id";
    $query = "SELECT * FROM `cost` ";
    if($search){
        $query.=" WHERE `name` LIKE :search ";
    }
    if($month){
        $query.= $search ? " AND " : " WHERE ";
        $query.=" MONTH(`created_at`) = :month ";
    }

    $query .= " AND `user_id` = :user_id ORDER BY `created_at` DESC";
    $stmt = $conn->prepare($query);
    if($search){
        $search = "%".$search."%";
        $stmt->bindParam(":search", $search);
    }
    if($month){
        $stmt->bindParam(":month",$month);
    }
    //$stmt->bindParam(":month",$month);
    $stmt->bindParam(":user_id",$user_id);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}

//insert post into cost table

function insertCost($new_cost){
    global $conn;
    $query = "INSERT INTO `cost`(`name`, `cost` , `user_id`) VALUES (:name,:cost,:user_id)";
    $stmt = $conn->prepare($query);
    
    $stmt->bindParam(":name",$new_cost['name']);
    $stmt->bindParam(":cost",$new_cost['cost']);
    $stmt->bindParam(":user_id",$new_cost['user_id']);

    return $stmt->execute();
}

//insertPost(['name'=>'potato','cost'=>'1500']);

//delete post from cost table

function deletePost($id){
    global $conn;
    $query = "DELETE FROM `cost` WHERE `id` = :id";
    $stmt = $conn->prepare($query);

    $stmt->bindParam(":id",$id);
    return $stmt->execute();
}


//find post by ID

function findPostById($id){
    global $conn;
    $query = "SELECT * FROM `cost` WHERE `id` = :id";
    $stmt = $conn->prepare($query);

    $stmt->bindParam(":id",$id);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetch();
}
//pretty_print(findPostById(36));

//update post from cost table

function updatePost($id,$update_post){
    global $conn;
    $query = "UPDATE `cost` SET `name`= :name,`cost`= :cost WHERE `id` = :id";
    $stmt = $conn->prepare($query);
    
    $stmt->bindParam(":name",$update_post['name']);
    $stmt->bindParam(":cost",$update_post['cost']);
    $stmt->bindParam(":id",$id);

    return $stmt->execute();
}

//updatePost(36,['name'=>'mkk','cost'=>40000]);


//create new user

function createUser($new_user){
    global $conn;
    $query = "INSERT INTO `users`(`name`, `email`, `password`) VALUES (:name ,:email ,:password)";
    $stmt = $conn->prepare($query);

    $stmt->bindParam(":name",$new_user['name']);
    $stmt->bindValue(":email",$new_user['email']);
    //hide password
    $password = password_hash($new_user['password'] , PASSWORD_DEFAULT);
    $stmt->bindParam(":password",$password);

    return $stmt->execute();
}

//createUser(["name"=>"Myat Ko Ko","email"=>"myatkoko.programmer@gmail.com","password"=>"myatkoko"]);


//check email
function checkEmail($email){
    global $conn;
    $query = "SELECT * FROM `users` WHERE `email` = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":email",$email);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $user = $stmt->fetch();
    return $user ? true : false;
}

//check login
function checkLogin($email,$password){
    global $conn;
    $query = "SELECT * FROM `users` WHERE `email` = :email";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(":email",$email);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $user = $stmt->fetch();
    if(!$user){
        return false;
    }
    //check password
    if(password_verify($password,$user['password'])){
        //save in the login session state
        $_SESSION['loggedin'] = $user;
        return true;
    }else{
        return false;
    }

}


//find user by id
function findUserById($id){
    global $conn;
    $query = "SELECT * FROM `users` WHERE `id` = :id";
    $stmt = $conn->prepare($query);

    $stmt->bindParam(":id",$id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetch();
}

//print_r(findUserById(2));


//update user info
function updateInfo($id,$new_info){
    global $conn;
    $query = "UPDATE `users` SET `name`=:name ,`bio`= :bio";
    if(!empty($new_info['photo'])){
        $query .= " ,`photo` = :photo";
    }
    $query .= " WHERE `id` = :id";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(":name",$new_info['name']);
    $stmt->bindParam(":bio",$new_info['bio']);
    $stmt->bindParam(":id",$id);
    if(!empty($new_info['photo'])){
        $stmt->bindParam(":photo",$new_info['photo']);
    }
    return $stmt->execute();
}

//is loggedin
function isLoggedin(){
    return isset($_SESSION['loggedin'])?$_SESSION['loggedin']:false;
}


//sum cost
function sumCost($arr){
    
    if(isset($arr)){
        $sum = 0;
        foreach($arr as $item){
            $sum += floatval($item[0]);
        }
        return sprintf('%.2f',$sum);
    }

}
// $cost = [100,200,300];
//printf(count($cost));
// printf(sumCost($cost));