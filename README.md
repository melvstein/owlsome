# owlsome (Simple E-commerce using Laravel Breeze, Tailwindcss, Jquery and AlpineJs with Intervention Image) by Melvs

Features
- Admin. Staff and Customer Page.
- has own Website Login
- has login to Facebook or Google
-  Notifications
-  Events
-  Listeners
-  Mails
-  Providers
-  Queue Jobs

Admin Page:
- Dashboard
- Profile
- Business Details
- User List, Add, Delete
- Product List, Add, Edit, Delete
- Category List, Add, Edit, Delete
- Order Checkout List, Shipped Order, Delivered Order, Total Earned, Order History
- Cities Fee List, Add, Edit, Delete

Staff Page:
- Dashboard
- Profile
- Product List, Add, Edit, Delete
- Category List, Add, Edit, Delete
- Order Checkout List, Shipped Order, Delivered Order, Total Earned, Order History
- Cities Fee List, Add, Edit, Delete

Customer Page (COD):
- Profile
- Buy Now, Add to Cart, Checkout, View Order Details

To use this system:

cp .env.example -> .env

Run 
- "composer install"
- "npm install"
- "php artisan key:generate"
- "php artisan storage:link"
- "php artisan migrate"
- "php artisan migrate:fresh --seed"
- "php artisan queue:work"
- default login as admin: email = owlsome2021@gmail.com and pass = admin1234

