# PHP CRUD API

I've made a very special routing system with __*Slim Framework*__ that I want to share.

## Connecting to the MySQL database
First of all lets edit the index.php located in the __*/public*__ folder. The first thing that we want to do is to make a database connection.

### The connector class

` DB::connect($host, $tablename, $username, $password);`

### Sample connection 

`$connector = DB::connect("localhost", "app_database", "root", "");`

### CREATE
```

Method	: POST
Return	: The ID that was inserted 
Route	: http://localhost/{table}

```
### READ ALL

```

Method					: GET
Return					: JSON Array
Route					: http://localhost/{table}
Select desired coloms	: http://localhost/{table}?coloms={colom1, colom2, etc}
Order By a Colom		: http://localhost/{table}?orderBy={colom}
Ascending / Descending 	: http://localhost/{table}?sorting={asc/desc}

Sample route			: http://localhost/users?coloms=id,firstname&orderBy=id&sorting=desc

```

### READ ByID
```

Method	: GET
Return	: JSON Array
Route	: http://localhost/{table}/{id}


```

*Note: that when you post something like __{username: mitchel}__, there must be a colom named __username__!*'


### UPDATE
```

Method	: PUT
Return	: 1 or 0
Route	: http://localhost/{table}/{id}

```

### DELETE
```

Method	: DELETE
Return	: 1 or 0
Route	: http://localhost/{table}/{id}

```

### Filter
```

Method	: GET
Return	: JSON Array
Route	: http://localhost/{table}?filter[]={colom},eq,{value}

```
### TODO
- Login
- Relations
