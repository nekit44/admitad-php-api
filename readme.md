Admitad API

#### install
```
composer require nekit44/admitad-php-api dev-master
```

Documetation API Admtad [link](https://developers.admitad.com/hc/ru/articles/7981317512337)

#### get Access token use Client id and client secret
```php
    $api = new Api();
    $clientId = 'cb281d918a37e346b45e9aea1c6eb7';
    $secret = 'a0f8a8b24de8b8182a0ddd2e89f5b1';

    $data = $api->authorizedByClientIdAndSecret($clientId, $secret, scope:'advcampaigns banners websites');
```
#### Refresh token
```php
    $refreshToken = $api->refreshToken($clientId, $secret, $data->refresh_token);
```
#### or get Access token use base64_header
```php
    $api = (new Api())->setBasicToken('Y2IyODFkOTE4YTM3ZTM0NmI0NWU5YWVhMWM2ZWI3OmEwZjhhOGIyNGRlOGI4MTgyYTBkZGQyZTg5ZjViMQ==');
    $clientId = 'cb281d918a37e346b45e9aea1c6eb7';
    $data = $api->authorizedByBasicToken($clientId, scope:'advcampaigns banners websites');
```

#### Partner programs
```php
    $clientId = 'cb281d918a37e346b45e9aea1c6eb7';
    $accessToken = (new Api())
        ->setBasicToken('Y2IyODFkOTE4YTM3ZTM0NmI0NWU5YWVhMWM2ZWI3OmEwZjhhOGIyNGRlOGI4MTgyYTBkZGQyZTg5ZjViMQ==')
        ->authorizedByBasicToken($clientId, 'advcampaigns banners websites');
    $programs = (new Programs(new Api($accessToken->access_token)))->advcampaigns();
```
#### Partner program
```php
    $program = (new Programs(new Api($accessToken->access_token)))->advcampaigns(id: 92, params: ['language' => Language::ES]);
```
#### Partner program for website
```php
    $programWebsite = (new Programs(new Api($accessToken->access_token)))->advcampaignsWebsite(1);
```
#### Connecting the site to the program
```php
    $attach = (new Programs(new Api($accessToken->access_token)))->advcampaignsAttach(siteId: 1, partnerProgramId: 1);
```
#### Disconnecting the site from the program
```php
    $attach = (new Programs(new Api($accessToken->access_token)))->advcampaignsDetach(siteId: 1, partnerProgramId: 1);
```

#### Any way you can use the basic method GET or POST
```php

    $clientId = 'cb281d918a37e346b45e9aea1c6eb7';
    $accessToken = (new Api())
    ->setBasicToken('Y2IyODFkOTE4YTM3ZTM0NmI0NWU5YWVhMWM2ZWI3OmEwZjhhOGIyNGRlOGI4MTgyYTBkZGQyZTg5ZjViMQ==')
    ->authorizedByBasicToken($clientId, 'announcements manage_broken_links');
    $methodGet = (new Method(new Api($accessToken->access_token)))->get('/announcements/');
    $methodPost = (new Method(new Api($accessToken->access_token)))->post('/broken_links/resolve/', [
            'link_id' => 20
    ]);
```