<?php 
session_start();

// Jika sudah login, langsung lempar ke index
if(isset($_SESSION['status']) && $_SESSION['status'] == "login"){
    header("location:index.php");
}

// LOGIKA LOGIN SEDERHANA
if(isset($_POST['masuk'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Cek Username & Password (Hardcode untuk kemudahan)
    // Di aplikasi nyata, ini dicek ke Database tabel admin
    if($user == "admin" && $pass == "123456"){
        $_SESSION['username'] = $user;
        $_SESSION['status'] = "login";
        header("location:index.php");
    } else {
        $error = "Username atau Password Salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Charity Hope</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            overflow: hidden;
            border: none;
        }
        .login-header {
            background-color: #2b211e; /* Warna Sidebar */
            padding: 30px;
            text-align: center;
        }
        .login-header h4 {
            color: #fcb900; /* Warna Kuning */
            font-weight: 800;
            margin: 0;
            letter-spacing: 1px;
        }
        .btn-login {
            background-color: #fcb900;
            border: none;
            font-weight: bold;
            color: #fff;
            padding: 12px;
            transition: 0.3s;
        }
        .btn-login:hover {
            background-color: #e0a800;
            color: #fff;
        }
        .form-control {
            padding: 12px;
            border-radius: 8px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <h4>CHARITY HOPE</h4>
            <small class="text-white-50">Administrator Panel</small>
        </div>
        <div class="p-4">
            
            <?php if(isset($error)): ?>
                <div class="alert alert-danger text-center small py-2 mb-3">
                    <i class="fas fa-exclamation-circle me-1"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">Username</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                        <input type="text" name="username" class="form-control border-start-0" placeholder="Masukkan username" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                        <input type="password" name="password" class="form-control border-start-0" placeholder="Masukkan password" required>
                    </div>
                </div>
                <button type="submit" name="masuk" class="btn btn-login w-100 rounded-pill shadow-sm">MASUK DASHBOARD</button>
            </form>
        </div>
        <div class="bg-light p-3 text-center border-top">
            <small class="text-muted">&copy; 2025 Charity Hope Foundation</small>
        </div>
    </div>

</body>
</html>