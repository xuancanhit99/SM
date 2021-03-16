<?php
session_start();
error_reporting(0);
include('includes/db_connection.php');
global $dbh, $msg, $error;
if (strlen($_SESSION['alogin']) == 0) {
    header("Location: index.php");
} else {
    if (isset($_GET['acid'])) {
        $acid = intval($_GET['acid']);
        $status = 1;
        $sql = "update subjectcombination set status=:status where id=:acid ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':acid', $acid, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $msg = "Subject Activate successfully";
    }

    if (isset($_GET['sjcid'])) {
        $sjcid = intval($_GET['sjcid']);
        $sql = "delete from subjectcombination where id=:sjcid ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':sjcid', $sjcid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Subject Combination has been deleted";
    }

    if (isset($_GET['did'])) {
        $did = intval($_GET['did']);
        $status = 0;
        $sql = "update subjectcombination set status=:status where id=:did ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':did', $did, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $msg = "Subject Deactivate successfully";
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
        <title>SM Admin Manage Subjects Combination</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
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
                                <h2 class="title">Manage Subjects Combination</h2>
                            </div>
                        </div>
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li> Subjects</li>
                                    <li class="active">Manage Subjects Combination</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h5>View Subjects Combination Info</h5>
                                            </div>
                                        </div>
                                        <?php if ($msg) { ?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                                            </div><?php } else if ($error) { ?>
                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                            </div>
                                        <?php } ?>
                                        <div class="panel-body p-20">

                                            <table id="example" class="display table table-striped table-bordered"
                                                   cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Class Info</th>
                                                    <th>Subject</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Class Info</th>
                                                    <th>Subject</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>
                                                <?php $sql = "SELECT classes.ClassName,classes.ClassNumber,classes.ClassYear,subjects.SubjectName,subjectcombination.id as scid,subjectcombination.status from subjectcombination join classes on classes.id=subjectcombination.ClassID  join subjects on subjects.id=subjectcombination.SubjectID";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) { ?>
                                                        <tr>
                                                            <td><?php echo htmlentities($cnt); ?></td>
                                                            <td><?php echo htmlentities($result->ClassName); ?>
                                                                -<?php echo htmlentities($result->ClassNumber); ?>
                                                                -<?php echo htmlentities($result->ClassYear); ?></td>
                                                            <td><?php echo htmlentities($result->SubjectName); ?></td>
                                                            <td><?php $stts = $result->status;
                                                                if ($stts == '0') {
                                                                    echo htmlentities('Inactive');
                                                                } else {
                                                                    echo htmlentities('Active');
                                                                }
                                                                ?></td>
                                                            <td>
                                                                <?php if ($stts == '0') { ?>
                                                                <a href="manage-subjectcombination.php?acid=<?php echo htmlentities($result->scid); ?>"
                                                                   title="Active"
                                                                   onclick="return confirm('Do you really want to activate this subject')">
                                                                        <i class="fa fa-check"
                                                                           title="Acticvate Record"></i>

                                                                    </a><?php } else { ?>

                                                                    <a href="manage-subjectcombination.php?did=<?php echo htmlentities($result->scid); ?>"
                                                                       title="Deactive"
                                                                       onclick="return confirm('Do you really want to deactivate this subject')"><i
                                                                                class="fa fa-times"
                                                                                title="Deactivate Record"></i> </a>
                                                                <?php } ?>
                                                                <a href="manage-subjectcombination.php?sjcid=<?php echo htmlentities($result->scid); ?>"
                                                                   title="Delete Record" class="delete"
                                                                   onclick="return confirm('Are you sure you want to delete this Subject Combination')"><i
                                                                            class="fa fa-trash-alt"
                                                                            title="Delete Record"></i></a>
                                                            </td>
                                                        </tr>
                                                        <?php $cnt = $cnt + 1;
                                                    }
                                                } ?>
                                                </tbody>
                                            </table>
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
    <script src="js/DataTables/datatables.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        $(function ($) {
            $('#example').DataTable();
            $('#example2').DataTable({
                "scrollY": "300px",
                "scrollCollapse": true,
                "paging": false
            });

            $('#example3').DataTable();
        });
    </script>
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
