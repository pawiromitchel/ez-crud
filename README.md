# PHP MYSQL CRUD API

I've made a very special routing system with __*Slim Framework*__ that I want to share.

## Connecting to the MySQL database
First of all lets edit the index.php located in the __*/public*__ folder. The first thing that we want to do is to make a database connection.

### The connector class

` DB::connect($host, $tablename, $username, $password);`

### Sample connection 

`$connector = DB::connect("localhost", "app_database", "root", "");`

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
Select desired coloms	: http://localhost/{table}?coloms={colom1, colom2, etc}
Order By a Colom		: http://localhost/{table}?orderBy={colom, asc/desc}

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
### RELATIONS
```

Method		: GET
Return		: JSON
Route		: http://localhost:8001/{table}?join[]={table_to_join},{colomname1}={colomname2}

```

### FILTERS

Example : `http://localhost/users?filter[]=username,eq,mitchel&filter[]=password,eq,6881insljd`
#### Types:

- __*eq*__, equal (string or number matches exactly)
- __*cs*__, contain string (string contains value)

```

Method		: GET
Return		: JSON Array
Route		: http://localhost/{table}?filter[]={colom},{type},{value}

```

### TODO
- Relations
