<?php
session_start();
require 'config.php';

// Fetch projects
$sql = "SELECT projid, projname FROM projects ORDER BY projid ASC";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

// Fetch next event
$eventSql = "SELECT name, start_date 
             FROM events 
             WHERE status='active' AND start_date > NOW() 
             ORDER BY start_date ASC 
             LIMIT 1";
$eventResult = $conn->query($eventSql);

if ($eventResult && $eventResult->num_rows > 0) {
    $event = $eventResult->fetch_assoc();
    $eventStart = $event['start_date'];
    $eventName = $event['name'];
} else {
    // fallback if no future active events
    $eventStart = date('Y-m-d H:i:s', strtotime('+73 days')); 
    $eventName = "Test Event in 73 Days";
}

// Convert to ISO format for JS
$eventStartJS = date('c', strtotime($eventStart));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCP Outreach Program 2025</title>
    <link rel="icon" href="images/ccplogo.ico" type="image/x-icon">
    <link rel="shortcut icon" href="images/ccplogo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-light sticky-top shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#hero">
            <img src="images/ccplogo.png" alt="CCP Logo" class="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end bg-light text-white" tabindex="-1" id="offcanvasNavbar">
            <div class="offcanvas-header">
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item"><a class="nav-link" href="#hero">CCP OUTREACH PROGRAM 2025</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#beneficiaries">Beneficiaries</a></li>
                    <li class="nav-item"><a class="nav-link" href="#countdown">Outreach Countdown</a></li>
                    <li class="nav-item"><a class="nav-link" href="#projects">Income Generating Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="#raffle">E-Raffle</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section id="hero" class="hero-section text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-2 mb-4 fade-in">Christian Communities Program - Alumni</h1>
                <p class="lead fs-4 mb-5">"Extending Hands, Touching Lives and Creating Hope Together"</p>
                <div class="d-flex gap-3">
                    <a href="#countdown" class="btn btn-light btn-lg pulse">Outreach Countdown</a>
                    <a href="#about" class="btn btn-outline-light btn-lg">About Us</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="images/ccplogo.png" alt="CCP Outreach" class="img-fluid   ">
            </div>
        </div>
    </div>
</section>
<!-- About Us Section -->
<section id="about" class="section-padding">
    <div class="container">
        <div class="row align-items-center">
            <!-- Image --><h2 class="display-4 mb-4">About Us</h2>
            <div class="col-lg-6">
                <img src="images/ccplogo.png" alt="About Us" class="img-fluid">
            </div>
            <!-- Text -->
            <div class="col-lg-6 mb-5">
                
                <p class="lead">
                    We are the <strong>CHRISTIAN COMMUNITIES PROGRAM - ALUMNI</strong> of
                    the <strong>UNIVERSITY OF THE EAST CALOOCAN</strong>, a community of
                    alumni united by faith, service, love, and compassion.
                </p>
                <p>
                    Rooted in Christian values, we organize an <strong>Outreach Program</strong>
                    every year that brings us together to extend a helping hand to those in need.
                    More than just an activity, it is our way of living out the Gospel —
                    reaching out to the less fortunate, offering not only material support
                    but also hope, encouragement, and fellowship.
                </p>
                <p>
                    Through these initiatives, we aim to build bridges of understanding,
                    strengthen community spirit, and inspire others to make kindness a way of life.
                    Our outreach activities are moments of learning and growth, reminding us that
                    service is not just about giving but also about sharing in the joys and struggles of others.
                </p>
                <p>
                    As a community, we remain committed to being instruments of God’s love and light.
                    Guided by faith and driven by compassion, we continue to serve with open hearts
                    and steadfast dedication, believing that together, we can create lasting change.
                </p>
            </div>
        </div>
    </div>
</section>


<!-- Beneficiaries Section -->
<section id="beneficiaries" class="section-padding bg-light">
    <div class="container">
        <h2 class="display-4 text-center mb-5">Our Beneficiaries</h2>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card feature-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle mb-3">🏘️</div>
                        <h5 class="card-title">Rural Communities</h5>
                        <p class="card-text">Bringing arts education to remote barangays with limited cultural access.</p>
                        <small class="text-muted">8,000+ beneficiaries</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card feature-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle mb-3">👥</div>
                        <h5 class="card-title">Urban Youth</h5>
                        <p class="card-text">Engaging city-based young people through contemporary arts programs.</p>
                        <small class="text-muted">5,500+ young artists</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card feature-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle mb-3">🎭</div>
                        <h5 class="card-title">Indigenous Groups</h5>
                        <p class="card-text">Celebrating and preserving indigenous cultural heritage.</p>
                        <small class="text-muted">3,200+ community members</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card feature-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle mb-3">🏫</div>
                        <h5 class="card-title">Schools</h5>
                        <p class="card-text">Integrating arts education into school curricula nationwide.</p>
                        <small class="text-muted">6,000+ students & teachers</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card feature-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle mb-3">👴</div>
                        <h5 class="card-title">Senior Citizens</h5>
                        <p class="card-text">Cultural enrichment programs for elderly communities.</p>
                        <small class="text-muted">2,300+ seniors</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card feature-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle mb-3">♿</div>
                        <h5 class="card-title">PWDs</h5>
                        <p class="card-text">Inclusive arts programs for persons with disabilities.</p>
                        <small class="text-muted">1,000+ participants</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="beneficiaries-detail.html" class="btn btn-primary btn-lg">View Detailed Impact Report</a>
        </div>
    </div>
