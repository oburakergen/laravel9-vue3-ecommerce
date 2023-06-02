# Laravel E-commerce Website
E-commerce application built with Laravel9, Vue3.js and Vuetify. <br>

> If you want to see every single step how this E-commerce application is build and learn how to build your own Full Stack applications, check my website [thecodeholic.com](https://thecodeholic.com)

## Demo
```
Email: admin@admin.com
Password: password
```


## Installation
Make sure you have environment setup properly. You will need MySQL, PHP8.0, Node.js and composer.

### Install Laravel Website + API
1. Download the project (or clone using GIT)
2. Copy `.env.example` into `.env` and configure database credentials
3. Navigate to the project's root directory using terminal
4. Run `composer install`
5. Set the encryption key by executing `php artisan key:generate --ansi`
6. Run migrations `php artisan migrate --seed`
7. Start local server by executing `php artisan serve`
8. Open new terminal and navigate to the project root directory
9. Run `npm install`
10. Run `npm run dev` to start vite server for Laravel frontend