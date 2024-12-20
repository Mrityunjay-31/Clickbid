<?php
session_start();
include('backend/connection.php');

if (isset($_GET['project_id']) && !empty($_GET['project_id'])) {
    $project_id = $_GET['project_id'];
} else {
    die("Project ID is required.");
}

$sql = "SELECT * FROM projects WHERE project_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $project_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $project_name = htmlspecialchars($row['project_name']);
    $description = htmlspecialchars($row['description']);
    $category = htmlspecialchars($row['category']);
    $client_name = htmlspecialchars($row['client_name']);
    $price = number_format($row['price'], 2);  
    $bid_start_date = htmlspecialchars($row['bidding_date']);
    $deadline = htmlspecialchars($row['deadline']);
    $skills_required = explode(",", $row['skills']); 
    $features = explode(",", $row['features']);  
    $contact = $row['contact'];
} else {
    echo '<script>alert("Project Not Found");
    window.open("userfunction.php","_self");
    </script>';
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>
    <link rel="stylesheet" href="viewproject.css">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <a href="userfunction.php" style="text-decoration: none;">
                <h2 class="logo">CLICKBID</h2>
            </a>
            <nav class="navigation">
                <ul>
                    <li><a href="Hirefreelancer.html">Hire Freelancer</a></li>
                    <li><a href="findwork.html">Find Work</a></li>
                    <li><a href="postproject.html">Post a Project</a></li>
                    <li><a href="aboutpage.html">About</a></li>
                    <li><a href="backend/signout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <section class="project-details">
        <div class="project-card">
            <div class="card-header">
                <h2>Project Name: <span><?php echo $project_name; ?></span></h2>
            </div>
            <div class="card-body">
                <div class="project-info">
                    <div class="info-item">
                        <strong>Description:</strong>
                        <p><?php echo $description; ?></p>
                    </div>
                    <div class="info-item">
                        <strong>Category:</strong>
                        <p><?php echo $category; ?></p>
                    </div>
                    <div class="info-item">
                        <strong>Client Name:</strong>
                        <p><?php echo $client_name; ?></p>
                    </div>
                    <div class="info-item">
                        <strong>Bidding Price:</strong>
                        <p>₹<?php echo $price; ?></p>
                    </div>
                    <div class="info-item">
                        <strong>Bid Start Date:</strong>
                        <p><?php echo $bid_start_date; ?></p>
                    </div>
                    <div class="info-item">
                        <strong>Deadline:</strong>
                        <p><?php echo $deadline; ?></p>
                    </div>
                    <div class="info-item">
                        <strong>Skills Required:</strong>
                        <ul>
                            <?php foreach ($skills_required as $skill): ?>
                            <li><?php echo htmlspecialchars($skill); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="info-item">
                        <strong>Features:</strong>
                        <ul>
                            <?php foreach ($features as $feature): ?>
                            <li><?php echo htmlspecialchars($feature); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="tel:<?= $contact; ?>" class="contact-btn" style="text-decoration:none;">Contact Client</a>
            </div>
        </div>
    </section>
    <footer class="footer ">
        <div class="footer-container ">
            <!-- About Section -->
            <div class="footer-about ">
                <h3>About Bid Web Auction</h3>
                <p>Bid Web Auction is your trusted platform for bidding on projects and connecting with top talent worldwide. Empowering businesses and professionals to succeed together.</p>
                <a href="aboutpage.html" class="btn-footer ">Learn More</a>
            </div>

            <!-- Quick Links Section -->
            <div class="footer-links ">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="Auctionresult.html">Auction Result</a></li>
                    <li><a href="blogornews.html">Blog and News</a></li>
                    <li><a href="#">How It Works</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>

            <!-- Contact Section -->
            <div class="footer-contact ">
                <h3>Contact Us</h3>
                <p>Email: <a href="mailto:support@clickbid.com ">support@clickbid.com</a></p>
                <p>Phone: +91 9876543210</p>
                <p>Address: Bhubaneswar, Odisha, India</p>
                <div class="social-icons" style="margin-left: 140px">
                    <a href="https://www.facebook.com" target="_blank" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.twitter.com" target="_blank" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com" target="_blank" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="https://www.instagram.com" target="_blank" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom ">
            <p>&copy; 2024 CLICKBID Web Auction. All rights reserved.</p>
            <ul class="footer-bottom-links ">
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#faq">FAQs</a></li>
            </ul>
        </div>
    </footer>
    <script src="scripts.js"></script>
</body>
</html>
