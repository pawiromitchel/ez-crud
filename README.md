# PHP CRUD API

I've made a very special routing system with __*Slim Framework*__ that I want to share.

## Connecting to the MySQL database
First of all lets edit the index.php located in the __*/public*__ folder. The first thing that we want to do is to make a database connection.

### The connector class

` DB::connect($host, $tablename, $username, $password);`

### Sample connection 

`$connector = DB::connect("localhost", "app_database", "root", "");`


### SELECT ALL

```
Method					: GET 
Route					: http://localhost/{table}
Select desired coloms	: http://localhost/{table}?coloms={colom1, colom2, etc}
Order By a Colom		: http://localhost/{table}?orderBy={ColomName}
Ascending / Descending 	: http://localhost/{table}?sorting={asc/desc}

Sample route			: http://localhost/users?coloms=id,firstname&orderBy=id&sorting=desc
```
### SELECT ByID
```
Method	: GET 
Route	: http://localhost/{table}/{id}
```

### INSERT
```
Method	: POST 
Route	: http://localhost/{table}
```
*Note: that when you post something like __{username: mitchel}__, there must be a colom named __username__!*
### DELETE
```
Method	: DELETE 
Route	: http://localhost/{table}/{id}
```

### UPDATE
```
Method	: PUT 
Route	: http://localhost/{table}/{id}
```

### TODO
- Login
- Search filters
- Relations
