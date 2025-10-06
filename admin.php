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
        
</body>
</html>