// Function to handle form submission and initiate login request
function login() {
    // Retrieve the form input values
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
  
    // Perform client-side validation
    if (email === '' || password === '') {
      alert('Please enter your email and password.');
      return;
    }
  
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
  
    // Prepare the request URL and data
    var url = 'login.php';
    var data = 'email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password);
  
    // Configure the request
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
    // Handle the request response
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Successful login, redirect to the appropriate dashboard
          window.location.href = xhr.responseText;
        } else {
          // Login error, display error message
          alert('Login failed. Please check your credentials and try again.');
        }
      }
    };
  
    // Send the request
    xhr.send(data);
  }
  