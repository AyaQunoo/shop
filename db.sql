CREATE TABLE users ( 
id integer(11) AUTO_INCREMENT PRIMARY KEY,
username varchar(50) NOT NULL ,
email varchar(100) UNIQUE NOT NULL ,
password varchar(255) NOT NULL ,
address varchar(255),
phone varchar(15)
role ENUM('admin','customer') DEFAULT "customer"
)
CREATE TABLE category (
    id INTEGER(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(60) NOT NULL UNIQUE
);

CREATE TABLE products (
    id INTEGER(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL CHECK(price >= 0), 
    stock_quantity INTEGER DEFAULT 0 CHECK(stock_quantity >= 0), 
    category_id INTEGER(11) NOT NULL, 
    FOREIGN KEY (category_id) REFERENCES category(id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE 
);

CREATE TABLE order(
    id integer(11) AUTO_INCREMENT PRIMARY KEY,
    user_id integer(11) ,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    shipping_Status ENUM('in_cart', 'completed', 'shipped', 'cancelled') DEFAULT 'in_cart',
    FOREIGN KEY user_id REFERENCES users(id)
)
CREATE TABLE order_items(
    id integer(11) AUTO_INCREMENT PRIMARY KEY,
    order_id integer(11),
    product_id integer(11),
    quantity  integer CHECK (quantity>0),
    unit_Price DECIMAL(10, 2), 
    FOREIGN KEY order_id REFERENCES order(id)  ON DELETE CASCADE,
    FOREIGN KEY product_id REFERENCES products(id) ON DELETE CASCADE
    
)
CREATE TABLE reviews(
    id integer(11) AUTO_INCREMENT PRIMARY KEY,
user_id integer(11),
product_id integer(11),
rating  integer CHECK (rating BETWEEN 1 AND 5),
comment text ,
created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE

)

/*
users 
products 
orders 
categories 
reviews 




users : orders => 1 : m ;
products : orders => m : m ;
categories : products => 1 : m ; 
users : reviews => 1 : m ; 



*/

