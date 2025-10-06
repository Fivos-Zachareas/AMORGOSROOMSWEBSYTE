<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Επικοινωνία | AMORGOS ROOMS</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/style-form.css">
</head>
<body>
    <div class="col-s-12 col-m-12 col-l-12">
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

    <div class="form-container col-s-12 col-m-12 col-l-12">
        <h2>Φόρμα Επικοινωνίας</h2>
        <p>Συμπληρώστε τα παρακάτω πεδία:</p>

        <form id="reservationForm" method="post">
            <label for="firstName">Όνομα:</label><br>
            <input type="text" id="firstName" name="firstName" required><br>

            <label for="lastName">Επίθετο:</label><br>
            <input type="text" id="lastName" name="lastName" required><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>

            <label for="phone">Τηλέφωνο Επικοινωνίας:</label><br>
            <input type="tel" id="phone" name="phone" required><br>

            <label for="rooms">Συνολικός Αριθμός Δωματίων:</label><br>
            <input type="number" id="rooms" name="rooms" value="1" min="1" required><br>

            <label for="adults">Ενήλικες:</label><br>
            <input type="number" id="adults" name="adults" value="2" min="1" required><br>

            <label for="children">Ανήλικοι:</label><br>
            <input type="number" id="children" name="children" value="0" min="0" required><br>

            <label for="checkin">Ημερομηνία Άφιξης:</label><br>
            <input type="date" id="checkin" name="checkin" required><br>

            <label for="checkout">Ημερομηνία Αναχώρησης:</label><br>
            <input type="date" id="checkout" name="checkout" required><br>

            <label for="pet">Pet:</label><br>
            <select id="pet" name="pet">
                <option value="no">Όχι</option>
                <option value="dog">Σκύλος</option>
                <option value="cat">Γάτα</option>
                <option value="other">Άλλο</option>
            </select><br>

            <label for="comments">Σχόλια/Ερωτήσεις:</label><br>
            <textarea id="comments" name="comments" rows="4" cols="50"></textarea><br>

            <label for="captcha_question">CAPTCHA: </label>
            <span id="captcha_question"></span><br>
            <input type="text" id="captcha_input" name="captcha_input" required><br>
            <input type="hidden" id="captcha_answer" name="captcha_answer">

            <input type="hidden" id="hotel" name="hotel">
            <input type="hidden" id="hotelEmail" name="hotelEmail">
            <input type="submit" value="Αποστολή κράτησης" name = "submit" id = "submit" >
        </form>
    </div>

    <script src="JS/contact.js"></script>
    <?php

if(isset($_POST["submit"])){ 
    

// Συνδέστε το με το αρχείο PHPMailer
require PHPMailer\PHPMailer\PHPMailer;
require PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Τροποποιήστε ανάλογα με τον τρόπο εγκατάστασης του PHPMailer

// Στοιχεία για την αποστολή email
$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->isSMTP();
$mail->Host = 'smtp.yourserver.com'; // Εισάγετε τον SMTP server σας
$mail->SMTPAuth = true;
$mail->Username = 'your_email@example.com'; // Εισάγετε το email σας
$mail->Password = 'your_password'; // Εισάγετε τον κωδικό του email σας
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Λεπτομέρειες για το email
$senderEmail = 'Amorgos-rooms@gmail.com'; // Εισάγετε το email που θέλετε να εμφανίζεται ως αποστολέας
$senderName = 'AMORGOS ROOMS'; // Εισάγετε το όνομα που θέλετε να εμφανίζεται ως αποστολέας
$subject = 'Επιβεβαίωση Κράτησης';
$messageBody = 'Σας ευχαριστούμε για την κράτηση!';

// Συνδεσιμότητα με τη βάση δεδομένων (αναγκαίο να προσαρμοστείτε ανάλογα)
$servername = 'localhost';
$username = 'username'; // Εισάγετε το όνομα χρήστη της βάσης δεδομένων
$password = 'password'; // Εισάγετε τον κωδικό πρόσβασης της βάσης δεδομένων
$dbname = 'database'; // Εισάγετε το όνομα της βάσης δεδομένων

// Δεδομένα από τη φόρμα
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$rooms = $_POST['rooms'];
$adults = $_POST['adults'];
$children = $_POST['children'];
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$pet = $_POST['pet'];
$comments = $_POST['comments'];

// Σύνδεση στη βάση δεδομένων
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Αποτυχία σύνδεσης με τη βάση δεδομένων: ' . $conn->connect_error);
}

// Ελέγχουμε αν υπάρχει ήδη το email στη βάση δεδομένων
$sql = "SELECT * FROM reservations WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Το email υπάρχει ήδη, εδώ μπορείτε να διαχειριστείτε το σενάριο ανάλογα
   
} else {
    // Το email δεν υπάρχει, οπότε το αποθηκεύουμε
    $sql = "INSERT INTO reservations (firstName, lastName, email, phone, rooms, adults, children, checkin, checkout, pet, comments)
            VALUES ('$firstName', '$lastName', '$email', '$phone', '$rooms', '$adults', '$children', '$checkin', '$checkout', '$pet', '$comments')";

    if ($conn->query($sql) === TRUE) {
        // Αποστολή email επιβεβαίωσης στον χρήστη
        try {
            $mail->setFrom($senderEmail, $senderName);
            $mail->addAddress($email);
            $mail->isHTML(false);
            $mail->Subject = $subject;
            $mail->Body    = $messageBody;

            $mail->send();
        } catch (Exception $e) {
        }
    } else {
    }
}

$conn->close();
}

?>
</body>


</html>