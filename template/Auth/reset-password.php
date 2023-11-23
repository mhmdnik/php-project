<!DOCTYPE html>
<html lang="en">
<head>
    <title>reset password</title>
<?php require_once(BASE_PATH . '/template/Auth/layouts/head-tag.php')?>
</head>

<body>

<div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                <img src="<?= asset('public/auth/assets/images/img-01.png') ?>" alt="IMG">
                </div>
  
                <form method="POST" action="<?= url('reset-password-operation/' . $forgot_token) ?>" class="login100-form validate-form">
                    <span class="login100-form-title">
                        Reset Password
                    </span>
                    
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Send
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">
                            Forgot
                        </span>
                        <a class="txt2" href="#">
                            Username / Password?
                        </a>
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="#">
                            Login your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>




<?php require_once(BASE_PATH . '/template/Auth/layouts/scripts.php')?>

  

</body>

</html>