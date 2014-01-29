# User Login for [CouchCMS](http://www.couchcms.com/)


## Features
- Registration
- Account Activation
- Log In
- Remember Me (Stay Logged In)
- Log Out
- Reset Password/Forgot Password
- User Profiles
- User Listing
- Account Settings
- Easy Field Customization
- Login Throttling (Brute Force Protection)
- Secure Password Hashing ([Password Compatibility Library](https://github.com/ircmaxell/password_compat))


## Requirements
- PHP 5.3.7+
- CouchCMS 1.4+


## Installation
- In your `couch/addons/kfunctions.php` file, make sure the **session** and **DataBound** tags are enabled like so:

```PHP
require_once( K_COUCH_DIR . 'addons/cart/session.php' );
require_once( K_COUCH_DIR . 'addons/data-bound-form/data-bound-form.php' );
```

- Place the `addons/password-compatibility.php` file in your `couch/addons` folder.
- Place all of the `snippets/*.php` files in your `couch/snippets` folder.
- Copy the contents of `config.php` and paste it to the end of your `couch/config.php` file.
- Place the `account.php`, `login.php`, `register.php`, `reset.php`, and `users.php` templates in your website root folder and register them with CouchCMS.


## Author
#### [Increment Web Services](http://incrementwebservices.com/)


## Copyright and License
Copyright (c) 2014 [Increment Web Services](http://incrementwebservices.com/). Released under the [MIT License](LICENSE).
