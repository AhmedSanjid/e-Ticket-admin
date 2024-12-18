<?php
    session_start();
?>
<?php require_once('include/connection.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TICKET F0! | </title>

    <!-- Bootstrap -->
    <link href="<?= $baseurl ?>asset/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= $baseurl ?>asset/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= $baseurl ?>asset/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?= $baseurl ?>asset/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= $baseurl ?>asset/build/css/custom.min.css" rel="stylesheet">
  </head>


  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post">
              <a href=""></a>
              <h1>Login Form</h1>
              <div>
                <input type="text" name="username" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button name="login_button" class="btn btn-default submit" type="submit">Log in</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="asset/images/BUS.svg"></i>TICKET FO!</h1>
                  <p>©from 2020 we are successfully providing our e-ticket service. Ticket F0! is a Bootstrap 4 version</p>
                </div>
              </div>
            </form>
              <?php
                if(isset($_POST['login_button'])){
                    unset($_POST['login_button']);
                    $_POST['password']=sha1($_POST['password']);
                    $rs=$mysqli->common_select_single('auth','*',$_POST);
                    if($rs['data']){
                        $_SESSION['loggedin']="true";
                        $_SESSION['username']=$rs['data']->username;
                        $_SESSION['email']=$rs['data']->email;
                        header('location:index.php');
                    }else{
                        echo "Please check your user name and password again.";
                    }
                  }
              ?>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form method="post">
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" name="username" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" name="email" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" required="" />
              </div>
              <div>
              <button name="register_button" class="btn btn-default submit" type="submit">Submit</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> TICKET-FO!</h1>
                  <p>©from 2020 we are successfully providing our e-ticket service. Ticket F0! is a Bootstrap 4 version</p>
                </div>
              </div>
            </form>
            <?php
              if(isset($_POST['register_button'])){
                  $crud=new crud();
                  unset($_POST['register_button']);
                  $_POST['password']=sha1($_POST['password']);
                  $_POST['created_at']=date('Y-m-d H:i:s');
                  $rs=$crud->common_create('auth',$_POST);
                  print_r($_POST);
                  if($rs['data']){
                      header('location:login.php');
                  }else{
                      print_r($rs['error']);
                  }
                }
              ?>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
