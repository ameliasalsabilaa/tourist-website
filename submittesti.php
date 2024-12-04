<?php 
require_once 'config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['namatesti'];
    $email = $_POST['emailtesti'];
    $message = $_POST['pesantesti'];

    $stmt = $koneksi->prepare("INSERT INTO testimonials (namatesti, emailtesti, pesantesti) VALUES (?, ?, ?)");
    
    $stmt->bind_param("sss", $name, $email, $message);
    
    if ($stmt->execute()) {
        header('Location: index.php');
        exit(); 
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
