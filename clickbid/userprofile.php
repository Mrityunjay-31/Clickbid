<?php 
    include 'backend/connection.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="userprofile.css">
</head>
<body>

    <div class="profile-container">
        <div class="profile-card">
        <div class="profile-header">
            <div class="profile-img-container">
                    <img src="https://media.istockphoto.com/id/1300845620/vector/user-icon-flat-isolated-on-white-background-user-symbol-vector-illustration.jpg?s=612x612&w=0&k=20&c=yBeyba0hUkh14_jgv1OKqIH0CCSWU_4ckRkAoy2p73o=" alt="User" class="profile-img">
                </div>
                <h2 class="username"><?php echo $_SESSION['username'];?></h2>
                <p class="role">Auction Enthusiast</p>
            </div>

            <div class="profile-body">
                <h3>Contact Information</h3>
                <p><strong>Email:</strong> <?php echo $_SESSION['email'];?></p>
                <p><strong>Phone:</strong> +91 9437852495</p>
                <p><strong>Location:</strong> <?php echo $_SESSION['city'];?></p>
            </div>

            <div class="profile-footer">
            <a href="edit_profile.html" style="text-decoration: none;">
                <button>Edit Profile</button></a>
                <div class="bid-history">
                    <h3>Bid History</h3>
                    <ul>
                        <li><span>Ai-Chatbot</span> - $100</li>
                        <li><span>Text to Video</span> - $250</li>
                        <li><span>Digilocker</span> - $50</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="script3.js"></script>
</body>
</html>

