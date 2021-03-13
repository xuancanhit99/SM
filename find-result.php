<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
global $dbh
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
    <div class="login-bg-color bg-black-300">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel login-box">
                    <div class="panel-heading">
                        <div class="panel-title text-center">
                            <h4>Student Result</h4>
                        </div>
                    </div>
                    <div class="panel-body p-20">
                        <form action="result.php" method="post">
                            <div class="form-group">
                                <label for="studentno">Student ID</label>
                                <input type="text" class="form-control" id="studentno"
                                       placeholder="Enter Your Student ID"
                                       autocomplete="off" name="studentno">
                            </div>
                            <div class="form-group">
                                <label for="default" class="col-sm-2 control-label">Class</label>
                                <select name="class" class="form-control" id="default" required="required">
                                    <option value="">Select Class</option>
                                    <?php
                                    $sql = "Select * from classes";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>
                                            <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->ClassName); ?>
                                                &nbsp;<?php echo htmlentities($result->ClassNumber); ?>
                                                -<?php echo htmlentities($result->ClassYear); ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group mt-20">
                                <div class="">
                                    <button type="submit" class="btn btn-success btn-labeled pull-right">Search<span
                                                class="btn-label btn-label-right"><i class="fa fa-check"></i></span>
                                    </button>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <a href="index.php">Back to Home</a>
                            </div>
                        </form>
                        <hr>
                    </div>
                </div>
                <p class="text-muted text-center"><small>Copyright © 2021 T-11 IKBO-07-19</small></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
