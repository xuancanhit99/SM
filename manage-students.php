<?php
session_start();
error_reporting(0);
include 'includes/db_connection.php';
global $dbh, $error;
if (!isset($_SESSION["email"])) {
    header('location: ../index.php');
} else {
    if ((Boolean) $_SESSION["isStudent"]) {
        header('location: ../index.php');
    } else if ((Boolean) $_SESSION["isEditor"]) {
        header('location: ../index.php');
    } else {
        if (isset($_GET['stuid'])) {
            $stuid = intval($_GET['stuid']);
            $sql = "delete from students where StudentID=:stuid ";
            $query = $dbh->prepare($sql);
            $query->bindParam(':stuid', $stuid, PDO::PARAM_STR);
            $query->execute();
            $msg = "Student has been deleted";
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

        <title>SM Admin Manage Students</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
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
                                <h2 class="title">Manage Students</h2>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                    <li> Students</li>
                                    <li class="active">Manage Students</li>
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
                                                <h5>View Students Info</h5>
                                            </div>
                                        </div>
                                        <?php if ($msg) {?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>Well done! </strong><?php echo htmlentities($msg); ?>
                                            </div><?php } else if ($error) {?>
                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                <strong>Oh snap! </strong> <?php echo htmlentities($error); ?>
                                            </div>
                                        <?php }?>
                                        <div class="panel-body p-20">
                                            <table id="example" class="display table table-striped table-bordered"
                                                   cellspacing="0" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Student Name</th>
                                                    <th>Student ID</th>
                                                    <th>Class</th>
                                                    <th>Reg Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Student Name</th>
                                                    <th>Student ID</th>
                                                    <th>Class</th>
                                                    <th>Reg Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>
                                                <?php $sql = "SELECT students.StudentName,students.StudentNo,students.RegDate,students.StudentID,students.Status,classes.ClassName,classes.ClassNumber,classes.ClassYear from students join classes on classes.id=students.ClassID";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
            foreach ($results as $result) {?>
                                                        <tr>
                                                            <td><?php echo htmlentities($cnt); ?></td>
                                                            <td><?php echo htmlentities($result->StudentName); ?></td>
                                                            <td><?php echo htmlentities($result->StudentNo); ?></td>
                                                            <td><?php echo htmlentities($result->ClassName); ?>
                                                                -<?php echo htmlentities($result->ClassNumber); ?>
                                                                -<?php echo htmlentities($result->ClassYear); ?>
                                                            </td>
                                                            <td><?php echo htmlentities($result->RegDate); ?></td>
                                                            <td><?php if ($result->Status == 1) {
                echo htmlentities('Active');
            } else {
                echo htmlentities('Blocked');
            }
                ?></td>
                                                            <td>
                                                                <a href="edit-student.php?stid=<?php echo htmlentities($result->StudentID); ?>"><i
                                                                            class="fa fa-edit" title="Edit Record"></i>
                                                                </a>
                                                                <a href="manage-students.php?stuid=<?php echo htmlentities($result->StudentID); ?>"
                                                                   title="Delete Record" class="delete"
                                                                   onclick="return confirm('Are you sure you want to delete this student')"><i
                                                                            class="fa fa-trash-alt"
                                                                            title="Delete Record"></i></a>
                                                            </td>
                                                        </tr>
                                                        <?php $cnt = $cnt + 1;
            }
        }?>
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

