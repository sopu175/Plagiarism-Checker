<?php


include "db/dbconfig.php";
$user_wrong = false;
$user_message = "";
$user_message_password = "";
$pass_wrong = false;
$both = false;
if (isset($_POST['submit'])) {


    $username = $_POST['id'];
    $pass = $_POST['password'];
    if ((empty($username)) && (!empty($pass))) {
        $user_wrong = true;
        $user_message = "Please enter your ID";
    }
    else if ((empty($pass)) && (!empty($username))) {
        $pass_wrong = true;
        $user_message_password = "Please enter your password";
    }
    else if (empty($username) && empty($pass)) {
        $user_wrong = true;
        $user_message = "Please enter your ID";
        $pass_wrong = true;
        $user_message_password = "Please enter your password";
    }
    else {

        $for_user = "SELECT * FROM user where id='" . $username . "' and password='" . $pass . "'";
        $for_admin = "SELECT * FROM admin where username='" . $username . "' and password='" . $pass . "'";

        $for_userResult = str_replace("\'", "", $for_user);
        $for_admin = str_replace("\'", "", $for_admin);

        $user_Result = mysqli_query($con, $for_userResult);
        $admin_Resul = mysqli_query($con, $for_admin);

        $admin_row = mysqli_num_rows($admin_Resul);
        $User_row = mysqli_num_rows($user_Result);
       if
        ($admin_row == 1)
        {
        session_start();
        $_SESSION['id'] = $username;
        $_SESSION['password'] = $pass;
        header('Location:dashboard.php');

    }
        if ($User_row == 1) {
            session_start();
            $_SESSION['id'] = $username;
            $_SESSION['password'] = $pass;
            header('Location:profile.php');

        } else {
            $both = true;
        }

    }


    mysqli_close($con);
}


?>
<div id="loading">
    <img id="loading-image" src="assets/image/ajaxloader.gif" alt="Loading..."/>
</div>


<!-- Box Section Start -->
<section class="login_body">
    <div class="container-fluid login_body_wrapper">
        <div class="row">
            <!-- BUBT info Start -->
            <div class="col-md-6 login_body_wrapper_right" style="background: url('assets/image/login.jpg')">
            </div>
            <!-- BUBT info end -->

            <!-- login info Start -->
            <div class="col-md-6 login_body_wrapper_left">
                <div class="login">
                    <div class="login_title">
                        <h3><strong>Account Login</strong></h3>
                        <img class="usericon" src="assets/image/user.png">
                    </div>
                    <div class="input">
                        <form action="index.php" method="POST">
                            <div class="form-group">

                                <input type="text" size="40" id="user_id" onchange="check()" required placeholder="Enter your ID" class="form-control" name="id">
                                <p class='wrong_message' id="wronguser">  </p>
                            </div>
                            <div class="form-group">

                                <input type="password" id="password" size="40" onchange="check()" required placeholder="Password" class="form-control"
                                       name="password">
                                <p class='wrong_message' id="wrongpassword">  </p>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block" id="button" name="submit">
                                    <strong>LOGIN</strong>
                                </button>
                                <div class="forget_text">
                                    <p class=""><span class="buttontext"><a href="forgot_password.php" target="blank">Forget Password ?</a></span>
                                        <span class="signuptext">Don't have an account?&nbsp<a href="sign-up.php">Sign up</a></span>
                                    </p>

                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- login info Start -->
        </div>
    </div>
</section>
<!-- Box Section End -->

<script>
        function check() {
                var user = document.getElementById('user_id');
                var pass = document.getElementById('password');

                if()
        }
</script>