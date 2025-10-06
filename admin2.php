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


        <div class = "pending_users" id = "pen_usr">
            <form method = "POST">
            
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

            $sql = "SELECT  first_name, last_name, business_name, business_number, business_email, username FROM pending_users";
        
            $result = $conn->query($sql);
            ?>
        
        <table class = "table" style="width:80%">
        <tr>
            <th>Όνομα</th>
            <th>Επίθετο</th>
            <th>Επωνυμία Επιχείρησης</th>
            <th>Τηλέφωνο Επιχείρησης</th>
            <th>Email Επιχείρησης</th>
            <th>username</th>
            <th>Αποδοχή</th>
            <th>Απόρριψη</th>
        </tr>
        <?php
        if ($result->num_rows == 0) {
            ?>
            </table>
            <table class = "table">
            <th rowspan = "2"><?php echo "Δεν υπάρχουν χρήστες σε αναμονή\n";?> </th>
        </table>
        
            <?php
        }
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        // output data of each row
            
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $business_name = $row["business_name"];
            $business_number = $row["business_number"];
            $business_email = $row["business_email"];
            $username = $row["username"];
            

            ?>
        <tr>
            <td> <?php echo "$first_name";?> </td>
            <td> <?php echo "$last_name";?> </td>
            <td> <?php echo "$business_name";?> </td>
            <td> <?php echo "$business_number";?> </td>
            <td> <?php echo "$business_email";?> </td>
            <td> <?php echo "$username";?> </td>
            <!-- <td><input type="submit" name="test" value="Button1"/>  </td> -->
            <td> <button type="submit" id = "accept" name = "accept" value = "<?php echo "$username";?>">Αποδοχή</button> </td>
            <td> <button type="submit" id = "deny" name = "deny" value = "<?php echo "$username";?>">Απόρριψη</button> </td>
        </tr>
        <?php
        
            }
        }
        mysqli_close($conn);
        ?>
        
        
        </table>
    </form>
        </div>


    </body>
    <?php
    if(isset($_POST["accept"])){
            
            $value = $_POST["accept"];
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
            $sql = "SELECT  first_name, last_name, business_name, business_number, business_email, username FROM pending_users WHERE username = '$value'";
        
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $business_name = $row["business_name"];
            $business_number = $row["business_number"];
            $business_email = $row["business_email"];
            $username = $row["username"];
            if(!empty($username)){
                $sql = "INSERT INTO registered_users  VALUES (null, '$first_name', '$last_name', '$business_name', '$business_phone', '$business_email', '$username', '$password')";

                if (mysqli_query($conn, $sql)) {
                    echo '<script>alert("New record created successfully");</script>'; 
                    
                } else {
                    echo '<script>alert("Error in sql ")</script>';
                }
                $sql = "DELETE FROM pending_users WHERE username = '$value'";

                if (mysqli_query($conn, $sql)) {
                    echo "New record deleted successfully";
                    
                } else {
                    echo '<script>alert("Error in sql ")</script>';
                }
            }
                mysqli_close($conn);
                

            }
            if(isset($_POST["deny"])){
                $value = $_POST["deny"];
               

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
                $sql = "DELETE FROM pending_users WHERE username = '$value'";

                if (mysqli_query($conn, $sql)) {
                    echo "New record deleted successfully";
                    
                } else {
                    echo '<script>alert("Error in sql ")</script>';
                }
            
            mysqli_close($conn);
            
        }
        ?>
    </html>