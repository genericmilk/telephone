# 📱 Telephone
## By Genericmilk

Telephone is a lovely frontend to PHP's cURL that allows quick and easy GET and POST requests to JSON led api's!

### Why use this over cURL?
Simple! While yes it's definetely possible to use cURL, this dramatically simplifies the process down to 1-3 lines of code and most importantly, respond as a PHP Object ready to go for navigation! It makes for a more readable more traversible request

### Install Telephone
To get started using Telephone you need to add it to your composer.json file. You can do this by running the following command
```
composer require genericmilk/telephone
```
This'll install the prerequisites to get Telephone working.

### Using Telephone
To get started using Telephone in your controller, You need to import it. Add this to the top of your controller to get started;
```
use Genericmilk\Telephone\Telephone;
```
Now that you've added Telephone to your controller, you can use it to build requests!

### Creating a GET request without authorisation using Telephone
Get requests using Telephone are made up of two parts, The `url` and any `headers` you want to use. If you have no header information you need to pass such as bearer tokens, You can make a request as such
```
$RingRing = Telephone::call('https://jsonplaceholder.typicode.com/photos/1')->get();
```
The value of `$RingRing` will be a PHP Object of the response the api delivered. You can then traverse it as such;
```
return $RingRing->url; // will return example photo from api call
```
And of course if you have more than one item in the response, simply iterate over it using a foreach like so;
```
foreach($RingRing as $Item){
  echo $Item->url;
}
```

### Creating a GET request with authorisation using Telephone
If you need to pass authorisation into your request, for example by means of a `Bearer Token` you can do so by adding it to the chain like so
```
$RingRing = Telephone::call('https://jsonplaceholder.typicode.com/photos/1')
->bearer('xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx')
->get();
```

### Extending headers
If you need to add more to the headers array you can do so by adding the following
```
$RingRing = Telephone::call('https://jsonplaceholder.typicode.com/photos/1')
->headers([
  'Origin: https://status.quuu.co',
  'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36'
])
->get();
```
You can extend the header array as you need using this method. Any data will be sent along with the request

### Creating a POST request using Telephone
Creating a POST request is pretty much similar to how GET requests are made, with the key difference there is space for another array which will be sent as `form-data` in the post request if you need.

You can use the request like so;
```
$RingRing = Telephone::call('https://jsonplaceholder.typicode.com/photos/1')
->bearer('xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx')
->body([
  'Key' => 'Value',
  'AnotherKey' => 'AnotherValue'
])
->post();
```

You can scale up or down this request as you see fit. If you do not provide an array (i.e. a POST request without form-data) simply don't include it in your request like so;
```
$RingRing = Telephone::call('https://jsonplaceholder.typicode.com/photos/1')
->bearer('xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx')
->post();
```
Telephone will not send any data if no array exists by default.

### Failed requests
If Telephone recieves anything outside of a `200`, by default it'll throw an exception. You can change this behaviour in a later version via the means of configs!

### Roadmap
I really hope you love using Telephone. It should really aide with readability of your API requests and by converting data into a native PHP object speeds up the workflow! I've got plans to allow XML endpoints as well as more configuration and defaults, so if you have a common bearer token, you can add it to all requests meeting a certain pattern. Let me know your thoughts! Love you guys 🥰
