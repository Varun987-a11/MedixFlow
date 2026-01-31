<?php
ob_start(); // Start output buffering

if (session_status() === PHP_SESSION_NONE) 
    session_start();

include 'db_connect.php';

$message = "";

// Handle login logic first (before any output)
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user from DB
    $stmt = $conn->prepare("SELECT * FROM patients WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['patient_id'] = $user['patient_id'];
            $_SESSION['patient_name'] = $user['name'];
            header("Location: patient_dashboard.php"); 
            exit();
        } else {
            $message = "Incorrect password. Please try again.";
        }
    } else {
        $message = "Email not found. Please register if you're new.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login | Appointment Scheduler</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@500;700&display=swap" rel="stylesheet"/>
    <style>
        :root {
            --primary: #1e3a8a;
            --accent: #3b82f6;
            --error: #ef4444;
            --glass: rgba(255, 255, 255, 0.95);
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: linear-gradient(rgba(30, 58, 138, 0.85), rgba(30, 58, 138, 0.5)), 
                        url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&q=80&w=2053');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .login-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background: var(--glass);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 400px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .login-card h2 {
            margin: 0 0 10px 0;
            font-family: 'Poppins', sans-serif;
            color: var(--primary);
            text-align: center;
            font-size: 28px;
        }

        .login-card p.subtitle {
            text-align: center;
            color: #64748b;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .error-box {
            background-color: #fee2e2;
            color: var(--error);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
            border-left: 4px solid var(--error);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--primary);
            font-size: 14px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            box-sizing: border-box;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        input[type="submit"] {
            width: 100%;
            padding: 14px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: var(--accent);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #64748b;
            font-size: 14px;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: var(--primary);
        }

        footer {
            background-color: rgba(31, 41, 55, 0.9);
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 13px;
            backdrop-filter: blur(5px);
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-card">
            <h2>Patient Login</h2>
            <p class="subtitle">Access your health dashboard</p>

            <?php if (!empty($message)): ?>
                <div class="error-box"><?php echo $message; ?></div>
            <?php endif; ?>

            <form method="POST" action="patient_login.php">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="e.g. name@example.com" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>

                <input type="submit" name="login" value="Sign In">
            </form>

            <a href="index.php" class="back-link">← Back to Home</a>
        </div>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> Appointment Scheduler | Secure Patient Portal
    </footer>

</body>
</html>

<?php
ob_end_flush(); // End output buffering
?>