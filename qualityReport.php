<?php
    include("databse.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .logout-btn {
    background-color: #28a745
    border-color #28a745;
    transition: background-color 0.3s ease, border-color 0.3s ease;
    }

.logout-btn:hover {
    background-color: #dc3545 !important; /* Red on hover */
    border-color: #dc3545 !important;
}

.navbar-nav .nav-link, 
    .navbar-nav .dropdown-toggle {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        min-width: 150px;
        text-align: center;
    }

    .navbar-nav .dropdown-menu .dropdown-item {
        text-align: center;
    }

    .dropdown-menu .dropdown-item:hover {
        background-color: orange;
        color: white;
    }

</style>

    <meta charset="utf-8">
    <title>Banglar Krishi - Organic Farm Website</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid px-5 d-none d-lg-block">
        <div class="row gx-5 py-3 align-items-center">
            <div class="col-lg-3">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="bi bi-phone-vibrate fs-1 text-primary me-2"></i>
                    <h2 class="mb-0">019 091 091 91</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-flex align-items-center justify-content-center">
                    <a href="index.html" class="navbar-brand ms-lg-5">
                        <h1 class="m-0 display-4 text-primary"><span class="text-secondary">বাংলার </span>কৃষি</h1>
                    </a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex align-items-center justify-content-end">
                    <!-- Profile Icon -->
                    <a class="btn btn-primary btn-square rounded-circle me-2" href="profile.html" title="Profile">
                        <i class="fas fa-user"></i>
                    </a>
                    <!-- Logout Icon -->
                    <a class="btn btn-success btn-square rounded-circle logout-btn" href="login.html" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>   
        </div>
    </div>
    <!-- Topbar End -->


       <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-5">
        <a href="index.html" class="navbar-brand d-flex d-lg-none">
            <h1 class="m-0 display-4 text-secondary"><span class="text-white">Banglar</span>Krishi</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0 d-flex align-items-center text-center">
                <a href="index.html" class="nav-item nav-link px-3">Home</a>
                <a href="gradingCriteria.html" class="nav-item nav-link px-3">Grading Criteria</a>
                <a href="qualityReport.html" class="nav-item nav-link px-3">Inspector Report</a>
                <a href="qualityTrendAnalysis.html" class="nav-item nav-link px-3">Quality Trend</a>
                <a href="transportationTracking.html" class="nav-item nav-link px-3">Transportation Tracking</a>
                <a href="trackingOfGradedProducts.html" class="nav-item nav-link px-3">Graded Product Tracking</a>
                <a href="packagingTrackingSystem.html" class="nav-item nav-link px-3">Packaging Tracking</a>
                
                <div class="nav-item dropdown px-3">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">More</a>
                    <div class="dropdown-menu text-center">
                        <a href="service.html" class="dropdown-item">Service</a>
                        <a href="contact.html" class="dropdown-item">Contact Us</a>
                        <a href="about.html" class="dropdown-item">About</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->



<!-- Hero Start -->
<div class="container-fluid bg-primary py-5 bg-hero-inspect mb-5">
    <div class="container h-100 d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-1 text-white mb-0"></h1>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->


    <!-- Blog Start -->
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Blog Detail Start -->
                <!-- <div class="mb-5">
                    <div class="row g-5 mb-5">
                        <div class="col-md-6">
                            <img class="img-fluid w-100" src="img/blog-1.jpg" alt="">
                        </div>
                        <div class="col-md-6">
                            <img class="img-fluid w-100" src="img/blog-2.jpg" alt="">
                        </div>
                    </div>
                    <h1 class="mb-4">Diam dolor est labore duo ipsum clita sed et lorem tempor duo</h1>
                    <p>Sadipscing labore amet rebum est et justo gubergren. Et eirmod ipsum sit diam ut
                        magna lorem. Nonumy vero labore lorem sanctus rebum et lorem magna kasd, stet
                        amet magna accusam consetetur eirmod. Kasd accusam sit ipsum sadipscing et at at
                        sanctus et. Ipsum sit gubergren dolores et, consetetur justo invidunt at et
                        aliquyam ut et vero clita. Diam sea sea no sed dolores diam nonumy, gubergren
                        sit stet no diam kasd vero.</p>
                    <p>Voluptua est takimata stet invidunt sed rebum nonumy stet, clita aliquyam dolores
                        vero stet consetetur elitr takimata rebum sanctus. Sit sed accusam stet sit
                        nonumy kasd diam dolores, sanctus lorem kasd duo dolor dolor vero sit et. Labore
                        ipsum duo sanctus amet eos et. Consetetur no sed et aliquyam ipsum justo et,
                        clita lorem sit vero amet amet est dolor elitr, stet et no diam sit. Dolor erat
                        justo dolore sit invidunt.</p>
                    <p>Diam dolor est labore duo invidunt ipsum clita et, sed et lorem voluptua tempor
                        invidunt at est sanctus sanctus. Clita dolores sit kasd diam takimata justo diam
                        lorem sed. Magna amet sed rebum eos. Clita no magna no dolor erat diam tempor
                        rebum consetetur, sanctus labore sed nonumy diam lorem amet eirmod. No at tempor
                        sea diam kasd, takimata ea nonumy elitr sadipscing gubergren erat. Gubergren at
                        lorem invidunt sadipscing rebum sit amet ut ut, voluptua diam dolores at
                        sadipscing stet. Clita dolor amet dolor ipsum vero ea ea eos.</p>
                </div> -->
                <!-- Blog Detail End -->
