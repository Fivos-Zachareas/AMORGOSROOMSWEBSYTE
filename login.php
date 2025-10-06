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
    <?php $logged_in = 0;?>
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
    <div class="layout">
        <div class="form-container" id  = "login">
            
            <h1>Είσοδος</h1>
            <form method="POST">
                <div class="input-group">
                    <label for="username">Όνομα χρήστη:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Κωδικός πρόσβασης:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" name = "submit" id = "submit" >Σύνδεση</button>
            </form>
        
        </div>

        <div class="form-container" id  = "choice" hidden>
            
            <h1>Επιλέξτε λειτουργία:</h1>
            <form method="POST" action = "add-accommodation.php">
                
                <button type="submit" name = "accommodation" id = "accommodation" >Καταχώρηση καταλύματος</button> <br><br>
            </form>
            
            <form method="POST" action = "profile.php">
                
                <button type="submit" name = "profile" id = "profile" >Τροποποίηση προφίλ</button> <br><br>
            </form>
            <form method="POST" action = "create-page.php">
                
                <button type="submit" name = "create" id = "create" >Δημιουργία ιστοσελίδας</button> <br><br>
            </form>
            
        
        </div>




    </div>

    <?php
        session_start();
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

                $username = $_POST['username'];
                $password = $_POST['password'];

                $sql = "SELECT username, password FROM administrators WHERE username = '$username' AND password = '$password'";

                $result = $conn->query($sql);
                if ($result->num_rows == 1){
                    $_SESSION["username"] = $username;
                    $_SESSION["password"] = $password;
                    header("Location: admin.php");
                    exit();
                }




                $sql = "SELECT username, password FROM registered_users WHERE username = '$username' AND password = '$password'";

                $result = $conn->query($sql);

                if ($result->num_rows == 1){
                    $_SESSION["username"] = $username;
                    $_SESSION["password"] = $password;
                    $logged_in = 1;
                    ?>

                    <?php
                    
                   
                }else{
                    echo "<script>alert('incorrect username or password');</script>"; 

                }

                mysqli_close($conn);
            }

            if($logged_in == 1){
                $logged_in = 0;
                ?>
            <script>
                var div1 = document.getElementById("login");
                var div2 = document.getElementById('choice');
                div1.style.display = "none";
                div2.style.display = "block";
                
            </script>

            <?php
            }
            
            ?>
</body>
</html>
