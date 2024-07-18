-- Create Users table
CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255), -- Nullable to accommodate OAuth users who might not have a password
    email VARCHAR(100) NOT NULL UNIQUE,
    oauth_provider VARCHAR(50), -- For storing the OAuth provider (e.g., Google, Facebook)
    oauth_uid VARCHAR(255), -- For storing the unique user ID from the OAuth provider
    oauth_token VARCHAR(255), -- For storing the OAuth access token
    oauth_refresh_token VARCHAR(255), -- For storing the OAuth refresh token
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create Stores table
CREATE TABLE Stores (
    store_id INT AUTO_INCREMENT PRIMARY KEY,
    owner_user_id INT NOT NULL, -- The user who owns the store
    store_name VARCHAR(100) NOT NULL,
    location VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (owner_user_id) REFERENCES Users(user_id)
);

-- Create StoreUsers table (associates users with stores)
CREATE TABLE StoreUsers (
    store_user_id INT AUTO_INCREMENT PRIMARY KEY,
    store_id INT NOT NULL,
    user_id INT NOT NULL,
    role VARCHAR(50) NOT NULL, -- e.g., 'admin', 'manager', 'staff'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (store_id) REFERENCES Stores(store_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Create Products table
CREATE TABLE Products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    store_id INT NOT NULL,
    barcode VARCHAR(50) UNIQUE,
    product_name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (store_id) REFERENCES Stores(store_id)
);

-- Create Sales table
CREATE TABLE Sales (
    sale_id INT AUTO_INCREMENT PRIMARY KEY,
    store_id INT NOT NULL,
    user_id INT NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    sale_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (store_id) REFERENCES Stores(store_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Create SaleItems table
CREATE TABLE SaleItems (
    sale_item_id INT AUTO_INCREMENT PRIMARY KEY,
    sale_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (sale_id) REFERENCES Sales(sale_id),
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
);

-- Create Inventory table
CREATE TABLE Inventory (
    inventory_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    store_id INT NOT NULL,
    initial_quantity INT NOT NULL,
    current_quantity INT NOT NULL,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES Products(product_id),
    FOREIGN KEY (store_id) REFERENCES Stores(store_id)
);

-- Create Logins table
CREATE TABLE Logins (
    login_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    logout_time TIMESTAMP NULL,
    ip_address VARCHAR(50),
    location VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Create Reports table
CREATE TABLE Reports (
    report_id INT AUTO_INCREMENT PRIMARY KEY,
    store_id INT NOT NULL,
    report_type VARCHAR(50) NOT NULL,
    report_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (store_id) REFERENCES Stores(store_id)
);

-- Create Notifications table
CREATE TABLE Notifications (
    notification_id INT AUTO_INCREMENT PRIMARY KEY,
    store_id INT NULL,
    user_id INT NULL,
    notification_type VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (store_id) REFERENCES Stores(store_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Create NotificationTypes table (optional for defining types)
CREATE TABLE NotificationTypes (
    type_id INT AUTO_INCREMENT PRIMARY KEY,
    type_name VARCHAR(50) NOT NULL UNIQUE,
    description TEXT
);

-- Add indexes
CREATE INDEX idx_user_id_storeusers ON StoreUsers(user_id);
CREATE INDEX idx_store_id_storeusers ON StoreUsers(store_id);
CREATE INDEX idx_role_storeusers ON StoreUsers(role);
CREATE INDEX idx_oauth_uid_users ON Users(oauth_uid);
CREATE INDEX idx_email_users ON Users(email);
CREATE INDEX idx_store_id_notifications ON Notifications(store_id);
CREATE INDEX idx_user_id_notifications ON Notifications(user_id);
CREATE INDEX idx_notification_type_notifications ON Notifications(notification_type);
CREATE INDEX idx_is_read_notifications ON Notifications(is_read);
CREATE INDEX idx_created_at_notifications ON Notifications(created_at);
CREATE INDEX idx_user_id ON Stores(user_id);
CREATE INDEX idx_store_id ON Products(store_id);
CREATE INDEX idx_store_id_sale ON Sales(store_id);
CREATE INDEX idx_user_id_sale ON Sales(user_id);
CREATE INDEX idx_sale_id ON SaleItems(sale_id);
CREATE INDEX idx_product_id ON SaleItems(product_id);
CREATE INDEX idx_product_id_inventory ON Inventory(product_id);
CREATE INDEX idx_store_id_inventory ON Inventory(store_id);
CREATE INDEX idx_user_id_login ON Logins(user_id);
CREATE INDEX idx_store_id_report ON Reports(store_id);
