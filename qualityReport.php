<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "agriculturesupplychain";

// Create connection using mysqli with error handling
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize message variables
$success_message = "";
$error_message = "";

// Delete record - with prepared statement to prevent SQL injection
if (isset($_POST['delete_record'])) {
    $record_id = $_POST['record_id'];
    
    $deleteQuery = "DELETE FROM inspector_records WHERE record_id = ?";
    $stmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "s", $record_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $success_message = "Record deleted successfully!";
    } else {
        $error_message = "Failed to delete record: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}

// Add new record - with prepared statement
if (isset($_POST['add_record'])) {
    // Sanitize inputs
    $inspector_name = mysqli_real_escape_string($conn, $_POST['inspectorName']);
    $batchID = mysqli_real_escape_string($conn, $_POST['batchID']);
    $standardGradeID = mysqli_real_escape_string($conn, $_POST['standardGradeID']);
    $packageID = mysqli_real_escape_string($conn, $_POST['packageID']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
    
    // Generate a unique record_id (e.g., REC001, REC002)
    $result = mysqli_query($conn, "SELECT MAX(CAST(SUBSTRING(record_id, 4) AS UNSIGNED)) as max_id FROM inspector_records WHERE record_id LIKE 'REC%'");
    $row = mysqli_fetch_assoc($result);
    $next_id = ($row['max_id'] ?? 0) + 1;
    $record_id = 'REC' . sprintf('%03d', $next_id);
    
    // Use prepared statement for insert
    $insertQuery = "INSERT INTO inspector_records (record_id, inspector_name, batchID, standardGradeID, packageID, remarks) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($stmt, "ssssss", $record_id, $inspector_name, $batchID, $standardGradeID, $packageID, $remarks);
    
    if (mysqli_stmt_execute($stmt)) {
        $success_message = "Record added successfully!";
    } else {
        $error_message = "Failed to add record: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}

// Update record - with prepared statement
if (isset($_POST['update_record'])) {
    // Sanitize inputs
    $record_id = mysqli_real_escape_string($conn, $_POST['record_id']);
    $inspector_name = mysqli_real_escape_string($conn, $_POST['inspectorName']);
    $batchID = mysqli_real_escape_string($conn, $_POST['batchID']);
    $standardGradeID = mysqli_real_escape_string($conn, $_POST['standardGradeID']);
    $packageID = mysqli_real_escape_string($conn, $_POST['packageID']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
    
    // Use prepared statement for update
    $updateQuery = "UPDATE inspector_records SET inspector_name = ?, batchID = ?, standardGradeID = ?, packageID = ?, remarks = ? WHERE record_id = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "ssssss", $inspector_name, $batchID, $standardGradeID, $packageID, $remarks, $record_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $success_message = "Record updated successfully!";
    } else {
        $error_message = "Failed to update record: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}

// Search by batch ID - with prepared statement
$search_query = "";
$search_param = "";
if (isset($_GET['search']) && !empty($_GET['search_term'])) {
    $search_term = $_GET['search_term'];
    $search_param = "%" . $search_term . "%";
    $search_query = "WHERE batchID LIKE ?";
}

// Get all records for display
$query = "SELECT * FROM inspector_records " . $search_query . " ORDER BY record_id";
$stmt = mysqli_prepare($conn, $query);

// If search is active, bind the parameter
if ($search_param) {
    mysqli_stmt_bind_param($stmt, "s", $search_param);
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        /* Original styles */
        .logout-btn {
            background-color: #28a745;
            border-color: #28a745;
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

        /* New styles for full-width table section */
        .full-width-section {
            width: 100%;
            max-width: 100%;
            padding: 0;
            margin-bottom: 3rem;
        }

        .full-width-container {
            width: 100%;
            max-width: 100%;
            padding: 2rem;
            background-color: #f8f9fa;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        #recordsTable {
            width: 100%;
            table-layout: auto;
        }

        #recordsTable th, #recordsTable td {
            white-space: nowrap;
            min-width: 120px;
        }

        #recordsTable th:first-child,
        #recordsTable td:first-child {
            min-width: 80px;
        }

        #recordsTable td:last-child {
            min-width: 100px;
            text-align: center;
        }

        .form-container {
            width: 100%;
        }

        /* Chart container styles */
        .chart-container {
            width: 100%;
            margin-top: 2rem;
            height: 300px;
        }
        
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            border-radius: 5px;
        }
        
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }
        
        /* Center the "Add Record" button */
        .add-record-btn-container {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
        
        .edit-form-container {
            display: none;
        }

        /* Alert messages */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .full-width-container {
                padding: 1rem;
            }
            
            .modal-content {
                width: 90%;
            }
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
                    <h2 class="mb-0">01794017804</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-flex align-items-center justify-content-center">
                    <a href="home.php" class="navbar-brand ms-lg-5">
                        <h1 class="m-0 display-4 text-primary"><span class="text-secondary">বাংলার </span>কৃষি</h1>
                    </a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex align-items-center justify-content-end">
                    <!-- Profile Icon -->
                    <a class="btn btn-primary btn-square rounded-circle me-2" href="profile.php" title="Profile">
                        <i class="fas fa-user"></i>
                    </a>
                    <!-- Logout Icon -->
                    <a class="btn btn-success btn-square rounded-circle logout-btn" href="logout.php" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>   
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-5">
        <a href="home.php" class="navbar-brand d-flex d-lg-none">
            <h1 class="m-0 display-4 text-secondary"><span class="text-white">Banglar</span>Krishi</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0 d-flex align-items-center text-center">
                <a href="home.php" class="nav-item nav-link px-3">Home</a>
                <a href="gradingCriteria.php" class="nav-item nav-link px-3">Grading Criteria</a>
                <a href="qualityReport.php" class="nav-item nav-link active px-3">Inspector Report</a>
                <a href="qualityTrendAnalysis.php" class="nav-item nav-link px-3">Quality Trend</a>
                <a href="transportationTracking.php" class="nav-item nav-link px-3">Transportation Tracking</a>
                <a href="trackingOfGradedProducts.php" class="nav-item nav-link px-3">Graded Product Tracking</a>
                <a href="packagingTrackingSystem.php" class="nav-item nav-link px-3">Packaging Tracking</a>
                
                <div class="nav-item dropdown px-3">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">More</a>
                    <div class="dropdown-menu text-center">
                        <a href="service.php" class="dropdown-item">Service</a>
                        <a href="contact.php" class="dropdown-item">Contact Us</a>
                        <a href="about.php" class="dropdown-item">About</a>
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

    <!-- Alert Messages -->
    <?php if(!empty($success_message)): ?>
    <div class="container mb-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $success_message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if(!empty($error_message)): ?>
    <div class="container mb-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $error_message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php endif; ?>

    <!-- Search Form in Container -->
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form method="GET" action="qualityReport.php">
                    <div class="input-group">
                        <input type="text" name="search_term" class="form-control p-3" placeholder="Search by Batch ID..." value="<?php echo isset($_GET['search_term']) ? htmlspecialchars($_GET['search_term']) : ''; ?>">
                        <button type="submit" name="search" class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                        <?php if(isset($_GET['search'])): ?>
                            <a href="qualityReport.php" class="btn btn-secondary px-4">Clear</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Record Button (Centered) -->
    <div class="container mb-4">
        <div class="add-record-btn-container">
            <button id="addRecordBtn" class="btn btn-primary btn-lg">Add New Record</button>
        </div>
    </div>

    <!-- Inspector Records and Chart Start - FULL WIDTH -->
    <div class="container-fluid full-width-section">
        <div class="full-width-container">
            <h2 class="text-center mb-4">Inspector Records and Quality Reports</h2>
            
            <!-- Records Table -->
            <div class="table-responsive mb-4">
                <h3>Current Records</h3>
                <?php if(isset($_GET['search']) && !empty($_GET['search_term'])): ?>
                    <p>Showing results for: "<?php echo htmlspecialchars($_GET['search_term']); ?>"</p>
                <?php endif; ?>
                
                <table id="recordsTable" class="table table-bordered text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>Record ID</th>
                            <th>Inspector Name</th>
                            <th>Batch ID</th>
                            <th>Standard Grade ID</th>
                            <th>Package ID</th>
                            <th>Remarks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr data-id="<?php echo htmlspecialchars($row['record_id']); ?>">
                            <td><?php echo htmlspecialchars($row['record_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['inspector_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['batchID']); ?></td>
                            <td><?php echo htmlspecialchars($row['standardGradeID']); ?></td>
                            <td><?php echo htmlspecialchars($row['packageID']); ?></td>
                            <td><?php echo htmlspecialchars($row['remarks']); ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="openEditModal('<?php echo htmlspecialchars($row['record_id']); ?>', '<?php echo htmlspecialchars($row['inspector_name']); ?>', '<?php echo htmlspecialchars($row['batchID']); ?>', '<?php echo htmlspecialchars($row['standardGradeID']); ?>', '<?php echo htmlspecialchars($row['packageID']); ?>', '<?php echo htmlspecialchars($row['remarks']); ?>')">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete('<?php echo htmlspecialchars($row['record_id']); ?>')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No records found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Chart Container -->
            <div class="chart-container">
                <canvas id="qualityChart"></canvas>
            </div>
        </div>
    </div>
    <!-- Inspector Records and Chart End -->

    <!-- Add Record Modal -->
    <div id="addRecordModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddModal()">&times;</span>
            <h3>Add New Record</h3>
            <form id="recordForm" method="POST" action="qualityReport.php" onsubmit="return validateForm('recordForm')">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="inspectorName" class="form-label">Inspector Name</label>
                        <input type="text" class="form-control" id="inspectorName" name="inspectorName" required>
                        <div class="invalid-feedback">Please enter an inspector name.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="batchID" class="form-label">Batch ID</label>
                        <input type="text" class="form-control" id="batchID" name="batchID" required>
                        <div class="invalid-feedback">Please enter a batch ID.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="standardGradeID" class="form-label">Standard Grade ID</label>
                        <input type="text" class="form-control" id="standardGradeID" name="standardGradeID" required>
                        <div class="invalid-feedback">Please enter a standard grade ID.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="packageID" class="form-label">Package ID</label>
                        <input type="text" class="form-control" id="packageID" name="packageID" required>
                        <div class="invalid-feedback">Please enter a package ID.</div>
                    </div>
                    <div class="col-md-12">
                        <label for="remarks" class="form-label">Remarks</label>
                        <input type="text" class="form-control" id="remarks" name="remarks" required>
                        <div class="invalid-feedback">Please enter remarks.</div>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <button type="submit" name="add_record" class="btn btn-primary">Add Record</button>
                    <button type="button" class="btn btn-secondary" onclick="closeAddModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Record Modal -->
    <div id="editRecordModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h3>Edit Record</h3>
            <form id="editForm" method="POST" action="qualityReport.php" onsubmit="return validateForm('editForm')">
                <input type="hidden" id="edit_record_id" name="record_id">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="edit_inspectorName" class="form-label">Inspector Name</label>
                        <input type="text" class="form-control" id="edit_inspectorName" name="inspectorName" required>
                        <div class="invalid-feedback">Please enter an inspector name.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="edit_batchID" class="form-label">Batch ID</label>
                        <input type="text" class="form-control" id="edit_batchID" name="batchID" required>
                        <div class="invalid-feedback">Please enter a batch ID.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="edit_standardGradeID" class="form-label">Standard Grade ID</label>
                        <input type="text" class="form-control" id="edit_standardGradeID" name="standardGradeID" required>
                        <div class="invalid-feedback">Please enter a standard grade ID.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="edit_packageID" class="form-label">Package ID</label>
                        <input type="text" class="form-control" id="edit_packageID" name="packageID" required>
                        <div class="invalid-feedback">Please enter a package ID.</div>
                    </div>
                    <div class="col-md-12">
                        <label for="edit_remarks" class="form-label">Remarks</label>
                        <input type="text" class="form-control" id="edit_remarks" name="remarks" required>
                        <div class="invalid-feedback">Please enter remarks.</div>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <button type="submit" name="update_record" class="btn btn-primary">Update Record</button>
                    <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Form (Hidden) -->
    <form id="deleteForm" method="POST" action="qualityReport.php" style="display: none;">
        <input type="hidden" id="delete_record_id" name="record_id">
        <input type="hidden" name="delete_record" value="1">
    </form>

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

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Form validation
        function validateForm(formId) {
            const form = document.getElementById(formId);
            const inputs = form.querySelectorAll('input[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });
            
            return isValid;
        }
        
        // Add Record Modal
        var addModal = document.getElementById("addRecordModal");
        var addBtn = document.getElementById("addRecordBtn");
        
        addBtn.onclick = function() {
            addModal.style.display = "block";
        }
        
        function closeAddModal() {
            addModal.style.display = "none";
            // Reset form
            document.getElementById("recordForm").reset();
            const inputs = document.getElementById("recordForm").querySelectorAll('input');
            inputs.forEach(input => input.classList.remove('is-invalid'));
        }
        
        // Edit Record Modal
        var editModal = document.getElementById("editRecordModal");
        
        function openEditModal(recordId, inspectorName, batchID, standardGradeID, packageID, remarks) {
            document.getElementById("edit_record_id").value = recordId;
            document.getElementById("edit_inspectorName").value = inspectorName;
            document.getElementById("edit_batchID").value = batchID;
            document.getElementById("edit_standardGradeID").value = standardGradeID;
            document.getElementById("edit_packageID").value = packageID;
            document.getElementById("edit_remarks").value = remarks;
            
            editModal.style.display = "block";
        }
        
        function closeEditModal() {
            editModal.style.display = "none";
            // Reset form validation styles
            const inputs = document.getElementById("editForm").querySelectorAll('input');
            inputs.forEach(input => input.classList.remove('is-invalid'));
        }
        
        // Delete Confirmation
        function confirmDelete(recordId) {
            if (confirm("Are you sure you want to delete this record?")) {
                document.getElementById("delete_record_id").value = recordId;
                document.getElementById("deleteForm").submit();
            }
        }
        
        // Close modals when clicking outside
        window.onclick = function(event) {
            if (event.target == addModal) {
                closeAddModal();
            }
            if (event.target == editModal) {
                closeEditModal();
            }
        }
        
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
            
            // Initialize chart with current data
            updateChart();
        });
        
        function updateChart() {
            const rows = document.querySelectorAll('#recordsTable tbody tr');
            const batchCounts = {};
            const gradeData = {};
            
            // Count batches and collect grade info
            rows.forEach(row => {
                if (row.cells.length > 2) { // Make sure it's a data row
                    const batchID = row.cells[2].textContent.trim();
                    const gradeID = row.cells[3].textContent.trim();
                    
                    // Count batches
                    if (batchCounts[batchID]) {
                        batchCounts[batchID]++;
                    } else {
                        batchCounts[batchID] = 1;
                    }
                    
                    // Collect grade data
                    if (!gradeData[gradeID]) {
                        gradeData[gradeID] = 1;
                    } else {
                        gradeData[gradeID]++;
                    }
                }
            });
            
            // Prepare chart data
            const labels = Object.keys(batchCounts);
            const data = Object.values(batchCounts);
            
            // Create color array with different colors
            const backgroundColors = labels.map((_, index) => {
                const hue = (index * 30) % 360; // Different hue for each bar
                return `hsla(${hue}, 70%, 60%, 0.7)`;
            });
            
            const borderColors = labels.map((_, index) => {
                const hue = (index * 30) % 360;
                return `hsla(${hue}, 70%, 50%, 1)`;
            });
            
            // Create or update chart
            const ctx = document.getElementById('qualityChart').getContext('2d');
            
            if (window.qualityChart) {
                window.qualityChart.destroy();
            }
            
            window.qualityChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Records per Batch',
                        data: data,
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Number of Records by Batch ID',
                            font: {
                                size: 16
                            }
                        },
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `Records: ${context.raw}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                precision: 0
                            },
                            title: {
                                display: true,
                                text: 'Number of Records'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Batch ID'
                            }
                        }
                    }
                }
            });
        }
    </script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>