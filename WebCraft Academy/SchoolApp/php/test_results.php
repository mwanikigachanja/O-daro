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
  // Connect to the database and retrieve the test results (replace 'hostname', 'username', 'password', and 'database' with your database credentials and adjust the query)
  $conn = mysqli_connect('hostname', 'username', 'password', 'database');
  if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
  }

  // Fetch the test results (replace 'current_student_id' with the actual ID of the current logged-in student)
  $query = "SELECT test_name, date_taken, score FROM tests WHERE student_id = 'current_student_id'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    // Display the test results in a table
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Test Name</th>';
    echo '<th>Date Taken</th>';
    echo '<th>Score</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $row['test_name'] . '</td>';
      echo '<td>' . $row['date_taken'] . '</td>';
      echo '<td>' . $row['score'] . '</td>';
      echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
  } else {
    echo '<p>No test results found.</p>';
  }

  mysqli_close($conn);
  ?>

  <!-- Add Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
