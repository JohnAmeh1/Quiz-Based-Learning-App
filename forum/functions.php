<?php
session_start();

defined('APP') or die('direct script access denied!');

function authenticate($row)
{
	$_SESSION['USER'] = $row;
}

function query($query)
{
	global $con;

	$result = mysqli_query($con, $query);
	if(!is_bool($result) && mysqli_num_rows($result) > 0)
	{
		$data = [];
		while ($row = mysqli_fetch_assoc($result)) {
			$data[] = $row;
		}

		return $data;
	}

	return false;
}

function logged_in(){

	if(!empty($_SESSION['USER']))
		return true;

	return false;
}

function logout(){

	if(!empty($_SESSION['USER']))
		unset($_SESSION['USER']);

}

function get_image($path)
{
    // Base folder where profile pictures are stored
    $base_folder = '../pp/';
    
    // Construct the full path
    $full_path = $base_folder . $path;

    // Check if the path is not empty and the file exists
    if (!empty($path) && file_exists($full_path)) {
        return $full_path;
    }

    // Return the default image if no valid file is found
    return 'assets/images/user.jpg';
}


function i_own_post($row)
{
	if(logged_in() && $_SESSION['USER']['user_id'] == $row['user_id'])
		return true;

	return false;
}

function i_own_profile($row)
{
	if(logged_in() && $_SESSION['USER']['user_id'] == $row['id'])
		return true;

	return false;
}

