<?php
// Validate and process the uploaded test file

// Check if the form is submitted and the file is uploaded successfully
if (isset($_POST['submit']) && isset($_FILES['test']) && $_FILES['test']['error'] === UPLOAD_ERR_OK) {
  // Sanitize the course ID
  $courseId = filter_var($_POST['course'], FILTER_SANITIZE_STRING);

  // Validate the course ID
  if (!empty($courseId)) {
    // Get the uploaded file details
    $file = $_FILES['test'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    // Perform additional security checks on the uploaded file
    $allowedExtensions = array('pdf', 'doc', 'docx'); // Add the allowed file extensions
    $maxFileSize = 5 * 1024 * 1024; // 5MB, adjust the limit as needed

    // Extract the file extension
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validate the file extension
    if (in_array($fileExtension, $allowedExtensions)) {
      // Validate the file size
      if ($fileSize <= $maxFileSize) {
        // Generate a unique filename to prevent overwriting existing files
        $uniqueFilename = uniqid('', true) . '.' . $fileExtension;
        $uploadPath = 'uploads/' . $uniqueFilename;

        // Move the uploaded file to the designated upload directory
        if (move_uploaded_file($fileTmpName, $uploadPath)) {
          // Connect to the database and insert the test record (replace 'hostname', 'username', 'password', and 'database' with your database credentials)
          $conn = mysqli_connect('hostname', 'username', 'password', 'database');
          if (!$conn) {
            die('Connection failed: ' . mysqli_connect_error());
          }

          // Sanitize the uploaded file path
          $safeFilePath = mysqli_real_escape_string($conn, $uploadPath);

          // Insert the test record into the database
          $query = "INSERT INTO tests (course_id, title, file_path) VALUES ('$courseId', '$fileName', '$safeFilePath')";
          if (mysqli_query($conn, $query)) {
            echo 'Test uploaded successfully.';
          } else {
            echo 'Error: Unable to upload the test.';
          }

          mysqli_close($conn);
        } else {
          echo 'Error: Failed to move the uploaded file.';
        }
      } else {
        echo 'Error: The file size exceeds the allowed limit.';
      }
    } else {
      echo 'Error: Invalid file format. Only PDF, DOC, and DOCX files are allowed.';
    }
  } else {
    echo 'Error: Invalid course ID.';
  }
} else {
  echo 'Error: Invalid request.';
}
