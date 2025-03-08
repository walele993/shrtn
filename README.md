# SHRTN - URL Shortening Service

SHRTN is a simple, efficient URL shortening service built using PHP and MySQL. Users can submit long URLs, and the system will generate a unique short code. The short URL can then be copied directly to the clipboard for easy sharing.

## Features

- Generate short URLs from long URLs.
- Check if the URL has already been shortened to avoid duplicates.
- Copy the shortened URL to clipboard with a single click.
- Clean and responsive design with custom fonts and icons.

## Requirements

- PHP 7.x or later
- MySQL
- Web server with PHP support (e.g., Apache, Nginx, or built-in PHP server)

## Installation

1. Clone the repository or download the files.
2. Import the `short_url_db` database schema in your MySQL server.
3. Update the `index.php` file with your database connection details (`$host`, `$dbname`, `$user`, `$pass`).
4. Place the project in your web server's root directory or use the built-in PHP server (`php -S localhost:8000`).
5. Visit `http://localhost:8000` to start using the URL shortening service.

## Usage

1. Enter a URL you wish to shorten in the input field.
2. Click the "SHRTN!" button to generate the shortened URL.
3. The shortened URL will be displayed along with a clipboard icon to copy it easily.

## Technologies Used

- PHP
- MySQL
- Font Awesome (for clipboard icon)
- Google Fonts (for custom comic-style font)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Credits
Created by **Gabriele Meucci**.