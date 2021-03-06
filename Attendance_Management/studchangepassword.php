<?php
session_start();
$_SESSION['email']=$_SESSION['login_user'];
$name=$_SESSION['email'];
if(isset($_SESSION['login_user']))
{
}
else
{
  header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Bootstrap core CSS-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <title>Attendance Management</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <meta charset="utf-8">

  </head>

<body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="studentlogin.php">BMSCE</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
        <div><?php
          echo "<span style='color:#FFFFFF;text-align:center;'>".$name."</span>";
          ?></div>
          </li>
          </div>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="studentlogin.php"style="font-size:20px;">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
      
        <li class="nav-item ">
        
        <span><a class="nav-link" href="studchangepassword.php"><i class="material-icons"style="font-size:20px">&#xe869;</i> Change Password</a>
        </span>

        </li>
        <li class="nav-item ">
        <span><a class="nav-link" href="logout.php"><i class="material-icons"style="font-size:20px">&#xe8ac;</i> Logout</a></span>

        </li>
        
      </ul>

  <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="studentlogin.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Change Password</li>

          </ol>
   <form method="POST" action="changepassword.php">
    <table>
    
    <tr>
    <td>Enter your existing password:</td>
    <td><input type="password" size="10" name="password"></td>
    </tr>
    <tr>
    <td>Enter your new password:</td>
    <td><input type="password" size="10" name="newpassword"></td>
    </tr>
    <tr>
   <td>Re-enter your new password:</td>
   <td><input type="password" size="10" name="confirmnewpassword"></td>
    </tr>
    </table>
    <p><input type="submit" value="Update Password"></p>
    </form>
    <?php
      $con = mysqli_connect("localhost","root","","student");
      if(!$con)
      {
          die("Connection failed: " . mysqli_connect_error());
      } 
      else if(!isset($_POST['password']) & !isset($_POST['username'])& !isset($_POST['newpassword'])& !isset($_POST['confirmnewpassword']))
      {
        
      }
      else
      {
        $password=$_POST['password'];
        $sql = "SELECT password FROM logintab WHERE email='$name'";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result)>0)
        {
              // output data of each row
              while($row = mysqli_fetch_assoc($result))
              {
                $pass=$row["password"];
                if($pass == $password)
                {
                  if($_POST['newpassword']==$_POST['confirmnewpassword'])
                  {
                    $np=$_POST['newpassword'];
                    $que="UPDATE logintab SET password = '$np' WHERE email = '$name'";
                    $query=mysqli_query($con, $que) or die(mysqli_error($con));
                    if($query)
                    {
                      echo "<script type='text/javascript'>confirm('Congratulations You have successfully changed your password')</script>";
                      echo "<script type='text/javascript'>confirm('You Have To Login With New Password')</script>";
                      echo "<script type='text/javascript'>location.href='http://localhost/Attendance_Management/logout.php'</script>";
                    }
                   else
                    {
                       echo "<script type='text/javascript'>confirm('error while updating password')</script>";
                      echo "<script type='text/javascript'>location.href='http://localhost/Attendance_Management/studchangepassword.php'
                      </script>";
                    }
                  }
                  else
                  {
                     echo "<script type='text/javascript'>confirm('Passwords do not match')</script>";
                     echo "<script type='text/javascript'>location.href='http://localhost/Attendance_Management/studchangepassword.php'
                      </script>";
                  }
                }
                else
                {
                  echo "<script type='text/javascript'>confirm('Enter Correct password')</script>";
                  echo "<script type='text/javascript'>location.href='http://localhost/Attendance_Management/studchangepassword.php'
                      </script>";
                }
              }
           
        }





       
        
        }
      ?>
      </div>            
      </div>
      </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>

  </body>
</html>