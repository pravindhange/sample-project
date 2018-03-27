<?php


if (isset($_REQUEST["register"])) {
    extract($_REQUEST);
    $error = "";
    $fname = trim($firstname);
    if (empty($fname)) {
        $error = 1;
    }
    $lname = trim($lastname);
    if (empty($lname)) {
        $error = 1;
    }
    $emailId = trim($email);
    if (empty($emailId)) {
        $error = 1;
    }
    if (empty($password)) {
        $error = 1;
    }
    if ($error === 1) {
        $error = "<div class='alert alert-danger'><span>Please fill required(*) details</span></div>";
    }

    if (empty($error)) {
        function __autoload($class)
        {
            include_once($class . ".php");
        }

        $student = new student();
        session_start();
        $user = array('fname' => $fname, 'lname' => $lname, 'email' => $emailId, 'password' => $password, 'gender' => $gender,
            'address' => $address, 'city' => $city, 'state' => $state, 'class' => $class);
        if ($student->insertStudent($user)) {
            $_SESSION["status"] = "<div class='alert alert-success'><span>Registration Successful!!!</span></div>";
            header("location: login.php");
        } else {
            $_SESSION["status"] = "<div class='alert alert-danger'><span>Registration Unsuccessful...</span></div>";
            header("location: login.php");
        }
    }
}
?>
<html>
<head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

    <style> .err {
            color: red;
        }</style>
</head>
<body>
<div class="container">
    <div style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div align="center" class="panel-title">Sign Up</div>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="" method="post">

                    <?php echo $error; ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label">First Name <span class="err">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>"
                                   placeholder="First Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Last Name <span class="err">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>"
                                   placeholder="Last Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email Id <span class="err">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="email" value="<?php echo $email; ?>"
                                   placeholder="Email Id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Password <span class="err">*</span></label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Gender </label>
                        <div class="col-md-9">
                            <input type="radio" name="gender" value="Male"> Male
                            <input type="radio" name="gender" value="Female"> Female
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Address </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="address" value="<?php echo $address; ?>"
                                   placeholder="flat no., street name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">City </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="city" value="<?php echo $city; ?>"
                                   placeholder="City">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">State </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="state" value="<?php echo $state; ?>"
                                   placeholder="State">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Standard </label>
                        <div class="col-md-9">
                            <select name="class" class="form-control">
                                <option value="<?php echo $class; ?>">Choose...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" name="register" class="btn btn-primary">Sign Up</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div align="center" style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                Already have an account!
                                <a href="login.php">Login Here</a>
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