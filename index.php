<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Appointment Scheduler | Modern Care</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@500;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <style>
    :root {
      --primary: #2563eb;
      --secondary: #0f172a;
      --accent: #38bdf8;
      --light: #f8fafc;
      --text-dark: #1e293b;
    }

    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      color: var(--text-dark);
      /* Professional Medical Background Image */
      background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.8)), 
                  url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&q=80&w=2000');
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
      font-size: clamp(2rem, 5vw, 3.5rem);
      font-weight: 700;
      margin: 0;
      letter-spacing: -1px;
    }

    header p {
      font-size: 1.1rem;
      opacity: 0.9;
      margin-top: 10px;
      font-weight: 300;
    }

    .container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    nav {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      padding: 40px;
      border-radius: 24px;
      width: 100%;
      max-width: 450px;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .nav-title {
      text-align: center;
      margin-bottom: 20px;
      font-weight: 600;
      color: var(--secondary);
    }

    nav a {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      padding: 16px;
      background-color: var(--primary);
      color: white;
      text-decoration: none;
      border-radius: 12px;
      font-size: 16px;
      font-weight: 600;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    nav a i {
      font-size: 1.2rem;
    }

    /* Distinct style for secondary buttons (Register) */
    nav a.register-btn {
      background-color: transparent;
      border: 2px solid var(--primary);
      color: var(--primary);
    }

    nav a:hover {
      background-color: var(--secondary);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
    }

    nav a.register-btn:hover {
        background-color: var(--primary);
    }

    footer {
      background: rgba(15, 23, 42, 0.9);
      color: white;
      text-align: center;
      padding: 30px;
      font-size: 14px;
    }

    footer .creator {
      color: var(--accent);
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    @media (max-width: 480px) {
      nav {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>

  <header>
    <h1>Appointment Scheduler</h1>
    <p>Seamless healthcare management at your fingertips.</p>
  </header>

  <div class="container">
    <nav>
      <div class="nav-title">Welcome Back</div>
      
      <?php if (isset($_SESSION['admin_id'])): ?>
          <a href="admin_dashboard.php"><i class="fa-solid fa-chart-line"></i> Admin Dashboard</a>
          <a href="admin_logout.php" style="background: #ef4444;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
      
      <?php elseif (isset($_SESSION['patient_id'])): ?>
          <a href="patient_dashboard.php"><i class="fa-solid fa-user-doctor"></i> Patient Dashboard</a>
          <a href="patient_logout.php" style="background: #ef4444;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
      
      <?php else: ?>
          <a href="patient_login.php"><i class="fa-solid fa-hospital-user"></i> Patient Login</a>
          <a href="patient_register.php" class="register-btn"><i class="fa-solid fa-user-plus"></i> Create Account</a>
          <hr style="width:100%; border: 0; border-top: 1px solid #e2e8f0; margin: 10px 0;">
          <a href="admin_login.php" style="background: var(--secondary);"><i class="fa-solid fa-lock"></i> Staff Portal</a>
      <?php endif; ?>
    </nav>
  </div>

  <footer>
    &copy; <?php echo date("Y"); ?> Appointment Scheduler System<br>
    <span class="creator">Developed by Varun Kumar S</span>
  </footer>

</body>
</html>
