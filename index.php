<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
global $dbh;
if (isset($_POST['login'])) {
    $uname = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "Select UserName and Password from admin where UserName=:uname and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $_SESSION['alogin'] = $_POST['username'];
        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    } else {
        $msg = "Invalid Details.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="University">
    <meta name="author" content="Xuan Canh">
    <title>Student Management</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="css/main.css" media="screen">
    <script src="https://kit.fontawesome.com/e427de2876.js" crossorigin=""></script>
</head>
<body class="">
<div class="main-wrapper">
    <div class="">
        <div class="row">
            <h1 align="center">Student Management</h1>
            <div class="col-lg-6 ">
                <section class="section">
                    <div class="row mt-40">
                        <div class="col-md-10 col-md-offset-1 pt-50">
                            <div class="row mt-30 ">
                                <div class="col-md-11">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div class="panel-title text-center">
                                                <h4>For Students</h4>
                                            </div>
                                        </div>
                                        <div class="panel-body p-20">
                                            <form class="form-horizontal" method="post">
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-6 control-label">Search your
                                                        result</label>
                                                    <div class="col-sm-6">
                                                        <a href="find-result.php">click here</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-lg-6">
                <section class="section">
                    <div class="row mt-40">
                        <div class="col-md-10 col-md-offset-1 pt-50">
                            <div class="row mt-30 ">
                                <div class="col-md-11">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div class="panel-title text-center">
                                                <h4>Admin Login</h4>
                                            </div>
                                        </div>
                                        <div class="panel-body p-20">
                                            <p style="font-size:16px; color:#ff0000" align="center"> <?php if ($msg) {
                                                    echo $msg;
                                                } ?>
                                            </p>
                                            <form class="form-horizontal" method="post">
                                                <div class="form-group">
                                                    <label for="inputEmail3"
                                                           class="col-sm-2 control-label">Username</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="username" class="form-control"
                                                               id="inputEmail3" placeholder="UserName">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3"
                                                           class="col-sm-2 control-label">Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" name="password" class="form-control"
                                                               id="inputPassword3" placeholder="Password">
                                                    </div>
                                                </div>
                                                <div class="form-group mt-20">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" name="login"
                                                                class="btn btn-success btn-labeled pull-right">Sign
                                                            in<span class="btn-label btn-label-right"><i
                                                                        class="fa fa-check"></i></span></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <p class="text-muted text-center"><small>Copyright © 2021 T-11 IKBO-07-19  </a></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
</body>
</html>



