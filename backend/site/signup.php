


<style>

    .asSubmitSignup, .login_button{
        background-color: #311B92 !important;
        color: white;
        min-width: 350px;
        display: block;
        margin: 0 auto;
        width: 350px;
        border-radius: 0;
        letter-spacing: 1px;
        font-family: monospace;
        font-size: 19px;
        transition: 0.3s all ease-in;
        padding: 6px;
        border: none;
    }
    .asSubmitSignup:hover, .login_button:hover{
        background-color: #673AB7 !important;
        color: white;
        text-decoration: none;
    }
</style>


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
                        <h3><strong>Registration</strong></h3>
                        <img class="usericon" src="assets/image/user.png">
                    </div>
                    <div class="input">
                        <form action="user_module/user_add_process.php" method="post" class="">
                            <div class="form-group">
                                <input type="text" id="name)" class="form-control" name="name" placeholder="Full Name">
                            </div>
                            <div class="form-group">
                            <input type="number" id="id" class="form-control" name="id" placeholder="Institutional ID">
                            </div>

                            <div class="form-group">
                            <input type="text" id="intake" name="intake" class="form-control" placeholder="Intake">
                            </div>
                            <div class="form-group">

                            <input type="number" id="section" name="section" class="form-control" placeholder="Section">
                            </div>
                            <div class="form-group">
                            <input type="email" id="email" class="form-control" name="email" placeholder="Email">
                            </div>

                            <div class="form-group">
                            <select class="wide form-control " id="program" name="program">
                                <option class="option" data-display="Select Program" value="0">--Select Program--
                                </option>
                                <option class="option" value="BBA">BBA</option>
                                <option class="option" value="B.Sc in CSIT">B.Sc in CSIT</option>
                                <option class="option" value="B.Sc in CSE">B.Sc in CSE</option>
                                <option class="option" value="B.Sc in Textile">B.Sc in Textile</option>
                                <option class="option" value="B. Architechture (B.Arch.)">B. Architechture (B.Arch.)</option>
                                <option class="option" value="BA (Hons.) in English">BA (Hons.) in English  </option>
                                <option class="option" value="B.Sc. (Hons.) in Economics">B.Sc. (Hons.) in Economics</option>
                                <option class="option" value="LL.B (Hons.)">LL.B (Hons.)</option>


                            </select>
                            </div>

                            <div class="form-group">
                            <input type="tel" id="phone" class="form-control" name="phone" placeholder="Mobile Number">
                            </div>
                            <div class="form-group">

                            <input type="tel" id="password" class="form-control" name="password" placeholder="Password">
                            </div>

                            <div class="form-group">
                            <input type="tel" id="confirm_p" class="form-control" name="cp_password" placeholder="Confirm Password">
                            </div>
                            <div class="form-group">
                            <input type="submit" id="submit" class=" asSubmitSignup" name="submit">
                            </div>
                            <a href="index.php" class="login_button" style="display: block;text-align: center;">Login</a>
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