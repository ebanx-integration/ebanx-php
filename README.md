# EBANX PHP Library
EBANX is the market leader in e-commerce payment solutions for International Merchants selling online to Brazil.
This library enables you to integrate EBANX with any PHP application.

## Requirements
* PHP >= 5.3
* cURL

## Installation
### Composer
The EBANX library is available on Packagist (https://packagist.org/packages/ebanx/ebanx), 
therefore you can install it by simply updating your composer.json file:

``` json
{
  "require" : {
    "ebanx/ebanx": "dev-master"
  }
}
```
After that run _composer install_ and wait for it to finish. Include the Composer
generated autoloader from 'vendor/autoload.php' and you're ready to use the library.

### Git Repository
Clone the git repository anywhere you want and include the EBANX library autoloader
from 'src/autoload.php'.

## Usage
### Setup
To use the EBANX PHP library you need to setup your integration key.
``` php
\Ebanx\Config::setIntegrationKey('your-integration-key');
```

If you need to change other settings, you can use the following function call: 
``` php
\Ebanx\Config::set([
    'integrationKey' => 'your-integration-key'
  , 'testMode'       => true
]);
```

You can change the following settings:
* integrationKey: your integration key. It will be different in test and production modes.
* testMode: enable or disable the test mode. The default value is _false_.
* directMode: enable or disable the direct checkout mode. The default value is _false_.

To create a new API request, just call one of the following methods on the \Ebanx\Ebanx
class and supply it with the request parameters:
* \Ebanx\Ebanx::doCancel
* \Ebanx\Ebanx::doCapture
* \Ebanx\Ebanx::doExchange
* \Ebanx\Ebanx::doModify
* \Ebanx\Ebanx::doPrintHtml
* \Ebanx\Ebanx::doQuery
* \Ebanx\Ebanx::doRefund
* \Ebanx\Ebanx::doRefundOrCancel
* \Ebanx\Ebanx::doRequest
* \Ebanx\Ebanx::doToken
* \Ebanx\Ebanx::doZipcode

doRequest command example:
``` php
require_once __DIR__ . 'vendor/autoload.php';

\Ebanx\Config::setIntegrationKey('6e556ff76e55...56ff7');

$request = \Ebanx\Ebanx::doRequest([
    'currency_code'     => 'USD'
  , 'amount'            => 119.90
  , 'name'              => 'Jose da Silva'
  , 'email'             => 'jose@example.org'
  , 'payment_type_code' => 'boleto'
  , 'merchant_payment_code' => '10101101'
]);
```

## Changelog
* **1.4.1**: updated production URL.
* **1.4.0**: added custom user agent, made library PSR compliant.
* **1.3.0**: added Zipcode operation, improved HTTP Client error handling.
* **1.2.1**: updated autoloader and sandbox URL.
* **1.2.0**: added Token operation.
* **1.1.0**: added business person to Direct mode.
* **1.0.0**: first release.
