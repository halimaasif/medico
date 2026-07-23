<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medico - Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        :root {
            /* Nayi theme ke CSS variables */
            --royal-blue: #0f2027;
            --accent-gold: #c5a059;
            --deep-black: #000000;
            --white: #f5f6fa;
            
            /* Structural mapping variables */
            --bg-color: var(--royal-blue);
            --surface-color: rgba(15, 32, 39, 0.65);
            --accent-purple: var(--accent-gold);
            --accent-cyan: var(--accent-gold);
            --text-main: var(--white);
            --glass-border: rgba(197, 160, 89, 0.25);
        }
        body {
            background-color: var(--bg-color);
            background-image: radial-gradient(at 95% 85%, rgba(197, 160, 89, 0.12) 0px, transparent 45%);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .glass-card {
            background: var(--surface-color);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: 0 12px 40px 0 rgba(0, 0, 0, 0.6) !important;
        }
        .custom-input {
            background: rgba(255, 255, 255, 0.04) !important;
            border: 1px solid var(--glass-border) !important;
            color: var(--text-main) !important;
            border-radius: 12px !important;
            padding: 12px 18px;
            transition: all 0.3s ease;
        }
        .custom-input::placeholder {
            color: rgba(245, 246, 250, 0.4) !important;
        }
        .custom-input:focus {
            border-color: var(--accent-gold) !important;
            box-shadow: 0 0 20px rgba(197, 160, 89, 0.25) !important;
        }
        .action-btn {
            background: linear-gradient(135deg, var(--accent-gold), #967439);
            color: var(--deep-black) !important;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: 14px;
            transition: all 0.3s ease;
        }
        .action-btn:hover {
            box-shadow: 0 0 20px rgba(197, 160, 89, 0.4);
            transform: translateY(-2px);
            filter: brightness(1.1);
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="glass-card p-5">
                    <div class="text-center mb-4">
                        <h2 style="font-weight: 700; color: var(--white);"><i class="bi bi-heart-pulse-fill" style="color: var(--accent-gold);"></i> Create Account</h2>
                        <p class="text-muted small">Join Medico Advanced Diagnostic Platform</p>
                    </div>

                    <form action="/register" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="text-white-50 small mb-1">Full Name (Unique)</label>
                            <input type="text" name="name" class="form-control custom-input" placeholder="e.g., ali_ahmed" required value="{{ old('name') }}">
                            @error('name') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="text-white-50 small mb-1">Email Address</label>
                            <input type="email" name="email" class="form-control custom-input" placeholder="name@example.com" required value="{{ old('email') }}">
                            @error('email') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="text-white-50 small mb-1">Phone Number</label>
                            <input type="text" name="phone" class="form-control custom-input" placeholder="e.g., 03001234567" required value="{{ old('phone') }}">
                            @error('phone') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="text-white-50 small mb-1">Password</label>
                            <input type="password" name="password" class="form-control custom-input" placeholder="Minimum 6 characters" required>
                            @error('password') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="text-white-50 small mb-1">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control custom-input" placeholder="Repeat password" required>
                        </div>

                        <button type="submit" class="btn action-btn w-100 mb-3">Create Account</button>
                    </form>

                    <div class="text-center">
                        <p class="text-muted small m-0">Already registered? <a href="/login" class="text-decoration-none fw-semibold" style="color: var(--accent-gold);">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>