<?php

trait Connect
{
    public function connect()
    {
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $database = "application";
        $conn = mysqli_connect($hostname, $username, $password, $database);
        mysqli_set_charset($conn, "UTF8");
        return $conn;
    }
}

class User
{
    use Connect;
    
    public function checkStatus($status): ?string
    {
        if ($status == 1)
            return 'active';
        elseif ($status == 2)
            return 'soft_delete';
        else return null;
    }

    public function getAllUsers(): array|null
    {
        $query = "Select * from user";
        $result = mysqli_query($this->connect(), $query);
        $user = [];
        $i = 0;
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $user[$i++] = $row;
            }
            return $user;
        } else {
            return null;
        }
    }
}

$a = new User();
echo print_r($a->getAllUsers());
