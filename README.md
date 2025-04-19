
## About Laravel 11 sanctum api | php 8.3 
Прект сырой, то что успел, сделал не все проверил и не все доделал

## Установка
composer install
php artisan migrate
php artisan db:seed

## Postman
заходим сначало api/login <BR>
'email' => 'alex@example.com', <BR>
'password' => 'password' <BR>
логинимся, берем в ответе токен <BR>
и потом делаем запрос на:

## Endpoint
POST api/login <BR>
POST api/orders/store <BR>
POST api/orders/{order}/status <BR>
GET  api/orders

## Отдельно проект HTML + JS
заходим на login.html регистрируемся и страничку редиректит на
index.html


## BD
Это не успел сделать, по этому теория

CREATE TABLE users (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255),
email VARCHAR(255),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255),
price DECIMAL(10,2),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE orders ADD user_id BIGINT UNSIGNED;
ALTER TABLE orders ADD product_id BIGINT UNSIGNED;
<BR>
=====================================
 
public function run(): void
{
\App\Models\User::factory(1000)->create();
\App\Models\Product::factory(500)->create();

    \App\Models\Order::factory(10000)->create([
        'user_id' => fn() => \App\Models\User::inRandomOrder()->first()->id,
        'product_id' => fn() => \App\Models\Product::inRandomOrder()->first()->id,
    ]);
}
=====================================

## SQL- (JOIN + GROUP BY + HAVING)
   SELECT u.name AS user_name, COUNT(o.id) AS orders_count, SUM(p.price) AS total_spent
   FROM orders o
   JOIN users u ON o.user_id = u.id
   JOIN products p ON o.product_id = p.id
   GROUP BY u.id
   HAVING COUNT(o.id) > 5
   ORDER BY total_spent DESC;


## EXPLAIN до оптимізації
EXPLAIN SELECT u.name, COUNT(o.id), SUM(p.price)
FROM orders o
JOIN users u ON o.user_id = u.id
JOIN products p ON o.product_id = p.id
GROUP BY u.id
HAVING COUNT(o.id) > 5;

## Добавление индесов
CREATE INDEX idx_orders_user_id ON orders(user_id);
CREATE INDEX idx_orders_product_id ON orders(product_id);
CREATE INDEX idx_products_price ON products(price);

## EXPLAIN после оптимизации
EXPLAIN SELECT u.name, COUNT(o.id), SUM(p.price)
FROM orders o
JOIN users u ON o.user_id = u.id
JOIN products p ON o.product_id = p.id
GROUP BY u.id
HAVING COUNT(o.id) > 5;


## (EXPLAIN ANALYZE) До и после
