<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login - Portal UKM PRO</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://themewagon.github.io/elearning/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(rgba(24, 29, 56, .7), rgba(24, 29, 56, .7)),
                url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=1440');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Nunito', sans-serif;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            backdrop-filter: blur(5px);
        }

        .login-card h3 {
            font-weight: 700;
            color: #181d38;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25 red rgba(6, 187, 204, 0.25);
            border-color: #06BBCC;
        }

        .btn-login {
            background: #06BBCC;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            width: 100%;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #05a3b3;
            transform: translateY(-2px);
            color: white;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .back-link:hover {
            color: #06BBCC;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <h3><i class="fa fa-graduation-cap text-primary me-2"></i>UKM PRO</h3>
        <p class="text-center text-muted mb-4">Silakan masuk ke akun Anda</p>

        @if ($errors->has('login'))
            <div class="alert alert-danger text-center">
                Email atau password yang kamu masukkan salah.
            </div>
        @endif

        @if ($errors->any() && !$errors->has('login'))
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-bold">Alamat Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i
                            class="fa fa-envelope text-muted"></i></span>
                    <input type="email" name="email" class="form-control border-start-0"
                        placeholder="nama@email.com" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold">Kata Sandi</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fa fa-lock text-muted"></i></span>
                    <input type="password" name="password" class="form-control border-start-0"
                        placeholder="Masukkan password" required>
                </div>
            </div>

            <button type="submit" class="btn btn-login shadow-sm">Sign In</button>

            <a href="/" class="back-link"><i class="fa fa-arrow-left me-1"></i> Kembali ke Beranda</a>
        </form>
    </div>

</body>

</html>
