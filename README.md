# Surface
Surface is simple, light-weight, MVC based framework written in PHP to provide a faster, secure and efficent way to build websites.

# Features
- Object Relational Mapper used - Eloquent
- Templating Engine - Twig
- Simple Router
- Serverend Validation
- SMTP settings to send mail
- Easy and simple middlewares
- MVC design pattern
- Easy integration with 3rd party packages

# Installation
## On Linux (Ubuntu/Debian based)
1. Install ```LAMP``` stack on your PC.
2. Install [https://github.com/RoverWire/virtualhost](virtualhost) bash script.
3. Create a virtualhost as per given in above link.
4. ```cd /var/www/```
5. Delete the folder created by your virtualhost. Please note the name of the folder before deleting.
6. ```git clone https://github.com/feat7/Surface.git <folder-name-you-just-deleted>```
7. Open that folder in terminal and run ```composer install```
8. Done! Check the website from your browser!

## On Windows
If you're using ```XAMPP``` then simply move of the contents to ```htdocs``` folder. Note that htdocs should be root folder and don't make any subfolder inside it.

# Next update
I will make the installation procedure easier and more convenient.
Create issue if you face any problem regarding installation.
Router will be very robust and flexible in next version.

# To Do
- New Router
- Command Line Interface tool
- Migrations from CLI
- SHELL to debug
- PHPUnit for unit tests
- suggest more..
