

##  Laravel MVC Based User Authentication System
The MVC structure of the project is as follows.
<br><br><br>

Models: User<br>
Views: login.blade.php, register.blade.php, layout.blade.php<br>
Controllers: userlogin.php<br>
Middleware : customerAuth.php<br>

<br> A simple user login, register project with session handling that also performs form validations(checks username,email,password length and for password mismatch)
On successfull register it routes to the login page where on successfull login, dashboard containg the current username os the session is also displayed along with the welcome message.

<br><br>Model Demo of the website on localhost http://127.0.0.1:8000/ <br>






