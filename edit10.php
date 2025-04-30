<?php
session_start();

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "ev";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Helper function to generate random IDs
function generateRandomID($prefix) {
    return $prefix . rand(100, 999);
}

// Default page
$page = isset($_GET['page']) ? $_GET['page'] : 'welcome';

// Logout functionality
if ($page == 'logout') {
    session_destroy();
    header("Location: ?page=welcome");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Management System</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #e6f7ff; /* Light blue background */
        color: #333;
        margin: 0;
        padding: 0;
        align-items: center;
        height: 100vh;
    }

    .welcome-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 80%;
        max-width: 600px;
        text-align: center;
        margin-left: 450px;
        margin-top: 200px;
    }

    .welcome-container h1 {
        font-size: 36px;
        color: #0056b3;
        margin-bottom: 20px;
    }

    .welcome-container p {
        font-size: 18px;
        color: #555;
        margin-bottom: 30px;
    }

    .welcome-container .cta-btn {
        display: inline-block;
        background-color: #0056b3;
        color: #fff;
        padding: 15px 25px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 18px;
        transition: background-color 0.3s ease;
    }

    .welcome-container .cta-btn:hover {
        background-color: #003366;
    }

    .welcome-container .cta-btn:focus {
        outline: none;
    }



.login {
    display: inline-block;
    background-color: #0056b3; /* Blue background */
    color: #fff; /* White text */
    padding: 10px 20px; /* Padding for clickable area */
    margin: 10px 5px; /* Space between links */
    text-decoration: none; /* Remove underline */
    border-radius: 5px; /* Rounded corners */
    font-size: 16px; /* Font size */
    font-weight: bold; /* Bold text */
    transition: background-color 0.3s ease, transform 0.2s ease; /* Hover effect */
    text-align: center;
    margin-left: 7px;
}

.login:hover {
    background-color: #003366; /* Darker blue on hover */
    transform: translateY(-2px); /* Slight lift on hover */
}

.login:active {
    transform: translateY(1px); /* Pressed-down effect */
}








    .dashboard-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
            text-align: center;
             margin-left: 330px;
             margin-top: 100px;
        }

        .dashboard-container h2 {
            font-size: 32px;
            color: #0056b3;
            margin-bottom: 20px;
        }

        .dashboard-container p {
            font-size: 18px;
            color: #555;
            margin-bottom: 30px;
        }

        .dashboard-container .dashboard-content {
            margin-top: 20px;
            text-align: center;
        }

        .dashboard-container .dashboard-content ul {
            list-style-type: none;
            padding: 0;
        }

        .dashboard-container .dashboard-content ul li {
            margin: 10px 0;
        }

        .dashboard-container .dashboard-content ul li a {
            text-decoration: none;
            color: #0056b3;
            font-size: 18px;
        }

        .dashboard-container .dashboard-content ul li a:hover {
            color: #003366;
 text-decoration: underline;
        }

        .dashboard-container .dashboard-content ul li a:focus {
            outline: none;
        }



       /* Styled links for navigation */
.styled-link {
    display: inline-block;
    background-color: #0056b3; /* Blue background */
    color: #fff; /* White text */
    padding: 10px 20px; /* Padding for clickable area */
    margin: 10px 5px; /* Space between links */
    text-decoration: none; /* Remove underline */
    border-radius: 5px; /* Rounded corners */
    font-size: 16px; /* Font size */
    font-weight: bold; /* Bold text */
    transition: background-color 0.3s ease, transform 0.2s ease; /* Hover effect */
    text-align: center;
    margin-left: 650px;
}

.styled-link:hover {
    background-color: #003366; /* Darker blue on hover */
    transform: translateY(-2px); /* Slight lift on hover */
}

.styled-link:active {
    transform: translateY(1px); /* Pressed-down effect */
}



/* Styled buttons */
button, input[type="submit"], input[type="button"] {
    display: inline-block;
    background-color: #0056b3; /* Primary blue background */
    color: #fff; /* White text */
    padding: 10px 20px; /* Padding for clickable area */
    border: none; /* Remove default border */
    border-radius: 5px; /* Rounded corners */
    font-size: 16px; /* Font size */
    font-weight: bold; /* Bold text */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s ease, transform 0.2s ease; /* Hover effect */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Subtle shadow */
}

button:hover, input[type="submit"]:hover, input[type="button"]:hover {
    background-color: #0056b3; /* Darker blue on hover */
    transform: translateY(-2px); /* Slight lift on hover */
}

button:active, input[type="submit"]:active, input[type="button"]:active {
    transform: translateY(1px); /* Pressed-down effect */
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3); /* Reduce shadow */
}


      

    .container {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
    }

    h2 {
        text-align: center;
        color: #0056b3;
        margin-bottom: 20px;
    }

    .feedback-box {
        border: 1px solid #ddd;
        padding: 20px;
        margin-bottom: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .feedback-box strong {
        color: #0056b3;
    }

    .feedback-box p {
        margin: 5px 0;
    }

    .feedback-box a {
        display: inline-block;
        background-color: #0056b3;
        color: #fff;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 20px;
        text-align: center;
    }

    .feedback-box a:hover {
        background-color: #003366;
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 20px;
        font-size: 16px;
    }

    .back-link a {
        color: #0056b3;
        text-decoration: none;
    }

    .back-link a:hover {
        text-decoration: underline;
    }

    .error-message {
        color: red;
        text-align: center;
    }

    /* Form and Table Styles */
    form, table {
        width: 60%;
        margin: 0 auto;
        padding: 10px;
        border: 1px solid #ddd;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    table {
        border-collapse: collapse;
    }

    th, td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        color: #0056b3;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    input[type="date"], input[type="text"], input[type="number"], input[type="email"], textarea {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 80%;
        margin: 10px 0;
        font-size: 14px;
    }

    input[type="date"]:focus, input[type="text"]:focus, input[type="number"]:focus, textarea:focus {
        border-color: #0056b3;
    }

    textarea {
        resize: vertical;
        height: 100px;
    }

