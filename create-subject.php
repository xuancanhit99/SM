<?php
session_start();
error_reporting(0);
include 'includes/db_connection.php';
global $dbh;
if (!isset($_SESSION["email"])) {
    header('location: ../index.php');
} else {
    if ((Boolean) $_SESSION["isStudent"]) {
        header('location: ../index.php');
    } else if ((Boolean) $_SESSION["isEditor"]) {
        header('location: ../index.php');
    } else {
        if (isset($_POST['submit'])) {
            $subjectname = $_POST['subjectname'];
            $subjectcode = $_POST['subjectcode'];
            $sql = "Insert into  subjects(SubjectName,SubjectCode) values(:subjectname,:subjectcode)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':subjectname', $subjectname, PDO::PARAM_STR);
            $query->bindParam(':subjectcode', $subjectcode, PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
            if ($lastInsertId) {
                $msg = "Subject Created successfully";
            } else {
                $error = "Something went wrong. Please try again";
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
        <link rel="shortcut icon" href="../images/logo/mirea.ico">

        <title>SM Admin Subject Creation </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="css/main.css" media="screen">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;1,100;1,500;1,600&family=Rajdhani:wght@500&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/e427de2876.js" crossorigin=""></script>
    </head>
    <body class="top-navbar-fixed" style="font-family: 'Montserrat', sans-serif;">
    <div class="main-wrapper">
        <?php include 'includes/topbar.php';?>
        <div class="content-wrapper">
            <div class="content-container">
                <?php include 'includes/leftbar.php';?>
                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">Subject Creation</h2>
                            </div>
                        </div>
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li> Subjects</li>
                                    <li class="active">Create Subject</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h5>Create Subject</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <?php if ($msg) {?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>Well done! </strong><?php echo htmlentities($msg); ?>
                                            </div><?php } else if ($error) {?>
                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                            </div>
                                        <?php }?>
                                        <form class="form-horizontal" method="post">
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Subject Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="subjectname" class="form-control"
                                                           id="default" placeholder="Subject Name" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="default" class="col-sm-2 control-label">Subject Code</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="subjectcode" class="form-control"
                                                           id="default" placeholder="Subject Code" required="required">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" name="submit" class="btn btn-primary">Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/main.js"></script>
    </body>
    <div class="foot">
        <footer>
            <?php include 'includes/footer.php';?>
        </footer>
    </div>
    <style> .foot {
            text-align: center;
            */
        }</style>
    </html>
<?PHP }
}?>
