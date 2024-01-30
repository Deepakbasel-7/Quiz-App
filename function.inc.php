<?php

function safe_data( $conn, $data ) {
    $msg = '';
    $data = mysqli_real_escape_string($conn, $data );

    // Validate username length
    if (strlen($data) <= 4) {
        echo "Username must be more than 4 characters.";
    }

     // Validate that the username contains only letters
     elseif (!ctype_alpha($data)) {
        echo "Username must contain only letters.";
    }

    // If all validations pass, you can proceed with further actions
    else {
        echo "Validation successful. Username: " . $data;
        // Additional processing can be done here
    }
    return $data;

}

?>