</style></head>
<body>


<?php if ($page == 'welcome') { ?>
    <div class="welcome-container">
        <h1>Welcome to Our Website!</h1>
        <p>We are glad to have you here. Explore the site and get the most out of our services.</p>
        <a href="?page=register" class="cta-btn">Register</a>
        <a href="?page=login" class="cta-btn">Login</a>
        <a href="?page=explore_events" class="cta-btn">Explore Events</a>
    </div>
<?php } ?>


    <?php if ($page == 'register') { ?>
        <h2>Register</h2>
        <form method="POST">
            User Type:
            <select name="user_type">
                <option value="customer">Customer</option>
                <option value="organizer">Organizer</option>
            </select><br>
            Name: <input type="text" name="name" required><br>
            Phone: <input type="text" name="phone" required><br>
            Email: <input type="email" name="email" required><br>
            <div id="organizer_fields" style="display: none;">
                Provided Services: <input type="text" name="services"><br>
            </div>
            <button type="submit" name="register">Register</button>
        </form>

        <script>
            document.querySelector('select[name="user_type"]').addEventListener('change', function() {
                if (this.value === 'organizer') {
                    document.getElementById('organizer_fields').style.display = 'block';
                } else {
                    document.getElementById('organizer_fields').style.display = 'none';
                }
            });
        </script>

        <?php
        if (isset($_POST['register'])) {
            $userType = $_POST['user_type'];
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $services = $_POST['services'] ?? '';

            if ($userType == 'customer') {
                $id = generateRandomID("C");
                $query = "INSERT INTO Customer (cust_id, cust_name, cust_phn, cust_email) VALUES ('$id', '$name', '$phone', '$email')";
            } else {
                $id = generateRandomID("O");
                $query = "INSERT INTO Organizer (org_id, org_name, org_mail, org_phn, org_provided_services) VALUES ('$id', '$name', '$email', '$phone', '$services')";
            }

            if ($conn->query($query)) {
                echo "Registration successful. Your ID is: <strong>$id</strong>";
            } else {
                echo "Error: " . $conn->error;
            }
        }
        ?>
        <br><a href="?page=welcome" class="styled-link">Back to Homepage</a>
    <?php } ?>

    <?php if ($page == 'login') { ?>
        <h2>Login</h2>
        <form method="POST">
            User Type:
            <select name="user_type">
                <option value="customer">Customer</option>
                <option value="organizer">Organizer</option>
            </select><br>
            ID: <input type="text" name="id" required><br>
            Email: <input type="email" name="email" required><br>
            <button type="submit" name="login">Login</button>
        </form>

        <?php
        if (isset($_POST['login'])) {
            $userType = $_POST['user_type'];
            $id = $_POST['id'];
            $email = $_POST['email'];

            if ($userType == 'customer') {
                $query = "SELECT * FROM Customer WHERE cust_id = '$id' AND cust_email = '$email'";
            } else {
                $query = "SELECT * FROM Organizer WHERE org_id = '$id' AND org_mail = '$email'";
            }

            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $_SESSION['user_type'] = $userType;
                $_SESSION['user_id'] = $id;
                echo "<p>Login successful. Welcome!</p>";
                echo "<a href='?page=dashboard' class='styled-link'>Go to Dashboard</a>";
            } else {
                echo "<p>Invalid ID or email. Please try again.</p>";
            }
        }
        ?>
        <br><a href="?page=welcome"  class="styled-link">Back to Homepage</a>
    <?php } ?>





<?php if ($page == 'explore_events') { ?>
    <h2>Explore Events</h2>
    <?php
    // Database connection
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "ev";
    $conn = new mysqli($host, $user, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Updated SQL query to include Organizer details
    $sql = "SELECT DISTINCT 
                e.evnt_id, 
                e.evnt_type, 
                e.evnt_budget, 
                v.ven_name, 
                v.ven_address, 
                v.ven_capacity, 
                o.org_id, 
                o.org_name, 
                o.org_mail, 
                o.org_phn, 
                o.org_provided_services
            FROM Eventt e
            LEFT JOIN Availability a ON e.evnt_id = a.evnt_id
            LEFT JOIN Venue v ON a.ven_id = v.ven_id
            LEFT JOIN Organises og ON e.evnt_id = og.evnt_id
            LEFT JOIN Organizer o ON og.org_id = o.org_id
            LEFT JOIN Booking b ON e.evnt_id = b.evnt_id
            ORDER BY e.evnt_id";

    // Execute the query and check for errors
    $result = $conn->query($sql);

    if ($result === false) {
        // Output SQL error if the query fails
        echo "Error in query: " . $conn->error;
    } elseif ($result->num_rows > 0) {
        // Display table with additional Organizer details
        echo "<table border='1' style='width: 100%; border-collapse: collapse;'>
                <thead>
                    <tr>
                        <th>Event Type</th>
                        <th>Event Budget</th>
                        <th>Venue Name</th>
                        <th>Venue Address</th>
                        <th>Venue Capacity</th>
                        <th>Organizer ID</th>
                        <th>Organizer Name</th>
                        <th>Organizer Email</th>
                        <th>Contact Number</th>
                        <th>Other Services</th>
                    </tr>
                </thead>
                <tbody>";
        
        // Output data for each event
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['evnt_type']) . "</td>
                    <td>" . htmlspecialchars($row['evnt_budget']) . "</td>
                    <td>" . htmlspecialchars($row['ven_name']) . "</td>
                    <td>" . htmlspecialchars($row['ven_address']) . "</td>
                    <td>" . htmlspecialchars($row['ven_capacity']) . "</td>
                    <td>" . htmlspecialchars($row['org_id']) . "</td>
                    <td>" . htmlspecialchars($row['org_name']) . "</td>
                    <td>" . htmlspecialchars($row['org_mail']) . "</td>
                    <td>" . htmlspecialchars($row['org_phn']) . "</td>
                    <td>" . htmlspecialchars($row['org_provided_services']) . "</td>
                  </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "No events available.";
    }

    // Close the database connection
    $conn->close();
    ?>
    <br><a href="?page=welcome" class="styled-link">Back to Homepage</a>
<?php } ?>



