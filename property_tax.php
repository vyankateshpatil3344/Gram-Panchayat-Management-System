<?php
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "payments_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $homeNo = $_POST['homeNo'];
    $yearFrom = $_POST['yearFrom'];
    $yearTo = $_POST['yearTo'];
    $totalFees = $_POST['totalFees'];
    $paymentMethod = 'Google Pay'; // Set payment method
    $paymentStatus = 'Pending'; // Default payment status

    $stmt = $conn->prepare("INSERT INTO payments (name, home_no, year_from, year_to, total_fees, payment_method, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissdss", $name, $homeNo, $yearFrom, $yearTo, $totalFees, $paymentMethod, $paymentStatus);

    if ($stmt->execute()) {
        $paymentId = $stmt->insert_id; // Get the inserted payment ID
        // Redirect to Google Pay
        $amount = $totalFees * 100; // Convert to paisa for UPI
        $googlePayUrl = "upi id:vyankateshpatil3344@okhdfcbank" . ($amount / 100) . "&cu=INR";
        header("Location: $googlePayUrl");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

if (isset($_GET['paymentId'])) {
    $paymentId = $_GET['paymentId'];

    // Update payment status to 'Success' (for demonstration)
    $updateStmt = $conn->prepare("UPDATE payments SET payment_status='Success' WHERE id=?");
    $updateStmt->bind_param("i", $paymentId);
    $updateStmt->execute();
    $updateStmt->close();

    // Retrieve payment details for receipt
    $receiptStmt = $conn->prepare("SELECT * FROM payments WHERE id=?");
    $receiptStmt->bind_param("i", $paymentId);
    $receiptStmt->execute();
    $result = $receiptStmt->get_result();
    $paymentDetails = $result->fetch_assoc();
    $receiptStmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Village Council Website</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com">
</head>
<body>
    <div class="centered-container">
        <table>
            <tr>
                <td><img src="pngwing.com.png" alt="img not found"></td>
                <td>
                    <h2 style="text-align: start;"><strong>Gram Panchayat Yavaluj</strong></h2>
                    <h5 style="padding: 1px; text-align: center;">Tal: Panhala, Dist: Kolhapur</h5>
                </td>
            </tr>
        </table>
    </div>

    <nav>
        <ul>
            <li><a href="index_english.html">Home</a></li>
            <li>
                <a href="#">Services ▾</a>
                <ul class="dropdown">
                    <li><a href="waterbill.html">Water Bill Payment</a></li>
                    <li><a href="property_tax.html">Property Tax</a></li>
                    <li><a href="https://wss.mahadiscom.in/wss/wss?uiActionName=getViewPayBill">MSEB Bill Payment</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Scheme ▾</a>
                <ul class="dropdown">
                    <li><a href="https://rdd.maharashtra.gov.in/en/state">State Gov.</a></li>
                    <li><a href="https://www.india.gov.in/my-government/schemes">Central Gov.</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Documents ▾</a>
                <ul class="dropdown">
                    <li><a href="#">Birth certificate</a></li>
                    <li><a href="#">Death certificate</a></li>
                    <li><a href="https://bhulekh.mahabhumi.gov.in/Pune/Home.aspx">7/12,8a etc.</a></li>
                </ul>
            </li>
            <li><a href="commitee.html">Committee Members</a></li>
            <li><a href="aboutus.html">About Us</a></li>
        </ul>
    </nav>

    <section id="bill">
        <div class="centered-container">
            <form id="paymentForm" action="" method="post">
                <table>
                    <tr>
                        <th colspan="3"><h1>Property Bill</h1></th>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td colspan="3"><input type="text" name="name" placeholder="Enter your Full Name" required></td>
                    </tr>
                    <tr>
                        <td>Home No</td>
                        <td colspan="3"><input type="number" name="homeNo" placeholder="Enter Home No" required></td>
                    </tr>
                    <tr>
                        <td>Year</td>
                        <td>To <input type="datetime-local" name="yearTo" required></td>
                        <td>From <input type="datetime-local" name="yearFrom" required></td>
                    </tr>
                    <tr>
                        <td>Total Fees <label style="font-size:10px;" for="Amount">(Amount)</label></td>
                        <td colspan="3"><input type="number" name="totalFees" placeholder="Enter Amount" required></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <section id="pay">
                                <button type="submit" style="background-color: green; color: white;">Pay with Google Pay</button>
                            </section>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </section>

    <?php if (isset($paymentDetails)): ?>
    <section id="receipt">
        <div class="centered-container">
            <h2>Payment Receipt</h2>
            <table>
                <tr><td>Name</td><td><?php echo $paymentDetails['name']; ?></td></tr>
                <tr><td>Home No</td><td><?php echo $paymentDetails['home_no']; ?></td></tr>
                <tr><td>Year From</td><td><?php echo $paymentDetails['year_from']; ?></td></tr>
                <tr><td>Year To</td><td><?php echo $paymentDetails['year_to']; ?></td></tr>
                <tr><td>Total Fees</td><td><?php echo $paymentDetails['total_fees']; ?></td></tr>
                <tr><td>Payment Method</td><td><?php echo $paymentDetails['payment_method']; ?></td></tr>
                <tr><td>Payment Status</td><td><?php echo $paymentDetails['payment_status']; ?></td></tr>
                <tr><td>Date</td><td><?php echo $paymentDetails['created_at']; ?></td></tr>
            </table>
            <button onclick="window.print()">Print Receipt</button>
        </div>
    </section>
    <?php endif; ?>
</body>
</html>
