# Profile
Nesmenu: Nestable + Bootstrap  Admin Menu like Wordpress with PHP+MySQL

# Demo

Demo Link: http://www.awaimai.com/demo/nesmenu/


# Usage
1. Download source code from github;
2. Import "nesmenu.sql" to your database;
3. Edit second line of save.php, change:
	$db = new PDO("mysql:host=localhost;dbname=shop;charset=utf8", "root", "root");
to
	$db = new PDO("mysql:host=<Your DB host>;dbname=<Your DB name>;charset=utf8", "<Your DB username>", "<Your DB password>");
4. Done.


This Project was refe0edr to : https://github.com/msurguy/laravel-shop-menu