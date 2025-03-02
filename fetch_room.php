<?php
include('db.php');

if (isset($_GET['room'])) {
    $roomNum = $conn->real_escape_string($_GET['room']);
    
    $sql = "SELECT * FROM rooms WHERE Roomnum='$roomNum'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo "<p>
                <strong>Room Number:</strong> {$row['Roomnum']}<br>
                <strong>Occupants:</strong> {$row['Occupants']}<br>
                <strong>Cost:</strong> ₱{$row['Cost']}<br>
                <strong>Balance:</strong> ₱{$row['Balance']}
              </p>";
    } else {
        echo "<p>No details found for this room.</p>";
    }
}
?>