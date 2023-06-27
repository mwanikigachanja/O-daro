<!DOCTYPE html>
<html>
<head>
  <title>Upload Tests</title>
  <!-- Add Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <h1>Upload Tests</h1>

  <form action="process_upload.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="course">Select Course:</label>
      <select name="course" id="course" class="form-control" required>
        <?php
        // Connect to the database and fetch tutor's courses (replace 'hostname', 'username', 'password', and 'database' with your database credentials and adjust the query)
        $conn = mysqli_connect('hostname', 'username', 'password', 'database');
        if (!$conn) {
          die('Connection failed: ' . mysqli_connect_error());
        }
        $query = "SELECT course_id, title FROM courses WHERE tutor_id = 'current_tutor_id'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
          // Iterate through each course and display as options
          while ($row = mysqli_fetch_assoc($result)) {
            $courseId = $row['course_id'];
            $title = $row['title'];

            echo '<option value="' . $courseId . '">' . $title . '</option>';
          }
        } else {
          echo '<option value="" disabled selected>No courses found</option>';
        }

        mysqli_close($conn);
        ?>
      </select>
    </div>

    <div class="form-group">
      <label for="test">Select Test File:</label>
      <input type="file" name="test" id="test" class="form-control-file" required>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Upload Test</button>
  </form>

  <!-- Add Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
