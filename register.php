<?php
# Script 9.5 - register.php (Updated Code with Debugging)

$page_title = 'Register';
include('includes/header.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('mysqli_connect.php'); // Include database connection

    $errors = array();

    // Validation (same as before)
    if (empty($_POST['first_name'])) {
        $errors[] = 'You forgot to enter your first name.';
    } else {
        $fn = trim($_POST['first_name']);
    }

    if (empty($_POST['last_name'])) {
        $errors[] = 'You forgot to enter your last name.';
    } else {
        $ln = trim($_POST['last_name']);
    }

    if (empty($_POST['email'])) {
        $errors[] = 'You forgot to enter your email address.';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'The email address is invalid.';
    } else {
        $e = trim($_POST['email']);
    }

    if (!empty($_POST['pass1'])) {
        if ($_POST['pass1'] != $_POST['pass2']) {
            $errors[] = 'Your password did not match the confirmed password.';
        } else {
            $p = trim($_POST['pass1']);
        }
    } else {
        $errors[] = 'You forgot to enter your password.';
    }

    if (empty($errors)) {
        // Check for duplicate email
        $check_email_query = "SELECT user_id FROM users WHERE email = ?";
        $stmt_check = mysqli_prepare($dbc, $check_email_query);
        mysqli_stmt_bind_param($stmt_check, 's', $e);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);

        if (mysqli_stmt_num_rows($stmt_check) > 0) {
            $errors[] = 'This email address is already registered.';
        }
        mysqli_stmt_close($stmt_check);
    }

    if (empty($errors)) {
        // Hash the password
        $hashed_password = password_hash($p, PASSWORD_DEFAULT);

        // Insert user data using prepared statements
        $insert_query = "INSERT INTO users (first_name, last_name, email, pass, reg_date) VALUES (?, ?, ?, ?, NOW())";
        $stmt = mysqli_prepare($dbc, $insert_query);
        mysqli_stmt_bind_param($stmt, 'ssss', $fn, $ln, $e, $hashed_password);

        if (mysqli_stmt_execute($stmt)) {
            echo '<h1>Thank you!</h1><p>You are now registered.</p><p><br /></p>';

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "<p>User inserted successfully.</p>";
            } else {
                echo "<p>User insertion failed: " . mysqli_stmt_error($stmt) . "</p>";
            }

            // *** UPDATE SITE_STATS TABLE (Example) ***
            // Replace 'site_stats' with your actual table name if different.
            // Replace column names 'total_users' and 'last_registration' if different.
            $update_stats_query = "UPDATE site_stats SET total_users = total_users + 1, last_registration = NOW()";
            $stats_result = mysqli_query($dbc, $update_stats_query);

            if ($stats_result) {
                if (mysqli_affected_rows($dbc) > 0) {
                    echo "<p>Site stats updated successfully.</p>";
                } else {
                    echo "<p>Site stats update executed, but no rows affected.</p>";
                }
            } else {
                echo "<p>Error updating site statistics: " . mysqli_error($dbc) . "</p>";
            }
            // *** END UPDATE SITE_STATS TABLE ***

        } else {
            echo '<h1>System Error</h1><p class="error">You could not be registered. Please try again.</p>';
            echo '<p>' . mysqli_error($dbc) . '</p>';
        }

        mysqli_stmt_close($stmt);
        mysqli_close($dbc);
        include('includes/footer.html');
        exit();
    } else {
        echo '<h1>Error!</h1><p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) {
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p><p><br /></p>';
    }
    mysqli_close($dbc);
}
?>

<h1>Register</h1>
<form action="register.php" method="post">
    <p>First Name: <input type="text" name="first_name" size="15" maxlength="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></p>
    <p>Last Name: <input type="text" name="last_name" size="15" maxlength="40" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></p>
    <p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
    <p>Password: <input type="password" name="pass1" size="10" maxlength="20" /></p>
    <p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20" /></p>
    <p><input type="submit" name="submit" value="Register" /></p>
</form>

<?php include('includes/footer.html'); ?>