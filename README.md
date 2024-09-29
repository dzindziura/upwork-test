# Project Setup and Instructions

## Project Setup

Follow these steps to set up the project:

1. **Clone the Repository:**
   ```sh
   git clone https://github.com/dzindziura/upwork-test.git
   cd upwork-test
   
2. Install Dependencies: Ensure you have Composer installed on your machine. Then run:
   ```sh
   composer install

3. Environment Configuration: Copy .env.example to .env and configure your environment variables as needed:
   ```sh
   cp .env.example .env

   
   
4. Generate Application Key:
   ```sh
   php artisan key:generate
5. ENV:
   ```sh
   QUEUE_CONNECTION=database
   
# Running Migrations

## Before running the migrations, ensure your database configuration is correctly set up in the .env file. Then run:
    php artisan migrate
### This command will apply all necessary database migrations.

# Testing the API Endpoint

## To test the API endpoint, follow these steps:

1. Start the Development Server:
   ```sh
   php artisan serve

1. Start the Queue:
   ```sh
   php artisan queue:work
   
2. Send a POST Request: You can use tools like Postman or curl to send a POST request to the endpoint. Example using curl:
   ```sh
   curl -X POST "http://127.0.0.1:8000/api/submit" \
     -H "Content-Type: application/json" \
     -d '{
           "name": "John Doe",
           "email": "john.doe@example.com",
           "message": "This is a test message."
         }'

3. Review the Response: The API should respond with a success message if the validation passes and the job is dispatched:
   ```sh
   {
    "success": "Data received and job dispatched"
   }
   
If there are validation errors, you will receive a response with the details of the validation issues:

        {
        "message": "The given data was invalid.",
        "errors": {
            "name": ["The name field is required."],
            "email": ["The email field is required."],
            "message": ["The message field is required."]
         }
        }

# Running Unit Tests

## To ensure your application functions as expected, you can run the unit tests provided in the project:

1. Run Migrations for Testing Environment:
   ```sh
   php artisan migrate --env=testing
   
2. Run the Tests:
   ```sh
   php artisan test

These commands will run all the unit tests and ensure your code performs as expected.
