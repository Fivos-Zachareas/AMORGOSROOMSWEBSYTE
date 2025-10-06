<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN UP|AMORGOS ROOMS</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/style-form.css">
    <script src="JavaScript.js"></script>
    
</head>
<body>
        <nav class="nav">
            <img src="images/index/LOGO2.png" alt="amorgos logo">
            <a href="index.php">Αρχική</a>
                <span class="divider"></span>
            <a href="find-a-room.php">Καταλύματα</a>
                <span class="divider"></span>
            <a href="contact.php">Επικοινωνία</a>
                <span class="divider"></span>
            <a href="more.php">Περισσότερα</a>
                <span class="divider"></span>
            <a href="sign-up.php">Εγγραφή</a>
                <span class="divider"></span>
            <a href="login.php">Σύνδεση</a>
                <span class="divider"></span>
        </nav>
<!-- Κύριο περιεχόμενο -->
<div class="form-container">
    <h2>Νέο Κατάλυμα - Εγγραφή Τώρα!</h2>
    <form method="POST" >
    
        <label for="first_name">Όνομα Υπευθύνου:</label><br>
        <input type="text" id="first_name" name="first_name" required><br><br>
        
        <label for="last_name">Επίθετο Υπευθύνου:</label><br>
        <input type="text" id="last_name" name="last_name" required><br><br>
        
        <label for="business_name">Επωνυμία Επιχείρησης:</label><br>
        <input type="text" id="business_name" name="business_name" required><br><br>
        
        <label for="business_phone">Τηλέφωνο Επιχείρησης:</label><br>
        <input type="tel" id="business_phone" name="business_phone" required><br><br>
        
        <label for="business_email">Email Επιχείρησης:</label><br>
        <input type="email" id="business_email" name="business_email" required><br><br>
        
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        
        
        
        <input type="submit" value="Εγγραφή" name = "submit" id = "submit" >
        <?php
        if(isset($_POST["submit"])){ 
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "Amorgos-rooms";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection

            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }


            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $business_name = $_POST['business_name'];
            $business_phone = $_POST['business_phone'];
            $business_email = $_POST['business_email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];


            if($first_name== null){
            echo '<script>alert("task failed")</script>';
            }else{ 
            $sql = " SELECT username FROM registered_users WHERE username = '$username'";
            $result = $conn->query($sql);

            if(strcmp( $password, $confirm_password ) !== 0){
                echo '<script>alert("Οι κωδικοί δεν είναι ίδιοι")</script>';
            }else{
                if ($result->num_rows > 0){
                echo '<script>alert("Το username χρησιμοποιείται από άλλο χρήστη")</script>';
                }else{
                    
                $sql = "INSERT INTO pending_users  VALUES (null, '$first_name', '$last_name', '$business_name', '$business_phone', '$business_email', '$username', '$password')";

                if (mysqli_query($conn, $sql)) {
                echo '<script>alert("New record created successfully")</script>';
                
                } else {
                    echo '<script>alert("Error in sql ")</script>';
                }

            }
        }
            }
            mysqli_close($conn);
         }
         ?>
    </form>
</div>

</body>
</html>
