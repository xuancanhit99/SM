<?php
session_start();
error_reporting(0);
include 'includes/db_connection.php';
if (!isset($_SESSION["email"])) {
    header('location: ../index.php');
} else {
    if ((Boolean) $_SESSION["isStudent"]) {
        header('location: ../index.php');
    } else if ((Boolean) $_SESSION["isEditor"]) {
        header('location: ../index.php');
    } else {
        if (isset($_POST['update'])) {
            $classname = $_POST['classname'];
            $classnumber = $_POST['classnumber'];
            $classyear = $_POST['classyear'];
            $cid = intval($_GET['classid']);
            $sql = "update  classes set ClassName=:classname,ClassNumber=:classnumber,ClassYear=:classyear where id=:cid ";
            $query = $dbh->prepare($sql);
            $query->bindParam(':classname', $classname, PDO::PARAM_STR);
            $query->bindParam(':classnumber', $classnumber, PDO::PARAM_STR);
            $query->bindParam(':classyear', $classyear, PDO::PARAM_STR);
            $query->bindParam(':cid', $cid, PDO::PARAM_STR);
            $query->execute();
            $msg = "Data has been updated successfully";
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

        <title>SM Admin Update Class</title>
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
                                <h2 class="title">Update Student Class</h2>
                            </div>
                        </div>
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li><a href="#">Classes</a></li>
                                    <li class="active">Update Class</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h5>Update Student Class info</h5>
                                            </div>
                                        </div>
                                        <?php if ($msg) {?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                                            </div><?php } else if ($error) {?>
                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                            </div>
                                        <?php }?>
                                        <div class="panel-body">
                                        <form method="post">
                                            <?php
$cid = intval($_GET['classid']);
        $sql = "SELECT * from classes where id=:cid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':cid', $cid, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
            foreach ($results as $result) {?>
                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Class Name</label>
                                                        <div class="">
                                                            <input type="text" name="classname"
                                                                   value="<?php echo htmlentities($result->ClassName); ?>"
                                                                   required="required" class="form-control"
                                                                   id="success">
                                                            <span class="help-block">Eg- IKBO, IABO, INBO etc</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Class Number</label>
                                                        <div class="">
                                                            <input type="text" name="classnumber"
                                                                   value="<?php echo htmlentities($result->ClassNumber); ?>"
                                                                   required="required" class="form-control"
                                                                   id="success">
                                                            <span class="help-block">Eg- 01,02,04,05 etc</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Year</label>
                                                        <div class="">
                                                            <input type="text" name="classyear"
                                                                   value="<?php echo htmlentities($result->ClassYear); ?>"
                                                                   class="form-control" required="required"
                                                                   id="success">
                                                            <span class="help-block">Eg- 18,19,20,21 etc</span>
                                                        </div>
                                                    </div>
                                                <?php }
        }?>
                                            <div class="form-group has-success">
                                                <div class="">
                                                    <button type="submit" name="update"
                                                            class="btn btn-success btn-labeled">Update<span
                                                                class="btn-label btn-label-right"><i
                                                                    class="fa fa-check"></i></span></button>
                                                </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
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
<?php }
}?>
