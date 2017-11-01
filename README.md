REST Prototype
==============

Simple REST prototype

INSTALLATION
------------

### Clone repo

Console:

```bash
git clone git@github.com:vsguts/rest-prototype.git
```

REQUIREMENTS
------------

- PHP 7 or higher

RUNING
------

### PHP builtin server

Start PHP builtin server:

```bash
cd public
php -S localhost:8000
```

And open the following URL: [http://localhost:8000](http://localhost:8000)

USING
-----

### Authenticate

Login: **root**

Password: **root**

You need to set **Authorization**.

Header must contain `'Basic ' . base64_encode($login . ':' . $password)`.

Example: 
```
Authorization: Basic cm9vdDpyb290
```

### Available formats

- `application/json`
- `text/plain`

You need to set **Accept** header, to use this feature

### Available routes

Without Authenticate

- GET [/](http://localhost:8000)

Authenticate required

- GET [/users](http://localhost:8000/users)
- GET [/users/{id}](http://localhost:8000/users/1) - 200 or 404
- POST [/users](http://localhost:8000/users) - Exception: 400
- PUT [/users/{id}](http://localhost:8000/users/1) - Exception: 400
- DELETE [/users/{id}](http://localhost:8000/users/1) - 204

