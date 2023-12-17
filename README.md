

## My Team Assignment

## Prerequisites
- Docker
- Docker Compose
- Composer.

## Getting Started

1. Clone the repository:
   git clone git@github.com:reload13/my_team.git

2. Navigate to the project directory:
   
   cd path/to/your/directory


4. Install PHP dependencies with Composer:
   
   composer install


6. Install JavaScript dependencies with NPM:

   npm install
   

8. Set up environment variables:

    - Copy the example environment file:
      cp .env.example .env

    - Update the '.env' file with those credentials
       
      DB_HOST=mysql
      
      DB_DATABASE=mysql
      
      DB_USERNAME=sail
      
      DB_PASSWORD=password
      

 9. Start the application with Sail:
   
    ./vendor/bin/sail up
   

11. Run database migrations:
    
    ./vendor/bin/sail php artisan migrate
   


   

