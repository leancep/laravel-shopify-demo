# Shopify Integration with Laravel

## **Overview**
This project demonstrates the integration of a Laravel 11 application with Shopify's API. It includes features to fetch products from Shopify in real-time and store them in a PostgreSQL database with pagination support. Additionally, it implements testing for services.

---

## **Setup Instructions**

### **Prerequisites**
- PHP 8.2+
- Composer
- PostgreSQL
- Shopify API credentials

### **Installation**
1. Clone the repository:
   ```bash
   git clone https://github.com/your-repo.git
   cd your-repo
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Configure the `.env` file:
   ```env
   APP_NAME=ShopifyIntegration
   APP_ENV=local
   APP_KEY=base64:generated-app-key
   APP_DEBUG=true
   APP_URL=http://localhost

   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=shopify_demo
   DB_USERNAME=postgres
   DB_PASSWORD=your_password

   SHOPIFY_API_KEY=your-shopify-api-key
   SHOPIFY_API_SECRET=your-shopify-api-secret
   SHOPIFY_ACCESS_TOKEN=your-access-token
   SHOPIFY_SHOP_DOMAIN=your-store.myshopify.com
   ```

4. Run migrations to set up the database:
   ```bash
   php artisan migrate
   ```

5. Start the development server:
   ```bash
   php artisan serve
   ```

---

## **Features**

### **1. Fetch Products from Shopify**
- **Route:** `/shopify-products`
- **Controller:** `ShopifyController`
- **Description:** Fetch products in real-time from the Shopify API and return them as JSON.

### **2. List Products from Local Database**
- **Route:** `/products`
- **Controller:** `ProductController`
- **Description:** List products stored in PostgreSQL with pagination.
- **Pagination Parameters:**
  - `per_page`: Number of products per page (default: 10).
  - `page`: Page number (default: 1).

### **3. Sync Products with Shopify**
- **Command:** `php artisan shopify:sync-products`
- **Description:** Fetch products from Shopify and store/update them in the PostgreSQL database.

---

## **Testing**

### **1. Run Tests**
Execute the test suite:
```bash
php artisan test
```

### **2. Test Coverage**

#### **ShopifyControllerTest**
- Verifies that products are fetched from the Shopify API.
- Uses mocks to simulate Shopify API responses.

#### **ProductControllerTest**
- Verifies that products are fetched from the database with pagination.
- Ensures the structure of the JSON response is correct.

#### **SyncShopifyProducts Command Test**
- Confirms that the command syncs products from Shopify to the database.

---

## **Project Structure**

### **Key Files and Directories:**
- **`app/Services/ShopifyService.php`**: Handles Shopify API integration.
- **`app/Http/Controllers/ShopifyController.php`**: Fetches products from Shopify.
- **`app/Http/Controllers/ProductController.php`**: Fetches products from the database with pagination.
- **`app/Console/Commands/SyncShopifyProducts.php`**: Syncs products from Shopify to the local database.
- **`tests/Feature`**: Contains feature tests for controllers.
- **`tests/Unit`**: Contains unit tests for services.