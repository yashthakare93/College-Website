<?php
include("connection.php");

if(isset($_POST['submit'])){

    $username = $_POST['user'];
    $password = $_POST['pass'];

    // Prepare the SQL statement with placeholders for username and password
    $stmt = $conn->prepare("SELECT * FROM login WHERE username = ? AND password = ?");
    
    // Bind the parameters to the placeholders
    $stmt->bind_param("ss", $username, $password);
    
    // Execute the prepared statement
    $stmt->execute();
    
    // Get the result set
    $result = $stmt->get_result();
    
    // Check if there is a match
    if ($result->num_rows == 1) {
        // Redirect the user to the welcome page
        header("Location: welcome.php");
    } else {
        // Redirect the user back to the login page and display an error message
        echo '<script>
            window.location.href = "index.php";
            alert("Login failed. Invalid Username or Password !!!")
        </script>';
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
}
/*
if(isset($_POST['submit'])){

    $username = $_POST['user'];
    $password = $_POST['pass'];

    $sql="select form login where username ='$username' and password= '$password'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count==1){
        header("Location:welcome.php");
    }
    else {
        echo '<script>
            window.location.href = "index.php";
            alert("Login failed. Invalid Username or Password !!!")
        </script>';
    }

}*/
?>