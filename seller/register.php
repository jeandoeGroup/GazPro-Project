<?php

// include '../components/connect.php';

if(isset($_POST['register'])){
    $id = unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $profession = $_POST['profession'];
    $profession = filter_var($profession, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $phone = $_POST['phone'];
    $phone = filter_var($phone, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $vpass = $_POST['cpass'];
    $vpass = filter_var($vpass, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id().'.'.$ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder  = '../uploaded_files/'.$rename;

    $select_seller = $conn->prepare('SELECT * FROM `sellers` WHERE email = ?');
    $select_seller->execute([$email]);

    if($select_seller->rowCount() > 0){
        $message_box[] = 'email already taken!';
    }else{
        if($pass != $cpass){
            $message_box[] = 'incorrect confirm password!';
        }else{
            echo "salut 1";
            $insert_seller = $conn->prepare("INSERT INTO `sellers`(id, name, profession, email, password, image, vpass, status) VALUES(?,?,?,?,?,?,?,?)");
            echo "salut 1 ".$image_tmp_name.' ++ '.$image_folder.' +++ '.$rename;
            echo $id . ' +++ ' . $name . '+++  ' . $profession . ' +++ ' . $email . '+++  ' . $phone . '+++  ' . $cpass . ' +++ ' . $rename . '+++  ' . $vpass;
            $insert_seller->execute([$id, $name, $profession, $email, $phone, $cpass, $rename, $vpass]);
            echo "salut 2";
            move_uploaded_file($image_tmp_name, $image_folder);
            $message_box[] = 'register succesfull, please login!';
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GazPro</title>
    <!-- seller head -->
    <?php include '../components/seller_head.php' ?>
</head>
<body>
    <div class="form_container">
        <form action="" method="post" enctype="multipart/form-data" class="register">
            <h3 class="heading">Create Account! 😉</h3>
            <?php include('../components/message.php') ?>
            <div class="flex">
            <div class="col">
                <label for="name">your name <span>*</span></label>
                <input id="name" type="text" placeholder="enter your name" maxlength="50" name="name" required class="box">
                <label for="profession">your profession <span>*</span></label>
                <input id="profession" type="text" placeholder="enter your profession" maxlength="50" name="profession" required class="box">
                <label for="email">your e-mail <span>*</span></label>
                <input id="email" type="text" placeholder="enter your email" name="email" maxlength="50" required class="box">
            </div>
            <div class="col">
                <label for="phone">your phone <span>*</span></label>
                <input id="phone" type="number" placeholder="enter your phone" min="000000000" max="999999999" maxlength="9" name="phone" required class="box">
                <label for="password">your password <span>*</span></label>
                <input id="password" type="password" placeholder="enter your password" maxlength="20" name="pass" required class="box">
                <label for="cpass">confirm password <span>*</span></label>
                <input id="cpass" type="password" placeholder="confirm your password" maxlength="20" name="cpass" required class="box">
            </div>
            </div>
            <label for="image">your profile <span>*</span></label>
            <input id="image" type="file" accept="image/*" name="image" class="box">
            <p>have an account <a href="./login.php" class="link">login</a></p>
            <input type="submit" name="register" value="register" class="btn">
        </form>
    </div>
</body>
</html>