<?php if ($page == 'dashboard') { ?>
    <div class="dashboard-container">
        <h2>Welcome to Your Dashboard!</h2>
        <p>Here you can manage all your details and activities.</p>
<div class="dashboard-content">
                        <ul>

    <?php if ($_SESSION['user_type'] == 'customer') { ?>
        <li><a href="?page=book_event">Book Event</a></li>
        <li><a href="?page=cancel_booking">Cancel Booking</a></li> <!-- Added Cancel Booking Option -->
    <?php } else { ?>
        <li><a href="?page=create_event">Create Event</a></li>
        <li><a href="?page=cancel_events">Cancel Event</a></li>
    <?php } ?>
    <li><a href="?page=history">View History</a></li>
    <li><a href="?page=feedback">Leave Feedback</a></li>
    <li><a href="?page=see_feedback">Received feedbacks</a></li>
    <li><a href="?page=submitted_feedbacks">Submitted feedbacks</a></li>
    <a href="?page=logout" class="login">Logout</a>
     </ul>
        </div>
    </div>
<?php } ?>







<?php if ($page == 'history') { ?>
<h2>History</h2>
<?php
$user_id = $_SESSION['user_id'];
$currentDate = new DateTime(); // Get current date
$currentDate->setTime(0, 0, 0); // Set time to 00:00:00

// For customer, show their information first
if ($_SESSION['user_type'] == 'customer') {
    // Fetch customer details
    $query = "SELECT cust_id, cust_name FROM Customer WHERE cust_id = '$user_id'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<div><strong>Customer ID:</strong> " . $row['cust_id'] . ", <strong>Customer Name:</strong> " . $row['cust_name'] . "</div><br>";
    }

    // Fetch the bookings with detailed event and organizer information
    $query = "SELECT DISTINCT
                Booking.booking_id, 
                Booking.evnt_date, 
                Booking.booking_date, 
                Eventt.evnt_type, 
                Eventt.evnt_budget, 
                Organizer.org_id, 
                Organizer.org_name, 
                Venue.ven_name, 
                Venue.ven_address, 
                Venue.ven_capacity 
              FROM Booking 
              JOIN Eventt ON Booking.evnt_id = Eventt.evnt_id 
              JOIN Organises ON Eventt.evnt_id = Organises.evnt_id 
              JOIN Organizer ON Organises.org_id = Organizer.org_id 
              JOIN Availability ON Eventt.evnt_id = Availability.evnt_id 
              JOIN Venue ON Availability.ven_id = Venue.ven_id 
              WHERE Booking.cust_id = '$user_id'";

    $result = $conn->query($query);

    echo "<h3 style='color: #333; border-bottom: 2px solid #ccc; padding-bottom: 5px;'>Completed Events</h3>";
    $completed_found = false;
    if ($result && $result->num_rows > 0) {
        echo "<table border='1' style='width: 100%; border-collapse: collapse;'>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Event Type</th>
                        <th>Event Budget</th>
                        <th>Event Date</th>
                        <th>Booking Date</th>
                        <th>Organizer ID</th>
                        <th>Organizer Name</th>
                        <th>Venue Name</th>
                        <th>Venue Address</th>
                        <th>Venue Capacity</th>
                    </tr>
                </thead>
                <tbody>";
        while ($row = $result->fetch_assoc()) {
            if ((new DateTime($row['evnt_date'])) < $currentDate) {
                $completed_found = true;
                echo "<tr>
                        <td>{$row['booking_id']}</td>
                        <td>{$row['evnt_type']}</td>
                        <td>{$row['evnt_budget']}</td>
                        <td>{$row['evnt_date']}</td>
                        <td>{$row['booking_date']}</td>
                        <td>{$row['org_id']}</td>
                        <td>{$row['org_name']}</td>
                        <td>{$row['ven_name']}</td>
                        <td>{$row['ven_address']}</td>
                        <td>{$row['ven_capacity']}</td>
                      </tr>";
            }
        }
        echo "</tbody></table>";
    }
    if (!$completed_found) {
        echo "<p>No completed events found.</p>";
    }

    // Reset result pointer for upcoming events
    $result->data_seek(0);

    echo "<h3 style='color: #333; border-bottom: 2px solid #ccc; padding-bottom: 5px;'>Upcoming Events</h3>";
    $upcoming_found = false;
    if ($result && $result->num_rows > 0) {
        echo "<table border='1' style='width: 100%; border-collapse: collapse;'>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Event Type</th>
                        <th>Event Budget</th>
                        <th>Event Date</th>
                        <th>Booking Date</th>
                        <th>Organizer ID</th>
                        <th>Organizer Name</th>
                        <th>Venue Name</th>
                        <th>Venue Address</th>
                        <th>Venue Capacity</th>
                    </tr>
                </thead>
                <tbody>";
        while ($row = $result->fetch_assoc()) {
            if ((new DateTime($row['evnt_date'])) >= $currentDate) {
                $upcoming_found = true;
                echo "<tr>
                        <td>{$row['booking_id']}</td>
                        <td>{$row['evnt_type']}</td>
                        <td>{$row['evnt_budget']}</td>
                        <td>{$row['evnt_date']}</td>
                        <td>{$row['booking_date']}</td>
                        <td>{$row['org_id']}</td>
                        <td>{$row['org_name']}</td>
                        <td>{$row['ven_name']}</td>
                        <td>{$row['ven_address']}</td>
                        <td>{$row['ven_capacity']}</td>
                      </tr>";
            }
        }
        echo "</tbody></table>";
    }
    if (!$upcoming_found) {
        echo "<p>No upcoming events found.</p>";
    }
}


