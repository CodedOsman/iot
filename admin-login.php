<?php
session_start();

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/classes/db.php';
require_once __DIR__ . '/classes/models/users.mod.php';

// Redirect if already logged in
if (isset($_SESSION['user_id']) || isset($_SESSION['user_id'])) {
    // clear old generic key if present
    unset($_SESSION['user_id']);
    header('Location: admin/index.php');
    exit();
}




$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['user_name'] ?? '';       // matches USERS.user_name
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Username and password are required';
    } else {
        try {
            $pdo = DB::getConnection();
            $user = new User($pdo);
            $foundUser = $user->findByUsername($username);

            $authenticated = false;
            if ($foundUser) {
                // try verifying hashed password first
                if (password_verify($password, $foundUser['password'])) {
                    $authenticated = true;
                } elseif ($password === $foundUser['password']) {
                    // stored password appears plaintext; authenticate and rehash
                    $authenticated = true;
                    $newHash = password_hash($password, PASSWORD_BCRYPT);
                    $user->updatePassword($foundUser['user_id'], $newHash);
                }
            }

            if ($authenticated) {
                // only administrators allowed
                if ((int)$foundUser['role_id'] === 1) {
                    $_SESSION['admin_user_id']   = $foundUser['user_id'];
                    $_SESSION['admin_username']  = $foundUser['user_name'];
                    $_SESSION['admin_role_id']   = $foundUser['role_id'];

                    header('Location: admin/index.php');
                    exit();
                } else {
                    $error = 'Access denied: not an administrator';
                }
            } else {
                $error = 'Invalid username or password';
            }
        } catch (Exception $e) {
            $error = 'Database error: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - IoT Portal</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 400px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header h1 {
            color: #333;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .login-header p {
            color: #666;
            font-size: 14px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }
        .alert {
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>IoT Admin</h1>
            <p>Portal Administrator Login</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="user_name">Username</label>
                <input type="text" id="user_name" name="user_name" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <div style="text-align: center; margin-top: 20px; color: #666; font-size: 12px;">
            <a href="/" style="color: white; text-decoration: none;">← Back to Home</a>
        </div>
    </div>
</body>
</html>
