function editProfile() {
    const username = prompt("Enter new username:", document.querySelector('.username').innerText);
    const email = prompt("Enter new email:", document.querySelector('.profile-body p strong').nextElementSibling.innerText);
    const phone = prompt("Enter new phone number:", document.querySelector('.profile-body p:nth-of-type(2) strong').nextElementSibling.innerText);
    const location = prompt("Enter new location:", document.querySelector('.profile-body p:nth-of-type(3) strong').nextElementSibling.innerText);

    if (username) {
        document.querySelector('.username').innerText = username;
    }
    if (email) {
        document.querySelector('.profile-body p strong').nextElementSibling.innerText = email;
    }
    if (phone) {
        document.querySelector('.profile-body p:nth-of-type(2) strong').nextElementSibling.innerText = phone;
    }
    if (location) {
        document.querySelector('.profile-body p:nth-of-type(3) strong').nextElementSibling.innerText = location;
    }
}
// auction result page 
document.addEventListener("DOMContentLoaded", () => {
    // Star Rating System
    const stars = document.querySelectorAll(".star");
    stars.forEach((star, index) => {
        star.addEventListener("click", () => {
            // Clear all active stars
            stars.forEach((s) => s.classList.remove("active"));
            // Highlight the clicked star and all previous ones
            for (let i = 0; i <= index; i++) {
                stars[i].classList.add("active");
            }
        });
    });

    // Feedback Submission
    const submitFeedbackBtn = document.querySelector(".submit-feedback-btn");
    const feedbackText = document.querySelector(".feedback-text");
    const thankYouMessage = document.createElement("p");
    thankYouMessage.textContent = "Thank you for your feedback!";
    thankYouMessage.style.color = "#28a745"; // Green color for success message

    submitFeedbackBtn.addEventListener("click", () => {
        if (feedbackText.value.trim() !== "") {
            feedbackText.disabled = true;
            submitFeedbackBtn.disabled = true;
            submitFeedbackBtn.textContent = "Feedback Submitted";
            feedbackText.style.border = "1px solid #28a745";
            feedbackText.style.backgroundColor = "#e9f7e9";
            feedbackText.value = ""; // Clear the feedback field after submission
            document.querySelector(".rating-feedback").appendChild(thankYouMessage); // Show the thank you message
        } else {
            alert("Please enter some feedback before submitting.");
        }
    });

    // Progress Tracker Animation
    const progressSteps = document.querySelectorAll(".progress-step");
    let currentStep = 0;
    const totalSteps = progressSteps.length;

    function updateProgressTracker() {
        if (currentStep < totalSteps) {
            progressSteps[currentStep].classList.add("in-progress");
            setTimeout(() => {
                progressSteps[currentStep].classList.add("completed");
                currentStep++;
                updateProgressTracker();
            }, 1000); // Delay to simulate step progression
        }
    }

    // Start progress tracker animation
    updateProgressTracker();

    // Auction End Timer Countdown
    const auctionEndTimeElement = document.querySelector(".auction-end-time span");
    const auctionEndTime = new Date("2024-12-18T11:00:00").getTime(); // Set auction end time here

    function updateAuctionTimer() {
        const now = new Date().getTime();
        const timeLeft = auctionEndTime - now;

        if (timeLeft <= 0) {
            auctionEndTimeElement.textContent = "Auction has ended.";
            clearInterval(timerInterval);
        } else {
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
            auctionEndTimeElement.textContent = `${hours}h ${minutes}m ${seconds}s`;
        }
    }

    // Start the auction timer countdown
    const timerInterval = setInterval(updateAuctionTimer, 1000);

    // Related Projects - Simulated Bidding
    const bidButtons = document.querySelectorAll(".project-item a");
    bidButtons.forEach((button) => {
        button.addEventListener("click", (event) => {
            event.preventDefault();
            const projectName = button.closest(".project-item").querySelector("h3").textContent;
            const startingBid = button.closest(".project-item").querySelector("p").textContent;
            alert(`You are placing a bid on "${projectName}"\nStarting Bid: ${startingBid}`);
        });
    });

    // Message the Winner (Modal Simulation)
    const messageButton = document.querySelector(".message-btn");
    const messageModal = document.createElement("div");
    messageModal.classList.add("message-modal");
    messageModal.innerHTML = `
        <div class="modal-content">
            <h3>Send a Message to the Winner</h3>
            <textarea placeholder="Write your message here..." rows="5"></textarea>
            <button class="send-message-btn">Send Message</button>
            <button class="close-modal-btn">Close</button>
        </div>
    `;
    document.body.appendChild(messageModal);
    messageModal.style.display = "none"; // Hidden by default

    messageButton.addEventListener("click", () => {
        messageModal.style.display = "block"; // Show modal
    });

    // Close modal button functionality
    const closeModalBtn = messageModal.querySelector(".close-modal-btn");
    closeModalBtn.addEventListener("click", () => {
        messageModal.style.display = "none"; // Hide modal
    });

    // Send Message Button functionality
    const sendMessageBtn = messageModal.querySelector(".send-message-btn");
    sendMessageBtn.addEventListener("click", () => {
        alert("Your message has been sent to the winner.");
        messageModal.style.display = "none"; // Hide modal after sending message
    });
});
document.addEventListener("DOMContentLoaded", () => {
    // Sample Data for Notifications
    const notifications = [
        { type: 'outbid', message: "You have been outbid on 'Website Design for eCommerce'.", time: "2024-12-18 10:00 AM" },
        { type: 'ending', message: "Auction for 'Logo Design for Startup' is ending soon.", time: "2024-12-18 10:30 AM" },
        { type: 'won', message: "Congratulations! You have won the 'SEO Optimization for Website' auction.", time: "2024-12-18 11:00 AM" }
    ];

    // Sample Data for Personalized Alerts
    const alerts = [];

    const notificationsList = document.getElementById("notifications-list");
    const alertsList = document.getElementById("alerts-list");

    // Display Notifications
    notifications.forEach(notification => {
        const notificationItem = document.createElement("div");
        notificationItem.classList.add("notification-item");
        if (notification.type === 'outbid') notificationItem.classList.add("new"); // New notification style for outbid
        notificationItem.innerHTML = `
            <p><strong>${notification.message}</strong></p>
            <small>${notification.time}</small>
        `;
        notificationsList.appendChild(notificationItem);
    });

    // Handle Personalized Alerts Form Submission
    const alertForm = document.getElementById("alert-form");
    alertForm.addEventListener("submit", (e) => {
        e.preventDefault();

        const alertItem = document.getElementById("alert-item").value;
        const alertCondition = document.getElementById("alert-condition").value;

        if (alertItem.trim() !== "") {
            const alert = { item: alertItem, condition: alertCondition };
            alerts.push(alert);
            updateAlertsList();
            alertForm.reset(); // Reset the form after adding an alert
        } else {
            alert("Please enter the auction item name.");
        }
    });

    // Update Alerts List
    function updateAlertsList() {
        alertsList.innerHTML = ""; // Clear the alerts list before updating
        alerts.forEach(alert => {
            const alertItem = document.createElement("div");
            alertItem.classList.add("alert-item");
            alertItem.innerHTML = `
                <p><strong>Alert for ${alert.item}:</strong> ${alert.condition}</p>
            `;
            alertsList.appendChild(alertItem);
        });
    }

    // Clear All Notifications
    const clearNotificationsBtn = document.getElementById("clear-notifications");
    clearNotificationsBtn.addEventListener("click", () => {
        notificationsList.innerHTML = ""; // Clear all notifications
    });

    // Search Notifications
    const searchNotificationsInput = document.getElementById("search-notifications");
    searchNotificationsInput.addEventListener("input", (e) => {
        const searchTerm = e.target.value.toLowerCase();
        const notificationItems = document.querySelectorAll(".notification-item");

        notificationItems.forEach(item => {
            const message = item.querySelector("p").textContent.toLowerCase();
            if (message.includes(searchTerm)) {
                item.style.display = "";
            } else {
                item.style.display = "none";
            }
        });
    });
});
