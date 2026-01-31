<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Appointment Scheduler | Professional Healthcare</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@500;700&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --primary: #1e3a8a;
      --accent: #3b82f6;
      --text-dark: #1f2937;
      --glass: rgba(255, 255, 255, 0.9);
    }

    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      color: var(--text-dark);
      /* Professional medical-themed background */
      background: linear-gradient(rgba(30, 58, 138, 0.8), rgba(30, 58, 138, 0.4)), 
                  url('https://images.unsplash.com/photo-1505751172107-12945827f729?auto=format&fit=crop&q=80&w=2070');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
    }

    header {
      padding: 40px 20px;
      text-align: center;
      color: white;
    }

    header h1 {
      font-family: 'Poppins', sans-serif;
      font-size: clamp(2.5rem, 5vw, 3.5rem);
      margin: 0;
      text-shadow: 0 2px 4px rgba(0,0,0,0.3);
      font-weight: 700;
    }

    header p {
      font-size: 1.1rem;
      opacity: 0.9;
      margin-top: 10px;
      letter-spacing: 1px;
    }

    .main-container {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    nav {
      background: var(--glass);
      backdrop-filter: blur(10px);
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 450px;
      display: flex;
      flex-direction: column;
      gap: 15px;
      border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .welcome-msg {
      text-align: center;
      margin-bottom: 20px;
    }

    .welcome-msg h2 {
      margin: 0;
      color: var(--primary);
      font-family: 'Poppins', sans-serif;
    }

    nav a {
      display: block;
      padding: 14px 24px;
      background-color: var(--primary);
      color: white;
      text-decoration: none;
      text-align: center;
      border-radius: 12px;
      font-size: 16px;
      font-weight: 500;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    /* Secondary style for certain buttons */
    nav a.secondary {
      background-color: transparent;
      border: 2px solid var(--primary);
      color: var(--primary);
      box-shadow: none;
    }

    nav a:hover {
      background-color: var(--accent);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
    }

    nav a:active {
      transform: translateY(0);
    }

    footer {
      background-color: rgba(31, 41, 55, 0.95);
      color: white;
      text-align: center;
      padding: 25px;
      font-size: 14px;
      backdrop-filter: blur(5px);
    }

    .creator {
      color: #93c5fd;
      font-weight: 600;
      text-decoration: none;
    }

    .footer-divider {
      height: 1px;
      background: rgba(255,255,255,0.1);
      margin: 10px auto;
      width: 50px;
    }

    @media (max-width: 480px) {
      nav {
        padding: 30px 20px;
      }
      header h1 {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>

  <header>
    <h1>Appointment Scheduler</h1>
    <p>Efficient Care • Seamless Scheduling • Secure Portal</p>
  </header>

  <div class="main-container">
    <nav>
      <div class="welcome-msg">
        <h2>Welcome Back</h2>
        <p>Please select an option to continue</p>
      </div>

      <?php if (isset($_SESSION['admin_id'])): ?>
          <a href="admin_dashboard.php">Go to Admin Dashboard</a>
          <a href="admin_logout.php" class="secondary">Logout</a>
      <?php elseif (isset($_SESSION['patient_id'])): ?>
          <a href="patient_dashboard.php">Go to Patient Dashboard</a>
          <a href="patient_logout.php" class="secondary">Logout</a>
      <?php else: ?>
          <a href="patient_login.php">Patient Login</a>
          <a href="patient_register.php" class="secondary">Create New Account</a>
          <hr style="width:100%; border:0; border-top:1px solid #ddd; margin: 10px 0;">
          <a href="admin_login.php" style="background-color: #475569;">Admin Access</a>
      <?php endif; ?>
    </nav>
  </div>

  <footer>
    &copy; <?php echo date("Y"); ?> Appointment Management System
    <div class="footer-divider"></div>
    Developed with excellence by <span class="creator">Varun Kumar S</span>
  </footer>

</body>
</html>
