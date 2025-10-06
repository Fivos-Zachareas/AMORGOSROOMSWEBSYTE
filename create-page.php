<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Δημιουργία Σελίδας|AMORGOS ROOMS</title>
        <link rel="stylesheet" href="CSS/style.css">
        <link rel="stylesheet" href="CSS/style-form.css">
    </head>
<body>
    <!-- <?php
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

    $sql = "SELECT email FROM administrators WHERE username = '$username' AND password = '$password'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $email = $row["email"];
    ?> -->

    

    
 
     
    <div class="nav">
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
    </div>
    
<div class="layout">


    <div class="form-container">
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "Amorgos-rooms";

       
        $conn = new mysqli($servername, $username, $password, $dbname);
       
        if ($conn->connect_error) {
         
        die("Connection failed: " . $conn->connect_error);
        }
        session_start();
        $username = $_SESSION['username'];
        

        $sql = "SELECT  business_name, business_number, business_email FROM registered_users where username = '$username'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $business_name = $row["business_name"];
        $business_number = $row["business_number"];
        $business_email = $row["business_email"];
       
    ?>
        <h2>Φόρμα Δημιουργίας Σελίδας</h2>
        <h3>Βεβαιωθείτε πως έχετε κάνει καταχώρηση καταλύματος</h3>
        <p>Εισαγάγετε τα παρακάτω στοιχεία:</p>
        

        <form method = "POST" enctype="multipart/form-data">
            <label for= "business_name">Επωνυμία Επιχείρησης/Δωματίων:</label><br>
            <input type="text" id="business_name" name="business_name"  value = "<?php echo $business_name; ?>" readonly><br>

            <label for="description">Περιγραφή Επιχείρησης/Δωματίων:</label><br>
            <textarea id="description" name="description" rows="4" cols="50" required></textarea><br>

            <label for="phone">Τηλέφωνο:</label><br>
            <input type="tel" id="phone" name="phone"  value = "<?php echo $business_number; ?>"readonly><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value = "<?php echo $business_email; ?>" readonly><br>

            <label for="mobile_phone">Κινητό Τηλέφωνο:</label><br>
            <input type="tel" id="mobile_phone" name="mobile_phone" required><br>

            <label for="photo">Φωτογραφία:</label><br>
            <input type="file" id="photo" name="photo" required><br><br>

            <input type="submit" name = "submit1" id  = "submit1" value="Ready!">
        </form>
        <h2>Φόρμα Σύνδεσης με Υπάρχον URL</h2>
    <p>Εισάγετε τα παρακάτω στοιχεία για να συνδέσετε το κατάλυμά σας με υπάρχον URL:</p>

    <form method = "POST">
        <label for="external_url">Link προς εξωτερικό URL:</label><br>
        <input type="url" id="external_url" name="external_url" required><br>

        <input type="checkbox" id="agree_check" name="agree_check">
        <label for="agree_check">Επιθυμώ σύνδεση με το παραπάνω URL</label><br><br>

        <input type="submit" name = "submit2" id  = "submit2" value="Ready!">
    </form>

    </div>
</div>
    <?php
    if(isset($_POST["submit1"])){ 
       submit1();

    }
    if(isset($_POST["submit2"])){ 
        submit2();
 
     }

    function submit1() { 
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
        
       $business_name = $_POST['business_name'];
       $description = $_POST['description'];
       $phone  =$_POST['phone'];
       $email = $_POST['email'];
       $mobile_phone = $_POST['mobile_phone'];
      

       $image_name = str_replace(" ", "-", $business_name).".jpeg";

       $target_dir = "images/find-a-room/";
       $target_file = $target_dir . $image_name;
      
       $uploadOk = 1;
       $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
       
         $check = getimagesize($_FILES["photo"]["tmp_name"]);
         if($check !== false) {
          
           $uploadOk = 1;
         } else {
           echo '<script>alert("File is not an image")</script>';
           $uploadOk = 0;
           exit();
         }

         // Check if file already exists
    if (file_exists($target_file)) {
        echo '<script>alert("Sorry, file already exists.")</script>';
        $uploadOk = 0;
        exit();
    }
    
    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        echo '<script>alert("Sorry, your file is too large.")</script>';
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "jpeg" ) {
        echo '<script>alert("Sorry, only JPG and JPEG files are allowed.")</script>';
        $uploadOk = 0;
        exit();
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<script>alert("Sorry, your file was not uploaded.")</script>';
        exit();
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
       
        $sql = "INSERT INTO local_websites  VALUES (null, '$business_name', '$description', '$phone', '$email', '$mobile_phone', '$image_name')";

        if (mysqli_query($conn, $sql)) {
           
            
        } else {
            echo '<script>alert("Error in sql ")</script>';
            exit();
        }

        $sql = "UPDATE accomodation SET image = '$image_name' WHERE name = '$business_name' ";

        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("New record created successfully")</script>';
            
        } else {
            echo '<script>alert("Error in sql ")</script>';
            exit();
        }
        } else {
        echo '<script>alert("Sorry, there was an error uploading your file.")</script>';
        exit();
        }
    }

    
    
    
    $string = str_replace("-", " ", $string);
    $filename = 'local-websites/'.$business_name.".php";
    
    $myfile = fopen($filename, "w") or die("Unable to open file!");


    $text = <<<HTML
    <!DOCTYPE html>
    <html lang="el">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/style.css">
        <link rel="stylesheet" href="CSS/style-form.css">
    </head>
    <body>
        
        <div class="layout">
            <div class="form-container" style = "border: 5px solid DodgerBlue">
                <h1>$business_name</h1>
                
                </form>
            </div>
        </div>
        <div class = "form-container" style = "border: 0px">
            <img src="images/find-a-room/$image_name"  style="float:left;width:20%;height:20%;">
            <p>
            $description
            </p>
        </div>
        <div class = "form-container" style = "border: 5px solid DodgerBlue">
            Κινητό: $mobile_phone &emsp;
            Σταθερό: $phone &emsp;
            Email: $email
        </div>
        
    </body>
    </html>
    HTML;
    
    fwrite($myfile, $text);
    
    fclose($myfile);


    $sql = "UPDATE accomodation SET website = '$filename' WHERE email = '$email'";
        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("New record created successfully")</script>';
            
        } else {
            echo '<script>alert("Error in sql ")</script>';
            
        }
        
            mysqli_close($conn);
    } 



    function submit2() { 
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
        session_start();
        $username = $_SESSION['username'];

        $sql = "SELECT business_email FROM registered_users WHERE username = '$username'";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $email = $row["business_email"];
        
        
        $website = $_POST["external_url"];
       
        $sql = "UPDATE accomodation SET website = '$website' WHERE email = '$email'";
        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("New record created successfully")</script>';
            
        } else {
            echo '<script>alert("Error in sql ")</script>';
        }
        mysqli_close($conn);
    }

    ?>

</body>
</html>


