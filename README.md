Simple PHP MVC prototype.

### List of features

* URL format: `host/{controller}/{method}/{@array params}`
* Simple template engine using [tinyTemplate](https://github.com/miya0001/tinyTemplate)
* PDO Database wrapper, see `/app/core/database.php`

## Install

Download or clone this repository.

## Configuration

Change your setting in `app/config.php`

---

## Controller

First url parameter is trigger the controller. `host/{controller}/...` and the controller files are inside **/app/controllers** folder.

Default trigger are `home::main()` if there is no url parameter for both controller and method then the available url parameter will be a `params` for default controller and method.

### Format

> URL: /post/read/123

* `post` are first url parameter and this is our controller
* `read` are the second url parameter and will be a method accessed in `post` class/controller.
* `123` are the third url parameter and this is the params (array)

### Example

More easy to explain it in example.

>URL:	/post/read/tags/slug
```
post::read('tags','slug')
```

>URL:	/post/read/hello-world
```
post::read('hello-world')
```

>URL:	/hello-world
```
home::main('hello-world')
```
>URL:	/fakecontroller/hello-world
```
main::main('hello-world')
```
---
### Controller inside folder

Just add a "dot" in controller name to access folder, in case `home.post` will open `/app/controllers/home/post`.

> URL: /home.post/read/123
```
post::read(123)
```

Enable `DEBUG_MODE` in `/app/config.php` will show the error notice even default controller / method was triggered (or actually there is no problem).