// For organizer, show their information first
if ($_SESSION['user_type'] == 'organizer') {
    $org_id = $_SESSION['user_id']; // Organizer's ID from session

    // Fetch organizer details
    $query = "SELECT org_id, org_name FROM Organizer WHERE org_id = '$org_id'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<div style='margin-bottom: 20px;'><strong>Organizer ID:</strong> " . $row['org_id'] . ", <strong>Organizer Name:</strong> " . $row['org_name'] . "</div>";
    }

    // Fetch the events the organizer has created
    $query = "SELECT DISTINCT
                Eventt.evnt_id, 
                Eventt.evnt_type, 
                Eventt.evnt_budget, 
                Venue.ven_name, 
                Venue.ven_address, 
                Venue.ven_capacity 
              FROM Organises 
              JOIN Eventt ON Organises.evnt_id = Eventt.evnt_id 
              JOIN Availability ON Eventt.evnt_id = Availability.evnt_id 
              JOIN Venue ON Availability.ven_id = Venue.ven_id 
              WHERE Organises.org_id = '$org_id'";

    $result = $conn->query($query);

    echo "<h3 style='color: #333; border-bottom: 2px solid #ccc; padding-bottom: 5px;'>Your Created Events</h3>";
    if ($result && $result->num_rows > 0) {
        echo "<table border='1' style='width: 100%; border-collapse: collapse;'>
                <thead>
                    <tr>
                        <th>Event ID</th>
                        <th>Event Type</th>
                        <th>Event Budget</th>
                        <th>Venue Name</th>
                        <th>Venue Address</th>
                        <th>Venue Capacity</th>
                    </tr>
                </thead>
                <tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['evnt_id']}</td>
                    <td>{$row['evnt_type']}</td>
                    <td>{$row['evnt_budget']}</td>
                    <td>{$row['ven_name']}</td>
                    <td>{$row['ven_address']}</td>
                    <td>{$row['ven_capacity']}</td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No events organized yet.</p>";
    }

    // Fetch the bookings for the organizer's events and split into completed and upcoming
    $query = "SELECT 
                Booking.booking_id, 
                Booking.evnt_date, 
                Booking.booking_date, 
                Customer.cust_name, 
                Customer.cust_email, 
                Customer.cust_phn, 
                Eventt.evnt_id, 
                Eventt.evnt_type, 
                Eventt.evnt_budget 
              FROM Booking 
              JOIN Eventt ON Booking.evnt_id = Eventt.evnt_id 
              JOIN Organises ON Eventt.evnt_id = Organises.evnt_id 
              JOIN Customer ON Booking.cust_id = Customer.cust_id 
              WHERE Organises.org_id = '$org_id'";

    $result = $conn->query($query);

    echo "<h3 style='color: #333; border-bottom: 2px solid #ccc; padding-bottom: 5px;'>Completed Events</h3>";
    $completed_found = false;
    if ($result && $result->num_rows > 0) {
        echo "<table border='1' style='width: 100%; border-collapse: collapse;'>
                <thead>
                    <tr>
                        <th>Event ID</th>
                        <th>Booking ID</th>
                        <th>Event Type</th>
                        <th>Event Budget</th>
                        <th>Event Date</th>
                        <th>Booking Date</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Customer Phone</th>
                    </tr>
                </thead>
                <tbody>";
        while ($row = $result->fetch_assoc()) {
            if ((new DateTime($row['evnt_date'])) < $currentDate) {
                $completed_found = true;
                echo "<tr>
                        <td>{$row['evnt_id']}</td>
                        <td>{$row['booking_id']}</td>
                        <td>{$row['evnt_type']}</td>
                        <td>{$row['evnt_budget']}</td>
                        <td>{$row['evnt_date']}</td>
                        <td>{$row['booking_date']}</td>
                        <td>{$row['cust_name']}</td>
                        <td>{$row['cust_email']}</td>
                        <td>{$row['cust_phn']}</td>
                      </tr>";
            }
        }
        echo "</tbody></table>";
    }

    if (!$completed_found) {
        echo "<p>No completed events found.</p>";
    }

    // Show upcoming events
    $result->data_seek(0); // Reset result pointer
    echo "<h3 style='color: #333; border-bottom: 2px solid #ccc; padding-bottom: 5px;'>Upcoming Events</h3>";
    $upcoming_found = false;
    if ($result && $result->num_rows > 0) {
        echo "<table border='1' style='width: 100%; border-collapse: collapse;'>
                <thead>
                    <tr>
                        <th>Event ID</th>
                        <th>Booking ID</th>
                        <th>Event Type</th>
                        <th>Event Budget</th>
                        <th>Event Date</th>
                        <th>Booking Date</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Customer Phone</th>
                    </tr>
                </thead>
                <tbody>";
        while ($row = $result->fetch_assoc()) {
            if ((new DateTime($row['evnt_date'])) >= $currentDate) {
                $upcoming_found = true;
                echo "<tr>
                        <td>{$row['evnt_id']}</td>
                        <td>{$row['booking_id']}</td>
                        <td>{$row['evnt_type']}</td>
                        <td>{$row['evnt_budget']}</td>
                        <td>{$row['evnt_date']}</td>
                        <td>{$row['booking_date']}</td>
                        <td>{$row['cust_name']}</td>
                        <td>{$row['cust_email']}</td>
                        <td>{$row['cust_phn']}</td>
                      </tr>";
            }
        }
        echo "</tbody></table>";
    }

    if (!$upcoming_found) {
        echo "<p>No upcoming events found.</p>";
    }
}
?>

