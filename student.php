<?php
/**
 * Created by PhpStorm.
 * User: Pravin
 * Date: 19/3/18
 * Time: 6:29 PM
 */

/*
 * Class for students operations. extends class connection to create connection with database
 *
 * Contains CRUD operations on student database.
 */

class student extends connection
{

    /*
     * Constructor function to create connection with database
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /*
     * Student Validation function
     * @param string $username entered for login
     * @param string $password entered for login
     * @return array of information of validated user if user exists
     */
    public function validateStudent($username, $password)
    {
        $q = $this->conn->prepare("select * from student where email = :un AND password = :pwd");
        $q->execute(array(':un' => $username, ':pwd' => $password));
        return $q->fetch(PDO::FETCH_ASSOC);
    }

    /*
     * Getting student information by student id
     * @param int $id of student
     * @return array of information of corresponding student
     */
    public function getStudentById($id)
    {
        $q = $this->conn->prepare("select * from student where id = :id");
        $q->execute(array(':id' => $id));
        return $q->fetch(PDO::FETCH_ASSOC);
    }

    /*
     * function to insert student information into database
     * @param array $user information of corresponding student
     * @return boolean true if student inserted successfully otherwise false
     */
    public function insertStudent($user)
    {
        extract($user);
        $q = "insert into student set fname = :fn, lname = :ln, email = :em, password = :pwd, gender = :gd, 
              address = :ad, city = :ct, state = :st, class = :cl";
        $stmt = $this->conn->prepare($q);
        if ($stmt->execute(array(':fn' => $fname, ':ln' => $lname, ':em' => $email, ':pwd' => $password, ':gd' => $gender,
            ':ad' => $address, ':ct' => $city, ':st' => $state, ':cl' => $class))) {
            return true;
        } else
            return false;
    }

    /*
     * function to update student information into database
     * @param array $user information of corresponding student
     * @return boolean true if student updated successfully otherwise false
     */
    public function updateStudent($user)
    {
        extract($user);
        $q = "update student set fname = :fn, lname = :ln, email = :em, gender = :gd, address = :ad, city = :ct, 
                  state = :st, class = :cl where id = :id";
        $stmt = $this->conn->prepare($q);
        if ($stmt->execute(array(':fn' => $fname, ':ln' => $lname, ':em' => $email, ':gd' => $gender, ':ad' => $address,
            ':ct' => $city, ':st' => $state, ':cl' => $class, ':id' => $id))) {
            return true;
        } else
            return false;
    }

    /*
     * function to upload profile photo
     * @param string $name of image after uploading
     * @return boolean true if successful upload or false
     */
    public function uploadImage($name)
    {
        $pic_loc = $_FILES['pic']['tmp_name'];
        $folder = "/var/www/html/student/images/" . $name;
        //delete if file already exists
        if (file_exists($folder)) {
            unlink($folder);
        }
        if (move_uploaded_file($pic_loc, $folder)) {
            chmod($folder, 0777);
            return true;
        }else
            return false;
    }
}