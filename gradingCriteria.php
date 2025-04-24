<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "agriculturesupplychain";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Sorry, failed to connect with database" . mysqli_connect_error());
}
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
    <title>Banglar Krishi - Product Grading Standards</title>
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

    <!-- Additional Custom CSS for Grading Charts -->
    <style>
        .grading-section {
            margin-bottom: 50px;
        }
        .grading-section h2 {
            color: #5CB874;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #5CB874;
        }
        .table-responsive {
            margin-bottom: 25px;
        }
        .additional-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .additional-info p {
            margin-bottom: 5px;
        }
        .table-primary {
            --bs-table-bg: rgba(92, 184, 116, 0.1);
        }
        .table-primary th {
            background-color: #5CB874;
            color: white;
        }
    </style>
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
                <a href="gradingCriteria.php" class="nav-item nav-link px-3">Grading Criteria</a>
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
<div class="container-fluid bg-primary py-5 bg-hero-grading mb-5">
    <div class="container h-100 d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-1 text-white mb-0"></h1>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->


    <!-- Grading Charts Start -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-5 text-center">
                    <h1 class="display-5">Grading Criteria & Standards</h1>
                    <p class="fs-5 text-muted">Quality standards for our organic farm products</p>
                </div>
            </div>
        </div>
        <div class="container py-5">
            <div class="row mb-4">
                <div class="col-md-6 offset-md-3">
                    <input type="text" id="gradingTableSearch" class="form-control" placeholder="Search table...">
                </div>
            </div>
            <div class="table-responsive">
                <table id="gradingTable" class="table table-bordered table-striped table-primary">
                    <thead>
                        <tr>
                            <th>Standard Grade ID</th>
                            <th>Crop Type ID</th>
                            <th>Quantity</th>
                            <th>Grade</th>
                            <th>Size</th>
                            <th>Shape</th>
                            <th>Colour</th>
                            <th>Infestation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>STD-TOM-01-A</td>
                            <td>TOM-Roma-01</td>
                            <td>2Kg</td>
                            <td>A</td>
                            <td>10-25cm</td>
                            <td>Straight</td>
                            <td>Bright Red</td>
                            <td>None</td>
                            <td>
                                <button class="btn btn-sm btn-warning btn-edit">Edit</button>
                                <button class="btn btn-sm btn-danger btn-delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>STD-ORG-02-A</td>
                            <td>ORG-Roma-04</td>
                            <td>2Kg</td>
                            <td>A</td>
                            <td>10-25cm</td>
                            <td>Straight</td>
                            <td>Bright Orange</td>
                            <td>None</td>
                            <td>
                                <button class="btn btn-sm btn-warning btn-edit">Edit</button>
                                <button class="btn btn-sm btn-danger btn-delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>STD-TOM-05-A</td>
                            <td>TOM-Roma-07</td>
                            <td>2Kg</td>
                            <td>A</td>
                            <td>10-25cm</td>
                            <td>Straight</td>
                            <td>Bright Red</td>
                            <td>None</td>
                            <td>
                                <button class="btn btn-sm btn-warning btn-edit">Edit</button>
                                <button class="btn btn-sm btn-danger btn-delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>STD-TOM-05-A</td>
                            <td>TOM-Roma-07</td>
                            <td>2Kg</td>
                            <td>A</td>
                            <td>10-25cm</td>
                            <td>Straight</td>
                            <td>Bright Red</td>
                            <td>None</td>
                            <td>
                                <button class="btn btn-sm btn-warning btn-edit">Edit</button>
                                <button class="btn btn-sm btn-danger btn-delete">Delete</button>
                            </td>
                        </tr>

                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            
            </div>
        </div>
        

       <!--grading table ends-->

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
    <script>
        // Search Filter
        document.getElementById('gradingTableSearch').addEventListener('input', function () {
            const query = this.value.toLowerCase();
            const rows = document.querySelectorAll('#gradingTable tbody tr');
    
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    
        // Edit/Delete Actions
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', function () {
                const row = this.closest('tr');
                row.contentEditable = row.isContentEditable ? false : true;
                this.textContent = row.isContentEditable ? 'Save' : 'Edit';
            });
        });
    
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function () {
                const row = this.closest('tr');
                row.remove();
            });
        });
    </script> 
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartCtx = document.getElementById('gradeChart').getContext('2d');
        const gradeCounts = { A: 0, B: 0, C: 0 };
    
        const gradeChart = new Chart(chartCtx, {
            type: 'bar',
            data: {
                labels: ['A', 'B', 'C'],
                datasets: [{
                    label: 'Graded Products',
                    data: [gradeCounts.A, gradeCounts.B, gradeCounts.C],
                    backgroundColor: ['#5cb85c', '#f0ad4e', '#d9534f']
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    
        // Function to update chart data
        function updateGradeChart(grade) {
            const g = grade.toUpperCase();
            if (gradeCounts[g] !== undefined) {
                gradeCounts[g]++;
                gradeChart.data.datasets[0].data = [gradeCounts.A, gradeCounts.B, gradeCounts.C];
                gradeChart.update();
            }
        }
    
        // Add inside your form submission JS (AFTER row is added)
        document.getElementById('addGradingForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const form = e.target;
            const values = Array.from(form.elements).reduce((obj, el) => {
                if (el.name) obj[el.name] = el.value;
                return obj;
            }, {});
    
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${values.standardGradeId}</td>
                <td>${values.cropTypeId}</td>
                <td>${values.quantity}</td>
                <td>${values.grade}</td>
                <td>${values.size}</td>
                <td>${values.shape}</td>
                <td>${values.colour}</td>
                <td>${values.infestation}</td>
                <td>
                    <button class="btn btn-sm btn-warning btn-edit">Edit</button>
                    <button class="btn btn-sm btn-danger btn-delete">Delete</button>
                </td>
            `;
            document.querySelector('#gradingTable tbody').appendChild(newRow);
            attachRowActions(newRow);
            updateGradeChart(values.grade); // <- UPDATE CHART HERE
            form.reset();
            bootstrap.Modal.getInstance(document.getElementById('addGradingModal')).hide();
        });
    </script>
    



   
</body>

</html>


   