<br><a href="?page=dashboard" class="styled-link">Back to Dashboard</a>
<?php } ?>









    <?php if ($page == 'feedback') { ?>
    <h2>Feedback</h2>

    <form method="POST">
        <?php if ($_SESSION['user_type'] == 'customer') { ?>
            Organizer ID: <input type="text" name="org_id" required><br>
        <?php } else { ?>
            Customer ID: <input type="text" name="cust_id" required><br>
        <?php } ?>
        Rating (1 to 5): <input type="number" name="rating" min="1" max="5" required><br>
        Review: <textarea name="review" required></textarea><br>
        <button type="submit" name="submit_feedback">Submit Feedback</button>
    </form>

    <?php
    if (isset($_POST['submit_feedback'])) {
        // Collect inputs
        $rating = $_POST['rating'];
        $review = $_POST['review'];
        $user_id = $_SESSION['user_id'];
        $user_type = $_SESSION['user_type'];

        // Generate unique IDs
        $fed_id = generateRandomID("F"); // Feedback ID
        $cust_feedback_id = generateRandomID("CF"); // CustomerFeedback ID
        $org_feedback_id = generateRandomID("OF"); // OrganizerFeedback ID

        if ($user_type == 'customer') {
            $org_id = $_POST['org_id'];

            // Insert into Feedback table
            $query1 = "INSERT INTO Feedback (fed_id, rating, review) 
                       VALUES ('$fed_id', '$rating', '$review')";

            // Insert into customerfeedback table
            $query2 = "INSERT INTO customerfeedback (cust_feedback_id, cust_id, org_id, fed_id) 
                       VALUES ('$cust_feedback_id', '$user_id', '$org_id', '$fed_id')";
        } else {
            $cust_id = $_POST['cust_id'];

            // Insert into Feedback table
            $query1 = "INSERT INTO Feedback (fed_id, rating, review) 
                       VALUES ('$fed_id', '$rating', '$review')";

            // Insert into organizerfeedback table
            $query2 = "INSERT INTO organizerfeedback (org_feedback_id, org_id, cust_id, fed_id) 
                       VALUES ('$org_feedback_id', '$user_id', '$cust_id', '$fed_id')";
        }

        // Execute both queries
        if ($conn->query($query1) && $conn->query($query2)) {
            echo "<p>Feedback submitted successfully.</p>";
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }
    }
    ?>
    <br><a href="?page=dashboard" class="styled-link">Back to Dashboard</a>
<?php } ?>



