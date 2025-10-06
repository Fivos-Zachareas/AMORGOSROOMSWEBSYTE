<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG IN|AMORGOS ROOMS</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/style-form.css">
    <style>
    table, th, td {
    border:1px solid black;
    }
    .table {
    margin-left: auto;
    margin-right: auto;
    }
    .table {
        background-color: #EBEBEB;
    }
    </style>
    
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

        <div class="form-container" id  = "choice" >
            
            <h1>Επιλέξτε λειτουργία:</h1>
            <form method="POST" action = "admin1.php">
                
                <button type="submit" name = "show_users" id = "show_users" >Προβολή εγγεγραμμένων χρηστών</button> <br><br>
            </form>
            <form method="POST" action = "admin2.php">
                
                <button type="submit" name = "show_pending" id = "show_pending" >Προβολή λογαριασμών σε αναμονή</button> <br><br>
            </form>
            <form method="POST" action = "admin3.php">
                
                <button type="submit" name = "add_admin" id = "add_admin" >Προσθήκη διαχειρηστή</button> <br><br>
            </form>
            <form method="POST" action = "admin4.php">
                
                <button type="submit" name = "profile" id = "profile" >Τροποποίηση προφίλ</button> <br><br>
            </form>
        
        </div>


        <div class="form-container" id  = "add_admin" >
            
            <h2>Προσθήκη διαχειρηστή</h2>
         <form method="POST" >
         
             <label for="first_name">Όνομα Διαχειρηστή:</label><br>
             <input type="text" id="first_name" name="first_name" required><br><br>
             
             <label for="last_name">Επίθετο Διαχειρηστή:</label><br>
             <input type="text" id="last_name" name="last_name" required><br><br>
             
             <label for="email">Email Διαχειρηστή:</label><br>
             <input type="email" id="email" name="email" required><br><br>
             
             <label for="username">Username:</label><br>
             <input type="text" id="username" name="username" required><br><br>
             
             <label for="password">Password:</label><br>
             <input type="password" id="password" name="password" required><br><br>
             
             <label for="confirm_password">Confirm Password:</label><br>
             <input type="password" id="confirm_password" name="confirm_password" required><br><br>
             
             
             
             <input type="submit" value="Εγγραφή" name = "submit_admin" id = "submit_admin" >
             
             </div>
    </body>
    <?php
    if(isset($_POST["submit_admin"])){
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
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];


            if($first_name== null){
                echo '<script>alert("Task failed")</script>';
            }else{ 
            

            if(strcmp( $password, $confirm_password ) !== 0){
                echo '<script>alert("Οι κωδικοί δεν είναι ίδιοι")</script>';
            }else{
                $sql = " SELECT username FROM registered_users WHERE username = '$username'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0){
                    echo '<script>alert("Error in sql ")</script>';
                }else{
                    $sql = " SELECT username FROM administrators WHERE username = '$username'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0){
                        echo '<script>alert("Το username χρησιμοποιείται από άλλο χρήστη")</script>';
                    }else{
                    
                $sql = "INSERT INTO administrators VALUES (null, '$first_name', '$last_name','$email', '$username', '$password')";

                if (mysqli_query($conn, $sql)) {
                echo '<script>alert("New record created successfully")</script>';
                
                } else {
                    echo '<script>alert("Error in sql ")</script>';
                }
            }
            }
        }
            }
            mysqli_close($conn);
         
        }
        ?>

    </html>