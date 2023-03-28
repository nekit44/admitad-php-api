Admitad API

#### install
```
composer require admitad/api dev-master
```

Documetation API Admtad [link](https://developers.admitad.com/hc/ru/articles/7981317512337)

#### get Access token use Client id and client secret
```php
    $api = new Api();
    $clientId = 'cb281d918a37e346b45e9aea1c6eb7';
    $secret = 'a0f8a8b24de8b8182a0ddd2e89f5b1';

    $data = $api->authorizedByClientIdAndSecret($clientId, $secret, 'advcampaigns banners websites');
```
#### Refresh token
```php
    $refreshToken = $api->refreshToken($clientId, $secret, $data->refresh_token);
```
#### or Access token use base64_header
```php
    $api = (new Api())->setBasicToken('Y2IyODFkOTE4YTM3ZTM0NmI0NWU5YWVhMWM2ZWI3OmEwZjhhOGIyNGRlOGI4MTgyYTBkZGQyZTg5ZjViMQ==');
    $clientId = 'cb281d918a37e346b45e9aea1c6eb7';
    $data = $api->authorizedByBasicToken($clientId, 'advcampaigns banners websites');
```