<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database settings
$host = 'localhost';
$dbname = 'short_url_db';
$user = 'root';
$pass = 'Libraries.1993';

// Database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Function to generate a unique short code
function generateShortCode($length = 6) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

// Handle POST request to create a new shortened URL
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["long_url"])) {
    $long_url = filter_var($_POST["long_url"], FILTER_VALIDATE_URL);

    if ($long_url) {
        // Check if the URL already exists in the database
        $stmt = $pdo->prepare("SELECT short_code FROM urls WHERE long_url = :long_url");
        $stmt->execute(['long_url' => $long_url]);
        $existing_code = $stmt->fetchColumn();

        if ($existing_code) {
            $short_code = $existing_code;
        } else {
            do {
                $short_code = generateShortCode();
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM urls WHERE short_code = :short_code");
                $stmt->execute(['short_code' => $short_code]);
                $count = $stmt->fetchColumn();
            } while ($count > 0);

            // Insert the new URL into the database
            $stmt = $pdo->prepare("INSERT INTO urls (short_code, long_url) VALUES (:short_code, :long_url)");
            $stmt->execute(['short_code' => $short_code, 'long_url' => $long_url]);
        }

        $short_url = "http://localhost:8000/" . $short_code;
        $message = "Shortened URL: <a id='short-url' href='$short_url' target='_blank'>$short_url</a> <i id='copy-btn' class='fas fa-clipboard' onclick='copyToClipboard()'></i>";
    } else {
        $message = "Invalid URL.";
    }
} else {
    $message = "";  // No message if the form hasn't been submitted yet
}

// Handle redirection when accessing a shortened URL
if (isset($_SERVER['PATH_INFO'])) {
    $code = ltrim($_SERVER['PATH_INFO'], '/');
    $stmt = $pdo->prepare("SELECT long_url FROM urls WHERE short_code = :code");
    $stmt->execute(['code' => $code]);
    $url = $stmt->fetchColumn();

    if ($url) {
        header("Location: " . $url);
        exit;
    } else {
        $message = "Shortened URL not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHRTN - URL Shortening Service</title>
    <!-- Font Awesome for clipboard icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Google font for comic-style button text -->
    <link href="https://fonts.googleapis.com/css2?family=Gaegu:wght@400&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        input[type="url"] {
            width: calc(100% - 100px); /* Adjusted to make room for the button */
            padding: 15px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-right: 10px;
            outline: none;
            transition: all 0.3s ease;
        }

        input[type="url"]:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 8px rgba(76, 175, 80, 0.5);
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            font-size: 24px;
            font-family: 'Gaegu', cursive; /* Updated to Gaegu font */
            font-weight: 300;  /* Font weight set to 400 */
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 100px;  /* Ensures button size adapts to text */
            line-height: 1.2;
        }

        button:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        .message {
            margin-top: 20px;
            font-size: 16px;
            color: #333;
            text-align: center;
        }

        .message a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }

        .message a:hover {
            text-decoration: underline;
        }

        #copy-btn {
            cursor: pointer;
            font-size: 20px;
            margin-left: 10px;
            color: #007bff;
        }

        #copy-btn:hover {
            color: #0056b3;
        }

        #short-url {
            word-wrap: break-word;
            display: inline-block;
            max-width: 70%;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="POST" action="index.php">
            <div class="form-group">
                <input type="url" name="long_url" placeholder="Enter URL to shorten" required>
                <button type="submit">shrtn</button>
            </div>
        </form>

        <div class="message">
            <?php echo $message; ?>
        </div>
    </div>

    <script>
        function copyToClipboard() {
            const url = document.getElementById('short-url').textContent;
            const tempInput = document.createElement('input');
            document.body.appendChild(tempInput);
            tempInput.value = url;
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            alert('URL copied to clipboard!');
        }
    </script>
</body>
</html>
