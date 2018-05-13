# Thinkific PHP SDK
[![Dependency Status](https://beta.gemnasium.com/badges/github.com/elliotboney/thinkific-php.svg)](https://beta.gemnasium.com/projects/github.com/elliotboney/thinkific-php)

This is under heavy construction and in early alpha stages. It is an sdk to help interact with the
[Thinkific LMS](http://www.thinkific.com/) API. The documentation for that REST Api can be found
[here](https://api.thinkific.com/documentation).




## Installation

#### Bleeding Edge
During your development, you can keep up with the latest changes on the master branch by setting the version
requirement for thinkific-api to `dev-master`
```json
{
   "require": {
      "elliotboney/thinkific-php": "dev-master"
   }
}
```


#### Via command line:
```shell
composer require elliotboney/thinkific-php
```


## Usage

Create a client for interacting with the API:
```php
$think = new \Thinkific\Thinkific ( [
   'apikey'    => 'your-api-key',
   'subdomain' => 'yoursubdomain',
   'debug'     => true
   ] );
```

### Endpoints
You can reach the following endpoints:
- Bundles
- Collections
- Coupons
- Course reviews
- Courses
- Enrollments
- Orders
- Products
- Promotions
- Users

by using the following scheme:
```php
// Create interface to access Users endpoint
$users = $think->users();

// Create interface to access Bundles endpoint
$bundles = $think->bundles();
// etc, etc
```

### Methods
The classes have the basic requests for GET, PUT, POST, DELETE with the Id parameter as well a getAll.
If the endpoint doesn't support the call, an `ApiException()` will be thrown.
Some examples of accessing these endpoints:
```php
// Get all users
$users = $users->getAll();

// Get a specific user
$users->getById(1234);

// Add a user
$users->add([
    "first_name" => "John",
    "last_name" => "Doe",
    "email"=>"johndoe@example.com",
    "roles"=>[]
  ]);

// Update a user
$users->update( 1234, [
    "first_name" => "John",
    "last_name" => "Doe",
    "email"=>"johndoe@example.com",
    "roles"=>[]
  ]);

// Delete a user
$users->delete( 1234);
```




For more details of which endpoints support which, please make sure you look through the [Thinkific API Docs](https://api.thinkific.com/documentation).





