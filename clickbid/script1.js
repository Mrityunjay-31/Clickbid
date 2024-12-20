// const auctions = [
//     { id: 1, title: "AI-Powered Chatbot", currentBid: 120, timeLeft: 300, bidHistory: [] },
//     { id: 2, title: "E-commerce Website", currentBid: 800, timeLeft: 420, bidHistory: [] },
//     { id: 3, title: "Mobile App Development", currentBid: 1200, timeLeft: 600, bidHistory: [] },
//     { id: 4, title: "Real-Time Monitoring System", currentBid: 1500, timeLeft: 720, bidHistory: [] },
//     { id: 5, title: "Cloud Infrastructure Setup", currentBid: 2000, timeLeft: 900, bidHistory: [] },
//     { id: 6, title: "Blockchain App Development", currentBid: 2500, timeLeft: 1080, bidHistory: [] },
//     { id: 7, title: "Big Data Analysis", currentBid: 3000, timeLeft: 1320, bidHistory: [] },
//     { id: 8, title: "IoT Smart Home", currentBid: 3500, timeLeft: 1500, bidHistory: [] },
//     { id: 9, title: "AR/VR Development", currentBid: 4000, timeLeft: 1800, bidHistory: [] },
//     { id: 10, title: "Autonomous Vehicles", currentBid: 4500, timeLeft: 2100, bidHistory: [] },
//     { id: 11, title: "Digital Marketing Strategy", currentBid: 5000, timeLeft: 2400, bidHistory: [] },
//     { id: 12, title: "Sustainable Energy Solutions", currentBid: 6000, timeLeft: 2700, bidHistory: [] }
// ];

// document.addEventListener("DOMContentLoaded", () => {
//     auctions.forEach((auction) => {
//         setupAuction(auction);
//     });
// });

// function setupAuction(auction) {
//     const timerElement = document.getElementById(`timer${auction.id}`);
//     const bidElement = document.getElementById(`currentBid${auction.id}`);
//     const bidInput = document.getElementById(`bidInput${auction.id}`);
//     const bidButton = document.querySelector(`.place-bid-btn[data-id="${auction.id}"]`);
//     const messageElement = document.getElementById(`bidMessage${auction.id}`);
//     const historyList = document.getElementById(`historyList${auction.id}`);

//     startTimer(auction, timerElement);

//     bidElement.textContent = `$${auction.currentBid}`;

//     bidButton.addEventListener("click", () => {
//         placeBid(auction, bidInput, bidElement, messageElement, historyList);
//     });
// }

// function startTimer(auction, timerElement) {
//     const interval = setInterval(() => {
//         if (auction.timeLeft > 0) {
//             auction.timeLeft--;
//             const minutes = Math.floor(auction.timeLeft / 60);
//             const seconds = auction.timeLeft % 60;
//             timerElement.textContent = `Time Remaining: ${minutes.toString().padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;
//         } else {
//             clearInterval(interval);
//             timerElement.textContent = "Auction Ended";
//             timerElement.style.color = "red";
//         }
//     }, 1000);
// }

// function placeBid(auction, bidInput, bidElement, messageElement, historyList) {
//     const bidValue = parseFloat(bidInput.value);

//     if (isNaN(bidValue)) {
//         showMessage(messageElement, "Please enter a valid bid amount!", "error");
//     } else if (bidValue <= auction.currentBid) {
//         showMessage(messageElement, `Your bid must be higher than $${auction.currentBid}!`, "error");
//     } else if (auction.timeLeft <= 0) {
//         showMessage(messageElement, "This auction has already ended!", "error");
//     } else {
//         auction.currentBid = bidValue;
//         bidElement.textContent = `$${auction.currentBid}`;
//         addBidToHistory(auction, bidValue, historyList);
//         showMessage(messageElement, "Your bid has been placed successfully!", "success");
//         bidInput.value = "";
//     }
// }

// function addBidToHistory(auction, bidValue, historyList) {
//     const li = document.createElement("li");
//     li.innerHTML = `Bid of $${bidValue} placed.`;
//     historyList.appendChild(li);
// }

// function showMessage(element, message, type) {
//     element.textContent = message;
//     element.style.color = type === "success" ? "green" : "red";
//     element.style.opacity = 1;

//     setTimeout(() => {
//         element.style.opacity = 0;
//     }, 3000);
// }

// function updateAuctionUI(auctionId, currentBid, timeLeft) {
//     const bidElement = document.getElementById(`currentBid${auctionId}`);
//     const timerElement = document.getElementById(`timer${auctionId}`);

//     bidElement.textContent = `$${currentBid}`;

