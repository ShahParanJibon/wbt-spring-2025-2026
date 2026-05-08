<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login &mdash; Pharmacy Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-body">

<div class="auth-shell">

    <div class="auth-side">
        <div class="logo-big">&#128138;</div>
        <h1>Welcome Back</h1>
        <p>
            Log in to access the Pharmacy Management System dashboard 
            and manage your daily inventory.
        </p>
        <ul class="feature-list">
            <li>&#10003; Secure Admin & Pharmacist access</li>
            <li>&#10003; Real-time stock monitoring</li>
            <li>&#10003; Automated sales calculations</li>
        </ul>
    </div>

    <div class="auth-form-wrap">
        <div class="auth-card">
            <h2>Sign In</h2>
            <p class="muted">Enter your credentials to continue</p>

            <?php if (!empty($error)): ?>
                <div class="alert alert-error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php?page=login" class="form">
                
                <div class="field">
                    <label for="username">Username</label>
                    <input type="text" 
                           id="username" 
                           name="username" 
                           value="<?= htmlspecialchars($prefill) ?>" 
                           placeholder="Enter your username" 
                           required>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           placeholder="Enter your password" 
                           required>
                </div>

                <div class="field-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" <?= $prefill ? 'checked' : '' ?>>
                        <span>Remember Me</span>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    Log In
                </button>

            </form>

            <p class="auth-foot">
                Need an account? 
                <a href="index.php?page=register">Create one</a>
            </p>
        </div>
    </div>

</div>

</body>
</html>