</section>

<!-- Countdown Section -->
<section id="countdown" class="section-padding">
    <div class="container">
        <h2 class="display-4 text-center mb-5">Outreach Countdown</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="countdown-card">
                    <h3 class="mb-4">Next Major Outreach Event</h3>
                    <div class="row text-center">
                        <div class="col-3">
                            <span class="countdown-number" id="days">00</span>
                            <div class="countdown-label">Days</div>
                        </div>
                        <div class="col-3">
                            <span class="countdown-number" id="hours">00</span>
                            <div class="countdown-label">Hours</div>
                        </div>
                        <div class="col-3">
                            <span class="countdown-number" id="minutes">00</span>
                            <div class="countdown-label">Minutes</div>
                        </div>
                        <div class="col-3">
                            <span class="countdown-number" id="seconds">00</span>
                            <div class="countdown-label">Seconds</div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h5><?= htmlspecialchars($eventName) ?></h5>
                        <p class="mb-3"><?= date('F j, Y', strtotime($eventStart)) ?></p>
                        <a href="countdown-detail.html" class="btn btn-light">View Full Schedule</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="projects" class="section-padding bg-light">
    <div class="container text-center">
        <h2 class="display-4 mb-5">Income Generating Projects</h2>
        
        <div class="row g-4 justify-content-center">
            <?php if ($result->num_rows > 0): ?>
                <?php while($project = $result->fetch_assoc()): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="project-card position-relative text-center text-white transition" 
                             style="background-image: url('images/tag.png'); background-size: cover; background-position: center; padding: 100px 20px; min-height: 250px;">
                            <h1 class="card-title text-dark"><?= htmlspecialchars($project['projname']) ?></h1>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">No projects found.</p>
            <?php endif; ?>
        </div>

        <div class="project-description mt-5 text-center">
            <h5>We sincerely and humbly ask for your support in our projects. The proceeds will help make our Outreach program successful and allow us to extend assistance to those who need it most. Every contribution, whether big or small, will truly make a difference.</h5>
            <h5>Thank you for being part of our mission of service, love, and compassion.</h5>
        </div>
    </div>
</section>


<!-- E-Raffle Section -->
<section id="raffle" class="section-padding raffle-section text-white">
  <div class="container text-center">
    <h2 class="display-4 mb-4">E-Raffle</h2>
    <p class="lead mb-5">To avail your raffle ticket, please contact any authorized solicitor!</p>

    <!-- Ticket Image -->
    <div class="row justify-content-center mb-5">
      <div class="col-md-6"> <!-- made wider column -->
        <a href="register.php" class="ticket-link d-inline-block">
            <img src="images/ticket.png" alt="Buy Raffle Ticket" class="ticket-img">
        </a>
        <p class="mt-3 fs-5">Click the ticket to register</p>
      </div>
    </div>

    <div class="row justify-content-center mb-5">
      <div class="col-md-6">
        <a href="register.php" class="ticket-link d-inline-block">
          <img src="images/box.png" style="max-width: 20%; height: auto;" alt="Raffle Entry" class="ticket-img">
        </a>
      </div>
    </div>

    <!-- Call-to-Action Buttons -->
    <div class="raffle-message mt-4">
      <h3 class="fw-bold">Want to check your raffle entry?</h3>
      <p class="mt-3 fs-5">
        Click on the image below to view and confirm <br>
        your entry details.
      </p>
    </div>
  </div>
</section>

<!-- Contact Section -->
<section class="py-5 bg-light text-dark">
    <div class="container text-center">
        <img src="images/ccplogo.png" alt="CCP Logo" class="img-fluid mb-4 zoom-effect" style="max-width: 400px;">
        <h2 class="pulse">“Once a CCPian, always a CCPian”</h2>
    </div>
</section>

<!-- Footer -->
<footer class="bg-secondary text-white text-center py-3">
    <p class="mb-0">&copy; 2025 CHRISTIAN COMMUNITIES PROGRAM - ALUMNI</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const eventStart = "<?= $eventStartJS ?>";
</script>
<script src="js/script.js"></script>
</body>
</html>