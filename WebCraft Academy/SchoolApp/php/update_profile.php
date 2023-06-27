<!DOCTYPE html>
<html>
<head>
  <title>Update Profile</title>
  <!-- Add Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <h1>Update Profile</h1>

  <?php
  // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $date_of_birth = $_POST['date_of_birth'];

    // Perform necessary validations and sanitization on the form data

    // Connect to the database and update the student's profile information (replace 'hostname', 'username', 'password', and 'database' with your database credentials and adjust the query)
    $conn = mysqli_connect('hostname', 'username', 'password', 'database');
    if (!$conn) {
      die('Connection failed: ' . mysqli_connect_error());
    }

    // Update the student's profile information (replace 'current_student_id' with the actual ID of the current logged-in student)
    $query = "UPDATE students SET first_name = '$first_name', last_name = '$last_name', email = '$email', phone_number = '$phone_number', address = '$address', date_of_birth = '$date_of_birth' WHERE student_id = 'current_student_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
      echo '<div class="alert alert-success">Profile updated successfully!</div>';
    } else {
      echo '<div class="alert alert-danger">Failed to update profile.</div>';
    }

    mysqli_close($conn);
  }
  ?>

  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="form-group">
      <label for="first_name">First Name</label>
      <input type="text" class="form-control" id="first_name" name="first_name" required>
    </div>
    <div class="form-group">
      <label for="last_name">Last Name</label>
      <input type="text" class="form-control" id="last_name" name="last_name" required>
    </div>
    <div class="form-group">
      <label for="email">Email Address</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
      <label for="phone_number">Phone Number</label>
      <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <textarea class="form-control" id="address" name="address" required></textarea>
    </div>
    <div class="form-group">
      <label for="date_of_birth">Date of Birth</label>
      <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Profile</button>
  </form>

  <!-- Add Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