//     const minutes = Math.floor(timeLeft / 60);
//     const seconds = timeLeft % 60;
//     timerElement.textContent = `Time Remaining: ${minutes.toString().padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;
// }

// function simulateRealTimeUpdates() {
//     setInterval(() => {
//         auctions.forEach((auction) => {
//             if (auction.timeLeft > 0) {
//                 auction.timeLeft--;
//             }
//             updateAuctionUI(auction.id, auction.currentBid, auction.timeLeft);
//         });
//     }, 1000);
// }

// simulateRealTimeUpdates();

// document.querySelectorAll('.faq-question').forEach((question) => {
//     question.addEventListener('click', () => {
//         question.classList.toggle('active');
//         const answer = question.nextElementSibling;
//         if (answer.style.display === 'block') {
//             answer.style.display = 'none';
//         } else {
//             answer.style.display = 'block';
//         }
//     });
// });

// const timers = document.querySelectorAll(".timer");
// timers.forEach(timer => {
//     let timeRemaining = parseInt(timer.textContent.split(":")[1]) * 60;
//     const updateTimer = setInterval(() => {
//         if (timeRemaining <= 0) {
//             clearInterval(updateTimer);
//             timer.textContent = "Auction Ended";
//             timer.style.color = "red";
//         } else {
//             timeRemaining--;
//             const minutes = Math.floor(timeRemaining / 60);
//             const seconds = timeRemaining % 60;
//             timer.textContent = `Time Remaining: ${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`;
//         }
//     }, 1000);
// });

let currentIndex = 0;
const testimonials = document.querySelectorAll('.testimonial-slide');
const totalTestimonials = testimonials.length;

function moveSlide(direction) {
    currentIndex += direction;

    if (currentIndex < 0) {
        currentIndex = totalTestimonials - 1;
    } else if (currentIndex >= totalTestimonials) {
        currentIndex = 0;
    }

    updateCarousel();
}

function updateCarousel() {
    testimonials.forEach((slide, index) => {
        if (index === currentIndex) {
            slide.style.display = "block";
            slide.style.opacity = "1";
        } else {
            slide.style.display = "none";
            slide.style.opacity = "0";
        }
    });
}

updateCarousel();

const leaderboardData = [
    { rank: 1, name: "Alice Johnson", project: "IoT Smart Home", bid: "$15,000" },
    { rank: 2, name: "John Smith", project: "AI Assistant", bid: "$12,000" },
    { rank: 3, name: "Samantha Brown", project: "Blockchain Supply Chain", bid: "$10,500" },
    { rank: 4, name: "David Miller", project: "AR Virtual Tour", bid: "$8,000" },
    { rank: 5, name: "Emma Wilson", project: "Solar Power Drone", bid: "$7,500" }
];

function renderLeaderboard(data) {
    const tbody = document.getElementById("leaderboard-body");
    tbody.innerHTML = "";
    data.forEach((entry) => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${entry.rank}</td>
            <td>${entry.name}</td>
            <td>${entry.project}</td>
            <td>${entry.bid}</td>
        `;
        tbody.appendChild(row);
    });
}

function simulateUpdates() {
    setInterval(() => {
        const randomIndex = Math.floor(Math.random() * leaderboardData.length);
        const randomBidIncrease = Math.floor(Math.random() * 500) + 100;

        leaderboardData[randomIndex].bid = `$${(
            parseInt(leaderboardData[randomIndex].bid.replace("$", "")) +
            randomBidIncrease
        ).toLocaleString()}`;
        leaderboardData.sort((a, b) => parseInt(b.bid.replace("$", "")) - parseInt(a.bid.replace("$", "")));

        leaderboardData.forEach((entry, index) => (entry.rank = index + 1));

        renderLeaderboard(leaderboardData);
    }, 5000);
}

renderLeaderboard(leaderboardData);
simulateUpdates();

document.addEventListener('DOMContentLoaded', function() {

    function smoothScrollToSection() {
        const links = document.querySelectorAll('nav ul li a');

        links.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const targetId = link.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);

                window.scrollTo({
                    top: targetElement.offsetTop - 50,
                    behavior: 'smooth'
                });
            });
        });
    }

    const auctionTabs = document.querySelectorAll('.auction-tab');
    auctionTabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            auctionTabs.forEach((tab) => tab.classList.remove('active'));
            tab.classList.add('active');
            const auctionSections = document.querySelectorAll('.auction-section');
            auctionSections.forEach((section) => section.style.display = 'none');
            const targetSection = document.querySelector(`#${tab.dataset.target}`);
            targetSection.style.display = 'block';
        });
    });

    smoothScrollToSection();
});
