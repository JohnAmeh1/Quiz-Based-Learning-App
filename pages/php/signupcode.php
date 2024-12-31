
<?php
class Signup
{
    private $error = "";

    public function evaluate($data)
    {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $this->error .= "$key is empty!<br>";
            }

            if ($key == "email") {
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->error .= "Invalid email address!<br>";
                }
            }
        }

        $checkNum = $this->corrNumber($data['username']);
        $checkEmail = $this->corrEmail($data['email']);

        if ($checkNum && $checkNum["username"] == $data['username']) {
            $this->error = "User with this Username already exists";
        } elseif ($checkEmail && $checkEmail["email"] == $data['email']) {
            $this->error = "User with this Email Address already exists";
        } elseif (empty($this->error)) {
            $this->create_user($data);
        }

        return $this->error;
    }

    private function corrNumber($id)
    {
        $id = htmlspecialchars($id);
        $query = "SELECT * FROM users WHERE username = '$id' LIMIT 1";
        $DB = new Database();
        $result = $DB->read($query);
        return $result ? $result[0] : false;
    }

    private function corrEmail($id)
    {
        $id = htmlspecialchars($id);
        $query = "SELECT * FROM users WHERE email = '$id' LIMIT 1";
        $DB = new Database();
        $result = $DB->read($query);
        return $result ? $result[0] : false;
    }

    private function create_user($data)
    {
        $userId = 'user_' . uniqid();
        $username = htmlspecialchars($data["username"]);
        $name = htmlspecialchars($data["name"]);
        $email = htmlspecialchars($data["email"]);
        $account_type = $data['account_type'];
        $password = $data["password"];
        $score = $data["score"] ?? 0;
        $level = $data["level"] ?? 1;
        $completed_courses = $data["completed_courses"] ?? '[]';

        if ($_FILES['image_path']['error'] !== UPLOAD_ERR_NO_FILE) {
            $fileName = $_FILES["image_path"]["name"];
            $fileSize = $_FILES["image_path"]["size"];
            $tmpName = $_FILES["image_path"]["tmp_name"];
            $fileType = $_FILES["image_path"]["type"];

            $validImageExtensions = ['image/jpg', 'image/jpeg', 'image/png'];
            $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (in_array($fileType, $validImageExtensions) && $fileSize <= 10000000) {
                $newImageName = $this->uniqueID() . '.' . $imageExtension;
                move_uploaded_file($tmpName, 'pp/' . $newImageName);

                $query = "INSERT INTO users (user_id, username, name, email, password, bio, image_path, account_type, score, level, completed_courses, fb, tw, yt)
                          VALUES ('$userId', '$username', '$name', '$email', '$password', 'Learning Enthusiast | Comprehensive Learning Fan', '$newImageName', '$account_type', '$score', '$level', '$completed_courses', 'fb', 'tw', 'yt')";
                $DB = new Database();
                $DB->save($query);
                header("location: index.php?success=Account created successfully");
                exit;
            } else {
                $this->error = $fileSize > 10000000 ? "File size is too big" : "Invalid File type";
            }
        } else {
            $this->error = "Image does not exist";
        }
    }

    private function uniqueID()
    {
        return rand(10000, 99999) . uniqid();
    }
}
