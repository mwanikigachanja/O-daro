// Function to handle form submission and initiate registration request
function register() {
    // Retrieve the form input values
    var firstName = document.getElementById('firstName').value;
    var lastName = document.getElementById('lastName').value;
    var email = document.getElementById('email').value;
    var phoneNumber = document.getElementById('phoneNumber').value;
    var address = document.getElementById('address').value;
    var dob = document.getElementById('dob').value;
    var course = document.getElementById('course').value;
    var startDate = document.getElementById('startDate').value;
  
    // Perform client-side validation
    if (firstName === '' || lastName === '' || email === '' || phoneNumber === '' || address === '' || dob === '' || course === '' || startDate === '') {
      alert('Please fill in all the required fields.');
      return;
    }
  
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
  
    // Prepare the request URL and data
    var url = 'register.php';
    var data =
      'firstName=' +
      encodeURIComponent(firstName) +
      '&lastName=' +
      encodeURIComponent(lastName) +
      '&email=' +
      encodeURIComponent(email) +
      '&phoneNumber=' +
      encodeURIComponent(phoneNumber) +
      '&address=' +
      encodeURIComponent(address) +
      '&dob=' +
      encodeURIComponent(dob) +
      '&course=' +
      encodeURIComponent(course) +
      '&startDate=' +
      encodeURIComponent(startDate);
  
    // Configure the request
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
    // Handle the request response
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Successful registration, display success message or perform any additional actions
          alert('Registration successful. You can now log in.');
          // Optionally redirect to the login page
          window.location.href = 'login.html';
        } else {
          // Registration error, display error message
          alert('Registration failed. Please try again.');
        }
      }
    };
  
    // Send the request
    xhr.send(data);
  }
  