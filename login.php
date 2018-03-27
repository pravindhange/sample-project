<?php
session_start();

if (isset($_SESSION["user"])) {
    $_SESSION["user"] == 'admin' ? header("location: adminHome.php") :
        header("location: profile.php?id=" . $_SESSION["user"]["id"]);
}

if (isset($_POST["login"])) {
    $unerror = $perror = "";
    $uname = trim($_POST["username"]);
    if (empty($uname)) {
        $unerror = "Please Enter Email Id.";
    }
    $pass = $_POST["password"];
    if (empty($pass)) {
        $perror = "Please Enter Password.";
    }

    if (empty($unerror) && empty($perror)) {

        function __autoload($class)
        {
            include_once($class . ".php");
        }

        $obj = new student();

        $conn = new PDO("mysql:host=localhost;dbname=phpdb", "root", "abcd1234");
        $username = $_POST["username"];
        $password = $_POST["password"];

        $row = $obj->validateStudent($username, $password);
        print_r($row);
        if (count($row) > 0) {
            if (!empty($_POST["remember"])) {
                setcookie("username", $username, time() + 60 * 60 * 24 * 7, '/student', 'localhost');
                setcookie("password", $password, time() + 60 * 60 * 24 * 7, '/student', 'localhost');
            } else {
                setcookie("username", "");
                setcookie("password", "");
            }
            if ($row["role"] === '1') {
                $_SESSION["user"] = 'admin';
                header("location: adminHome.php");
            } else if ($row["role"] === '2') {
                $_SESSION["user"] = $row;
                header("location: profile.php");
            } else
                $_SESSION["status"] = "<div class='alert alert-danger'><span>Invalid Username or password...</span></div>";
        } else {
            echo "Login Failed";
        }
    }
}
?>
<html>
<head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

    <style>.error {
            color: #ff0000
        }</style>
</head>
<body>
<div class="container">
    <div style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 ">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div align="center" class="panel-title">Sign In</div>
            </div>
            <div style="padding-top:30px" class="panel-body">
                <form class="form-horizontal" method="post" action="">
                    <?php echo $_SESSION["status"]; ?>
                    <span class="error"><?php echo $unerror; ?></span>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" name="username"
                               value="<?php if (isset($_COOKIE["username"])) {
                                   echo $_COOKIE["username"];
                               } ?>" placeholder="Email Id">
                    </div>
                    <span class="error"><?php echo $perror; ?></span>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" name="password"
                               value="<?php if (isset($_COOKIE["password"])) {
                                   echo $_COOKIE["password"];
                               } ?>" placeholder="Password">
                    </div>
                    <div class="input-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" value="1"> Remember me
                            </label>
                        </div>
                    </div>
                    <div style="margin-top:10px" class="form-group">
                        <div align="center">
                            <button type="submit" name="login" class="btn btn-primary"><span
                                        class='glyphicon glyphicon-log-in'></span> Login
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div align="center" style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                Don't have an account!
                                <a href="register.php">Sign Up Here</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>