<!-- Inspector Records Start -->
<!-- <div class="bg-light p-5 my-5">
    <h2 class="mb-4">Inspector Records and Quality Reports</h2>
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-primary">
                <tr>
                    <th>Inspector Name</th>
                    <th>Date</th>
                    <th>Product Type</th>
                    <th>Quality Assessment</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Rahim Uddin</td>
                    <td>2025-04-15</td>
                    <td>Mango</td>
                    <td>Excellent quality, well-packed, no visible damage.</td>
                </tr>
                <tr>
                    <td>Fatema Khatun</td>
                    <td>2025-04-14</td>
                    <td>Tomato</td>
                    <td>Medium ripeness, slight bruising noted on 5% of batch.</td>
                </tr>
                <tr>
                    <td>Jashim Ali</td>
                    <td>2025-04-12</td>
                    <td>Green Chili</td>
                    <td>Fresh and firm, suitable for transport.</td>
                </tr>
                <tr>
                    <td>Md.Abrar sayed tasin</td>
                    <td>2025-04-12</td>
                    <td>Capsicum</td>
                    <td>Fresh and firm, suitable for transport.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div> -->
<!-- Inspector Records End -->
<!-- Inspector Records and Chart Start -->
<div class="bg-light p-5 my-5">
    <h2 class="mb-4">Inspector Records and Quality Reports</h2>
    <div class="table-responsive mb-4">
        <table class="table table-bordered text-center">
            <thead class="table-primary">
                <tr>
                    <th>Inspector Name</th>
                    <th>Date</th>
                    <th>Product Type</th>
                    <th>Quality Assessment</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Rahim Uddin</td><td>2025-04-15</td><td>Mango</td><td>Excellent quality, well-packed.</td></tr>
                <tr><td>Fatema Khatun</td><td>2025-04-14</td><td>Tomato</td><td>Medium ripeness, slight bruising.</td></tr>
                <tr><td>Jashim Ali</td><td>2025-04-12</td><td>Green Chili</td><td>Fresh and firm.</td></tr>
                <tr><td>Md.Abrar Sayed Tasin</td><td>2025-04-12</td><td>Capsicum</td><td>Fresh and firm.</td></tr>
                <tr><td>Sharmin Akter</td><td>2025-04-11</td><td>Banana</td><td>Overripe in 10% of samples.</td></tr>
                <tr><td>Rafiq Hasan</td><td>2025-04-10</td><td>Guava</td><td>Uniform size and good texture.</td></tr>
                <tr><td>Nasima Begum</td><td>2025-04-09</td><td>Potato</td><td>Minimal dirt, good storage condition.</td></tr>
                <tr><td>Azharul Islam</td><td>2025-04-08</td><td>Eggplant</td><td>Firm and glossy, slight denting.</td></tr>
            </tbody>
        </table>
    </div>
    <canvas id="qualityChart" height="100"></canvas>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('qualityChart').getContext('2d');
    const qualityChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Mango', 'Tomato', 'Green Chili', 'Capsicum', 'Banana', 'Guava', 'Potato', 'Eggplant'],
            datasets: [{
                label: 'Inspection Count',
                data: [1, 1, 1, 1, 1, 1, 1, 1],
                backgroundColor: 'rgba(40, 167, 69, 0.7)',
                borderColor: 'rgba(40, 167, 69, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1
                }
            }
        }
    });
