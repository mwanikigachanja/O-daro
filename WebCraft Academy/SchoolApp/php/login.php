<?php
// Connect to the database (replace 'hostname', 'username', 'password', and 'database' with your database credentials)
$conn = mysqli_connect('hostname', 'username', 'password', 'database');
if (!$conn) {
  die('Connection failed: ' . mysqli_connect_error());
}

// Process the login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the form data
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Perform a database query to check if the user exists (replace 'users' and 'email' with your table and column names)
  $query = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) === 1) {
    // User found, verify the password
    $row = mysqli_fetch_assoc($result);
    $hashedPassword = $row['password'];

    if (password_verify($password, $hashedPassword)) {
      // Password is correct, start a new session and store user data
      session_start();

      // Store relevant user data in session variables
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['user_role'] = $row['role'];

      // Redirect to the appropriate dashboard based on user role
      if ($row['role'] === 'student') {
        header("Location: student_dashboard.html");
      } elseif ($row['role'] === 'tutor') {
        header("Location: tutor_dashboard.html");
      }
      exit();
    }
  }

  // If user authentication fails, redirect back to the login page with an error message
  header("Location: login.html?error=1");
  exit();
}

// Close the database connection
mysqli_close($conn);
?>
