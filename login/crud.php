<?php
    define("SERVER", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DBNAME", "baobites");

    class crud{
        function __construct(){
            $connection = mysqli_connect(SERVER, USERNAME, PASSWORD, DBNAME);
            $this->conn = $connection;
            if ($this->conn){
                echo "OK";
            }
        }

        public function login($username, $email, $password){
            $login = "SELECT * FROM dbname WHERE Username = '$username' AND Password = '$password'";
            $result = mysqli_query($this->conn, $login);

            if($result){
                header("location: /recipes/index.php");
            }
        }

        public function registration($fname, $lname, $username, $email, $password){
            $register = "INSERT INTO users(Fname, Lname, Username, Email, Password) VALUES('$fname', '$lname', '$username', '$email', '$password')";
            $result = mysqli_query($this->conn, $register);

            if ($result){
                echo "
                    <script>
                        alert('Registration Successful');
                        window.location.href='index.php';
                    </script>
                ";
            }
        }
    }
?>