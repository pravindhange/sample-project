<?php
/**
 * Created by PhpStorm.
 * User: pravin
 * Date: 15/3/18
 * Time: 5:14 PM
 */
session_start();
if (!isset($_SESSION["user"])) {
    header("location: login.php");
} else {
    if (!empty($_GET["id"])) {
        function __autoload($class)
        {
            include_once($class . ".php");
        }

        $student = new student();

        $id = $_GET["id"];
        $user = $student->getStudentById($id);

        if ($_SESSION["user"] == 'admin') {
            $home = "<a type=\"button\" href='adminHome.php' class=\"btn btn-sm btn-primary\">
                        <i class=\"glyphicon glyphicon-home\"></i> Home</a>";
        }
    } else
        $user = $_SESSION["user"];
}
?>

<html>
<head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="css/profileStyle.css" rel="stylesheet">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 toppad  pull-right ">
            <a href="logout.php" type="button"
               class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
        </div>
        <div class="col-md-6 col-md-offset-3 toppad">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $user["id"]; ?></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center">
                            <img alt="Profile Photo" src="images/pro-pic-<?php echo $user['id']; ?>"
                                 class="img-rounded img-responsive">
                        </div>
                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td><?php echo $user["fname"] . " " . $user["lname"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Email Id</td>
                                    <td><?php echo $user["email"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td><?php echo $user["gender"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td><?php echo $user["address"]; ?></td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td><?php echo $user["city"]; ?></td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td><?php echo $user["state"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Class</td>
                                    <td><?php echo $user["class"]; ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <?php echo $home; ?>

                    <a href="editProfile.php?id=<?php echo $user['id']; ?>" type="button"
                       class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>