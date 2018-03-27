<?php

session_start();
if (!isset($_SESSION["user"]) or $_SESSION["user"]["id"] != $_GET["id"]) {
    if ($_SESSION["user"] != 'admin') {
        header("location: login.php");
    }
}

function __autoload($class)
{
    include_once($class . ".php");
}

$student = new student();
$id = $_GET["id"];
if (isset($_REQUEST["save"])) {
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
    if ($error === 1) {
        $error = "<div class='alert alert-danger'><span>Please fill required(*) details</span></div>";
    }

    if (empty($error)) {
        if (!empty($_FILES["pic"]["name"])) {
            $pic = "pro-pic-" . $id;
            if (!$student->uploadImage($pic))
                echo "Error while uploading";
        }
        $user = array('id' => $id, 'fname' => $fname, 'lname' => $lname, 'email' => $emailId, 'gender' => $gender,
            'address' => $address, 'city' => $city, 'state' => $state, 'class' => $class);
        if ($student->updateStudent($user)) {
            header("location: profile.php?id=$id");
        } else
            echo "Error while updating";
    }
}

//$id = $_GET["id"];
$user = $student->getStudentById($id);
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
    <div style="margin-top:50px;" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <h2 class="text-muted">Edit Profile</h2>
    </div>
    <div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title"><?php echo $user["id"]; ?></div>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="col-md-3 control-label">First Name <span class="err">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="firstname"
                                   value="<?php echo $user["fname"]; ?>" placeholder="First Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Last Name <span class="err">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="lastname"
                                   value="<?php echo $user["lname"]; ?>" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email Id <span class="err">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="email" value="<?php echo $user["email"]; ?>"
                                   placeholder="Email Id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Gender</label>
                        <div class="col-md-9">
                            <input type="radio" name="gender"
                                   value="Male" <?php echo $user["gender"] == 'Male' ? "checked" : ""; ?>> Male
                            <input type="radio" name="gender"
                                   value="Female" <?php echo $user["gender"] == 'Female' ? "checked" : ""; ?>> Female
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Address</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="address"
                                   value="<?php echo $user["address"]; ?>" placeholder="flat no., street name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">City</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="city" value="<?php echo $user["city"]; ?>"
                                   placeholder="City">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">State</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="state" value="<?php echo $user["state"]; ?>"
                                   placeholder="State">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Standard</label>
                        <div class="col-md-9">
                            <select name="class" class="form-control">
                                <option value="<?php echo $user["class"]; ?>">Choose...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Upload Profile Photo</label>
                        <div class="col-md-9">
                            <input type="file" class="form-control" name="pic">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" name="save" class="btn btn-primary">Save</button>
                            <a href="profile.php?id=<?php echo $user["id"]; ?>" type="submit" name="cancel"
                               class="btn btn-warning">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>