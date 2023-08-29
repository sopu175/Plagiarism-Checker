








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
                        <h3><strong>Forget Password ?</strong></h3>
                       
                    </div>
                    <div class="input">
                        <form action="./backend/forget_password/send_link.php" method="POST">
                            <div class="form-group">

                                <input type="email" size="40" id="user_email" onchange="check()" required placeholder="Email" class="form-control" name="email">
                             
                            </div>
                      
                            <div class="form-group">
                                <button type="submit" class="btn btn-block" id="button" name="submit_email">
                                    <strong>Submit Email</strong>
                                </button>
                           

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





