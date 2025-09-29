<?php
    define("SERVER", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DBNAME", "");

    class crud_login{
        function __construct(){
            $connection = mysqli_connect(SERVER, USERNAME, PASSWORD, DBNAME);
            $this->conn = $connection;
        }

        public function login($username, $email, $password){
            $login = "SELECT * FROM dbname WHERE Username = '$username' OR Email = '$email' AND Password = '$password'";
            $result = mysqli_query($this->conn, $login);

            if($result){
                header("location: /recipes/index.php");
            }
        }
    }
?>