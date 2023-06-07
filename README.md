## Description

Laranime is a Simple Laravel 9 application for streaming and discovering anime that uses Gogoanime and Otakudesu data to offer a seamless anime-watching experience. Browse through episode lists and stream episodes with ease.

## Disclaimer

This streaming website has been created solely for the purpose of applying my knowledge and skills in developing a Laravel project. It is important to note that this platform does not endorse or support any form of anime piracy. The content available on this website is intended for informational and educational purposes only.

By using this streaming website, you acknowledge that the purpose of its creation is solely for educational and developmental purposes related to web development using the Laravel framework, and that the content provided is not intended to support or promote anime piracy in any way.

Thank you for your understanding and cooperation in maintaining a responsible and lawful approach to content consumption.

## Roadmap

- [x] Add Indonesian Home Page (added on )
- [x] Add Popular Anime Page
- [x] Add Top Airing Anime Page
- [x] Add Genre Page
- [x] Add Search Anime Page
- [x] Implement Anime Blacklist Feature for Admin
- [x] Implement Anime Min Age Requirements Feature for Admin
- [x] Implement Anime Watchlist Feature for Normal User
- [x] Implement Anime History Feature fro Normal User
- [x] Multi-language Support
    - [x] Add Indonesia Language Support
    - [x] Add English Language Support
- [x] Multi-Theme Support
    - [x] Add Dark theme
    - [x] Add Light theme

## Getting Started

### Installing the project

1. Install Dependencies: Open a terminal or command prompt and navigate to the project's root directory. Run the following command to install the required dependencies:
   ```sh
   composer install
   ```
2. Rename the provided .env.example file to .env. You can do this by running the following command:
   ```sh
   cp .env.example .env
   ```
3. Generate the application key by running the following command:
   ```sh
   php artisan key:generate
   ```
4. Create a new database and configure its details in the .env file. After configuring the database, run the following command to migrate the database tables:
   ```sh
   php artisan migrate
   ```
5. Start the Laravel development server:
   ```sh
   php artisan serve
   ```
   > **Note:** Now the server is running on http://127.0.0.1:8000/


