<?php

session_start();

// Cek login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

// Ambil informasi admin dari database
$query  = "SELECT * FROM user WHERE username = '{$_SESSION['username']}'";
$result = $db->query($query);

if ($result->num_rows == 1) {
    $adminInfo = $result->fetch_assoc();
} else {
    // Handle jika informasi admin tidak ditemukan
    echo "Failed to retrieve admin information.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profile Popup</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Gaya CSS Anda di sini */

        .profile-image {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mt-3">
                
                <h4 class="mt-2"><?php echo $adminInfo['nama']; ?></h4>
                <div class="mt-3">
                    <button class="btn btn-primary" id="profileButton">Profile</button>
                    <button class="btn btn-warning" id="signOutButton">Log Out</button>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (diperlukan jQuery) -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Fungsi untuk menangani tombol "Profile"
            document.getElementById('profileButton').addEventListener('click', function () {
                alert('Profile button clicked!'); // Gantilah dengan tindakan yang sesuai
            });

            // Fungsi untuk menangani tombol "Sign Out"
            document.getElementById('signOutButton').addEventListener('click', function () {
                // Gantilah dengan tindakan logout yang sesuai
                window.location.href = 'logout.php';
            });
        });
    </script>
</body>

</html>
