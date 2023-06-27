<?php
// Connect to the database (replace 'hostname', 'username', 'password', and 'database' with your database credentials)
$conn = mysqli_connect('hostname', 'username', 'password', 'database');
if (!$conn) {
  die('Connection failed: ' . mysqli_connect_error());
}

// Process the registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the form data
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $phoneNumber = $_POST['phoneNumber'];
  $address = $_POST['address'];
  $dob = $_POST['dob'];
  $course = $_POST['course'];
  $startDate = $_POST['startDate'];

  // Perform any additional validation on the form data

  // Perform a database query to insert the user data (replace 'users' with your table name)
  $query = "INSERT INTO users (firstName, lastName, email, phoneNumber, address, dob, course, startDate) VALUES ('$firstName', '$lastName', '$email', '$phoneNumber', '$address', '$dob', '$course', '$startDate')";
  $result = mysqli_query($conn, $query);

  if ($result) {
    // Registration successful
    // You can perform additional actions here, such as sending a confirmation email
    echo 'success';
  } else {
    // Registration failed
    echo 'error';
  }

  // Close the database connection
  mysqli_close($conn);
}
?>
