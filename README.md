# User Login for [CouchCMS](http://www.couchcms.com/)
**This project is no longer maintained; native functionality has been introduced.**


## Features
- Registration
- Account Activation
- Log In
- Remember Me (*Stay Logged In*)
- Log Out
- Reset/Forgot Password
- User Profiles
- User Avatars (*[Gravatar](http://gravatar.com/) Fallback*)
- User Listing
- Account Settings
- Field Customization
- Login Throttling (*Brute Force Protection*)
- Secure Password Hashing (*[Password Compatibility Library](https://github.com/ircmaxell/password_compat)*)


## Requirements
- PHP 5.3.7+
- CouchCMS 1.4+
- Enable the *session* and *data-bound-form* addons in your `couch/addons/kfunctions.php` file:

```PHP
require_once( K_COUCH_DIR . 'addons/cart/session.php' );
require_once( K_COUCH_DIR . 'addons/data-bound-form/data-bound-form.php' );
```


## Installation
- Place the `addons/password-compatibility.php` file in your `couch/addons` folder.
- Place all of the `snippets/*.php` files in your `couch/snippets` folder.
- Copy the contents of `config.php` and paste it to the end of your `couch/config.php` file.
- Place the `account.php`, `login.php`, `register.php`, `reset.php`, and `users.php` templates in your website root folder and register them with CouchCMS.


## Usage
- Embed the `user-init.php` snippet file at the start of each template you wish to enable user functionality:

```PHP
<cms:embed 'user-init.php'/>
```

- You can then check a visitor's login status using the `authenticated` variable:

```PHP
<cms:if authenticated>
	You are logged in!
<cms:else/>
	You are not logged in!
</cms:if>
```

- If a visitor is logged in, a number of additional variables are provided:
	- `my_user_id` - ID of user's cloned page
	- `my_user_profile` - Link to user's cloned page
	- `my_user_name` - Username
	- `my_user_email` - Email Address
	- `my_user_fname` - First Name (*Optional*)
	- `my_user_lname` - Last Name (*Optional*)
	- `my_user_avatar` - Avatar Image


## Copyright and License
Copyright (c) 2015. Released under the [MIT License](LICENSE).
