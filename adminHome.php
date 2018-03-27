<?php
session_start();
if (!isset($_SESSION["user"]) or $_SESSION["user"] != 'admin') {
    header("location: login.php");
}
?>


<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .header h2 {
            margin-top: 0;
            margin-bottom: 0;
            line-height: 40px;
        }
    </style>
    <script language="JavaScript" type="text/javascript">
        function checkDelete() {
            return confirm('Are you sure?');
        }
    </script>
</head>

<?php
function __autoload($class)
{
    include_once($class . ".php");
}

$obj = new admin();
?>

<body>
<div class="container">
    <div class="col-md-10 col-md-offset-1 header clearfix">
        <nav>
            <ul class="nav nav-pills pull-right">
                <li class="active"><a href="register.php"><span class='glyphicon glyphicon-plus'></span> Add Student</a>
                </li>
                <li class="active"><a href="logout.php"><span class='glyphicon glyphicon-log-out'></span> Logout</a>
                </li>
            </ul>
        </nav>
        <h2 class="text-muted">Student Details</h2>
    </div>
    <div class="col-md-10 col-md-offset-1 table-responsive">
        <hr/>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email Id</th>
                <th>Class</th>
                <th>City</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($obj->allStudents() as $result) {
                extract($result);
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$fname $lname</td>";
                echo "<td>$email</td>";
                echo "<td>$class</td>";
                echo "<td>$city</td>";
                echo "<td> <a class='btn btn-success btn-sm' href='profile.php?id=$id'>
                            <span class='glyphicon glyphicon-eye-open'></span></a> 
                            <a class='btn btn-danger btn-sm' href='delete.php?id=$id' onclick='return checkDelete()'>
                            <span class='glyphicon glyphicon-trash'></span></a></td>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>