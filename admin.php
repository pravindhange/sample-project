<?php
/**
 * Created by PhpStorm.
 * User: pravin
 * Date: 21/3/18
 * Time: 10:51 AM
 */

class admin extends connection
{

    public function __construct()
    {
        parent::__construct();
    }

    /*
     * Collecting all students data
     * @return array of all students
     */
    public function allStudents()
    {
        $stmt = $this->conn->query("select * from student where role != 1") or die("Transaction failed");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /*
     * function to delete student information from database
     * @param int $id of corresponding student
     * @return boolean true if student deleted successfully otherwise false
     */
    public function deleteStudent($id)
    {
        $stmt = $this->conn->prepare("delete from student where id = :id");
        if ($stmt->execute(array(':id' => $id))) {
            return true;
        } else
            return false;
    }
}