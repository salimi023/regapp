# SIMPLE APPLICATION FOR PARTICIPANT REGISTRATION

## PURPOSE OF THE APP
To provide registration opportunity to an event. 

## FUNCTIONS

### FRONTEND
- HTML form for user's data capturing 
- custom form validation 
- SPAM protection (custom CAPTCHA)

### BACKEND
- form data validation and sanitation
- data storage in database
- URI routing
- endpoint protection with JWT
- email notification to user
- registration confirmation through email sent to registered user
- reporting to admins through email (Cron)
- protection of sensitive configuration data (environmental variables)

## DEPENDENCIES

### FRONTEND
- w3css (https://www.w3schools.com/w3css/defaulT.asp)
- jQuery v3.7.1 (https://jquery.com/)

### BACKEND
- PHP v7.4.0
- Composer (https://getcomposer.org/)
- bramus/router v1.6.1 (https://packagist.org/packages/bramus/router)
- PHPMailer v6.9.1 (https://packagist.org/packages/phpmailer/phpmailer)
- rbdwllr/reallysimplejwt v5.0.0 (https://packagist.org/packages/rbdwllr/reallysimplejwt)
- vlucas/phpdotenv v5.6.0 (https://packagist.org/packages/vlucas/phpdotenv)

### DATABASE
- MySQL
- RedBeanPHP ORM (https://redbeanphp.com/index.php)
