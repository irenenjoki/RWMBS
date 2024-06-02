<?php
// process_meter_reading.php

// Assuming a connection to the database is already established

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $reading_date = $_POST['reading-date'];
    $current_reading = $_POST['current-reading'];
    // Handle file upload
    $meter_image = $_FILES['meter-image'];

    // Perform necessary validations
    // ...

    // Retrieve the previous reading from the database
    $previous_reading = 601; // Example value, replace with actual query result

    // Calculate consumption
    $consumption = $current_reading - $previous_reading;

    // Define rate
    $rate = 10.75; // Example rate, replace with actual rate

    // Calculate amount
    $amount = $consumption * $rate;

    // Define status
    $status = 'Pending';

    // Store the new reading in the database
    // ...

    // Retrieve the new entry ID
    $new_entry_id = 3; // Example ID, replace with actual new entry ID

    // Calculate due date (e.g., 15 days from reading date)
    $due_date = date('Y-m-d', strtotime($reading_date . ' +15 days'));

    // Return JSON response
    $response = [
        'id' => $new_entry_id,
        'reading_date' => $reading_date,
        'due_date' => $due_date,
        'current_reading' => $current_reading,
        'previous_reading' => $previous_reading,
        'consumption' => $consumption,
        'rate' => $rate,
        'status' => $status,
        'amount' => $amount
    ];

    echo json_encode($response);
}
?>
