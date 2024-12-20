document.addEventListener("DOMContentLoaded", function() {

    // Notification Interaction: Toggle read/unread notifications
    const notifications = document.querySelectorAll('.notification');

    notifications.forEach(notification => {
        notification.addEventListener('click', function() {
            // Toggle the "read" class to mark notifications as read
            this.classList.toggle('read');
            if (this.classList.contains('read')) {
                this.style.backgroundColor = "#444"; // Change background on read
            } else {
                this.style.backgroundColor = "#2e2e2e"; // Reset background on unread
            }
        });
    });

    // Activity Feed: Add new activities dynamically
    const activityFeed = document.getElementById('activity-feed');
    const newActivityButton = document.createElement('button');
    newActivityButton.textContent = 'Add New Activity';
    activityFeed.appendChild(newActivityButton);

    newActivityButton.addEventListener('click', () => {
        // Simulate adding a new activity to the feed
        const newActivity = document.createElement('li');
        newActivity.textContent = 'User placed a bid on Vintage Car - $2000';
        activityFeed.querySelector('ul').appendChild(newActivity);

        // Add a fade-in animation to new activity
        newActivity.classList.add('fade-in');
    });

    // Live Auction Updates: Bid updates in real-time
    let currentBid = 1000;
    const auctionBids = document.querySelectorAll('.auction-card');

    auctionBids.forEach(card => {
        card.querySelector('.view-auction').addEventListener('click', () => {
            // Simulate updating the bid dynamically
            currentBid += 100;
            const bidElement = card.querySelector('.current-bid');
            bidElement.textContent = `Current Bid: $${currentBid}`;

            // Animate the bid change
            bidElement.classList.add('bid-change');
            setTimeout(() => {
                bidElement.classList.remove('bid-change');
            }, 1000);
        });
    });

    // Form Validation for Settings Panel
    const settingsForm = document.getElementById('settings-form');
    const submitButton = settingsForm.querySelector('button');

    settingsForm.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent form submission for validation

        const emailInput = settingsForm.querySelector('#email');
        const passwordInput = settingsForm.querySelector('#password');

        if (!emailInput.value.includes('@') || !passwordInput.value) {
            alert('Please provide valid email and password.');
            return;
        }

        // Simulate saving settings with an alert and fade-out animation
        settingsForm.classList.add('fade-out');
        setTimeout(() => {
            alert('Settings Updated!');
            settingsForm.classList.remove('fade-out');
        }, 500);
    });

    // Dark Mode Toggle
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    darkModeToggle.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
        // Save preference to local storage
        localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
    });

    // Load saved preferences (e.g., Dark Mode)
    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark-mode');
    }

    // Auto-Save Auction Changes
    const auctionItems = document.querySelectorAll('.auction-card');
    auctionItems.forEach(item => {
        const statusElement = item.querySelector('.status');
        item.querySelector('.view-auction').addEventListener('click', () => {
            // Simulate a bid and change the auction status
            statusElement.textContent = 'Status: Live - Updated';
            statusElement.classList.add('status-update');
            setTimeout(() => {
                statusElement.classList.remove('status-update');
            }, 1000);
        });
    });

    // Adding Animations for New Data (Live updates in activities)
    const fadeInElements = document.querySelectorAll('.fade-in');
    fadeInElements.forEach(element => {
        element.classList.add('fade-in-animation');
    });

    // Create a countdown timer for auction ending (e.g., 10 seconds countdown)
    const countdownElement = document.getElementById('auction-countdown');
    let countdownTime = 10; // 10 seconds countdown
    const countdownInterval = setInterval(() => {
        countdownElement.textContent = `Auction Ending in: ${countdownTime}s`;
        countdownTime--;
        if (countdownTime < 0) {
            clearInterval(countdownInterval);
            countdownElement.textContent = 'Auction Ended';
        }
    }, 1000);
});
document.querySelectorAll('.dismiss-btn').forEach(button => {
    button.addEventListener('click', function() {
        this.closest('.notification').style.display = 'none';
    });
});
document.addEventListener('DOMContentLoaded', function() {

    // Toggle FAQ answers
    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const answer = this.nextElementSibling;
            answer.classList.toggle('show'); // Toggle visibility of the answer
        });
    });

    // Dismiss notifications
    const dismissBtns = document.querySelectorAll('.dismiss-btn');
    dismissBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const notification = this.closest('.notification');
            notification.style.display = 'none'; // Hide the notification when clicked
        });
    });

    // Edit Profile Button functionality
    // const editProfileButton = document.querySelector('.edit-profile');
    // if (editProfileButton) {
    //     editProfileButton.addEventListener('click', function() {
    //         // This could open a form or modal for editing the profile
    //         alert('Edit Profile Clicked');
    //     });
    // }

    // Filter Transactions based on search and status
    const searchBox = document.getElementById('search-transactions');
    const filterBox = document.getElementById('transaction-status');
    const transactionsTable = document.querySelector('.transaction-table tbody');

    searchBox.addEventListener('input', filterTransactions);
    filterBox.addEventListener('change', filterTransactions);

    function filterTransactions() {
        const searchText = searchBox.value.toLowerCase();
        const filterStatus = filterBox.value;

        const rows = transactionsTable.querySelectorAll('tr');
        rows.forEach(row => {
            const auctionName = row.cells[0].textContent.toLowerCase();
            const status = row.cells[2].textContent.toLowerCase();
            const matchesSearch = auctionName.includes(searchText);
            const matchesStatus = filterStatus ? status.includes(filterStatus) : true;

            if (matchesSearch && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Handle Wishlist remove button functionality
    const wishlistItems = document.querySelectorAll('.wishlist-item .btn');
    wishlistItems.forEach(button => {
        button.addEventListener('click', function() {
            const wishlistItem = this.closest('.wishlist-item');
            wishlistItem.remove(); // Remove the wishlist item from the UI
        });
    });

    // Handle Profile Picture Edit
    const profileImage = document.querySelector('.profile-image img');
    if (profileImage) {
        profileImage.addEventListener('click', function() {
            // Open a file input dialog to change the profile picture
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = 'image/*';
            fileInput.click();

            fileInput.addEventListener('change', function() {
                const file = fileInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profileImage.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    }

    // Handle Security & Privacy Settings (Example: Toggle Privacy Settings)
    const profilePrivateCheckbox = document.getElementById('profile-private');
    const allowMessagesCheckbox = document.getElementById('allow-messages');

    if (profilePrivateCheckbox) {
        profilePrivateCheckbox.addEventListener('change', function() {
            // Logic to handle profile privacy change, e.g., sending a request to update privacy settings
            console.log(`Profile privacy is now: ${this.checked ? 'Private' : 'Public'}`);
        });
    }

    if (allowMessagesCheckbox) {
        allowMessagesCheckbox.addEventListener('change', function() {
            // Logic to handle message permissions
            console.log(`Allow Direct Messaging: ${this.checked}`);
        });
    }

    // Handle Payment Methods (Example: Remove Payment Method)
    const removePaymentBtns = document.querySelectorAll('.payment-card .btn');
    removePaymentBtns.forEach(button => {
        button.addEventListener('click', function() {
            const paymentCard = this.closest('.payment-card');
            paymentCard.remove(); // Remove the payment method from the UI
        });
    });

    // Handle Activity Feed (Example: Timestamp updates dynamically)
    const activityFeed = document.querySelectorAll('.feed-list li');
    activityFeed.forEach(feed => {
        const timestamp = feed.querySelector('.timestamp');
        if (timestamp) {
            const timestampText = timestamp.textContent;
            const timestampDate = new Date(timestampText);
            const timeAgo = getTimeAgo(timestampDate);
            timestamp.textContent = timeAgo;
        }
    });

    // Function to display time ago in a user-friendly format (e.g., "2 hours ago")
    function getTimeAgo(date) {
        const now = new Date();
        const seconds = Math.floor((now - date) / 1000);
        const minutes = Math.floor(seconds / 60);
        const hours = Math.floor(minutes / 60);
        const days = Math.floor(hours / 24);

        if (seconds < 60) return `${seconds} seconds ago`;
        if (minutes < 60) return `${minutes} minutes ago`;
        if (hours < 24) return `${hours} hours ago`;
        return `${days} days ago`;
    }

    // Handle Testimonials Carousel (Simple auto-scrolling or manual click-based)
    const testimonialsCarousel = document.querySelector('.testimonials-carousel');
    if (testimonialsCarousel) {
        setInterval(function() {
            const firstTestimonial = testimonialsCarousel.querySelector('.testimonial-card');
            testimonialsCarousel.appendChild(firstTestimonial); // Move the first item to the end of the carousel
        }, 5000); // Auto-scroll every 5 seconds
    }

});
// Event listener for the "Contact Support" button
document.querySelector('#help-support .btn').addEventListener('click', function() {
    // Show an alert or redirect the user to a contact page or pop-up (you can modify this based on your needs)
    alert('Redirecting to contact support...');

    // Example: Redirect to a support page or open a contact form
    window.location.href = 'mailto:support@yourdomain.com'; // Opens the user's email client with the support email

    // OR, you could open a contact form in a modal (for example)
    // openSupportModal();
});

// Optional: Show a support form in a modal (example)
function openSupportModal() {
    const modalHtml = `
        <div class="modal-overlay" id="support-modal-overlay">
            <div class="modal-container">
                <h2>Contact Support</h2>
                <form id="support-form">
                    <label for="support-email">Email:</label>
                    <input type="email" id="support-email" placeholder="Enter your email" required>
                    
                    <label for="support-message">Message:</label>
                    <textarea id="support-message" placeholder="Describe your issue" required></textarea>
                    
                    <button type="submit" class="btn">Submit</button>
                    <button type="button" id="close-modal" class="btn">Close</button>
                </form>
            </div>
        </div>
    `;

    // Append the modal HTML to the body
    document.body.insertAdjacentHTML('beforeend', modalHtml);

    // Get the modal elements
    const modalOverlay = document.getElementById('support-modal-overlay');
    const closeModalButton = document.getElementById('close-modal');

    // Close modal on clicking the close button
    closeModalButton.addEventListener('click', function() {
        modalOverlay.remove();
    });

    // Close modal if user clicks outside the modal container
    modalOverlay.addEventListener('click', function(event) {
        if (event.target === modalOverlay) {
            modalOverlay.remove();
        }
    });

    // Form submit logic
    const supportForm = document.getElementById('support-form');
    supportForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const email = document.getElementById('support-email').value;
        const message = document.getElementById('support-message').value;

        // You can send this data to a server or email, for now, just log the data
        console.log('Support Email:', email);
        console.log('Support Message:', message);

        // Show a confirmation message or close the modal
        alert('Your message has been sent. Our support team will get back to you shortly.');
        modalOverlay.remove(); // Close the modal after submission
    });
}
document.addEventListener('DOMContentLoaded', function() {

    // Toggle FAQ answers with smooth animations
    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const answer = this.nextElementSibling;
            const isVisible = answer.classList.contains('show');
            if (isVisible) {
                answer.classList.remove('show');
                answer.style.maxHeight = 0; // Smooth collapse
            } else {
                answer.classList.add('show');
                answer.style.maxHeight = answer.scrollHeight + 'px'; // Smooth expand
            }
        });
    });

    // Dismiss notifications with fade-out effect
    const dismissBtns = document.querySelectorAll('.dismiss-btn');
    dismissBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const notification = this.closest('.notification');
            notification.classList.add('fade-out'); // Add fade-out class
            setTimeout(() => notification.remove(), 300); // Remove after animation
        });
    });

    // Edit Profile Button functionality with modal
    // const editProfileButton = document.querySelector('.edit-profile');
    // if (editProfileButton) {
    //     editProfileButton.addEventListener('click', function() {
    //         const modal = document.querySelector('.edit-profile-modal');
    //         modal.classList.add('open'); // Show modal
    //     });
    // }

    // Filter Transactions based on search and status
    const searchBox = document.getElementById('search-transactions');
    const filterBox = document.getElementById('transaction-status');
    const transactionsTable = document.querySelector('.transaction-table tbody');

    searchBox.addEventListener('input', filterTransactions);
    filterBox.addEventListener('change', filterTransactions);

    function filterTransactions() {
        const searchText = searchBox.value.toLowerCase();
        const filterStatus = filterBox.value;

        const rows = transactionsTable.querySelectorAll('tr');
        rows.forEach(row => {
            const auctionName = row.cells[0].textContent.toLowerCase();
            const status = row.cells[2].textContent.toLowerCase();
            const matchesSearch = auctionName.includes(searchText);
            const matchesStatus = filterStatus ? status.includes(filterStatus) : true;

            row.style.display = matchesSearch && matchesStatus ? '' : 'none';
        });
    }

    // Handle Wishlist remove button functionality with animation
    const wishlistItems = document.querySelectorAll('.wishlist-item .btn');
    wishlistItems.forEach(button => {
        button.addEventListener('click', function() {
            const wishlistItem = this.closest('.wishlist-item');
            wishlistItem.classList.add('fade-out'); // Add fade-out class
            setTimeout(() => wishlistItem.remove(), 300); // Remove after animation
        });
    });

    // Handle Profile Picture Edit with preview
    const profileImage = document.querySelector('.profile-image img');
    if (profileImage) {
        profileImage.addEventListener('click', function() {
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = 'image/*';
            fileInput.click();

            fileInput.addEventListener('change', function() {
                const file = fileInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profileImage.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    }

    // Handle Security & Privacy Settings (Example: Toggle Privacy Settings)
    const profilePrivateCheckbox = document.getElementById('profile-private');
    const allowMessagesCheckbox = document.getElementById('allow-messages');

    if (profilePrivateCheckbox) {
        profilePrivateCheckbox.addEventListener('change', function() {
            console.log(`Profile privacy is now: ${this.checked ? 'Private' : 'Public'}`);
        });
    }

    if (allowMessagesCheckbox) {
        allowMessagesCheckbox.addEventListener('change', function() {
            console.log(`Allow Direct Messaging: ${this.checked}`);
        });
    }

    // Handle Payment Methods (Example: Remove Payment Method with smooth transition)
    const removePaymentBtns = document.querySelectorAll('.payment-card .btn');
    removePaymentBtns.forEach(button => {
        button.addEventListener('click', function() {
            const paymentCard = this.closest('.payment-card');
            paymentCard.classList.add('fade-out'); // Add fade-out effect
            setTimeout(() => paymentCard.remove(), 300); // Remove after animation
        });
    });

    // Handle Activity Feed: Update timestamps dynamically
    const activityFeed = document.querySelectorAll('.feed-list li');

    function updateTimestamps() {
        activityFeed.forEach(feed => {
            const timestamp = feed.querySelector('.timestamp');
            if (timestamp) {
                const timestampDate = new Date(timestamp.textContent);
                timestamp.textContent = getTimeAgo(timestampDate);
            }
        });
    }

    // Function to calculate time difference in a user-friendly format
    function getTimeAgo(date) {
        const now = new Date();
        const seconds = Math.floor((now - date) / 1000);
        const minutes = Math.floor(seconds / 60);
        const hours = Math.floor(minutes / 60);
        const days = Math.floor(hours / 24);

        if (seconds < 60) return `${seconds} seconds ago`;
        if (minutes < 60) return `${minutes} minutes ago`;
        if (hours < 24) return `${hours} hours ago`;
        return `${days} days ago`;
    }

    setInterval(updateTimestamps, 60000); // Update every minute

    // Handle Testimonials Carousel: Auto-scrolling with manual control
    const testimonialsCarousel = document.querySelector('.testimonials-carousel');
    if (testimonialsCarousel) {
        setInterval(function() {
            const firstTestimonial = testimonialsCarousel.querySelector('.testimonial-card');
            testimonialsCarousel.appendChild(firstTestimonial); // Move the first item to the end of the carousel
        }, 5000); // Auto-scroll every 5 seconds

        const prevBtn = testimonialsCarousel.querySelector('.prev');
        const nextBtn = testimonialsCarousel.querySelector('.next');
        if (prevBtn && nextBtn) {
            prevBtn.addEventListener('click', function() {
                const lastTestimonial = testimonialsCarousel.querySelector('.testimonial-card:last-child');
                testimonialsCarousel.prepend(lastTestimonial); // Move the last item to the beginning
            });

            nextBtn.addEventListener('click', function() {
                const firstTestimonial = testimonialsCarousel.querySelector('.testimonial-card');
                testimonialsCarousel.appendChild(firstTestimonial); // Move the first item to the end
            });
        }
    }

    // Handle Responsive Design: Adjust layout based on window size
    window.addEventListener('resize', handleResponsiveLayout);

    function handleResponsiveLayout() {
        const windowWidth = window.innerWidth;
        const mobileBreakpoint = 768;

        // Adjust Testimonials Carousel based on window size
        const carouselItems = document.querySelectorAll('.testimonial-card');
        if (windowWidth < mobileBreakpoint) {
            testimonialsCarousel.style.flexDirection = 'column'; // Stack testimonials vertically
        } else {
            testimonialsCarousel.style.flexDirection = 'row'; // Align testimonials horizontally
        }
    }

    // Initialize responsive layout
    handleResponsiveLayout();
});