<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "agriculturesupplychain";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Sorry, failed to connect with database" . mysqli_connect_error());
}
// Handle Delete Operation
if (isset($_POST['delete'])) {
    $standardGradeID = $_POST['delete'];
    $delete_sql = "DELETE FROM farmer_crop_type_grade WHERE standardGradeID = '$standardGradeID'";
    
    if (mysqli_query($conn, $delete_sql)) {
        $success_message = "Record deleted successfully";
    } else {
        $error_message = "Error deleting record: " . mysqli_error($conn);
    }
}
// Handle Add Operation
if (isset($_POST['add_entry'])) {
    $standardGradeID = $_POST['standardGradeID'];
    $quantity = $_POST['quantity'];
    $cropGrade = $_POST['cropGrade'];
    $size = $_POST['criteria_size'];
    $shape = $_POST['criteria_shape'];
    $colour = $_POST['criteria_colour'];
    $infestation = isset($_POST['criteria_infestation']) ? 1 : 0;
    $cropTypeID = $_POST['cropTypeID'];
    
    $add_sql = "INSERT INTO farmer_crop_type_grade (standardGradeID, quantity, cropGrade, criteria_size,
     criteria_shape, criteria_colour, criteria_infestation, cropTypeID) 
                VALUES ('$standardGradeID', '$quantity', '$cropGrade', '$size', '$shape', '$colour', '$infestation',
                '$cropTypeID')";
    
    if (mysqli_query($conn, $add_sql)) {
        $success_message = "New record added successfully";
    } else {
        $error_message = "Error adding record: " . mysqli_error($conn);
    }
}
// Handle Update Operation
if (isset($_POST['update'])) {
    $standardGradeID = $_POST['edit_standardGradeID'];
    $quantity = $_POST['edit_quantity'];
    $cropGrade = $_POST['edit_cropGrade'];
    $size = $_POST['edit_criteria_size'];
    $shape = $_POST['edit_criteria_shape']; 
    $colour = $_POST['edit_criteria_colour'];
    $infestation = isset($_POST['edit_criteria_infestation']) ? 1 : 0; 
    $cropTypeID = $_POST['edit_cropTypeID']; 
    
    $update_sql = "UPDATE farmer_crop_type_grade SET 
                  quantity = '$quantity',
                  cropGrade = '$cropGrade', 
                  criteria_size = '$size', 
                  criteria_shape = '$shape',
                  criteria_colour = '$colour',
                  criteria_infestation = '$infestation',
                  cropTypeID = '$cropTypeID' 
                  WHERE standardGradeID = '$standardGradeID'";
    
    if (mysqli_query($conn, $update_sql)) {
        $success_message = "Record updated successfully";
    } else {
        $error_message = "Error updating record: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
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

        /* Add new styles for table and modal */
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .product-table th, .product-table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        
        .product-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        
        .product-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .product-table tr:hover {
            background-color: #f1f1f1;
        }
        
        .action-btn {
            margin: 2px;
            padding: 5px 10px;
            font-size: 0.8rem;
        }
        
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }
        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 350px; /* Slightly reduced width */
            max-height: 80vh; /* Limit maximum height */
            overflow-y: auto;
        }
        .form-group {
            margin-bottom: 8px; 
        }

        .form-group label {
            display: inline-block;
    width: 35%;
    margin-bottom: 2px;
    font-weight: bold;
    font-size: 0.9rem;
    vertical-align: middle;
        }
        
        .form-group input, .form-group select {
            width: 60%;
    display: inline-block;
    padding: 4px;
    border: 1px solid #ddd;
    border-radius: 3px;
    font-size: 0.9rem;
    vertical-align: middle;
        }
        .form-group input[type="checkbox"] {
            width: auto;
            height: auto;
            margin-top: 5px;
        }
        .btn-container {
            margin-top: 12px; /* Reduced from 20px */
            text-align: right;
        }

        .btn-container .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }
        .modal-content h4 {
            font-size: 1.1rem;
    margin: 0 0 10px 0;
    text-align: center;
    color: #28a745;
}
          
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

        /* Table styling with transitions */
.product-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

.product-table th, .product-table td {
    padding: 12px;
    text-align: center;
    border: 1px solid #e0e0e0;
    transition: all 0.3s ease;
}

.product-table th {
    background-color: #28a745;
    font-weight: bold;
    color:rgb(255, 255, 255);
    position: sticky;
    top: 0;
}

.product-table tr {
    transition: background-color 0.3s ease;
}

.product-table tr:nth-child(even) {
    background-color: #f2f7ff;
}

.product-table tr:nth-child(odd) {
    background-color: #ffffff;
}

.product-table tr:hover {
    background-color: #e8f4f8;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
}

.product-table tr:hover td {
    color: #28a745;
}

.product-table td .action-btn {
    opacity: 0.7;
    transition: all 0.3s ease;
    margin: 2px;
    transform: scale(1);
}

