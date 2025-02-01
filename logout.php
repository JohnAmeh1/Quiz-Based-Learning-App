<?php
session_unset($_SESSION['user']);
session_unset($_SESSION['auth']);
// session_destroy();
header("location: index.php");
exit();
?>
