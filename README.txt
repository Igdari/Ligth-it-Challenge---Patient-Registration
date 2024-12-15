# Patient Registration API

This API allows registering patients, storing their details in a MySQL database, and sending asynchronous email notifications using Laravel and Docker.

## Requirements
- Docker & Docker Compose installed.
- Mailtrap account for email testing.
- MySQL database.

## Setup Instructions

1. Clone the repository:
   git clone https://github.com/Igdari/Ligth-it-Challenge---Patient-Registration
   cd <repository-folder> // Your repository folder


2. Set environment variables:
   - Copy the `.env.example` file to `.env`:
     cp .env.example .env

   - Update `.env` with your configuration:
     - Database:
       DB_CONNECTION=mysql
       DB_HOST=db
       DB_PORT=3306
       DB_DATABASE=patients
       DB_USERNAME=root
       DB_PASSWORD=password

     - Mailtrap:
       MAIL_MAILER=smtp
       MAIL_HOST=sandbox.smtp.mailtrap.io
       MAIL_PORT=2525
       MAIL_USERNAME=<your-mailtrap-username>
       MAIL_PASSWORD=<your-mailtrap-password>
       MAIL_ENCRYPTION=null
       MAIL_FROM_ADDRESS=no-reply@example.com
       MAIL_FROM_NAME="Patient API"

3. Start Docker containers:
   docker-compose up -d

4. Run migrations:
   docker exec -it <php-container-name> php artisan migrate


5. Queue Worker:
   Ensure the queue worker is running for email notifications:
   docker exec -it <php-container-name> php artisan queue:work


## Usage

- Register a Patient:
  Send a `POST` request to `/api/register-patient` with the following JSON body:
  {
      "name": "John Doe",
      "email": "john.doe@example.com",
      "phone": "1234567890",
      "document_photo": "<base64-encoded-file>"
  }

  
- **Expected Response**:
  {
      "message": "Patient registered successfully."
  }


## Testing Email Notifications
- Emails are sent asynchronously using the patient’s email address.
- Check your Mailtrap inbox to verify emails.

## Future Development
- Implement SMS notifications using the stored `phone` field.

## Notes
- For development purposes, Mailtrap is used for email testing. No actual emails are sent to recipients.
- Ensure Docker is running before executing any commands.

## Troubleshooting
- Docker Issues:
  If containers fail to start, verify your Docker installation and ensure ports are not in use.
- Email Issues:
  Check Mailtrap credentials and queue worker status.