.product-table td .action-btn:hover {
    opacity: 1;
    transform: scale(1.1);
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

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


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
                    <a class="btn btn-primary btn-square rounded-circle me-2" href="profile.php" title="Profile">
                        <i class="fas fa-user"></i>
                    </a>
                    <!-- Logout Icon -->
                    <a class="btn btn-success btn-square rounded-circle logout-btn" href="login.php" title="Logout">
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
                <a href="qualityReport.php" class="nav-item nav-link px-3">Inspector Report</a>
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
 <!-- Add this right after the Hero section before the Grading Table section -->
<div class="container mt-3">
    <?php if(isset($success_message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $success_message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <?php if(isset($error_message)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $error_message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
</div>


    <!-- Grading Table Section Start -->
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
                <table class="product-table" id="gradingTable">
                    <thead>
                        <tr>
                            <th>Standard Grade ID</th>
                            <th>Quantity(kg)</th>
                            <th>Crop Grade</th>
                            <th>Size(cm)</th>
                            <th>Shape</th>
                            <th>Colour</th>
                            <th>Infestation</th>
                            <th>Crop Type ID</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT standardGradeID, quantity, cropGrade, criteria_size,criteria_shape,criteria_colour,
                        criteria_infestation, cropTypeID FROM farmer_crop_type_grade";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['standardGradeID']; ?></td>

                            <td><?php echo $row['quantity']; ?></td>

                            <td><?php echo $row['cropGrade']; ?></td>

                            <td><?php echo $row['criteria_size']; ?></td>

                            <td><?php echo $row['criteria_shape']; ?></td>

                            <td><?php echo $row['criteria_colour']; ?></td>

                            <td><?php echo $row['criteria_infestation']; ?></td>

                            <td><?php echo $row['cropTypeID']; ?></td>
                            <td>
                            <button class="btn btn-primary action-btn edit-btn" 
                                data-id="<?php echo $row['standardGradeID']; ?>" 
                                data-quantity="<?php echo $row['quantity']; ?>" 
                                data-cropgrade="<?php echo $row['cropGrade']; ?>" 
                                data-size="<?php echo $row['criteria_size']; ?>" 
                                data-shape="<?php echo $row['criteria_shape']; ?>"
                                data-colour="<?php echo $row['criteria_colour']; ?>"
                                data-infestation="<?php echo $row['criteria_infestation']; ?>"
                                data-croptypeid="<?php echo $row['cropTypeID']; ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="delete" value="<?php echo $row['standardGradeID']; ?>">
                                    <button type="submit" class="btn btn-danger action-btn delete-btn" 
                                            onclick="return confirm('Are you sure you want to delete this record?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>


                        </tr>

                <?php   }
                }
                ?>
                    </tbody>
            </table>
            
            </div>
            <div class="mb-3 text-center">
                <button id="addProductBtn" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Entry
                </button>
            </div>
        </div>
        

       <!--grading table ends-->
    <!-- ADD NEW ENTRY -->
    <div id="addProductModal" class="modal-overlay">
        <div class="modal-content">
            <h4>Add New Graded Product</h4>
            <form id="addProductForm" method="post" action="">
                <div class="form-group">
                    <label for="standardGradeID">Standard Grade ID</label>
                    <input type="text" id="standardGradeID" name="standardGradeID" required>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity(kg)</label>
                    <input type="text" id="quantity" name="quantity" required>
                </div>

                <div class="form-group">
                    <label for="cropGrade">Crop Grade</label>
                    <input type="text" id="cropGrade" name="cropGrade" required>
                </div>

                <div class="form-group">
                    <label for="criteria_size">Size</label>
                    <input type="text" id="criteria_size" name="criteria_size" required>
                </div>

                <div class="form-group">
                    <label for="criteria_shape">Shape</label>
                    <input type="text" id="criteria_shape" name="criteria_shape" required>
                </div>

                <div class="form-group">
                    <label for="criteria_colour">Colour</label>
                    <input type="text" id="criteria_colour" name="criteria_colour" required>
                </div>

                <div class="form-group">
                    <label for="criteria_infestation">Infestation</label>
                    <input type="checkbox" id="criteria_infestation" name="criteria_infestation" required>
                </div>

                <div class="form-group">
                    <label for="cropTypeID">Crop Type ID</label>
                    <select name="cropTypeID" class="form-control" required>
                            <option value="">Select Crop Type</option>
                            <?php
                            // Fetch crop types for dropdown
                            $cropTypes = $conn->query("SELECT cropTypeID, cropType FROM farmer_crop_type");
                            while ($cropType = $cropTypes->fetch_assoc()) {
                                echo "<option value='{$cropType['cropTypeID']}'>{$cropType['cropTypeID']} - {$cropType['cropType']}</option>";
                            }
                            ?>
                        </select>
                </div>
                <div class="btn-container">
                    <button type="button" id="cancelAddBtn" class="btn btn-secondary">Cancel</button>
                    <button type="submit" name="add_entry" class="btn btn-primary">Add Entry</button>
                </div>
            </form>
        </div>
    </div>
        <!-- Edit Product Modal -->
    <div id="editProductModal" class="modal-overlay">
        <div class="modal-content">
            <h4>Edit Graded Product</h4>
            <form id="editProductForm" method="post" action="">
                <input type="hidden" id="edit_standardGradeID" name="edit_standardGradeID">
                <div class="form-group">
                    <label for="edit_quantity">Quantity(kg)</label>
                    <input type="text" id="edit_quantity" name="edit_quantity" required>
                </div>

                <div class="form-group">
                    <label for="edit_cropGrade">Crop Grade</label>
                    <input type="text" id="edit_cropGrade" name="edit_cropGrade" required>
                </div>

                <div class="form-group">
                    <label for="edit_criteria_size">Size</label>
                    <input type="text" id="edit_criteria_size" name="edit_criteria_size" required>
                </div>

                <div class="form-group">
                    <label for="edit_criteria_shape">Shape</label>
                    <input type="text" id="edit_criteria_shape" name="edit_criteria_shape" required>
                </div>

                <div class="form-group">
                    <label for="edit_criteria_colour">Colour</label>
                    <input type="text" id="edit_criteria_colour" name="edit_criteria_colour" required>
                </div>

                <div class="form-group">
                    <label for="edit_criteria_infestation">Infestation</label>
                    <input type="checkbox" id="edit_criteria_infestation" name="edit_criteria_infestation" required>
                </div>

                <div class="form-group">
                    <label for="edit_cropTypeID">Crop Type ID</label>
                    <select name="edit_cropTypeID" class="form-control" required>
                            <option value="">Select Crop Type</option>
                            <?php
                            // Fetch crop types for dropdown
                            $cropTypes = $conn->query("SELECT cropTypeID, cropType FROM farmer_crop_type");
                            while ($cropType = $cropTypes->fetch_assoc()) {
                                echo "<option value='{$cropType['cropTypeID']}'>{$cropType['cropTypeID']} - {$cropType['cropType']}</option>";
                            }
                            ?>
                        </select>
                </div>

                <div class="btn-container">
                    <button type="button" id="cancelEditBtn" class="btn btn-secondary">Cancel</button>
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

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
    </script> 
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
       // Add New Entry Button Handler
document.getElementById('addProductBtn').addEventListener('click', function() {
    document.getElementById('addProductModal').style.display = 'block';
});

document.getElementById('cancelAddBtn').addEventListener('click', function() {
    document.getElementById('addProductModal').style.display = 'none';
    document.getElementById('addProductForm').reset();
});

// Edit Button Handler
        document.querySelectorAll(".edit-btn").forEach(btn => {
            btn.addEventListener("click", function() {
        const id = this.getAttribute('data-id');
        const quantity = this.getAttribute('data-quantity');
        const cropGrade = this.getAttribute('data-cropgrade');
        const size = this.getAttribute('data-size');
        const shape = this.getAttribute('data-shape');
        const colour = this.getAttribute('data-colour');
        const infestation = this.getAttribute('data-infestation');
        const cropTypeID = this.getAttribute('data-croptypeid');
        
        // Fill the edit form with data
        document.getElementById('edit_standardGradeID').value = id;
        document.getElementById('edit_quantity').value = quantity;
        document.getElementById('edit_cropGrade').value = cropGrade;
        document.getElementById('edit_criteria_size').value = size;
        document.getElementById('edit_criteria_shape').value = shape;
        document.getElementById('edit_criteria_colour').value = colour;
        
        // Handle checkbox for infestation (non-mandatory)
        document.getElementById('edit_criteria_infestation').checked = (infestation === '1');
        
        // Show the edit modal without pre-selecting cropTypeID
        document.getElementById('editProductModal').style.display = 'block';
    });
});

document.getElementById('cancelEditBtn').addEventListener('click', function() {
    document.getElementById('editProductModal').style.display = 'none';
});

// Close modals when clicking outside
window.addEventListener('click', function(event) {
    const addModal = document.getElementById('addProductModal');
    const editModal = document.getElementById('editProductModal');
    
    if (event.target === addModal) {
        addModal.style.display = 'none';
        document.getElementById('addProductForm').reset();
    }
    
    if (event.target === editModal) {
        editModal.style.display = 'none';
    }
});


// Remove required attribute from infestation checkboxes
document.addEventListener('DOMContentLoaded', function() {
    // For add form
    const addInfestationCheckbox = document.getElementById('criteria_infestation');
    if (addInfestationCheckbox) {
        addInfestationCheckbox.removeAttribute('required');
    }
    
    // For edit form
    const editInfestationCheckbox = document.getElementById('edit_criteria_infestation');
    if (editInfestationCheckbox) {
        editInfestationCheckbox.removeAttribute('required');
    }
});

document.addEventListener('DOMContentLoaded', refreshEditButtons);
    </script>
    



   
</body>

</html>


   