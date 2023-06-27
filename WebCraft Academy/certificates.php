<!DOCTYPE html>
<html>
<head>
  <title>Certificates</title>
</head>
<body>
  <h1>Certificates</h1>

  <?php
  // Connect to the database (replace 'hostname', 'username', 'password', and 'database' with your database credentials)
  $conn = mysqli_connect('hostname', 'username', 'password', 'database');
  if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
  }

  // Fetch the certificates for the passed courses from the database (replace 'certificates' and 'enrollments' with your table names and adjust the query as needed)
  $query = "SELECT c.course_id, c.title, c.certificate FROM certificates c
            INNER JOIN enrollments e ON c.course_id = e.course_id
            WHERE e.student_id = 'current_student_id' AND e.passed = 1";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    // Iterate through each row of the result
    while ($row = mysqli_fetch_assoc($result)) {
      $courseId = $row['course_id'];
      $title = $row['title'];
      $certificate = $row['certificate'];

      // Display the certificate information
      echo '<h2>' . $title . '</h2>';
      echo '<a href="' . $certificate . '">Download Certificate</a>';
    }
  } else {
    echo 'No certificates found.';
  }

  // Close the database connection
  mysqli_close($conn);
  ?>

</body>
</html>
