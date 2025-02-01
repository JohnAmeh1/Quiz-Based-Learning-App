<?php

class Login
{
    private $error = "";

    public function evaluate($data)
    {
        $username = $data["username"];

        $password = $data["password"];

        $query = "SELECT * FROM users WHERE username = '$username' limit 1 ";

        $DB = new Database();
        $result = $DB->read($query);
        
        if ($result) {
            $row = $result[0];
            $_SESSION['username'] = $row;
            $col = $_SESSION['username']['username'];

            $row = "SELECT * FROM users WHERE username = '$col' LIMIT 1";

            $DB = new Database();
            $result = $DB->read($row);
            // return $result;
            if (!empty($result)) {
                $row = $result[0];

                $_SESSION['auth'] = $row['user_id'];
            }

            if ($username == $row['username']) {
                //create session data

                $_SESSION['la'] = $row['username'];
            }

            if ($password == $row['password']) {
                //create session data

                $_SESSION['la'] = $row['username'];
            } else {
                $this->error .= "Invalid Credientials!<br>";
            }
        } else {
            $this->error .= "Invalid Credientials!<br>";
        }
        return $this->error;
    }

    public function val($id)
    {
        $correctMatNumber = $this->corrName($id);

        if ($correctMatNumber) {
            return $correctMatNumber;
        } else {
            // echo "<p>Invalid ID. Please go back to the <a href='./dashboard.php'>dashboard</a>.</p>";
            // echo "here3";
            header("location: ./profile_page.php");
            die;
        }
    }

    private function corrName($id)
    {
        $query = "SELECT * FROM users WHERE username = '$id' ";

        $DB = new Database();
        $result = $DB->read($query, [$id]);
        return $result ? $result[0] : null;
    }
}
