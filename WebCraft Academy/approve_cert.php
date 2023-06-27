<?php
// Connect to the database (replace 'hostname', 'username', 'password', and 'database' with your database credentials)
$conn = mysqli_connect('hostname', 'username', 'password', 'database');
if (!$conn) {
  die('Connection failed: ' . mysqli_connect_error());
}

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the selected students for certification approval
  $students = $_POST['student'];

  // Loop through the selected students and update their certification status in the database
  foreach ($students as $studentId) {
    // Perform a database query to update the certification status (replace 'students' and 'certified' with your table and column names)
    $query = "UPDATE students SET certified = 1 WHERE id = $studentId";
    $result = mysqli_query($conn, $query);

    if (!$result) {
      echo "Error updating certification status for student with ID: $studentId";
    }
  }

  // Close the database connection
  mysqli_close($conn);

  // Redirect to the tutor dashboard page after the certification approval process
  header("Location: tutor_dashboard.html");
  exit();
}
?>
