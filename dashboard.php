<?php
include("includes/session.php");
include("config/database.php");
include("includes/header.php");
include("includes/sidebar.php");
include("includes/auth.php");

// Dashboard Statistics
$patients      = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM patients"));
$doctors       = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM doctors"));
$appointments  = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM appointments"));
$pharmacy      = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM pharmacy"));
$billing       = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM billing"));
$users         = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users"));

// Recent Activities
$activities_sql = "

    SELECT
        CONCAT('👤 Patient Registered: ', full_name) AS activity,
        created_at AS activity_time,
        id AS record_id,
        'patients/patients.php' AS activity_link
    FROM patients

    UNION ALL

    SELECT
        CONCAT('👨‍⚕️ Doctor Added: ', full_name) AS activity,
        created_at AS activity_time,
        id AS record_id,
        'doctors/doctors.php' AS activity_link
    FROM doctors

    UNION ALL

    SELECT
        '📅 Appointment Created' AS activity,
        created_at AS activity_time,
        id AS record_id,
        'appointments/appointments.php' AS activity_link
    FROM appointments

    UNION ALL

    SELECT
        CONCAT('💊 Medicine Added: ', medicine_name) AS activity,
        created_at AS activity_time,
        id AS record_id,
        'pharmacy/pharmacy.php' AS activity_link
    FROM pharmacy

    UNION ALL

    SELECT
        CONCAT('👤 User Created: ', full_name) AS activity,
        created_at AS activity_time,
        id AS record_id,
        'users/users.php' AS activity_link
    FROM users

    UNION ALL

    SELECT
        CONCAT('🧾 Bill Created: ', service) AS activity,
        billing_date AS activity_time,
        id AS record_id,
        'billing/billing.php' AS activity_link
    FROM billing

    ORDER BY activity_time DESC
    LIMIT 10
";

$activities_result = mysqli_query($conn, $activities_sql);
?>

<div class="main-content">

<?php include("includes/topbar.php"); ?>

<div class="container-fluid">

<h2 class="mb-4">Dashboard</h2>

<div class="row">

    <!-- Patients -->
    <div class="col-md-4 mb-3">
        <a href="http://localhost/SMTH-EPR/patients/patients.php"
   class="dashboard-link"
   style="text-decoration:none !important; color:inherit !important;">

            <div class="card bg-primary text-white shadow dashboard-card">
                <div class="card-body text-center">
                    <i class="bi bi-people-fill dashboard-icon"></i>
<h5>Total Patients</h5>
                    <h2><?php echo $patients; ?></h2>
                </div>
            </div>

        </a>
    </div>


    <!-- Doctors -->
    <div class="col-md-4 mb-3">
        <a href="http://localhost/SMTH-EPR/doctors/doctors.php"
           class="dashboard-link"
   style="text-decoration:none !important; color:inherit !important;">

            <div class="card bg-success text-white shadow dashboard-card">
                <div class="card-body text-center">
                    <i class="bi bi-person-badge-fill dashboard-icon"></i>
<h5>Total Doctors</h5>
                    <h2><?php echo $doctors; ?></h2>
                </div>
            </div>

        </a>
    </div>


    <!-- Appointments -->
    <div class="col-md-4 mb-3">
        <a href="http://localhost/SMTH-EPR/appointments/appointments.php"
           class="dashboard-link"
   style="text-decoration:none !important; color:inherit !important;">

            <div class="card bg-warning text-dark shadow dashboard-card">
                <div class="card-body text-center">
                    <i class="bi bi-calendar-check dashboard-icon"></i>
<h5>Total Appointments</h5>
                    <h2><?php echo $appointments; ?></h2>
                </div>
            </div>

        </a>
    </div>


    <!-- Pharmacy -->
    <div class="col-md-4 mb-3">
        <a href="http://localhost/SMTH-EPR/pharmacy/pharmacy.php"
           class="dashboard-link"
   style="text-decoration:none !important; color:inherit !important;">

            <div class="card bg-info text-white shadow dashboard-card">
                <div class="card-body text-center">
                    <i class="bi bi-capsule dashboard-icon"></i>
<h5>Total Medicines</h5>
                    <h2><?php echo $pharmacy; ?></h2>
                </div>
            </div>

        </a>
    </div>


    <!-- Billing -->
    <div class="col-md-4 mb-3">
        <a href="http://localhost/SMTH-EPR/billing/billing.php"
           class="dashboard-link"
   style="text-decoration:none !important; color:inherit !important;">

            <div class="card bg-danger text-white shadow dashboard-card">
                <div class="card-body text-center">
                    <i class="bi bi-receipt dashboard-icon"></i>
