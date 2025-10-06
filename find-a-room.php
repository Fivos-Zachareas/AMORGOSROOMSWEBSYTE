<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Βρείτε Κατάλυμα | AMORGOS ROOMS</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/style-findaroom.css">
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
    <div class="layout">
        <div class="search-bar-container">
            <!-- Search Bar -->
             
                <div class="search-bar">
                    <input id = "textbox" type="text" placeholder="Search...">
                    <button id  ="search" type="submit" onclick  = "search_location()">Search</button>
                </div>
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

        $sql = "SELECT  DISTINCT location FROM accomodation";
        
        $result = $conn->query($sql);
        ?>
        <select class="location-search" name="locations" id="locations">
        <option value="select a location">Select a Location</option>
        <?php

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            $location = $row["location"];
           ?> <option value="$location"><?php echo $location;?></option> <?php
        }
        $conn->close();
    }
        ?>

               
                    
                    
                </select>
            
        </div>
    </div>

   <!-- Hotel Information Box -->
    
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

        $sql = "SELECT  name, location, number, email, website, image FROM accomodation where name like '%$search_name%' AND location lIKE '%$search_loc%'";
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $name = $row["name"];
            $location = $row["location"];
            $number = $row["number"];
            $email = $row["email"];
            $website = $row["website"];
            $image = $row["image"];


            if($image == null){
                $image = "images/find-a-room/default-image.jpg";
            }else{
                $image = "images/find-a-room/".$image;
            }
            ?>

        <div class="hotel-info">
            <div class="hotel-details">
                <div class="hotel-info">
                <a href = "<?php echo $website;?>" style  ="float:right; "> <img src = "<?php echo $image;?>" style = "float:right ;width: 400px; height: auto">  </a> 
                    <h3><?php echo "$name" ?></h3>
                    <p>Περιοχή: <?php echo "$location" ?><br>
                    Τηλ: +30 <?php echo "$number"?><br>
                    Email: <?php echo "$email" ?><br>
                    <a href="contact.php">Επικοινωνήστε απευθείας</a>
                    </p>
                </div>
                <!-- <div class="image-container">
                <img src = "<?php echo $image;?>">
                <a href = "<?php echo $website;?>">   </a> 
                
                </div> -->
            </div>
        </div>
            <?php

        }
        } 
        $conn->close();
    ?>


    <script src="JS/find-a-room.js"></script>



</body>

</html>


