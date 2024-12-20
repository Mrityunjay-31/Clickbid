<?php
    include 'backend/connection.php';
    session_start();
    $user_id = $_SESSION['user_id'];
    $sql = "Select * from user where user_id= '$user_id'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num>0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['user_name'] = $row['username'];
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Real-Time Auction</title>
    <link rel="stylesheet" href="livebid.css">
    <link rel="stylesheet" href="userbidhistory.css">
    <link rel="stylesheet" href="upcomingproject.css">
    <link rel="stylesheet" href="bidtestomonial.css">
    <link rel="stylesheet" href="liveleaderboard.css">
    <link rel="stylesheet" href="upskilfooter.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
    /* styles.css */

    /* Existing root and global styles */
    :root {
        --primary-color: #349b37;
        --secondary-color: #ff9800;
        --background-color: #f0f4f8;
        --card-background: #ffffff;
        --text-color: #333333;
        --highlight-color: #f44336;
        --box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        --border-radius: 12px;
        --transition: 0.3s ease-in-out;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Arial', sans-serif;
        background: var(--background-color);
        color: var(--text-color);
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        /* Ensure the body takes full height */
    }

    /* Ensure the main content area takes the remaining space */
    main {
        flex: 1;
        /* Allow this section to expand and fill space */
    }

    /* Header styles (unchanged) */
    .header {
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 2rem;
        text-align: center;
        box-shadow: var(--box-shadow);
        border-bottom-left-radius: var(--border-radius);
        border-bottom-right-radius: var(--border-radius);
    }

    .header h1 {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
    }

    /* Navbar styles (unchanged) */
    .navbar {
        display: flex;
        justify-content: space-between;
        padding: 1rem;
        background: var(--primary-color);
        box-shadow: var(--box-shadow);
    }

    .navbar ul {
        display: flex;
        gap: 1rem;
    }

    .navbar ul li {
        list-style: none;
    }

    .navbar ul li a {
        color: white;
        text-decoration: none;
        padding: 0.5rem 1rem;
        border-radius: var(--border-radius);
        transition: background var(--transition);
    }

    .navbar ul li a:hover {
        background: var(--secondary-color);
    }

    /* Auction container styles */
    .auction-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        padding: 2rem;
        flex-grow: 1;
        /* Ensure auction items expand to fill available space */
    }

    /* Auction card styles */
    .auction-card {
        background: var(--card-background);
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 1.5rem;
        transition: transform var(--transition), box-shadow var(--transition);
        max-height: 400px;
        /* Limit card height */
        overflow: hidden;
        /* Ensure excess content doesn't overflow */
    }

    .auction-card:hover {
        transform: scale(1.05);
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
    }

    .auction-card h2 {
        font-size: 1.5rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .details {
        margin-bottom: 1rem;
    }

    .timer {
        font-size: 1.2rem;
        color: var(--secondary-color);
        margin: 0.5rem 0;
        font-weight: bold;
    }

    .bid-section {
        display: flex;
        gap: 0.5rem;
    }

    input[type="number"] {
        flex: 1;
        padding: 0.5rem;
        font-size: 1rem;
        border: 1px solid #ddd;
        border-radius: var(--border-radius);
        outline: none;
        transition: border var(--transition);
    }

    input[type="number"]:focus {
        border: 1px solid var(--secondary-color);
    }

    .place-bid-btn {
        padding: 0.5rem 1rem;
        font-size: 1rem;
        color: white;
        background: var(--secondary-color);
        border: none;
        border-radius: var(--border-radius);
        cursor: pointer;
        transition: background var(--transition);
    }

    .place-bid-btn:hover {
        background: var(--highlight-color);
    }

    .message {
        margin-top: 1rem;
        font-size: 1rem;
        font-weight: bold;
        color: var(--highlight-color);
    }

    /* Bid History */
    .bid-history {
        margin-top: 20px;
        border-top: 1px solid #ddd;
        padding-top: 10px;
    }

    .bid-history h3 {
        font-size: 1.1rem;
        color: #333;
    }

    .bid-history ul {
        list-style-type: none;
        padding-left: 0;
    }

    .bid-history li {
        padding: 5px 0;
        font-size: 0.9rem;
        color: #555;
    }

    .bid-history li span {
        font-weight: bold;
    }

    /* Footer styles */
    .footer {
        background-color: #1a1a1a;
        color: #fff;
        padding: 50px 20px;
        font-family: 'Poppins', sans-serif;
        margin-top: 50px;
        flex-shrink: 0;
        /* Prevent footer from shrinking */
    }

    .footer-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Footer About */
    .footer-about {
        flex: 1;
        min-width: 300px;
    }

    .footer-about h3 {
        font-size: 1.5em;
        margin-bottom: 15px;
        color: #ffb400;
    }

    .footer-about p {
        font-size: 1em;
        line-height: 1.6;
        margin-bottom: 15px;
    }

    .btn-footer {
        display: inline-block;
        background-color: #ffb400;
        color: #1a1a1a;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: background 0.3s ease;
    }

    .btn-footer:hover {
        background-color: #e6a200;
    }

    /* Footer Links */
    .footer-links {
        flex: 1;
        min-width: 200px;
    }

    .footer-links h3 {
        font-size: 1.5em;
        margin-bottom: 15px;
        color: #ffb400;
    }

    .footer-links ul {
        list-style: none;
        padding: 0;
    }

    .footer-links li {
        margin-bottom: 10px;
    }

    .footer-links a {
        text-decoration: none;
        color: #fff;
        font-size: 1em;
        transition: color 0.3s ease;
    }

    .footer-links a:hover {
        color: #ffb400;
    }

    /* Footer Contact */
    .footer-contact {
        flex: 1;
        min-width: 300px;
    }

    .footer-contact h3 {
        font-size: 1.5em;
        margin-bottom: 15px;
        color: #ffb400;
    }

    .footer-contact p {
        font-size: 1em;
        line-height: 1.6;
        margin-bottom: 10px;
    }

    .footer-contact a {
        text-decoration: none;
        color: #ffb400;
    }

    .social-icons {
        display: flex;
        gap: 15px;
        margin-top: 10px;
    }

    .social-icons a img {
        width: 30px;
        height: 30px;
        transition: transform 0.3s ease;
    }

    .social-icons a:hover img {
        transform: scale(1.2);
    }

    /* Footer Bottom */
    .footer-bottom {
        margin-top: 30px;
        text-align: center;
        border-top: 1px solid #444;
        padding-top: 20px;
    }

    .footer-bottom p {
        font-size: 1em;
        margin-bottom: 10px;
    }

    .footer-bottom-links {
        list-style: none;
        display: flex;
        justify-content: center;
        gap: 15px;
        padding: 0;
    }

    .footer-bottom-links a {
        text-decoration: none;
        color: #ffb400;
        font-size: 1em;
        transition: color 0.3s ease;
    }

    .footer-bottom-links a:hover {
        color: #e6a200;
    }
    </style>
</head>

<body>
    <nav class="navbar">
        <ul>
            <li><a href="userfunction.php">Dashboard</a></li>
            <li><a href="#upcoming">Upcoming Auctions</a></li>
            <li><a href="#faq-container">FAQ</a></li>
            <li><a href="#tests">Testimonials</a></li>
        </ul>
    </nav>
    <header class="header">
        <h1>Real-Time Auction Platform</h1>
        <p>Participate in live bidding for exclusive projects and items!</p>
    </header>

    <main class="auction-container">
        <?php
        include 'backend/connection.php';
        $sql = "SELECT * FROM projects WHERE status= 'LIVE'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $deadline = $row['deadline']; 
                $deadlineTimestamp = strtotime($deadline) * 1000;
                $project_id = $row['project_id'];
                echo '
                    <div class="auction-card">
                        <h2>Project: '.$row['project_name'].'</h2>
                        <div class="details">
                            <p>Starting Bid: <strong>$'.$row['price'].'</strong></p>
                            <p>Current Bid: <span id="currentBid">$'.$row['price'].'</span></p>
                            <div class="timer" id="timer">Time Remaining:</div>
                        </div>
                        <input type="number" id="bidInput" name="bid" placeholder="Enter your bid">
                        <button class="place-bid-btn" data-id="1" id="'.$project_id.'">Place Bid</button>
                        <br>
                        <span id="bidMessage" class="message"></span>
                    </div>
                ';
            }
        }
        ?>
        <script>
        var deadline = <?php echo $deadlineTimestamp; ?>;
        var countdownFunction = setInterval(function() {
            var now = new Date().getTime();

            var distance = deadline - now;

            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("timer").innerHTML = "Time Remaining: " + hours + "h " + minutes + "m " +
                seconds + "s ";

            if (distance < 0) {
                clearInterval(countdownFunction);
                document.getElementById("timer").innerHTML = "Auction Ended";
            }
        }, 1000);

        $(document).ready(function() {
            $(".place-bid-btn").on("click", function(event) {
                var auctionCard = $(this).closest('.auction-card');

                var currentBidElement = auctionCard.find("#currentBid");
                var currentBid = parseFloat(currentBidElement.text().replace('$', '').trim());

                var startingBid = parseFloat(auctionCard.find("p").first().text().replace(
                    'Starting Bid: $', '').trim());

                var newBidInput = auctionCard.find("input[type='number']");
                var newBid = parseFloat(newBidInput.val());

                if (currentBid == startingBid) {
                    if (newBid > startingBid) {
                        var pid = $(this).attr('id');
                        $.ajax({
                            url: 'bidUpdate.php',
                            type: 'POST',
                            data: {
                                project_id: pid,
                                new_bid: newBid
                            }
                        });
                        alert("Bid placed successfully");
                        currentBidElement.text("$" + newBid.toFixed(2));

                    } else {
                        alert("Please enter a bid higher than the starting bid");
                    }
                } else {
                    if (currentBid > newBid) {
                        alert("Please enter a bid higher than the Current bid");
                    }
                }
            });
        });
        </script>

    </main>
    <main>
        <header>
            Leaderboard & Bidding History
        </header>

        <div class="container">
            <!-- Leaderboard Section -->
            <div class="card">
                <h2>Leaderboard</h2>
                <ul class="leaderboard">
                    <li>
                        <span>1. Aarav Patel</span>
                        <span>2500 Points</span>
                    </li>
                    <li>
                        <span>2. Priya Singh</span>
                        <span>2300 Points</span>
                    </li>
                    <li>
                        <span>3. Rahul Desai</span>
                        <span>2000 Points</span>
                    </li>
                    <li>
                        <span>4. Neha Gupta</span>
                        <span>1800 Points</span>
                    </li>
                    <li>
                        <span>5. Rohan Kumar</span>
                        <span>1600 Points</span>
                    </li>
                </ul>
            </div>

            <!-- Bidding History Section -->
            <div class="card">
                <h2>Bidding History</h2>
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Bid Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody id="history-body">
                        <tr>
                            <td>Mobile App Development</td>
                            <td>$1500</td>
                            <td>Live</td>
                            <td>2024-12-01</td>
                        </tr>
                        <tr>
                            <td>Website Redesign</td>
                            <td>$2000</td>
                            <td>End</td>
                            <td>2024-12-02</td>
                        </tr>
                        <tr>
                            <td>SEO Optimization</td>
                            <td>$1200</td>
                            <td>Live</td>
                            <td>2024-12-03</td>
                        </tr>
                        <tr>
                            <td>UI/UX Design</td>
                            <td>$950</td>
                            <td>End</td>
                            <td>2024-12-04</td>
                        </tr>
                        <tr>
                            <td>E-commerce Development</td>
                            <td>$3000</td>
                            <td>End</td>
                            <td>2024-12-05</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- JavaScript to swap rows automatically -->
            <script>
            // Function to swap rows in the table
            function swapRows() {
                const tbody = document.getElementById('history-body');
                const rows = Array.from(tbody.rows); // Get all rows as an array

                // Swap first and second rows
                if (rows.length > 1) {
                    const firstRow = rows[0];
                    const secondRow = rows[1];

                    // Swap the content of the rows
                    tbody.appendChild(firstRow); // Move the first row to the end
                    tbody.insertBefore(secondRow, firstRow); // Insert the second row before the first
                }
            }

            // Initialize the swapping every 5 seconds
            setInterval(swapRows, 5000); // Swap rows every 5 seconds
            </script>


        </div>
        <br>
        <header id="upcoming">
            Upcoming Auctions & Countdown Timer
        </header>

        <div class="container1">
            <!-- Project 1 -->
            <div class="project-card" id="project1">
                <h3>Smart Home Automation</h3>
                <p>Get ready for the auction of the Smart Home Automation system. Bid on state-of-the-art home tech and
                    devices to elevate your home to the next level of automation!</p>
                <div class="countdown" id="countdown1">
                    <span>Countdown: </span><span id="time1">Loading...</span>
                </div>
            </div>

            <!-- Project 2 -->
            <div class="project-card" id="project2">
                <h3>Electric Car Prototype</h3>
                <p>Our exclusive auction for the Electric Car Prototype is coming soon. Place your bids on innovative
                    eco-friendly vehicles that will change the future of transportation!</p>
                <div class="countdown" id="countdown2">
                    <span>Countdown: </span><span id="time2">Loading...</span>
                </div>
            </div>

            <!-- Project 3 -->
            <div class="project-card" id="project3">
                <h3>Artificial Intelligence for Healthcare</h3>
                <p>Be part of the revolution in healthcare with AI-powered solutions. Bid on groundbreaking technology
                    that will transform medical diagnostics and patient care!</p>
                <div class="countdown" id="countdown3">
                    <span>Countdown: </span><span id="time3">Loading...</span>
                </div>
            </div>

            <!-- Project 4 -->
            <div class="project-card" id="project4">
                <h3>Quantum Computing Development</h3>
                <p>The future of computing is quantum! Join us in bidding for cutting-edge quantum computing
                    technologies that will power the next generation of advancements in tech.</p>
                <div class="countdown" id="countdown4">
                    <span>Countdown: </span><span id="time4">Loading...</span>
                </div>
            </div>

            <!-- Project 5 -->
            <div class="project-card" id="project5">
                <h3>Blockchain for Secure Transactions</h3>
                <p>Explore the world of secure digital transactions with our Blockchain technology auction. Bid on
                    innovative blockchain solutions that promise to enhance security and transparency!</p>
                <div class="countdown" id="countdown5">
                    <span>Countdown: </span><span id="time5">Loading...</span>
                </div>
            </div>

            <!-- Project 6 -->
            <div class="project-card" id="project6">
                <h3>Space Exploration Innovations</h3>
                <p>Join the race for space with our auction featuring the latest technologies for space exploration. Bid
                    on exclusive items related to satellite systems, rockets, and more!</p>
                <div class="countdown" id="countdown6">
                    <span>Countdown: </span><span id="time6">Loading...</span>
                </div>
            </div>
        </div>

        <br>
        <header class="leaderboard-header">
            <h1>Live Auction Leaderboard</h1>
        </header>
        <section class="leaderboard">
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Name</th>
                        <th>Project</th>
                        <th>Bid Amount</th>
                    </tr>
                </thead>
                <tbody id="leaderboard-body">
                    <!-- Dynamic rows inserted here -->
                </tbody>
            </table>
        </section>

        <!-- JavaScript to make leaderboard rows interchange automatically -->
        <script>
        // Sample leaderboard data
        const leaderboardData = [{
                rank: 1,
                name: 'Raj Patel',
                project: 'Project Alpha',
                bidAmount: '₹15000'
            },
            {
                rank: 2,
                name: 'Anjali Sharma',
                project: 'Project Beta',
                bidAmount: '₹12000'
            },
            {
                rank: 3,
                name: 'Amit Verma',
                project: 'Project IoT',
                bidAmount: '₹10000'
            },
            {
                rank: 4,
                name: 'Priya Singh',
                project: 'Iron Man Suit',
                bidAmount: '₹9000'
            }
        ];

        // Function to display leaderboard
        function displayLeaderboard() {
            const leaderboardBody = document.getElementById('leaderboard-body');
            leaderboardBody.innerHTML = ''; // Clear current leaderboard data

            leaderboardData.forEach((data) => {
                const row = document.createElement('tr');

                row.innerHTML = `
                <td>${data.rank}</td>
                <td>${data.name}</td>
                <td>${data.project}</td>
                <td>${data.bidAmount}</td>
            `;

                leaderboardBody.appendChild(row);
            });
        }

        
        function swapRows() {
            const firstRow = leaderboardData.shift(); 
            leaderboardData.push(firstRow); 
            displayLeaderboard();
        }
        displayLeaderboard();
        setInterval(swapRows, 5000); 
        </script>
        <br>
        <section class="testimonials-grid" id="tests">
            <h2>What Our Winners Say</h2>
            <div class="grid-container">
                <div class="testimonial-card">
                    <div class="card-header">
                        <img src="img-folder/360_F_243123463_zTooub557xEWABDLk0jJklDyLSGl2jrr.jpg" alt="Rajesh Kumar"
                            class="avatar">
                        <div class="card-info">
                            <h4>Rajesh Kumar</h4>
                            <span class="project-name">Project Bharat 2.0</span>
                        </div>
                    </div>
                    <p class="quote">"The auction for Project Bharat 2.0 was an incredible experience! The platform was
                        easy to use, and I’m excited to be part of such a groundbreaking initiative."</p>
                </div>
                <div class="testimonial-card">
                    <div class="card-header">
                        <img src="img-folder/360_F_243123463_zTooub557xEWABDLk0jJklDyLSGl2jrr.jpg" alt="Priya Patel"
                            class="avatar">
                        <div class="card-info">
                            <h4>Priya Patel</h4>
                            <span class="project-name">Smart Agriculture System</span>
                        </div>
                    </div>
                    <p class="quote">"Bidding for the Smart Agriculture System was an exciting challenge! I love the
                        innovation and can't wait to see the positive impact it will have on farming in India."</p>
                </div>
                <div class="testimonial-card">
                    <div class="card-header">
                        <img src="img-folder/360_F_243123463_zTooub557xEWABDLk0jJklDyLSGl2jrr.jpg" alt="Amit Sharma"
                            class="avatar">
                        <div class="card-info">
                            <h4>Amit Sharma</h4>
                            <span class="project-name">Electric Auto Rickshaw</span>
                        </div>
                    </div>
                    <p class="quote">"Winning the Electric Auto Rickshaw auction was a major win for me. The system was
                        fast, and I love being part of a greener, more sustainable future for India."</p>
                </div>
                <div class="testimonial-card">
                    <div class="card-header">
                        <img src="img-folder/360_F_243123463_zTooub557xEWABDLk0jJklDyLSGl2jrr.jpg" alt="Sanya Gupta"
                            class="avatar">
                        <div class="card-info">
                            <h4>Sanya Gupta</h4>
                            <span class="project-name">Renewable Energy Solutions</span>
                        </div>
                    </div>
                    <p class="quote">"The bidding experience for the Renewable Energy Solutions project was seamless and
                        exciting! I’m looking forward to seeing how this will transform India's energy landscape."</p>
                </div>
            </div>
        </section>

        </div>


        </div>

        <div id="faq-container">
            <h2 class="faq-title">Frequently Asked Questions</h2>

            <div class="faq-item">
                <div class="faq-question">How do I place a bid?</div>
                <div class="faq-answer">
                    To place a bid, enter your desired amount in the input box and click on "Place Bid." Ensure your bid
                    is higher than the current bid, or you will be prompted to adjust it before confirming your bid
                    submission.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">What happens if I'm outbid?</div>
                <div class="faq-answer">
                    If you're outbid, you’ll receive a notification. You can either increase your bid or withdraw from
                    the auction. To stay in the running, your new bid must exceed the current highest bid by the minimum
                    increment specified.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">Can I retract a bid?</div>
                <div class="faq-answer">
                    No, once a bid is placed, it cannot be retracted. Bidding is binding, so please be sure about your
                    offer before placing it. If you encounter any issues, contact customer support immediately for
                    guidance.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">What happens when the timer runs out?</div>
                <div class="faq-answer">
                    When the timer ends, the highest bid wins the auction item. You’ll receive a notification with
                    details about your win or further steps if you were outbid. Make sure to keep an eye on the timer to
                    avoid surprises!
                </div>
            </div>
        </div>

        <!-- JavaScript to make FAQ functional -->
        <script>
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            const answer = item.querySelector('.faq-answer');

            // Initially hide all answers
            answer.style.display = 'none';

            // Toggle the answer when a question is clicked
            question.addEventListener('click', () => {
                const isVisible = answer.style.display === 'block';
                answer.style.display = isVisible ? 'none' : 'block';
            });
        });
        </script>

    </main>
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
                <div class="social-icons">
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

    <!-- <script src="script1.js"></script> -->
</body>

</html>