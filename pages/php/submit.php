<?php
class Submit
{
    public function create_upload()
    {
        $user_id = $_SESSION['username']['user_id'];
        $post_id = uniqid();
        $name = $_POST['name'];
        $categories = $_POST['categories'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        // Check if the user has already made 5 posts
        $numPosts = $this->getNumPosts($user_id);
        if ($_SESSION['username']['account_type'] == 'normal' && $numPosts >= 5) {
            $mnop = "You have reached the maximum number of posts. to continue making posts, pay for premium services";
            header("location: sell.php?error=$mnop");
            exit;
        }

        if ($_FILES['image_path']['error'] == 4) {
            echo "Image does not exist";
        } else {
            $fileName = $_FILES["image_path"]["name"];
            $fileSize = $_FILES["image_path"]["size"];
            $tmpName = $_FILES["image_path"]["tmp_name"];
            $fileType = $_FILES["image_path"]["type"];

            $validImageExtension = ['image/jpg', 'image/jpeg', 'image/png', 'application/pdf'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));

            if (in_array($fileType, $validImageExtension)) {

                $newImageName = $this->uniqueID();
                $newImageName .= '.' . $imageExtension;

                move_uploaded_file($tmpName, 'uploads/' . $newImageName);

                if ($fileType !== 'application/pdf') {
                    $query = "INSERT INTO users (user_id, post_id, name, categories, description, price, image_path) VALUES ('$user_id', '$post_id', '$name', '$categories', '$description', '$price', '$newImageName')";
                    
                    $DB = new Database();
                    $DB->save($query);
                    $adsm = "Ad posted successfully";
                    header("location: sell.php?success=$adsm");
                    exit;
                }
                // else{
                //     $edsm = "problem posting ad";
                //     header("location: sell.php?error=$edsm");
                //     exit;
                // }
                // echo "Success";

            } elseif ($fileSize > 10000000) {
                echo "File size is too big";
            } else {
                echo "Invalid File type";
                die;
            }
        }
    }

    private function uniqueID()
    {
        $length = rand(5, 19);
        $number = "";
        for ($i = 0; $i < $length; $i++) {
            # code...
            $new_rand = rand(0, 9);
            $number = $number . $new_rand;
        }
        return $number;
    }

    private function getNumPosts($user_id)
    {
        // Query the database to retrieve the number of posts for the user
        $query = "SELECT COUNT(*) as num_posts FROM users WHERE user_id = '$user_id'";

        $DB = new Database();
        $results = $DB->read($query);
        return $results[0]['num_posts'];
    }

    public function addUpload()
    {
        $upload_pdf = $this->upload();
        if ($upload_pdf) {
            return $upload_pdf;
        } elseif (!$upload_pdf) {

        } else {
            header("location: ./home.php");
            die;
        }
    }
    public function upload()
    {
        // $query = "SELECT pdf, name, semester FROM `uploads`";
        $query = "SELECT * FROM users";
        $DB = new Database();
        $results = $DB->read($query);
        return $results;
    }

    public function user_posts()
    {
        $posts = $this->posts();
        if ($posts) {
            return $posts;
        } elseif (!$posts) {
            // echo "No posts to display";
        } else {
            header("location: ./profile_Page.php");
            die;
        }
    }
    public function posts()
    {
        $user_id = $_SESSION['username']['user_id'];

        $query = "SELECT * FROM users WHERE user_id = '$user_id'";
        $DB = new Database();
        $results = $DB->read($query);
        return $results;
        
    }
    public function user_pp()
    {
        $pp = $this->pp();
        if ($pp) {
            return $pp;
        } elseif (!$pp) {

        } else {
            header("location: ./profile_Page.php");
            die;
        }
    }
    public function pp()
    {
        $query = "SELECT * FROM users";
        $DB = new Database();
        $results = $DB->read($query);
        return $results;
    }

    public function getItemById($id) {
    // SQL query to get item details based on ID
    $query = "SELECT * FROM users WHERE id = '$id'"; 
    
    // Using the Database class to execute the query
    $DB = new Database();
    $result = $DB->read($query);

    // Check if a result was returned
    if ($result && count($result) > 0) {
        return $result[0]; // Return the first result as an associative array
    } else {
        return false; // Return false if no item found
    }
}

    // public function search()
    // {
    //     $srch = $this->srch();
    //     if ($srch) {
    //         return $srch;
    //     } elseif (!$srch) {

    //     } else {
    //         header("location: ./home.php");
    //         die;
    //     }
    // }
    // public function srch()
    // {
    //     $searchValue = $_POST['searchValue'];
    //     $sql = "SELECT * FROM user WHERE name LIKE '%$searchValue%'";
    //     $DB = new Database();
    //     $results = $DB->read($sql);
    //     return $results;
    // }
}