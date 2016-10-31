# PHP MYSQL CRUD API

I've made a very special routing system with 
- __*Slim Framework*__ <a href="http://www.slimframework.com/docs/">http://www.slimframework.com/docs/<a>
- __*Pixie Query Builder*__ <a href="https://github.com/usmanhalalit/pixie">https://github.com/usmanhalalit/pixie<a>

## Connecting to the MySQL database
First of all lets edit the index.php located in the __*/public*__ folder. The first thing that we want to do is to make a database connection.

### The connector class (public/config.php)

```
$config = array(
        'driver'    => 'mysql', // Db driver
        'host'      => 'localhost',
        'database'  => 'app_nais',
        'username'  => 'root',
        'password'  => '',
        // 'charset'   => 'utf8', // Optional
        // 'collation' => 'utf8_unicode_ci', // Optional
        // 'prefix'    => 'cb_', // Table prefix, optional
        'options'   => array( // PDO constructor options, optional
            PDO::ATTR_TIMEOUT => 5,
            PDO::ATTR_EMULATE_PREPARES => false,
        ),
    );

new \Pixie\Connection('mysql', $config, 'DB');
```

## Usage jQuery
```

$.ajax({
	type: {GET/POST/PUT/DELETE},
	url: {url_here},
	data: {data}
	success: function(data){
		data = $.parseJSON(data);
		// do something with data when successful
	},
	fail: function(){
		// do something when failed
	}
});

```

## Usage PHP

### GET Method
```

$data = json_decode(file_get_contents({url_here}));
var_dump($data);


```

### POST | PUT | DELETE Method
```

$postdata = http_build_query(
    array(
        'var1' => 'some content',
        'var2' => 'doh'
    )
);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);

$context  = stream_context_create($opts);
$result = file_get_contents({url_here}, false, $context);

```

### CREATE
Example	: `http://localhost/users`

Body	: `{firstname: mitchel, lastname: pawirodinomo}`
```

Method		: POST
Body		: JSON
Return		: The ID that was inserted
Route		: http://localhost/{table}

```
### READ ALL
Example: ` http://localhost/users?coloms=id,username,password&orderBy=id,desc`
```

Method					: GET
Return					: JSON Array
Route					: http://localhost/{table}

```

### READ ByID
Example: `http://localhost/users/1`
```

Method		: GET
Return		: JSON Array
Route		: http://localhost/{table}/{id}

```

*Note: that when you post something like __{username: mitchel}__, there must be a colom named __username__!*'


### UPDATE
Example : `http://localhost/users/6`

Body	: `{firstname: mitchel, lastname: pawirodinomo, username: mitchel, password: yesIamPasswrd}`
```

Method		: PUT
Body		: JSON
Return		: 1 or 0
Route		: http://localhost/{table}/{id}

```

### DELETE
Example: `http://localhost/users/5`
```

Method	: DELETE
Return	: 1 or 0
Route	: http://localhost/{table}/{id}

```