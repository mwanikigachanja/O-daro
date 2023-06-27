<?php
// Connect to the database (replace 'hostname', 'username', 'password', and 'database' with your database credentials)
$conn = mysqli_connect('hostname', 'username', 'password', 'database');
if (!$conn) {
  die('Connection failed: ' . mysqli_connect_error());
}

// Retrieve the completed tests for review (replace 'test_id' with the actual ID of the test being reviewed)
$query = "SELECT t.test_id, t.student_id, t.test_name, t.date_taken, t.answers, s.first_name, s.last_name FROM tests t INNER JOIN students s ON t.student_id = s.student_id WHERE t.test_id = 'test_id'";
$result = mysqli_query($conn, $query);
if (!$result) {
  die('Error: ' . mysqli_error($conn));
}

// Check if the form is submitted for marking
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $test_id = $_POST['test_id'];
  $marks = $_POST['marks'];

  // Perform necessary validations and sanitization on the form data

  // Update the marks for the test (replace 'test_id' with the actual ID of the test being marked)
  $updateQuery = "UPDATE tests SET marks = '$marks' WHERE test_id = 'test_id'";
  $updateResult = mysqli_query($conn, $updateQuery);
  if (!$updateResult) {
    die('Error: ' . mysqli_error($conn));
  }

  // Perform automatic grading and clearance for certification
  $gradingQuery = "UPDATE tests SET grade = 
    CASE
      WHEN marks >= 80 THEN 'Distinction'
      WHEN marks >= 60 THEN 'Pass'
      WHEN marks >= 40 THEN 'Credit'
      ELSE 'Fail'
    END
    WHERE test_id = 'test_id'";
  $gradingResult = mysqli_query($conn, $gradingQuery);
  if (!$gradingResult) {
    die('Error: ' . mysqli_error($conn));
  }

  // Send signal for clearance for certification (replace 'student_id' with the actual ID of the student)
  $clearanceQuery = "UPDATE students SET certification_clearance = '1' WHERE student_id = 'student_id'";
  $clearanceResult = mysqli_query($conn, $clearanceQuery);
  if (!$clearanceResult) {
    die('Error: ' . mysqli_error($conn));
  }

  // Redirect to the test results page or display success message
  header('Location: test_results.php');
  exit();
}

// Display the completed test for review
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $testId = $row['test_id'];
    $studentId = $row['student_id'];
    $testName = $row['test_name'];
    $dateTaken = $row['date_taken'];
    $answers = $row['answers'];
    $firstName = $row['first_name'];
    $lastName = $row['last_name'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Test Marking</title>
  <!-- Add Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <h1>Test Marking</h1>

  <h2>Test Details</h2>
  <div>
    <p><strong>Test Name:</strong> <?php echo $testName; ?></p>
    <p><strong>Date Taken:</strong> <?php echo $dateTaken; ?></p>
    <p><strong>Student Name:</strong> <?php echo $firstName . ' ' . $lastName; ?></p>
  </div>

  <h2>Test Answers</h2>
  <div>
    <p><?php echo $answers; ?></p>
  </div>

  <h2>Marking</h2>
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="test_id" value="<?php echo $testId; ?>">
    <div class="form-group">
      <label for="marks">Marks:</label>
      <input type="number" class="form-control" id="marks" name="marks" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

  <!-- Add Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
  }
} else {
  echo '<p>No completed tests found.</p>';
}

mysqli_close($conn);
?>
