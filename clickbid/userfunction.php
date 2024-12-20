<?php
    include 'backend/connection.php';
    session_start();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        $sql = "Select * from user where email= '".$_SESSION['email']."'";
        $result = mysqli_query($conn, $sql);

        $num = mysqli_num_rows($result);
        if($num>0){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id']= $row['user_id'];
            $email = $row['email'];
            $_SESSION['email']= $email;
            $city = $row['city'];
            $_SESSION['city']= $city;
            $user_id = $_SESSION['user_id'];
        }
    }
    // include '_navbar.php';
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
        header("location: ../signin.html");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Project Auction Platform</title>
    <link rel="stylesheet" href="userfunction.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

</head>

<body>

    <header>
        <div class="navbar">
            <div class="logo">
                <a href="userfunction.php" style="text-decoration: none;">
                    <h2 class="logo">CLICKBID</h2>
                </a>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="userprofile.php">User Profile</a></li>
                    <li><a href="livebid.php">Live Bids</a></li>
                    <li><a href="postproject.html">Post Project</a></li>
                    <li><a href="allprojectrelated.html">Our Projects</a></li>
                    <li><a href="paymentmethod.html">Make Payment</a></li>
                    <li><a href="backend/signout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <section id="profile">
            <div class="profile-card">
                <div class="profile-image">
                    <img src="img-folder/profile-pic.webp" alt="Profile Picture">
                </div>
                <div class="profile-info">
                    <?php echo '
                                <h2>'.$_SESSION['username'].'</h2>
                                <p>Email: '.$email.'</p>
                                <p>Location: '.$city.'</p>';
                    ?>
                    <a href="edit_profile.html">
                        <button class="btn edit-profile">Edit Profile</button></a>

                </div>
            </div>
        </section>

        <section id="my-projects">
            <h2>My Projects</h2>
            <div class="project-cards">
                <?php
        $sql = "SELECT * FROM projects WHERE freelancer_id = '" . $_SESSION['user_id'] . "'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $project_id = $row['project_id'];
        ?>
                <div class="project-card card">
                    <h3><?php echo htmlspecialchars($row['project_name']); ?></h3>
                    <p>Bid Amount: $<?php echo number_format($row['price'], 2); ?></p>
                    <a href="Viewproject.php?project_id=<?php echo $project_id; ?>">
                        <button class="btn view-project">View Project</button>
                    </a>
                </div>
                <?php
            }
        } else {
            echo "<p>No projects found.</p>";
        }
        ?>
            </div>
        </section>



        <section id="my-bids">
            <h2>My Bids</h2>
            <div class="project-cards">
                <?php
                    $sql = "SELECT * FROM projects WHERE client_id = '".$_SESSION['user_id']."'";
                    $result = mysqli_query($conn, $sql);
                    
                    $num = mysqli_num_rows($result);
                    if ($num > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $project_id = $row['project_id'];
                            echo '
                                <div class="project-card card">
                                    <h3>' . $row['project_name'] . '</h3>
                                    <p>Bid Amount: $' . $row['price'] . '</p>
                                    <p>Status: ' . $row['status'] . '</p>
                                    <a href="Viewproject.php?project_id='.$project_id.'">
                                        <button class="btn view-project">View Project</button></a>
                                </div>
                            ';
                        }
                    }
                    else {
                        echo "<p>No Bids found.</p>";
                    }
                ?>
            </div>
        </section>



        <section id="notifications" class="notifications">
            <h2 class="section-title">Notifications</h2>

            <div class="notification notification-info">
                <div class="notification-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="notification-content">
                    <h3>Project Submission Reminder</h3>
                    <p>Your project submission deadline is approaching in 2 days. Lorem ipsum dolor sit amet consectetur
                        adipisicing elit. Quibusdam reprehenderit necessitatibus doloribus nobis laudantium.</p>
                </div>
                <button class="dismiss-btn"><i class="fas fa-times"></i></button>
            </div>

            <div class="notification notification-warning">
                <div class="notification-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="notification-content">
                    <h3>Important Alert</h3>
                    <p>Your project budget is close to exceeding the allocated amount. Please review your expenses.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui iure ad placeat, ratione jvvjhv.
                    </p>
                </div>
                <button class="dismiss-btn"><i class="fas fa-times"></i></button>
            </div>

            <div class="notification notification-success">
                <div class="notification-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="notification-content">
                    <h3>Task Completed</h3>
                    <p>Congratulations! The task "Research Phase" has been successfully completed. Well done! Lorem
                        ipsum dolor sit amet consectetur adipisicing elit. Soluta non hic aut exercitationem?.</p>
                </div>
                <button class="dismiss-btn"><i class="fas fa-times"></i></button>
            </div>
        </section>

        <section id="statistics">
            <h2>User Statistics</h2>

            <div class="statistics-container">
                <div class="statistics-card">
                    <h3>Total Auctions Participated</h3>
                    <p>25</p>
                    <span>Auctions</span>
                </div>

                <div class="statistics-card">
                    <h3>Total Bids Placed</h3>
                    <p>120</p>
                    <span>Bids</span>
                </div>

                <div class="statistics-card">
                    <h3>Successful Auctions</h3>
                    <p>18</p>
                    <span>Wins</span>
                </div>

                <div class="statistics-card">
                    <h3>Success Rate</h3>
                    <p>75%</p>
                    <span>Win Rate</span>
                </div>

                <div class="statistics-card">
                    <h3>Total Earnings</h3>
                    <p>$4000</p>
                    <span>Earnings</span>
                </div>


                <div class="statistics-card">
                    <h3>Active Auctions</h3>
                    <p>3</p>
                    <span>Ongoing</span>
                </div>


                <div class="statistics-card">
                    <h3>Total Items Sold</h3>
                    <p>15</p>
                    <span>Items</span>
                </div>


                <div class="statistics-card">
                    <h3>Total Bidding Activity</h3>
                    <p>200</p>
                    <span>Activities</span>
                </div>


                <div class="statistics-card">
                    <h3>Average Bid Amount</h3>
                    <p>$250</p>
                    <span>Per Auction</span>
                </div>


                <div class="statistics-card">
                    <h3>Recently Completed Auctions</h3>
                    <p>5</p>
                    <span>Completed</span>
                </div>
            </div>
        </section>


        <!-- Transaction History Section -->
        <section id="transaction-history">
            <h2>Transaction History</h2>

            <div class="transaction-summary">
                <div class="summary-card">
                    <h3>Total Transactions</h3>
                    <p>25</p>
                </div>
                <div class="summary-card">
                    <h3>Total Spending</h3>
                    <p>$10,000</p>
                </div>
                <div class="summary-card">
                    <h3>Successful Transactions</h3>
                    <p>20</p>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="transaction-filter">
                <input type="text" placeholder="Search by Auction Name" id="search-transactions" class="search-box">
                <select id="transaction-status" class="filter-box">
                    <option value="">Filter by Status</option>
                    <option value="completed">Completed</option>
                    <option value="pending">Pending</option>
                    <option value="failed">Failed</option>
                </select>
            </div>

            <table class="transaction-table">
                <thead>
                    <tr>
                        <th>Auction</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="completed">
                        <td>Gold Watch</td>
                        <td>$1,000</td>
                        <td><span class="status completed">Completed</span></td>
                        <td>2024-11-20</td>
                    </tr>
                    <tr class="pending">
                        <td>Vintage Painting</td>
                        <td>$500</td>
                        <td><span class="status pending">Pending</span></td>
                        <td>2024-11-22</td>
                    </tr>
                    <tr class="failed">
                        <td>Old Camera</td>
                        <td>$300</td>
                        <td><span class="status failed">Failed</span></td>
                        <td>2024-11-18</td>
                    </tr>
                </tbody>
            </table>
        </section>


        <!-- Testimonials Section -->
        <section id="testimonials">
            <h2>What Our Users Are Saying</h2>
            <div class="testimonials-carousel">
                <div class="testimonial-card">
                    <p>"ClickBid has revolutionized the way we handle project bids. It's easy to use and ensures we find
                        the right talent for every project!"</p>
                    <span>- Aarav Patel</span>
                </div>
                <div class="testimonial-card">
                    <p>"The platform is a game-changer. We've been able to connect with top professionals for our
                        projects and streamline our hiring process."</p>
                    <span>- Priya Singh</span>
                </div>
                <div class="testimonial-card">
                    <p>"ClickBid made it so simple to post our project requirements and get bids from qualified
                        freelancers. It's truly a time-saver!"</p>
                    <span>- Rahul Desai</span>
                </div>
            </div>
        </section>

        <section id="faq">
            <h2>Frequently Asked Questions</h2>
            <div class="faq-item">
                <button class="faq-question">How do I place a bid?</button>
                <div class="faq-answer">
                    <p>To place a bid on a project, first sign up for an account on ClickBid. Once logged in, browse
                        through the available project auctions, and select the project you're interested in. On the
                        project page, you’ll see a section to enter your bid amount along with any additional details
                        you might want to include. After entering your bid, click the 'Place Bid' button to submit it.
                        Keep an eye on the project to see if your bid is accepted or if other participants place higher
                        bids.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">How do I create a project auction?</button>
                <div class="faq-answer">
                    <p>Creating a project auction on ClickBid is simple and straightforward. Once you've logged into
                        your account, navigate to the "Create Auction" section from your dashboard. You'll be prompted
                        to provide detailed information about the project, including the project description, required
                        skills, deadline, and budget. Additionally, you can upload any relevant files or project
                        specifications to help bidders understand your requirements. Once all fields are filled out,
                        click 'Submit Auction' to publish it and start receiving bids from qualified professionals.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">What types of projects can I post on ClickBid?</button>
                <div class="faq-answer">
                    <p>ClickBid allows you to post a wide range of projects, from software development and web design to
                        marketing, content writing, and even consulting. Whether you're a startup looking for a web
                        developer or a company seeking a digital marketing expert, ClickBid is the platform to connect
                        with top professionals. You can post both short-term and long-term projects, and you have the
                        flexibility to set project milestones, deadlines, and budgets as per your needs.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">How can I manage the progress of my project after placing a bid?</button>
                <div class="faq-answer">
                    <p>Once your bid is accepted, ClickBid provides a comprehensive project management dashboard to help
                        you track progress. You can communicate with the project owner or freelancer directly through
                        the platform's messaging system, set milestones, and receive regular updates. In addition, you
                        can review the work completed so far, provide feedback, and make any necessary adjustments. The
                        platform also allows you to approve or reject completed work at each milestone to ensure
                        everything is on track and meets your expectations.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">Is there any fee to use ClickBid?</button>
                <div class="faq-answer">
                    <p>ClickBid is free to sign up and browse through the available projects. However, there are fees
                        associated with placing bids on certain high-value projects and receiving payment for completed
                        work. The exact fee structure is transparent and available in the platform's terms and
                        conditions. The fees are designed to cover administrative and transaction costs, and they vary
                        depending on the project size and type. You can always check the fee details before confirming a
                        bid or receiving payments.</p>
                </div>
            </div>
        </section>

        <script>
        const faqQuestions = document.querySelectorAll('.faq-question');
        faqQuestions.forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
            });
        });
        </script>



        <!-- Activity Feed Section -->

        <section id="activity-feed">
            <h2>Activity Feed</h2>
            <ul class="feed-list">
                <li><i class="fas fa-bid"></i> Placed a bid on "Mobile App Development" project - $1500 <span
                        class="timestamp">2 hours ago</span></li>
                <li><i class="fas fa-check-circle"></i> Won auction for "Website Redesign" project - $2500 <span
                        class="timestamp">1 day ago</span></li>
                <li><i class="fas fa-plus-circle"></i> Created a new auction for "E-commerce Platform Development"
                    project - $10000 starting bid <span class="timestamp">3 days ago</span></li>
            </ul>
        </section>



        <!-- Upcoming Projects Section -->
        <h2 id="up-h2">Upcoming Projects</h2>
        <section id="upcoming-projects">
            <div class="project-card">
                <h3>Mobile App Development</h3>
                <p>Starting Bid: $5000</p>
                <p>Start Time: 2025-01-20 10:00 AM</p>
                <button class="btn">View Project</button>
            </div>
            <div class="project-card">
                <h3>Website Redesign</h3>
                <p>Starting Bid: $2000</p>
                <p>Start Time: 2025-01-02 12:00 PM</p>
                <button class="btn">View Project</button>
            </div>
            <div class="project-card">
                <h3>SEO Optimization</h3>
                <p>Starting Bid: $3000</p>
                <p>Start Time: 2024-12-30 2:00 PM</p>
                <button class="btn">View Project</button>
            </div>
            <div class="project-card">
                <h3>UI/UX Design</h3>
                <p>Starting Bid: $2500</p>
                <p>Start Time: 2024-12-25 2:00 PM</p>
                <button class="btn">View Project</button>
            </div>
            <div class="project-card">
                <h3>CRM Development</h3>
                <p>Starting Bid: $2600</p>
                <p>2024-12-30 11:00 AM</p>
                <button class="btn">View Project</button>
            </div>
        </section>
        <a href="#up-h2" class="upbtn">View All</a>

        <!-- Payment Methods Section -->
        <section id="payment-methods">
            <h2>Manage Payment Methods</h2>
            <div class="payment-card">
                <h3>Credit Card</h3>
                <p>Visa ending in 6434</p>
                <button class="btn">Remove</button>
            </div>
            <div class="payment-card">
                <h3>PayPal</h3>
                <p>pratik.mohanty@email.com</p>
                <button class="btn">Remove</button>
            </div>
        </section>


        <section id="wishlist">
            <h2>Your Wishlist</h2>
            <div class="wishlist-item">
                <p>Mobile App Development for E-commerce</p>
                <button class="btn">Remove</button>
            </div>
            <div class="wishlist-item">
                <p>UI/UX Design for Mobile App</p>
                <button class="btn">Remove</button>
            </div>
        </section>


        <!-- Security & Privacy Section -->
        <section id="security-settings">
            <h2>Security & Privacy</h2>

            <div class="security-option">
                <h3>Change Password</h3>
                <p>Update your password for better security.</p>
                <a href="backend/change_pass.php"><button class="btn">Change Password</button></a>
            </div>

            <div class="security-option">
                <h3>Two-Factor Authentication</h3>
                <p>Enhance your account security by enabling Two-Factor Authentication.</p>
                <button class="btn">Enable 2FA</button>
            </div>

            <div class="security-option">
                <h3>Privacy Settings</h3>
                <p>Control who can view your personal information and activity.</p>
                <button class="btn">Manage Privacy</button>
            </div>

            <div class="security-option">
                <h3>Login Activity</h3>
                <p>Review recent login attempts to ensure your account is secure.</p>
                <button class="btn">View Login Activity</button>
            </div>

            <div class="security-option">
                <h3>Account Recovery Options</h3>
                <p>Update your recovery options to make account recovery easier.</p>
                <button class="btn">Update Recovery Options</button>
            </div>

            <div class="security-option">
                <h3>Data Deletion</h3>
                <p>If you wish to delete your account or request a data download, click below.</p>
                <a href="backend/delete_account.php"><button class="btn" data-bs-toggle="modal"
                        data-bs-target="#deleteModal">Delete Account</button></a>
                <button class="btn">Download Data</button>
            </div>
        </section>
    </main>
    <div>
        <footer class="footer ">
            <div class="footer-container ">
                <!-- About Section -->
                <div class="footer-about ">
                    <h3>About Bid Web Auction</h3>
                    <p>Bid Web Auction is your trusted platform for bidding on projects and connecting with top talent
                        worldwide. Empowering businesses and professionals to succeed together.</p>
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
                    <div class="social-icons" style="margin-left: 140px;">
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
    </div>




    <script src="script2.js"></script>
</body>

</html>