<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG IN|AMORGOS ROOMS</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/style-form.css">
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

        <?php
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

        $search_name = null;
        $search_loc = null;
        session_start();
        $username = $_SESSION["username"];
        $password = $_SESSION["password"];
       
       

        $sql = "SELECT  first_name, last_name, business_name, business_number, business_email FROM registered_users where username = '$username' AND password = '$password'";
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            $row = $result->fetch_assoc();
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $business_name = $row["business_name"];
            $business_number = $row["business_number"];
            $business_email = $row["business_email"];
            
           
            
        }


        ?>
    <div class="layout">
        <div class="form-container">
        <h1>Τροποποίηση προφίλ:</h1>
        <form method="POST" >
            <label for="first_name">Όνομα Υπευθύνου:</label><br>
            <input type="text" id="first_name" name="first_name" value = "<?php echo $first_name; ?>" required><br><br>
            
            <label for="last_name">Επίθετο Υπευθύνου:</label><br>
            <input type="text" id="last_name" name="last_name" value = "<?php echo $last_name; ?>"required><br><br>
            
            <label for="business_name">Επωνυμία Επιχείρησης:</label><br>
            <input type="text" id="business_name" name="business_name" value = "<?php echo $business_name; ?>"required><br><br>
            
            <label for="business_phone">Τηλέφωνο Επιχείρησης:</label><br>
            <input type="tel" id="business_phone" name="business_phone" value = "<?php echo $business_number; ?>"required><br><br>
            
            <label for="business_email">Email Επιχείρησης:</label><br>
            <input type="email" id="business_email" name="business_email" value = "<?php echo $business_email; ?>"required><br><br>
            
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" value = "<?php echo $username; ?>"readonly><br><br>
            
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" value = "<?php echo $password; ?>"required><br><br>
            
            <label for="confirm_password">Confirm Password:</label><br>
            <input type="password" id="confirm_password" name="confirm_password" value = "<?php echo $password; ?>"required><br><br>
                <button type="submit" name = "submit" id = "submit" >Σύνδεση</button>
            </form>

            
        </div>
    </div>
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
                echo '<script>alert("Task failed")</script>';
                }else{ 
                $sql = " SELECT username FROM registered_users WHERE username = '$username'";
                $result = $conn->query($sql);

                if(strcmp( $password, $confirm_password )!== 0){
                    echo '<script>alert("Οι κωδικοί δεν είναι ίδιοι")</script>';
                }else{
                
                    
                    $sql = "UPDATE registered_users  SET first_name = '$first_name', last_name = '$last_name', business_name = '$business_name', business_number = '$business_phone', business_email = '$business_email', password =  '$password' WHERE username = '$username'";

                    if (mysqli_query($conn, $sql)) {
                    echo '<script>alert("New record created successfully")</script>';
                    
                    } else {
                        echo '<script>alert("Error in sql ")</script>';
                    }

            
        }
            }
            mysqli_close($conn);
         }
         ?>
</body>
</html>
