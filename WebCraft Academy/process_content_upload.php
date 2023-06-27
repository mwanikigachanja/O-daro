<?php
// Check if the form is submitted and the file is uploaded successfully
if (isset($_POST['submit']) && isset($_FILES['content']) && $_FILES['content']['error'] === UPLOAD_ERR_OK) {
  // Get the course ID
  $courseId = $_POST['course'];

  // Get the uploaded file details
  $file = $_FILES['content'];
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
      $uploadPath = 'course_content/' . $uniqueFilename;

      // Move the uploaded file to the designated directory
      if (move_uploaded_file($fileTmpName, $uploadPath)) {
        // Connect to the database and insert the content record (replace 'hostname', 'username', 'password', and 'database' with your database credentials)
        $conn = mysqli_connect('hostname', 'username', 'password', 'database');
        if (!$conn) {
          die('Connection failed: ' . mysqli_connect_error());
        }

        // Sanitize the uploaded file path and course ID
        $safeFilePath = mysqli_real_escape_string($conn, $uploadPath);
        $safeCourseId = mysqli_real_escape_string($conn, $courseId);

        // Insert the content record into the database
        $query = "INSERT INTO course_content (course_id, file_name, file_path) VALUES ('$safeCourseId', '$fileName', '$safeFilePath')";
        if (mysqli_query($conn, $query)) {
          echo 'Content uploaded successfully.';
        } else {
          echo 'Error: Unable to upload the content.';
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
  echo 'Error: Invalid request.';
}
