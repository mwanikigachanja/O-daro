<!DOCTYPE html>
<html>
<head>
  <title>Course Content</title>
</head>
<body>
  <h1>Course Content</h1>

  <?php
  // Connect to the database (replace 'hostname', 'username', 'password', and 'database' with your database credentials)
  $conn = mysqli_connect('hostname', 'username', 'password', 'database');
  if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
  }

  // Fetch the course content from the database (replace 'course_content' with your table name and adjust the query as needed)
  $query = "SELECT cc.content_id, cc.course_id, cc.title, cc.content FROM course_content cc";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    // Iterate through each row of the result
    while ($row = mysqli_fetch_assoc($result)) {
      $contentId = $row['content_id'];
      $courseId = $row['course_id'];
      $title = $row['title'];
      $content = $row['content'];

      // Display the course content
      echo '<h2>' . $title . '</h2>';
      echo '<p>' . $content . '</p>';
      echo '<a href="download_content.php?contentId=' . $contentId . '&courseId=' . $courseId . '">Download Content</a>';
    }
  } else {
    echo 'No course content found.';
  }

  // Close the database connection
  mysqli_close($conn);
  ?>

</body>
</html>
