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
    session_start();
    $username = $_SESSION["username"];

    $sql = "SELECT  business_name, business_number, business_email FROM registered_users WHERE username = '$username'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $name = $row["business_name"];
    $number = $row["business_number"];
    $email = $row["business_email"];

    ?>
        

     

<div class="form-container">

        <h2>Φόρμα Δημιουργίας Σελίδας</h2>
        <p>Εισαγάγετε τα παρακάτω στοιχεία:</p>

        <form method = "POST" enctype="multipart/form-data">
            <label for= "business_name">Επωνυμία Επιχείρησης/Δωματίων:</label><br>
            <input type="text" id="business_name" name="business_name" value = "<?php echo $name;?> " readonly><br>

            <label for="description">Ιστοσελίδα Επιχείρησης/Δωματίων:</label><br>
            <input type="text" id="website" name="website" ><br>

            <label for="phone">Τοποθεσία:</label><br>
            <input type="tel" id="location" name="location" required><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value = "<?php echo $email;?>" readonly><br>

            <label for="mobile_phone">Τηλέφωνο Επιχείρησης:</label><br>
            <input type="tel" id="number" name="number" value = "<?php echo $number;?>" readonly><br>

            <label for="photo">Φωτογραφία:</label><br>
            <input type="file" id="photo" name="photo"><br><br>

            <input type="submit" name = "submit1" id  = "submit1" value="Ready!">
        </form>
</div>
</body>


<?php
if(isset($_POST["submit1"])) { 
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

   $business_name = $_POST["business_name"];
   $website = $_POST["website"];
   $number  =$_POST["number"];
   $email = $_POST["email"];
   if($photo != NULL){
    
   
   $image_name = str_replace(" ", "-", $business_name).".jpeg";

   $target_dir = "images/find-a-room/";
   $target_file = $target_dir . $image_name;
//    echo "image name: ". $target_file;
   $uploadOk = 1;
   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   
     $check = getimagesize($_FILES["photo"]["tmp_name"]);
     if($check !== false) {
    //    echo "File is an image - " . $check["mime"] . ".";
       $uploadOk = 1;
     } else {
       echo '<script>alert("File is not an image.")</script>'; 
       $uploadOk = 0;
     }

     // Check if file already exists
if (file_exists($target_file)) {
    echo '<script>alert("Sorry, file already exists.")</script>'; 
    $uploadOk = 0;
}

// Check file size
if ($_FILES["photo"]["size"] > 500000) {
    echo '<script>alert("Sorry, your file is too large.")</script>'; 
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "jpeg"
) {
    echo '<script>alert("Sorry, only JPG and JPEG files are allowed.")</script>'; 
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   echo '<script>alert("Sorry, your file was not uploaded.")</script>'; 
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        
    $sql = "INSERT INTO accomodation  VALUES (null, '$business_name', '$location', '$number', '$email', '$website', '$image_name')";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("New record created successfully")</script>'; 
        
    } else {
        echo '<script>alert("Error in sql ")</script>';
    }

}
}
}else{
    $sql = "INSERT INTO accomodation VALUES (null, '$business_name', '$location', '$number', '$email', '$website', '$image_name')";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("New record created successfully")</script>';
        
    } else {
        // echo "Error: " . $sql . "<br>" . mysqli_error($conn);  
        echo '<script>alert("Error in sql ")</script>';
    }
}

    


    
    
    
        
    
        mysqli_close($conn);
} 


?>
</html>