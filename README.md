# TestForATS

## Requirement

Using PHP, MySQL, HTML/CSS, Javascript, MVC design pattern, write a login / register application.

## Try it on your computer

* Pull the repository into your htdocs folder (or anywhere your WebServer can visit).

```bash
git clone https://github.com/hongshuan/TestForATS.git
```

* Make sure the folder `var/` and it subfolders writable.

```bash
cd TestForATS
chmod -R a+w var/
```

* Modify file `app/Config/config.ini` to change database settings.

```bash
vi app/Config/config.ini
```

* Create database table and add a user by running mysql script.

```bash
mysql -e "source users.sql"
```

This will create a database named `testats` and table named `users`. A testing account is added,
username is `testuser`, password is `123456`.

That's all. then open your browser and visit `localhost/TestForATS`, you will see the home page.

Click the link `login` or `register` to play around, After users logged in or
registered successfully, they will be redirected to a welcome page, click
`logout` to return home page.

The welcome page `/welcome` is only for logged in users, users will be redirected to login
page when non-authorized users try to visit this page.

In case of users try to visit a non-existing page like `/hello`, a 404 error page will be present.

## Solution

I didn't use any popular frameworks in my project, instead, I implemented my own mini MVC framework.

In frontend, I used jQuery and Bootstrap.

### Directories structure

```
TestForATS
├── app
│   ├── Config
│   ├── Controllers
│   ├── Models
│   └── Views
├── common
├── var
│   ├── logs
│   └── sessions
└── web
    ├── css
    └── js
```

### Description of Directories and Files

```
app/Config/config.ini       database settings
app/Config/routes.php       route definations

app/Controllers/
    - Controller            base class of all controllers
    - HomeController
    - UserController
    - ErrorController

app/Models/
    - Model                 base class of all models
    - UserModel

app/Views/
    - error404.phtml
    - home.phtml
    - login.phtml
    - register.phtml
    - welcome.phtml

common/                     kernel classes of the framework
    - Application.php
    - AutoLoader.php
    - Config.php
    - Database.php
    - ErrorHandler.php
    - Logger.php
    - Password.php
    - Request.php
    - Router.php
    - Session.php
    - Template.php

var/
    - logs/app.log
    - logs/error.log
    - var/sessions/

web                         DocumentRoot
    - css/style.css
    - js/login.js
    - js/register.js

web/.htaccess               Apache rewrite rules for clean url
web/index.php               front controller
```

## Conclusion

This is just a weekend project, I believe there is still much room for improvement.

