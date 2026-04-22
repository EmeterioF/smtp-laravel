composer install

cp .env.example .env

php artisan key:generate

php artisan migrate



go to your env folder
then replace this values
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME=<edu email>
MAIL_PASSWORD= i sent u the password in edu gmail
MAIL_FROM_ADDRESS=<edu email>
MAIL_FROM_NAME="${APP_NAME}"

composer run dev
