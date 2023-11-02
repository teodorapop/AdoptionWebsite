<?php
$connection = mysqli_connect('localhost', 'root', '', 'adoption_db');

if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $petname = $_POST['petname'];
    $other = $_POST['other'];

    $errors = array();

    // Validate the "name" field
    if (empty($name)) {
        $errors[] = "Name is required. Please enter your name.";
    }

    // Validate the "email" field
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is required and must be a valid email address.";
    }

    // Validate the "phone" field
    if (empty($phone) || !preg_match("/^\d{10}$/", $phone)) {
        $errors[] = "Phone is required and must be a 10-digit number.";
    }

    // Validate the "address" field
    if (empty($address)) {
        $errors[] = "Address is required. Please enter your address.";
    }

    // Validate the "petname" field (assuming it should not be empty)
    if (empty($petname)) {
        $errors[] = "Pet name is required. Please enter the pet's name.";
    }

    // Check for errors and display them if any
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    } else {
        // All fields are valid, proceed with the database insert

        // Use prepared statements to prevent SQL injection
        $request = "INSERT INTO adoption_form (name, email, phone, address, petname, other) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $request);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $phone, $address, $petname, $other);

            if (mysqli_stmt_execute($stmt)) {
                header('Location: adopt.html');
            } else {
                echo "Error executing the statement: " . mysqli_error($connection);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing the statement: " . mysqli_error($connection);
        }
    }
} else {
    echo 'Something went wrong';
}

?>