<h5>Total Bills</h5>
                    <h2><?php echo $billing; ?></h2>
                </div>
            </div>

        </a>
    </div>


    <!-- Users -->
    <div class="col-md-4 mb-3">
        <a href="http://localhost/SMTH-EPR/users/users.php"
           class="dashboard-link"
   style="text-decoration:none !important; color:inherit !important;">

            <div class="card bg-dark text-white shadow dashboard-card">
                <div class="card-body text-center">
                    <i class="bi bi-people dashboard-icon"></i>
<h5>Total Users</h5>
                    <h2><?php echo $users; ?></h2>
                </div>
            </div>

        </a>
    </div>

</div>

<!-- Charts -->

<div class="row mt-4">

<div class="col-md-8">

<div class="card shadow">

<div class="card-header">
<h5>Hospital Statistics</h5>
</div>

<div class="card-body">

<canvas id="barChart"></canvas>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card shadow">

<div class="card-header">
<h5>Distribution</h5>
</div>

<div class="card-body">

<canvas id="pieChart"></canvas>

</div>

</div>

</div>

</div>

<!-- Recent Activities -->

<div class="card mt-4 shadow">

<div class="card-header">
<h5>Recent Activities</h5>
</div>

<div class="card-body">

<ul class="list-group">

<ul class="list-group">

<?php if (mysqli_num_rows($activities_result) > 0): ?>

    <?php while ($activity = mysqli_fetch_assoc($activities_result)): ?>

        <li class="list-group-item d-flex justify-content-between align-items-center">

            <a href="<?php echo $activity['activity_link']; ?>?highlight=<?php echo $activity['record_id']; ?>"
   class="text-decoration-none text-dark">

    <?php echo htmlspecialchars($activity['activity']); ?>

</a>
            <small class="text-muted">
                <?php
                echo date(
                    "d M Y, h:i A",
                    strtotime($activity['activity_time'])
                );
                ?>
            </small>

        </li>

    <?php endwhile; ?>

<?php else: ?>

    <li class="list-group-item text-center text-muted">
        No recent activities
    </li>

<?php endif; ?>

</ul>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

new Chart(document.getElementById('barChart'), {

    type: 'bar',

    data: {

        labels: [
            'Patients',
            'Doctors',
            'Appointments',
            'Medicines',
            'Bills',
            'Users'
        ],

        datasets: [{

            label: 'Hospital Records',

            data: [
                <?php echo $patients; ?>,
                <?php echo $doctors; ?>,
                <?php echo $appointments; ?>,
                <?php echo $pharmacy; ?>,
                <?php echo $billing; ?>,
                <?php echo $users; ?>
            ],

            backgroundColor: [
                '#0d6efd',
                '#198754',
                '#ffc107',
                '#0dcaf0',
                '#dc3545',
                '#212529'
            ]

        }]

    },

    options: {

        responsive: true,

        plugins: {
            legend: {
                display: false
            }
        },

        scales: {

            y: {
                beginAtZero: true
            }

        },

        /*
         * Make each bar clickable
         */
        onClick: function(event, elements) {

            if (elements.length > 0) {

                const index = elements[0].index;

                const links = [

                    'http://localhost/SMTH-EPR/patients/patients.php',

                    'http://localhost/SMTH-EPR/doctors/doctors.php',

                    'http://localhost/SMTH-EPR/appointments/appointments.php',

                    'http://localhost/SMTH-EPR/pharmacy/pharmacy.php',

                    'http://localhost/SMTH-EPR/billing/billing.php',

                    'http://localhost/SMTH-EPR/users/users.php'

                ];

                window.location.href = links[index];

            }

        }

    }

});
new Chart(document.getElementById('pieChart'), {

    type: 'pie',

    data: {

        labels: [
            'Patients',
            'Doctors',
            'Appointments',
            'Medicines',
            'Bills',
            'Users'
        ],

        datasets: [{

            data: [
                <?php echo $patients; ?>,
                <?php echo $doctors; ?>,
                <?php echo $appointments; ?>,
                <?php echo $pharmacy; ?>,
                <?php echo $billing; ?>,
                <?php echo $users; ?>
            ],

            backgroundColor: [
                '#0d6efd',
                '#198754',
                '#ffc107',
                '#0dcaf0',
                '#dc3545',
                '#212529'
            ]

        }]

    },

    options: {

        responsive: true,

        onClick: function(event, elements) {

            if (elements.length > 0) {

                const index = elements[0].index;

                const links = [

                    'http://localhost/SMTH-EPR/patients/patients.php',

                    'http://localhost/SMTH-EPR/doctors/doctors.php',

                    'http://localhost/SMTH-EPR/appointments/appointments.php',

                    'http://localhost/SMTH-EPR/pharmacy/pharmacy.php',

                    'http://localhost/SMTH-EPR/billing/billing.php',

                    'http://localhost/SMTH-EPR/users/users.php'

                ];

                window.location.href = links[index];

            }

        }

    }

});

</script>

<?php include("includes/footer.php"); ?>