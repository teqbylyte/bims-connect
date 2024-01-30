# BIMSConnect

A laravel package extending [Laravel Socialite](https://laravel.com/docs/10.x/socialite) to provide authentication functionality specific to **BIMS** - *Beneficiary Identity Management Service* by TETFund.
Visit [bims.tetfund.gov.ng](https://bims.tetfund.gov.ng) to know more.

## Installation 💻

Install via composer

``` 
composer require teqbylyte/bims-connect
```

## Configuration ⚙️

Your BIMS client credentials should be placed in your `config/services.php` as given below:

```php
'bims' => [
    'client_id' => env('BIMS_CLIENT_ID'),
    'client_secret' => env('BIMS_CLIENT_SECRET'),
    'redirect' => 'https://yoursite.com/callback-url',
],
```

## Usage ✨

To initiate a connection with your BIMS service, invoke the init method provided by the package, 
which is a direct & easy replacement for how one would use Laravel Socialite:

```php
use Teqbylyte\BimsConnect\BimsConnect;

// Instead of Socialite::driver('bims'), use:
BimsConnect::init()

// Illustration 1:
Route::get('/oauth/redirect', function () {
    return BimsConnect::init()->redirect();
});
 
// Illustration 2:
Route::get('/oauth/callback', function () {
    $user = BimsConnect::init()->user();
 
    // $user->getEmail()
});
```

Visit [Laravel Socialite](https://laravel.com/docs/10.x/socialite) Learn more about other available methods.

## Contribution 🛠️

If you find any issue with this package, you're welcome to contribute 😄

