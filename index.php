<?php
$pageTitle = "Home";
include_once 'includes/header.php';
?>

<div class="jumbotron">
    <h2>Welcome to Tiny College Vehicle Management Database</h2>
    <p class="lead">This system manages vehicle reservations, checkouts, trip completions, and maintenance for the TFBS Center.</p>
</div>

<div class="row mt-4">
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Faculty</h3>
                <p class="card-text">Manage faculty members who can reserve vehicles.</p>
                <a href="faculty/list.php" class="btn btn-primary">View Faculty</a>
                <a href="faculty/create.php" class="btn btn-outline-primary">Add New</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Vehicles</h3>
                <p class="card-text">Manage the college's vehicle fleet.</p>
                <a href="vehicle/list.php" class="btn btn-primary">View Vehicles</a>
                <a href="vehicle/create.php" class="btn btn-outline-primary">Add New</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Reservations</h3>
                <p class="card-text">Manage vehicle reservations by faculty.</p>
                <a href="reservation/list.php" class="btn btn-primary">View Reservations</a>
                <a href="reservation/create.php" class="btn btn-outline-primary">Add New</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Trip Completion</h3>
                <p class="card-text">Record completed trips and related information.</p>
                <a href="trip_completion/list.php" class="btn btn-primary">View Trip Forms</a>
                <a href="trip_completion/create.php" class="btn btn-outline-primary">Add New</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Maintenance</h3>
                <p class="card-text">Track vehicle maintenance activities.</p>
                <a href="maintenance_log/list.php" class="btn btn-primary">View Maintenance</a>
                <a href="maintenance_log/create.php" class="btn btn-outline-primary">Add New</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Reports</h3>
                <p class="card-text">Generate monthly reports on vehicle usage and maintenance.</p>
                <a href="reports/index.php" class="btn btn-primary">View Reports</a>
            </div>
        </div>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>