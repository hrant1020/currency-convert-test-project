# Test currency convert (freecarency API project)

## Test description 

```
Back-end Developer

Create a module for storing and converting currencies.  
The module must have a predefined list of currencies (at the discretion of the developer - hardcoded in the module  
or added via the admin panel).  
Exchange rates should be downloaded from https://freecurrencyapi.com/ (API documentation at  
https://freecurrencyapi.com/docs) for all available currencies and stored in the database.  
Rates should be updated once a day.  
The module should provide a service for converting prices from one currency to another (using something like this  
$converter->convert(123, 'USD', 'RUB');).  
Also, a page in the admin panel should be created, where all saved exchange rates should be displayed.  
Libraries implementing integration with https://freecurrencyapi.com/ (e.g.  
https://github.com/everapihq/freecurrencyapi-php) shouldn’t be used.  
Integration should be implemented with Guzzle, curl, file_get_content or any other tool aimed to make http requests  
or network requests.  
Any suitable framework can be used to implement the currency converter module.

```

#### Login credentials 
```
email : test@gmail.com
password:   secret
```

## Deployed on server
### http://64.226.110.128/
