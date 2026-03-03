<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Masuk | Peminjaman Alat</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #4f46e5;
            --secondary: #9333ea;
            --dark-title: #0f172a;
            --text-muted: #64748b;
            --bg-light: #f8fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg-light);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Airy Light Background Shapes */
        .bg-shapes {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1;
            background: 
                radial-gradient(circle at 0% 0%, rgba(79, 70, 229, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 100% 100%, rgba(147, 51, 234, 0.05) 0%, transparent 40%);
        }

        .floating-blob {
            position: absolute;
            width: 600px;
            height: 600px;
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.1), rgba(147, 51, 234, 0.1));
            filter: blur(100px);
            border-radius: 50%;
            animation: moveAround 25s infinite alternate;
            z-index: -1;
        }

        @keyframes moveAround {
            from { transform: translate(-10%, -10%) scale(1); }
            to { transform: translate(15%, 15%) scale(1.1); }
        }

        .login-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            padding: 4rem 3rem;
            border-radius: 36px;
            width: 100%;
            max-width: 480px;
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.05),
                0 10px 10px -5px rgba(0, 0, 0, 0.02);
            animation: popIn 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
        }

        @keyframes popIn {
            from { opacity: 0; transform: translateY(40px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .brand-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .brand-icon {
            width: 68px;
            height: 68px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            margin: 0 auto 1.25rem;
            box-shadow: 0 12px 24px rgba(79, 70, 229, 0.25);
        }

        .brand-title {
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--dark-title);
            letter-spacing: -1.5px;
            line-height: 1;
        }

        .brand-subtitle {
            color: var(--text-muted);
            margin-top: 0.5rem;
            font-weight: 600;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.75rem;
            font-weight: 700;
            color: #334155;
            font-size: 0.9rem;
            letter-spacing: -0.2px;
        }

        .input-box {
            position: relative;
        }

        .input-box i {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            transition: 0.3s;
            font-size: 1.1rem;
        }

        .input-box input {
            width: 100%;
            padding: 1.125rem 1.25rem 1.125rem 3.5rem;
            background: #ffffff;
            border: 2px solid #f1f5f9;
            border-radius: 18px;
            color: var(--dark-title);
            font-size: 1rem;
            font-weight: 600;
            outline: none;
            transition: 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .input-box input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 6px rgba(79, 70, 229, 0.06);
            background: #fff;
        }

        .input-box input:focus + i {
            color: var(--primary);
            transform: translateY(-50%) scale(1.1);
        }

        .btn-submit {
            width: 100%;
            padding: 1.125rem;
            background: var(--dark-title);
            border: none;
            border-radius: 18px;
            color: white;
            font-size: 1.05rem;
            font-weight: 800;
            cursor: pointer;
            transition: 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            margin-top: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            box-shadow: 0 10px 20px rgba(15, 23, 42, 0.15);
        }

        .btn-submit:hover {
            background: #1e293b;
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(15, 23, 42, 0.2);
        }

        /* Modern Alert */
        .alert-box {
            padding: 1rem 1.25rem;
            border-radius: 16px;
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fee2e2;
            margin-bottom: 2rem;
            font-weight: 700;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
        }

        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
            40%, 60% { transform: translate3d(4px, 0, 0); }
        }

        .copyright {
            text-align: center;
            margin-top: 2.5rem;
            color: #94a3b8;
            font-size: 0.85rem;
            font-weight: 600;
        }
    </style>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <div class="bg-shapes"></div>
    <div class="floating-blob"></div>

    <div class="login-card">
        <div class="brand-header">
            <div class="brand-icon">
                <i class="fas fa-flask-vial"></i>
            </div>
            <h1 class="brand-title">Peminjaman Alat</h1>
            <p class="brand-subtitle">Sistem Peminjaman Inventaris</p>
        </div>

        <div style="margin-bottom: 2rem;">
            <?php Flasher::flash(); ?>
        </div>

        <form action="<?= BASEURL; ?>/auth/login" method="post">
            <div class="form-group">
                <label class="form-label">Username</label>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Masukkan ID atau username" required autocomplete="off">
                    <i class="fas fa-user-circle"></i>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-box">
                    <input type="password" name="password" placeholder="••••••••" required>
                    <i class="fas fa-shield-halved"></i>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                Masuk <i class="fas fa-arrow-right"></i>
            </button>
        </form>

        <div class="copyright">
            Official Tools Inventory System © 2026
        </div>
    </div>

</body>
</html>
