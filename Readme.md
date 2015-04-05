#Flowers-Shop-CMS 

##Introduction:
Flowers Shop CMS provides the web essential services for prospective consumers to buy online flowers.

##System Requirements:
  - Wamp or Xamp 
  - Php 5.2
  - phpMyAdmin 3.0
  - MySQL v5.5
  - phpMailer v5.5

##Demo:
  - FrontEnd: http://flowers-shop.webege.com/
  - BackEnd: http://flowers-shop.webege.com/admin/

#Getting Started
To make system work with localhost or any hosting service provider kindly update credentials from **includes > config.php**

```php
// Database Constants
defined("DB_SERVER") ? null : define("DB_SERVER" , "localhost");
defined("DB_USER") ? null : define("DB_USER" , "root");
defined("DB_PASS") ? null : define("DB_PASS" , "");
defined("DB_NAME") ? null : define("DB_NAME" , "f_shop");
```

#### PayPal Integration
Update **simpleCart.email="*"** from **layouts > header.php**


##Security Provisions:
- **Change** default hash $key from **includes > user.php**.

##Credits
- http://phpmailer.worxware.com/index.php?pg=phpmailer
- http://simplecartjs.org/

####Note:
Default MYSQL and User Accounts Password.txt is provided in source