<?php if ($page == 'book_event') { ?>
    <h2>Book an Event</h2>
    <form method="POST" style="margin-bottom: 20px;">
        <label>Event Type: <input type="text" name="event_type" required></label><br>
        <label>Booking Date: <input type="date" name="booking_date" required></label><br>
        <label>Event Date: <input type="date" name="event_date" required></label><br>
        <label>Start Time: <input type="text" id="book_start_time" name="start_time" required></label><br>
        <label>End Time: <input type="text" id="book_end_time" name="end_time" required></label><br>
        <label>Budget: <input type="number" name="budget" required></label><br>
        <button type="submit" name="check_availability">Check Availability</button>
    </form>

    <?php
    if (isset($_POST['check_availability'])) {
        $event_type = $_POST['event_type'];
        $booking_date = $_POST['booking_date'];
        $event_date = $_POST['event_date'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        $budget = $_POST['budget'];

        $today = date("Y-m-d");

        // Validate the dates
        if ($booking_date < $today || $event_date < $today) {
            echo "<p style='color: red;'>Invalid date selected. You can only book for today or future dates.</p>";
        } else {
            // Query to check availability based on time slots
            $query = "SELECT 
                         distinct E.evnt_id, E.evnt_type, E.evnt_budget, 
                         O.org_id, O.org_name, O.org_mail, O.org_phn, O.org_provided_services, 
                         V.ven_name, V.ven_address, V.ven_capacity
                      FROM Eventt E
                      JOIN Organises R ON E.evnt_id = R.evnt_id
                      JOIN Organizer O ON R.org_id = O.org_id
                      JOIN Availability A ON E.evnt_id = A.evnt_id
                      JOIN Venue V ON A.ven_id = V.ven_id
                      WHERE E.evnt_type = '$event_type' 
                      AND E.evnt_budget <= '$budget' 
                      AND NOT EXISTS (
                          SELECT 1 FROM Booking B
                          WHERE B.evnt_date = '$event_date' 
                          AND B.evnt_id = E.evnt_id 
                          AND (
                              (B.evnt_start_time < '$end_time' AND B.evnt_end_time > '$start_time')
                          )
                      )
                      AND (
                          -- Check if the input time slot is within the available time slot
                          '$start_time' >= A.start_time AND '$end_time' <= A.end_time
                      )";

            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                echo "<h3>Available Events:</h3>";
                echo "<table border='1' style='width: 100%; border-collapse: collapse; text-align: left;'>
                        <tr>
                            <th>Event ID</th>
                            <th>Event Type</th>
                            <th>Budget</th>
                            <th>Organizer</th>
                            <th>Organizer Email</th>
                            <th>Organizer Phone</th>
                            <th>Services Provided</th>
                            <th>Venue Name</th>
                            <th>Venue Address</th>
                            <th>Venue Capacity</th>
                            <th>Actions</th>
                        </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['evnt_id']}</td>
                            <td>{$row['evnt_type']}</td>
                            <td>{$row['evnt_budget']}</td>
                            <td>{$row['org_name']}</td>
                            <td>{$row['org_mail']}</td>
                            <td>{$row['org_phn']}</td>
                            <td>{$row['org_provided_services']}</td>
                            <td>{$row['ven_name']}</td>
                            <td>{$row['ven_address']}</td>
                            <td>{$row['ven_capacity']}</td>
                            <td>
                                <form method='POST' style='display: inline;'>
                                    <input type='hidden' name='evnt_id' value='{$row['evnt_id']}'>
                                    <input type='hidden' name='booking_date' value='{$booking_date}'>
                                    <input type='hidden' name='event_date' value='{$event_date}'>
                                    <input type='hidden' name='start_time' value='{$start_time}'>
                                    <input type='hidden' name='end_time' value='{$end_time}'>
                                    <button type='submit' name='book_event'>Book Now</button>
                                </form>
                                <form method='POST' style='display: inline;'>
                                    <input type='hidden' name='org_id' value='{$row['org_id']}'>
                                    <button type='submit' name='view_feedbacks'>Feedbacks</button>
                                </form>
                            </td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No events available for the selected criteria.</p>";
            }
            
            
        }
    }

    if (isset($_POST['book_event'])) {
        $booking_id = generateRandomID('B');
        $cust_id = $_SESSION['user_id'];
        $evnt_id = $_POST['evnt_id'];
        $avail_id = generateRandomID('A');  // Generate random availability ID
        $booking_date = $_POST['booking_date'];
        $event_date = $_POST['event_date'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
    
        // Insert the booking into the Booking table
        $query = "INSERT INTO Booking (booking_id, cust_id, evnt_id, booking_date, evnt_date, evnt_start_time, evnt_end_time) 
                  VALUES ('$booking_id', '$cust_id', '$evnt_id', '$booking_date', '$event_date', '$start_time', '$end_time')";
    
        if ($conn->query($query)) {
            // Now insert a new record into the Availability table for the booked time slot
            $availability_query = "INSERT INTO Availability (avail_id, evnt_id, ven_id, start_time, end_time, ven_status, avail_date) 
                                   SELECT '$avail_id', evnt_id, ven_id, '$start_time', '$end_time', 'booked', '$event_date'
                                   FROM Availability 
                                   WHERE evnt_id = '$evnt_id' LIMIT 1"; // Ensure we are selecting from Availability table
    
            if ($conn->query($availability_query)) {
                echo "<p>Booking confirmed! Your booking ID is: <strong>$booking_id</strong></p>";
            } else {
                echo "<p>Error inserting availability: " . $conn->error . "</p>";
            }
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }
    }

    if (isset($_POST['view_feedbacks'])) {
        $org_id = $_POST['org_id'];
    
        $feedback_query = "SELECT Feedback.rating, Feedback.review, Customer.cust_name 
                           FROM Feedback
                           JOIN customerfeedback ON Feedback.fed_id = customerfeedback.fed_id
                           JOIN Customer ON customerfeedback.cust_id = Customer.cust_id
                           WHERE customerfeedback.org_id = '$org_id'";
    
        $feedback_result = $conn->query($feedback_query);
    
        echo "<h3>Feedbacks for Organizer</h3>";
        if ($feedback_result && $feedback_result->num_rows > 0) {
            echo "<table border='1' style='width: 100%; border-collapse: collapse; text-align: left;'>
                    <tr>
                        <th>Customer Name</th>
                        <th>Rating</th>
                        <th>Review</th>
                    </tr>";
            while ($feedback = $feedback_result->fetch_assoc()) {
                echo "<tr>
                        <td>{$feedback['cust_name']}</td>
                        <td>{$feedback['rating']}</td>
                        <td>{$feedback['review']}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No feedbacks available for this organizer.</p>";
        }
    }
    
    ?>

    <!-- Include Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        flatpickr("#book_start_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
        });

        flatpickr("#book_end_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
        });

        // JavaScript to restrict dates to today and future
        const today = new Date().toISOString().split('T')[0];
        document.querySelector('input[name="booking_date"]').setAttribute('min', today);
        document.querySelector('input[name="event_date"]').setAttribute('min', today);
    </script>

    <br><a href="?page=dashboard" class="styled-link">Back to Dashboard</a><br>
    <a href="?page=history" class="styled-link">View Booking History</a><br>
<?php } ?>





<?php if ($page == 'cancel_booking') { ?>
    <h2>Cancel a Booking</h2>
    <form method="POST" style="margin-bottom: 20px;">
        <label>Booking ID: <input type="text" name="booking_id" required></label><br>
        <button type="submit" name="cancel_booking">Cancel Booking</button>
    </form>

    <?php
    if (isset($_POST['cancel_booking'])) {
        $booking_id = $_POST['booking_id'];
        $user_id = $_SESSION['user_id']; // Assuming the user is logged in and their ID is stored in the session.

        // Fetch booking details to validate cancellation eligibility
        $query = "SELECT evnt_id, booking_date, evnt_start_time, evnt_end_time, evnt_date FROM Booking WHERE booking_id = '$booking_id' AND cust_id = '$user_id'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $evnt_id = $row['evnt_id'];
            $booking_date = $row['booking_date'];
            $event_date = $row['evnt_date'];
            $start_time = $row['evnt_start_time'];
            $end_time = $row['evnt_end_time'];
            $today = date("Y-m-d");

            // Calculate the difference in days between the booking date and today
            $days_difference = (strtotime($today) - strtotime($booking_date)) / (60 * 60 * 24);

            if ($days_difference <= 2) {
                // Proceed with cancellation
                $cancel_booking_query = "DELETE FROM Booking WHERE booking_id = '$booking_id' AND cust_id = '$user_id'";

                if ($conn->query($cancel_booking_query)) {
                    // Delete from the Availability table using the event_date, start_time, and end_time
                    $cancel_availability_query = "DELETE FROM Availability 
                                                  WHERE evnt_id = '$evnt_id' 
                                                  AND ven_status = 'booked'
                                                  AND avail_date = '$event_date'
                                                  AND start_time = '$start_time'
                                                  AND end_time = '$end_time'";

                    if ($conn->query($cancel_availability_query)) {
                        echo "<p style='color: green;'>Booking ID <strong>$booking_id</strong> has been successfully canceled and availability updated.</p>";
                    } else {
                        echo "<p style='color: red;'>Error: Unable to update availability. Please try again later.</p>";
                    }
                } else {
                    echo "<p style='color: red;'>Error: Unable to cancel booking. Please try again later.</p>";
                }
            } else {
                echo "<p style='color: red;'>You can only cancel a booking within 2 days of the booking date.</p>";
            }
        } else {
            echo "<p style='color: red;'>Invalid Booking ID or you are not authorized to cancel this booking.</p>";
        }
    }
    ?>

    <br><a href="?page=dashboard" class="styled-link">Back to Dashboard</a>
