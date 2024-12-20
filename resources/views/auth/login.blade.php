<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Login Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h3 class="text-center">Login Form</h3>
            <form id="loginForm" method="POST" action="/login">
                @csrf
                <!-- Email or Mobile -->
                <div class="mb-3">
                    <label for="emailOrMobile" class="form-label">Email Address or Mobile Number</label>
                    <input
                        type="text"
                        class="form-control"
                        id="emailOrMobile"
                        name="emailormobile"
                        placeholder="Enter email or mobile number"
                        required
                        pattern="^(?:[0-9]{10}|[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+)$"
                        title="Enter a valid email or 10-digit mobile number">
                </div>
                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            placeholder="Enter password"
                            required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            Show
                        </button>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <!-- Register Link -->
                <div class="mt-3 text-center">
                    <p>Don't have an account? <a href="/register">Register here</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (optional but needed for responsive behavior) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Password Visibility
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;
            this.textContent = type === 'password' ? 'Show' : 'Hide';
        });
    </script>
</body>
</html>
