<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
<script>
    function validation(){
        var staffid = document.forms["RegForm"]["staffid"];
        var email = document.forms["RegForm"]["email"];
        var username = document.forms["RegForm"]["username"];
        var password = document.forms["RegForm"]["password"];

        if(staffid.value==""){
            window.alert("Please enter a staff ID");
            staffid.focus();
            return false;
        }

        if(email ==""){
            window.alert("Please enter your email");
            email.focus();
            return false;
        }

        if(username==""){
            window.alert("Please enter your username");
            username.focus();
            return false;
        }

        if(password==""){
            window.alert("Please enter a password");
            password.focus();
            return false;
        }
        return true;
    }
    </script>
    <title>KINDERCARE</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <style>
        .bg-login-image{
            padding-bottom: 20px;
            background:url("img/logo2.png");
            background-position: center;
            background-size:500px 550px;
            background-repeat: no-repeat;
        }
    </style>

</head>

<body class="bg-gradient-info">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->           
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h3 class="text-success mb-4">
                                        KINDERCARE <br> E-LEARNING SYSTEM</h3>
                                        <P class="text-primary" style ="font-size:20px;">Sign up to continue</P>
                                        <p id = 'demo2' class = 'text-danger'></p>
                                        <p id = 'demo1' class = 'text-success'></p>
                                    </div>
                                    <p id='warning'></p>
                                    <form name="RegForm" action="signup.php" onsubmit="return validation()" method="post">
                                    <div class="form-group">
                                            <input type="text" name="staffid" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="STAFF ID">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Enter E-mail Address">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        
                                        <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="SIGN UP">
                                         <p>Already have an account login? <a href="login.php">Login</a></p>
                                        <hr>
                                   
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>
</html>
<?php
if (isset($_POST['submit'])) {
    ob_start();
    include "config.php"; 
  // receive all input values from the form
  $staffId = mysqli_real_escape_string($conn, $_POST['staffid']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $pass = mysqli_real_escape_string($conn, $_POST['password']);

  $errors = array();
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $signup_query = "SELECT * FROM teachersdetail WHERE  staffId='$staffId' OR email='$email' LIMIT 1";
  $result = mysqli_query($conn, $signup_query);
  $teacher = mysqli_fetch_assoc($result);
  
  if ($teacher) { 
    if ($teacher['staffId'] === $staffId) {
        array_push($errors, "staff Id already exists");
      }

    if ($teacher['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  if (count($errors) === 0) {
  	$query = "INSERT INTO teachersdetail (staffId, email, username, passcode) VALUES('$staffId', '$email','$username', '$pass')";
      mysqli_query($conn, $query);
      echo "
      <script>
        document.getElementById('demo1').innerHTML = 'SIGN UP SUCCESSFUL, CLICK TO LOGIN';
      </script>
      ";
  }
  else{
    echo "
      <script>
        document.getElementById('demo2').innerHTML = 'SIGN UP FAILED, STAFF ID OR EMAIL ALREADY EXISTS';
      </script>
      ";
  }
}
?> 