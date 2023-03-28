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
        $clientId = 'cb281d918a37e346b45e9aea1c6eb7';
        $secret = 'a0f8a8b24de8b8182a0ddd2e89f5b1';
        $api->authorizedByClientIdAndSecret($clientId, $secret, 'advcampaigns banners websites');
        assertEquals('Y2IyODFkOTE4YTM3ZTM0NmI0NWU5YWVhMWM2ZWI3OmEwZjhhOGIyNGRlOGI4MTgyYTBkZGQyZTg5ZjViMQ==', $api->getBasicToken());
    }
}