<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
global $dbh, $error;
if (strlen($_SESSION['alogin']) == 0) {
    header("Location: index.php");
} else {
    if (isset($_POST['Update'])) {
        $sid = intval($_GET['subjectid']);
        $subjectname = $_POST['subjectname'];
        $subjectcode = $_POST['subjectcode'];
        $sql = "update subjects set SubjectName=:subjectname,SubjectCode=:subjectcode where id=:sid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':subjectname', $subjectname, PDO::PARAM_STR);
        $query->bindParam(':subjectcode', $subjectcode, PDO::PARAM_STR);
        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Subject Info updated successfully";
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
        <title>SM Admin Update Subject </title>
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
                            <div class="col-md-6">
                                <h2 class="title">Update Subject</h2>
                            </div>
                        </div>
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li> Subjects</li>
                                    <li class="active">Update Subject</li>
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
                                            <h5>Update Subject</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <?php if ($msg) { ?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                                            </div><?php } else if ($error) { ?>
                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                            </div>
                                        <?php } ?>
                                        <form class="form-horizontal" method="post">
                                            <?php
                                            $sid = intval($_GET['subjectid']);
                                            $sql = "SELECT * from subjects where id=:sid";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) { ?>
                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Subject
                                                            Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="subjectname"
                                                                   value="<?php echo htmlentities($result->SubjectName); ?>"
                                                                   class="form-control" id="default"
                                                                   placeholder="Subject Name" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Subject
                                                            Code</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="subjectcode" class="form-control"
                                                                   value="<?php echo htmlentities($result->SubjectCode); ?>"
                                                                   id="default" placeholder="Subject Code"
                                                                   required="required">
                                                        </div>
                                                    </div>
                                                <?php }
                                            } ?>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" name="Update" class="btn btn-primary">Update
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
            <?php include('includes/footer.php'); ?>
        </footer>
    </div>
    <style> .foot {
            text-align: center;
            */
        }</style>
    </html>
<?PHP } ?>