<?php } ?>





<?php if ($page == 'create_event') { ?>
    <h2>Create Event</h2>
    <form method="POST">
        Event Type: <input type="text" name="evnt_type" required><br>
        Event Budget: <input type="number" step="0.01" name="evnt_budget" required><br>
        Venue Name: <input type="text" name="ven_name" required><br>
        Venue Address: <input type="text" name="ven_address" required><br>
        Venue Capacity: <input type="number" name="ven_capacity" required><br>
        <br>(Total time slot of the venue)<br>
        Start Time: <input type="text" id="start_time" name="start_time" required><br>
        End Time: <input type="text" id="end_time" name="end_time" required><br>
        <button type="submit" name="create_event">Create Event</button>
    </form>

    <!-- Include Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        // Apply Flatpickr to Start Time and End Time inputs
        flatpickr("#start_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i", // 24-hour format
            time_24hr: true,
        });
        flatpickr("#end_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i", // 24-hour format
            time_24hr: true,
        });
    </script>

<?php
    if (isset($_POST['create_event'])) {
        // Collect Inputs
        $evnt_type = $_POST['evnt_type'];
        $evnt_budget = $_POST['evnt_budget'];
        $ven_name = $_POST['ven_name'];
        $ven_address = $_POST['ven_address'];
        $ven_capacity = $_POST['ven_capacity'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];

        // Generate Unique IDs
        $evnt_id = generateRandomID("E");
        $ven_id = generateRandomID("V");
        $avail_id = generateRandomID("A");
        $org_event_id = generateRandomID("OE");
        $org_id = $_SESSION['user_id']; // Organizer's ID from session

        // Insert into Eventt table
        $query1 = "INSERT INTO Eventt (evnt_id, evnt_type, evnt_budget) 
                   VALUES ('$evnt_id', '$evnt_type', '$evnt_budget')";

        // Insert into Venue table
        $query2 = "INSERT INTO Venue (ven_id, ven_address, ven_capacity, ven_name) 
                   VALUES ('$ven_id', '$ven_address', $ven_capacity, '$ven_name')";

        // Insert into Availability table
        $query3 = "INSERT INTO Availability (avail_id, evnt_id, ven_id, ven_status, start_time, end_time) 
                   VALUES ('$avail_id', '$evnt_id', '$ven_id', 'available', '$start_time', '$end_time')";

        // Insert into Organises table
        $query4 = "INSERT INTO Organises (org_event_id, org_id, evnt_id) 
                   VALUES ('$org_event_id', '$org_id', '$evnt_id')";

        // Execute Queries
        if ($conn->query($query1) && $conn->query($query2) && $conn->query($query3) && $conn->query($query4)) {
            echo "<p>Event created successfully!</p>";
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }
    }
?>
    <br><a href="?page=dashboard" class="styled-link">Back to Dashboard</a><br>
    <a href="?page=history" class="styled-link">View Created Events</a><br>
<?php } ?>





<?php if ($page == 'cancel_events') { ?>
    <h2>Manage Your Events</h2>

    <?php
    $org_id = $_SESSION['user_id'];

    // Query to fetch events created by this organizer
    $query = "SELECT DISTINCT
                Eventt.evnt_id, 
                Eventt.evnt_type, 
                Eventt.evnt_budget, 
                Venue.ven_name, 
                Venue.ven_address, 
                Venue.ven_capacity 
              FROM Organises 
              JOIN Eventt ON Organises.evnt_id = Eventt.evnt_id 
              JOIN Availability ON Eventt.evnt_id = Availability.evnt_id 
              JOIN Venue ON Availability.ven_id = Venue.ven_id 
              WHERE Organises.org_id = '$org_id'";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='5'>
                <tr>
                    <th>Event ID</th>
                    <th>Event Type</th>
                    <th>Budget</th>
                    <th>Venue</th>
                    <th>Action</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['evnt_id']}</td>
                    <td>{$row['evnt_type']}</td>
                    <td>{$row['evnt_budget']}</td>
                    <td>{$row['ven_name']}</td>
                    <td>
                        <form method='POST' onsubmit='return confirm(\"Are you sure you want to delete this event?\");'>
                            <input type='hidden' name='evnt_id' value='{$row['evnt_id']}'>
                            <button type='submit' name='delete_event'>Delete</button>
                        </form>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No events found.</p>";
    }
    ?>

    <?php
    if (isset($_POST['delete_event'])) {
        $evnt_id = $_POST['evnt_id'];

        // Check if the event has any bookings
        $check_query = "SELECT 1 FROM Booking WHERE evnt_id = '$evnt_id'";
        $check_result = $conn->query($check_query);

        if ($check_result->num_rows > 0) {
            echo "<p style='color: red;'>Cannot delete this event. There are existing bookings associated with it.</p>";
        } else {
            // Start a transaction for a safe cascade delete
            $conn->begin_transaction();

            try {
                // Get the venue ID linked to the event via Availability
                $venue_query = "SELECT ven_id FROM Availability WHERE evnt_id = '$evnt_id' LIMIT 1";
                $venue_result = $conn->query($venue_query);
                $venue_row = $venue_result->fetch_assoc();
                $ven_id = $venue_row['ven_id'];

                // Delete from Availability table
                $delete_availability = "DELETE FROM Availability WHERE evnt_id = '$evnt_id'";
                $conn->query($delete_availability);

                // Delete from Organises table
                $delete_organises = "DELETE FROM Organises WHERE evnt_id = '$evnt_id'";
                $conn->query($delete_organises);

                // Delete the event from Eventt table
                $delete_event = "DELETE FROM Eventt WHERE evnt_id = '$evnt_id'";
                $conn->query($delete_event);

                // Check if the venue is still associated with other events
                $venue_check_query = "SELECT 1 FROM Availability WHERE ven_id = '$ven_id'";
                $venue_check_result = $conn->query($venue_check_query);

                if ($venue_check_result->num_rows == 0) {
                    // Delete the venue if no other events are linked to it
                    $delete_venue = "DELETE FROM Venue WHERE ven_id = '$ven_id'";
                    $conn->query($delete_venue);
                }

                // Commit the transaction
                $conn->commit();
                echo "<p style='color: green;'>Event and all related records deleted successfully.</p>";
            } catch (Exception $e) {
                // Rollback the transaction on error
                $conn->rollback();
                echo "<p style='color: red;'>Error deleting event: " . $e->getMessage() . "</p>";
            }
        }
    }
    ?>

    

    <br><a href="?page=dashboard" class="styled-link">Back to Dashboard</a>

