<?php
class admin{

    public $username;
    public $name;
    public $role;
    public $password;

    var $table_name = "admin";

    function __construct($username, $password, $name ,$role){
        $this->username = $username;
        $this->name = $name;
        $this->password = $password;
        $this->role = $role;
    }

    function insert($con){
        $query = $con->query("INSERT INTO $this->table_name (username, password, name, role)
            VALUES ('$this->username', 'md5($this->password)', '$this->name','$this->role')");

        return $query;
    }

    public static function with_username($con, $username){
        $query = $con->query("SELECT username, password, name, role FROM admin WHERE username='$username' limit 1");
        if($query){
            $admin = $query->fetch_assoc();
            $instance = new admin($admin["username"], $admin["password"], $admin["name"], $admin["role"]);

            return $instance;
        }

    }

}


?>