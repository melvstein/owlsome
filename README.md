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
- Clone the repository with git clone
- Copy .env.example file to .env and edit database credentials there
- Run composer install
- Run php artisan key:generate
- Run php artisan migrate --seed (it has some seeded data for your testing)
- Run php artisan storage:link
- Run npm install
- Run npm run dev
- Run php artisan queue:work
- Run php artisan serve
- default login as admin: email = owlsome2021@gmail.com and pass = admin1234
Done!
