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

trait Post
{
    use Connect;

    public function getList()
    {
        $query = "Select * from post";
        $result = mysqli_query($this->connect(), $query);
        $post = [];
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $post[$i++] = $row;
        }
        return $post;
    }

    public function viewDetail($id)
    {
        $query = "Select * from post where id_Post='$id'";
        $result = mysqli_query($this->connect(), $query);
        $post = [];
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $post[$i++] = $row;
        }
        return $post;
    }
}

trait User
{
    use Connect;

    public function getList()
    {
        $query = "Select * from user";
        $result = mysqli_query($this->connect(), $query);
        $user = [];
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $user[$i++] = $row;
        }
        return $user;
    }

    public function viewDetail($id)
    {
        $query = "Select * from user where username='$id'";
        $result = mysqli_query($this->connect(), $query);
        $user = [];
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $user[$i++] = $row;
        }
        return $user;
    }
}
    
class HomePageController
{
    use Post, User {
        Post::getList insteadof User;
        User::viewDetail insteadof Post;
    }
}
