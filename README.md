# SumanasAssessment

1)	Initially download the code to your system.
2)	Then add “.env” file, You can copy & paste it from the “.env-example” file.
3)	Add your stripe API Keys in the “.env” file.
4)	Create a database in your phpmyadmin. Make sure that the provided database name is added in the “.env” file.
5)	Run “php artisan migrate” in your terminal or command prompt. This will migrate table in to your corresponding database that you mentioned in the “.env” file.
6)	Create some products in your stripe account. Make sure that the product price type is “recurring”. Note: You can see “products” options on the top of the stripe dashboard page.
7)	That products data will be added in to your table while running seeding command.
8)	Then run “php artisan db:seed –class=ProductSeeder” command, this will add the stripe products data into your “products” table.
9)	Then run “php artisan serve” command.
10)	Then browse http://127.0.0.1:8000/register. This will redirect you to the register page.
11)	Register a user & it will automatically logging you & redirected to the products list page.
12)	In products list page, we can see the products that we are seeding already.
13)	When clicking on the “Buy Now” button, it will be redirected to the checkout page.
14)	There you can see the corresponding product’s data.
15)	Enter the stripe test card details in the corresponding fields & click “Pay” button.
16)	If the payment is succeeded, then it will be redirected to the success page, if it’s a failure it will be redirected to the failure page.
17)	After the success, the payment will be updated in the stripe & In the stripe customer, you can see the product added to that customer.
