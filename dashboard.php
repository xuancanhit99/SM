<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
global $dbh;
if (strlen($_SESSION['alogin']) == 0) {
    header("Location: index.php");
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="University">
        <meta name="author" content="Xuan Canh">
        <title>Student Manager | Dashboard</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="css/main.css" media="screen">
        <script src="https://kit.fontawesome.com/e427de2876.js" crossorigin=""></script>
    </head>
    <body class="top-navbar-fixed">
    <div class="main-wrapper">
        <?php include('includes/topbar.php'); ?>
        <div class="content-wrapper">
            <div class="content-container">
                <?php include('includes/leftbar.php'); ?>
                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-sm-6">
                                <h2 class="title">Dashboard</h2>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat bg-primary" href="manage-students.php">
                                        <?php
                                        $sql1 = "SELECT StudentID from students ";
                                        $query1 = $dbh->prepare($sql1);
                                        $query1->execute();
                                        $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                        $totalstudents = $query1->rowCount();
                                        ?>
                                        <span class="number counter"><?php echo htmlentities($totalstudents); ?></span>
                                        <span class="name">Reg Users</span>
                                        <span class="bg-icon"><i class="fa fa-users"></i></span>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat bg-danger" href="manage-subjects.php">
                                        <?php
                                        $sql = "SELECT id from subjects";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $totalsubjects = $query->rowCount();
                                        ?>
                                        <span class="number counter"><?php echo htmlentities($totalsubjects); ?></span>
                                        <span class="name">Subjects Listed</span>
                                        <span class="bg-icon"><i class="fa fa-ticket"></i></span>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat bg-warning" href="manage-classes.php">
                                        <?php
                                        $sql2 = "SELECT id from classes ";
                                        $query2 = $dbh->prepare($sql2);
                                        $query2->execute();
                                        $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                        $totalclasses = $query2->rowCount();
                                        ?>
                                        <span class="number counter"><?php echo htmlentities($totalclasses); ?></span>
                                        <span class="name">Total classes listed</span>
                                        <span class="bg-icon"><i class="fa fa-bank"></i></span>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat bg-success" href="manage-results.php">
                                        <?php
                                        $sql3 = "SELECT distinct StudentID from  results ";
                                        $query3 = $dbh->prepare($sql3);
                                        $query3->execute();
                                        $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
                                        $totalresults = $query3->rowCount();
                                        ?>
                                        <span class="number counter"><?php echo htmlentities($totalresults); ?></span>
                                        <span class="name">Results Declared</span>
                                        <span class="bg-icon"><i class="fa fa-file-text"></i></span>
                                    </a>
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
            <?php include('includes/footer.php'); ?>
        </footer>
    </div>
    <style> .foot {
            text-align: center;
            */
        }</style>
    </html>
<?php } ?>
