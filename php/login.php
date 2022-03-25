<?php
include "dbConnect.php";
include "modules.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <link rel="stylesheet" href="../styles/style.css">
  <title>Login | MyLiShop</title>
</head>

<body>
  <div class="container">
    <div class="login__form" action="" method="post">
      <div class="login__header">
        <h1>Trang đăng nhập</h1>
      </div>

      <div class="login__content">
        <form action="" method="post" id="login">
          <div class="login__colection">

            <div class="login__data">
              <label for="userName">Tên đăng nhập hoặc email: </label> <br>
              <input class="login__input" type="text" id="userName" name="userNameLogin" required>
            </div>
            <div class="login__data">
              <label for="password">Mật khẩu: </label> <br>
              <input class="login__input" type="password" id="password" name="passwordLogin" required >
            </div>
            <p>Bạn chưa có tài khoản? <a style="text-decoration: none" href="login.php?register=true">Đăng ký tài khoản
                mới</a></p>
            <div class="login__btn">
              <input class="btn" type="submit" name="submitLogin" value="Đăng nhập">
              <a style="text-decoration: none; " class="btn" href="../index.php">
                <ion-icon style="font-size: 25px;" name="return-down-back-outline"></ion-icon>
              </a>
            </div>

          </div>
        </form>

        <form action="" method="post" id="register" style="display: none;">
          <a style="text-decoration: none; font-size: 25px;" class="btn" href="login.php">
            <ion-icon name="return-down-back-outline"></ion-icon>
          </a>
          <div class="login__colection">
            <div class="login__data">
              <label for="fullName">Tên đầy đủ: </label> <br>
              <input class="login__input" type="text" id="fullName" name="fullName" required>
            </div>
            <div class="login__data">
              <label for="userName">Tên đăng nhập: </label> <br>
              <input class="login__input" type="text" id="userName" name="userName" required>
            </div>
            <div class="login__data">
              <label for="password">Mật khẩu: </label> <br>
              <input class="login__input" type="password" id="password" name="password" required>
            </div>
            <div class="login__data">
              <label for="email">Email: </label> <br>
              <input class="login__input" type="text" id="email" name="email" required>
            </div>
            <div class="login__btn">
              <input class="btn" type="submit" name="submitRegister" value="Đăng ký">
            </div>

          </div>
        </form>
        <?php
        if (isset($_GET["register"])) {
          echo '
          <script>
            const register = document.getElementById("register");
            const login = document.getElementById("login");
            login.style.display = "none";
            register.style.display = "block";
          </script>';
          if (isset($_POST["submitRegister"])) {
            $fullName = $_POST["fullName"];
            $userName = $_POST["userName"];
            $password = $_POST["password"];
            $email = $_POST["email"];

            $rows = SelectTable("username, email","users");
            for ($pos = 0; $pos < count($rows); $pos++) {
              if($rows[$pos]["username"] != $userName && $rows[$pos]["email"] != $email){
                Insert("users", "fullname, username, password, email", "'$fullName', '$userName', '$password', '$email'");
                $_SESSION["username"] = $userName;
                echo '<script>
                alert("Đăng ký thành công!");
                window.location = "login.php";
                </script>';
              }elseif($rows[$pos]["username"] == $userName ){
                echo '
                <script>
                alert("Tên đăng nhập đã tồn tại!");
                </script>
                ';
              }elseif($rows[$pos]["email"] == $email ){
                echo '
                <script>
                alert("Email đã tồn tại!");
                </script>
                ';
              }
            }
          }
        }
        if (isset($_POST["submitLogin"])) {
          $userArray = SelectTable("username, password, email", "users");
          $username = $_POST["userNameLogin"];
          $password = $_POST["passwordLogin"];
          for ($pos = 0; $pos < count($userArray); $pos++) {
            if ($username == $userArray[$pos]["username"] && $password == $userArray[$pos]["password"] || $username == $userArray[$pos]["email"] && $password == $userArray[$pos]["password"])
              echo '<script>
            alert("Đăng nhập thành công!");
            window.location = "../index.php";
            </script>';
          }
        }
        ?>

        <div class="login__image">
          <img src="../images/login_background.png" alt="">
        </div>

      </div>
      <div class="login__footer">

      </div>

    </div>
  </div>
</body>

</html>