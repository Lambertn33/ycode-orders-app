# Ycode Test Assignment.

Projects requirements:
  - php >=8.2 
  - composer

Steps to run the project.
=========================

after cloning the project run:
1. composer install
2. cp .env.example .env (create new local DB and provide DB info in .env file)
3. php artisan key:generate
4. php artisan migrate
5. npm install
6. provide the YCODE_API_URL and YCODE_API_TOKEN values in .env 
  ( YCODE_API_URL = https://app.ycode.com/api/v1, YCODE_API_TOKEN="your API Key of the cloned project" ) 
7. php artisan serve
8. npm run dev

The Project is ready
