<?php
class Signup extends Dbh
{
    private $username;
    private $pwd;

    public function __construct($username, $pwd)
    {
        $this->username = $username;
        $this->pwd = $pwd;
    }

    private function insertUser()
    {
        $query = "INSERT INTO users ('username', 'password') VALUES (:username, :pwd);";
        $stmt = parent::connect()->prepare($query);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":pwd", $this->pwd);
        $stmt->execute();
    }

    private function isEmptySubmit()
    {
        if (isset($this->username) && isset($this->pwd)) {
            return false;
        } else return true;
    }

    public function signupUser()
    {
        //error handles
        if ($this->isEmptySubmit()) {
            header("location:" . $_SERVER['DOCUMENT_ROOT'] . '/index.php');
            die();
        }

        //if no error
        $this->insertUser();
    }
}
