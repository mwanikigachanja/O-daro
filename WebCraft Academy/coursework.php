<!DOCTYPE html>
<html>
<head>
  <title>Course Work</title>
</head>
<body>
  <h1>Course Work</h1>

  <?php
  // Connect to the database (replace 'hostname', 'username', 'password', and 'database' with your database credentials)
  $conn = mysqli_connect('hostname', 'username', 'password', 'database');
  if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
  }

  // Fetch the course work pages for the tutor's courses from the database (replace 'course_work' and 'tutors' with your table names and adjust the query as needed)
  $query = "SELECT cw.page_id, cw.course_id, cw.title FROM course_work cw
            INNER JOIN tutors t ON cw.course_id = t.course_id
            WHERE t.tutor_id = 'current_tutor_id'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    // Iterate through each row of the result
    while ($row = mysqli_fetch_assoc($result)) {
      $pageId = $row['page_id'];
      $courseId = $row['course_id'];
      $title = $row['title'];

      // Display the course work page
      echo '<h2>' . $title . '</h2>';
      echo '<a href="upload_content.php?pageId=' . $pageId . '&courseId=' . $courseId . '">Upload Content</a>';
    }
  } else {
    echo 'No course work pages found.';
  }

  // Close the database connection
  mysqli_close($conn);
  ?>

</body>
</html>