<?php } ?>




<div class="container">


<?php if ($page == 'see_feedback') { ?>
    <h2>Received Feedbacks</h2>

    <?php 
    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['user_type'];

    if ($user_type == 'customer') {
        // Show feedback given to the customer
        $query = "SELECT Feedback.rating, Feedback.review, Feedback.fed_id, Organizer.org_name 
                  FROM Feedback
                  JOIN organizerfeedback ON Feedback.fed_id = organizerfeedback.fed_id
                  JOIN Organizer ON organizerfeedback.org_id = Organizer.org_id
                  WHERE organizerfeedback.cust_id = '$user_id'";

        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;'>
                        <strong>From Organizer:</strong> {$row['org_name']}<br>
                        <strong>Rating:</strong> {$row['rating']}<br>
                        <strong>Review:</strong> {$row['review']}<br>
                        <strong>Feedback ID:</strong> {$row['fed_id']}<br>
                      </div>";
            }
        } else {
            echo "<p>No feedback available.</p>";
        }

    } elseif ($user_type == 'organizer') {
        // Show feedback given by customers to the organizer
        $query = "SELECT Feedback.rating, Feedback.review, Feedback.fed_id, Customer.cust_name 
                  FROM Feedback
                  JOIN CustomerFeedback ON Feedback.fed_id = CustomerFeedback.fed_id
                  JOIN Customer ON CustomerFeedback.cust_id = Customer.cust_id
                  WHERE CustomerFeedback.org_id = '$user_id'";

        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;'>
                        <strong>From Customer:</strong> {$row['cust_name']}<br>
                        <strong>Rating:</strong> {$row['rating']}<br>
                        <strong>Review:</strong> {$row['review']}<br>
                        <strong>Feedback ID:</strong> {$row['fed_id']}<br>
                      </div>";
            }
        } else {
            echo "<p>No feedback available.</p>";
        }
    }
    ?>

    


    <br><div class="back-link"><a href="?page=dashboard">Back to Dashboard</a></div>

<?php } ?>




<?php if ($page == 'submitted_feedbacks') { ?>
    <h2>Your Submitted Feedbacks</h2>

    <?php 
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_type'])) {
        echo "<p>Error: You need to log in to view this page.</p>";
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['user_type'];

    if ($user_type == 'customer') {
        $query = "SELECT Feedback.rating, Feedback.review, Feedback.fed_id, Organizer.org_name 
                  FROM Feedback
                  JOIN customerfeedback ON Feedback.fed_id = customerfeedback.fed_id
                  JOIN Organizer ON customerfeedback.org_id = Organizer.org_id
                  WHERE customerfeedback.cust_id = '$user_id'";
    } elseif ($user_type == 'organizer') {
        $query = "SELECT Feedback.rating, Feedback.review, Feedback.fed_id, Customer.cust_name 
                  FROM Feedback
                  JOIN organizerfeedback ON Feedback.fed_id = organizerfeedback.fed_id
                  JOIN Customer ON organizerfeedback.cust_id = Customer.cust_id
                  WHERE organizerfeedback.org_id = '$user_id'";
    } else {
        echo "<p>Error: Invalid user type.</p>";
        exit();
    }

    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;'>
                    <strong>To:</strong> " . ($user_type == 'customer' ? $row['org_name'] : $row['cust_name']) . "<br>
                    <strong>Rating:</strong> {$row['rating']}<br>
                    <strong>Review:</strong> {$row['review']}<br>
                    <strong>Feedback ID:</strong> {$row['fed_id']}<br>
                  </div>";
        }
    } else {
        echo "<p>You haven't submitted any feedback yet.</p>";
    }
    ?>

    <br><div class="back-link"><a href="?page=dashboard">Back to Dashboard</a></div>
<?php } ?>
</div>


<script>
    const currentYear = new Date().getFullYear();

    // Restrict booking_date and event_date to the current year and future
    document.querySelector('input[name="booking_date"]').setAttribute('min', `${currentYear}-01-01`);
    document.querySelector('input[name="event_date"]').setAttribute('min', `${currentYear}-01-01`);
</script>


</body>
</html>
