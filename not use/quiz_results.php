quiz result

<?php
$score = $_GET['score'];
$course_id = $_GET['course_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
</head>

<body>
    <h1>Quiz Results</h1>
    <p>Congratulations! You scored <?php echo $score; ?> points.</p>
    <a href="../courses.php">Back to Courses</a>
</body>

</html>