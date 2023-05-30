<?php
// Check for the presence of required POST data
if (isset($_POST['employeeId']) && isset($_POST['updatedSalary'])) {
  // Retrieve the values from the POST data
  $employeeId = $_POST['employeeId'];
  $updatedSalary = $_POST['updatedSalary'];

  // Perform the necessary database update operation
  $connection = mysqli_connect('localhost', 'root', '', 'employee_db');
  
  // Check if the connection was successful
  if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  // Perform the database update query
  $updateQuery = "UPDATE employee SET EmpSalary = '$updatedSalary' WHERE EmpID = '$employeeId'";
  mysqli_query($connection, $updateQuery);
  
  // Close the database connection
  mysqli_close($connection);
  
  // Return a response to indicate success
  echo 'Salary updated successfully';
}
else {
  // Return an error response if the required data is missing
  echo 'Error: Missing data';
}
?>
