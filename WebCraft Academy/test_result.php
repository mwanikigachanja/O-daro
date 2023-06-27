<!DOCTYPE html>
<html>
<head>
  <title>Test Results</title>
  <!-- Add Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <h1>Test Results</h1>

  <?php
  // Connect to the database and fetch tutor's courses (replace 'hostname', 'username', 'password', and 'database' with your database credentials and adjust the query)
  $conn = mysqli_connect('hostname', 'username', 'password', 'database');
  if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
  }
  $query = "SELECT t.test_id, t.course_id, t.title, t.result FROM tests t WHERE t.tutor_id = 'current_tutor_id'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    echo '<table class="table">';
    echo '<thead><tr><th>Test</th><th>Course</th><th>Result</th></tr></thead>';
    echo '<tbody>';
    // Iterate through each test and display the results
    while ($row = mysqli_fetch_assoc($result)) {
      $testId = $row['test_id'];
      $courseId = $row['course_id'];
      $title = $row['title'];
      $result = $row['result'];

      echo '<tr>';
      echo '<td>' . $title . '</td>';
      echo '<td>' . $courseId . '</td>';
      echo '<td>' . $result . '</td>';
      echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
  } else {
    echo 'No test results found.';
  }

  mysqli_close($conn);
  ?>

  <!-- Add Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
