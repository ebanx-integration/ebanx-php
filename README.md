# EBANX PHP Library
EBANX is the market leader in e-commerce payment solutions for International Merchants selling online to Brazil.
This library enables you to integrate EBANX with any PHP application.

## Requirements
* PHP >= 5.3
* cURL

## Installation
### Composer
The EBANX library is available on Packagist (https://packagist.org/packages/ebanx/ebanx), 
therefore you can install it by simple updating your composer.json file:

```
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
To use the EBANX PHP library you only need to setup your integration key.
```
\Ebanx\Config::setIntegrationKey('your-integration-key');
```

If you need to change other settings, you can use the following function call: 
```
\Ebanx\Config::set(array(
    'integrationKey' => 'your-integration-key'
  , 'testMode'       => true
));
```

You can change the following settings:
* integrationKey: your integration key. It will be different in test and production modes.
* testMode: enable or disable the test mode. The default value is _false_.
* directMode: enable or disable the direct checkout mode. The default value is _false_.


## Changelog
**1.0.0**: first release.