</script>

                <!-- Comment List Start -->
                <!-- <div class="mb-5">
                    <h2 class="mb-4">3 Comments</h2>
                    <div class="d-flex mb-4">
                        <img src="img/user.jpg" class="img-fluid" style="width: 45px; height: 45px;">
                        <div class="ps-3">
                            <h6><a href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>
                            <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor labore
                                accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed eirmod</p>
                            <button class="btn btn-sm btn-primary">Reply</button>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <img src="img/user.jpg" class="img-fluid" style="width: 45px; height: 45px;">
                        <div class="ps-3">
                            <h6><a href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>
                            <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor labore
                                accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed eirmod</p>
                            <button class="btn btn-sm btn-primary">Reply</button>
                        </div>
                    </div>
                    <div class="d-flex ms-5 mb-4">
                        <img src="img/user.jpg" class="img-fluid" style="width: 45px; height: 45px;">
                        <div class="ps-3">
                            <h6><a href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>
                            <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor labore
                                accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed eirmod</p>
                            <button class="btn btn-sm btn-primary">Reply</button>
                        </div>
                    </div>
                </div> -->
                <!-- Comment List End -->

                <!-- Comment Form Start -->
                <!-- <div class="bg-primary p-5">
                    <h2 class="text-white mb-4">Leave a comment</h2>
                    <form>
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control bg-white border-0" placeholder="Your Name" style="height: 55px;">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="email" class="form-control bg-white border-0" placeholder="Your Email" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control bg-white border-0" placeholder="Website" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control bg-white border-0" rows="5" placeholder="Comment"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-secondary w-100 py-3" type="submit">Leave Your Comment</button>
                            </div>
                        </div>
                    </form>
                </div> -->
                <!-- Comment Form End -->
            </div>

            <!-- Sidebar Start -->
            <div class="col-lg-4">
                <!-- Search Form Start -->
                <div class="mb-5">
                    <div class="input-group">
                        <input type="text" class="form-control p-3" placeholder="Keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <!-- Search Form End -->

                <!-- Category Start -->
                <!-- <div class="mb-5">
                    <h2 class="mb-4">Categories</h2>
                    <div class="d-flex flex-column justify-content-start bg-primary p-4">
                        <a class="fs-5 fw-bold text-white mb-2" href="#"><i class="bi bi-arrow-right me-2"></i>Web Design</a>
                        <a class="fs-5 fw-bold text-white mb-2" href="#"><i class="bi bi-arrow-right me-2"></i>Web Development</a>
                        <a class="fs-5 fw-bold text-white mb-2" href="#"><i class="bi bi-arrow-right me-2"></i>Web Development</a>
                        <a class="fs-5 fw-bold text-white mb-2" href="#"><i class="bi bi-arrow-right me-2"></i>Keyword Research</a>
                        <a class="fs-5 fw-bold text-white" href="#"><i class="bi bi-arrow-right me-2"></i>Email Marketing</a>
                    </div>
                </div> -->
                <!-- Category End -->

                <!-- Recent Post Start -->
                <div class="mb-5">
                    <h2 class="mb-4">Recent Reports</h2>
                    <div class="bg-primary p-4">
                        <div class="d-flex overflow-hidden mb-3">
                            <img class="img-fluid flex-shrink-0" src="img/rice.jpg" style="width: 75px;" alt="">
                            <a href="" class="d-flex align-items-center bg-white text-dark fs-5 fw-bold px-3 mb-0">Rice Reports
                            </a>
                        </div>
                        <div class="d-flex overflow-hidden mb-3">
                            <img class="img-fluid flex-shrink-0" src="img/blog-2.jpg" style="width: 75px;" alt="">
                            <a href="" class="d-flex align-items-center bg-white text-dark fs-5 fw-bold px-3 mb-0">Carrot Reports
                            </a>
                        </div>
                        <div class="d-flex overflow-hidden mb-3">
                            <img class="img-fluid flex-shrink-0" src="img/blog-3.jpg" style="width: 75px;" alt="">
                            <a href="" class="d-flex align-items-center bg-white text-dark fs-5 fw-bold px-3 mb-0">Tomato Reports
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Recent Post End -->

                <!-- Image Start -->
                <!-- <div class="mb-5">
                    <img src="img/blog-1.jpg" alt="" class="img-fluid rounded">
                </div> -->
                <!-- Image End -->

                <!-- Tags Start -->
                <!-- <div class="mb-5">
                    <h2 class="mb-4">Tag Cloud</h2>
                    <div class="d-flex flex-wrap m-n1">
                        <a href="" class="btn btn-primary m-1">Design</a>
                        <a href="" class="btn btn-primary m-1">Development</a>
                        <a href="" class="btn btn-primary m-1">Marketing</a>
                        <a href="" class="btn btn-primary m-1">SEO</a>
                        <a href="" class="btn btn-primary m-1">Writing</a>
                        <a href="" class="btn btn-primary m-1">Consulting</a>
                        <a href="" class="btn btn-primary m-1">Design</a>
                        <a href="" class="btn btn-primary m-1">Development</a>
                        <a href="" class="btn btn-primary m-1">Marketing</a>
                        <a href="" class="btn btn-primary m-1">SEO</a>
                        <a href="" class="btn btn-primary m-1">Writing</a>
                        <a href="" class="btn btn-primary m-1">Consulting</a>
                    </div>
                </div> -->
                <!-- Tags End -->

                <!-- Plain Text Start -->
                <div>
                    <h2 class="mb-4">Plain Text</h2>
                    <div class="bg-primary text-center text-white" style="padding: 30px;">
                        <p>Vero sea et accusam justo dolor accusam lorem consetetur, dolores sit amet sit dolor clita kasd justo, diam accusam no sea ut tempor magna takimata, amet sit et diam dolor ipsum amet diam</p>
                        <a href="" class="btn btn-secondary py-2 px-4">Read More</a>
                    </div>
                </div>
                <!-- Plain Text End -->
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
    <!-- Blog End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-footer bg-primary text-white mt-5">
        <!-- Footer content remains the same as in the original template -->
    </div>
    <div class="container-fluid bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; <a class="text-secondary fw-bold" href="#">Banglar Krishi</a>. All Rights Reserved.</p>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>