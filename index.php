<?php
/**
 * Electric Build Information System
 * Main Entry Point
 */

session_start();

// Load configuration
require_once 'src/config/database.php';

// Simple routing
$page = $_GET['page'] ?? 'dashboard';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electric Build Information System</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>⚡ Electric Build Information System</h1>
            <nav>
                <ul>
                    <li><a href="index.php?page=dashboard">Dashboard</a></li>
                    <li><a href="index.php?page=buildings">Buildings</a></li>
                    <li><a href="index.php?page=towers">Towers</a></li>
                    <li><a href="index.php?page=flats">Flats</a></li>
                    <li><a href="index.php?page=consumption">Consumption</a></li>
                    <li><a href="index.php?page=reports">Reports</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <?php
            $viewFile = "src/views/{$page}.php";
            if (file_exists($viewFile)) {
                include $viewFile;
            } else {
                echo '<div class="alert alert-error">Page not found</div>';
            }
            ?>
        </main>

        <footer>
            <p>&copy; 2026 Electric Build Information System. All rights reserved.</p>
        </footer>
    </div>

    <script src="public/js/main.js"></script>
    <script src="public/js/ajax.js"></script>
</body>
</html>
