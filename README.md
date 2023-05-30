<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Dmenu

Dmenu is a fullstack web application for order food via qr scanner, we provide a service for restaurant owner to manage their restaurants, menu, and have a statistic of food ordering for owner to track in their restaurant. Customer can easily scan qr code and order food from their mobile phone.

- Scan to pay: the cycle of our system is for restaurants' customers to scan browse food in the menu lists, add to card, checkout, get invoice and pay. We try to make the use of technology to replace the traditional order that we use a paper menu that is not flexible to update, maintenance and pass from one to another. So imagine the case when customers come in scan the Qr code on the table select the food that they want to eat, add to cart to review all menu (just like when the waiter or waitress confirming the menu again), checkout and get invoice to pay. Done!

- Admin (Restaurant owner): In tradition, each restaurant is using the paper base food menu for their customer, but for our system we provide many functions for admin that can help to manage their business:
    CRUD restaurant: admin can create as many restaurants as they want in their account so for each admin can have more than 1 restaurant to manage on, with just a single device.
    CRUD category and menu: in each restaurant, admin can create category for any type of food that makes it easy for customers to browse straight into the category that has food they want to order. And for each category admin can also create a lot of food menu and serve for customer to browse and order.
    Track and Analyze data: besides from all those above features, our system also provide a dashboard for admin to track all the records from their restaurant, review all order and also live order from customer. All order record of each restaurant will be saved for customer to calculate the income and expense for each restaurant.
    Telegram bot (future plan): we also want to apply this additional feature that we think it might be good for admin to be more flexible with all the data, we want to provide a telegram bot for each restaurant and customer can also order via telegram and all the order, invoice, and other stuffs will be sent directly to admin as a document that might be easy for admin to maintenance.

- Superadmin: this feature is design personally for our team members to tracking and maintenance the whole system for our user in case any bug or error haappen to the system. We also provide some additional features for superadmin.
    Dashboard: this dashboard will show the overall data for every restaurant, user, our income for the system, best restaurant with highest order, chat message with admin in case anything happen to the system.
    Restaurant and User insight: we have the data for each restaurant and use that have registered in our system that show how many restaurant that each user own, which restaurant belong to who and showing best food of each restaurant and more.

## Project Setup

```bash
First: composer install

```

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
