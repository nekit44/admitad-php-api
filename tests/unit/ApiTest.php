<?php
declare(strict_types=1);

namespace tests\func\unit;


use Nekit44\AdmitadPhpApi\Api;
use PHPUnit\Framework\TestCase;
use tests\common\DummyCurl;
use function PHPUnit\Framework\assertEquals;

class ApiTest extends TestCase
{

    public function testToken()
    {
        $api = new Api('access_token==');
        self::assertEquals(
            'access_token==',
            $api->getAccessToken()
        );
    }

    public function testGenToken()
    {
        $curl = new DummyCurl();
        $api = new Api('access_token', $curl);
        $clientId = 'b5c3064c07f18c931f65a6c23d3880';
        $secret = 'b98de2cbc0801976f1dcd47c3d61a2';
        $api->authorizedByClientIdAndSecret($clientId, $secret, 'advcampaigns banners websites');
        assertEquals('YjVjMzA2NGMwN2YxOGM5MzFmNjVhNmMyM2QzODgwOmI5OGRlMmNiYzA4MDE5NzZmMWRjZDQ3YzNkNjFhMg==', $api->getBasicToken());
    }
}