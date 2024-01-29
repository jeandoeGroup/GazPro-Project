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
        <form action="" method="post" enctype="multipart/form-data" class="login">
            <h3 class="heading">Welcome! 😎</h3>
            <label for="phone">your phone <span>*</span></label>
            <input id="phone" type="text" placeholder="enter your phone" name="phone" required class="box">
            <label for="password">your password <span>*</span></label>
            <input id="password" type="password" placeholder="enter your password" name="password" required class="box">
            <p>no have an account <a href="./register.php" class="link">register</a></p>
            <input type="submit" name="login" value="login" class="btn">
        </form>
    </div>
</body>
</html>