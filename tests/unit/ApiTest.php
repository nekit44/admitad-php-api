<?php
declare(strict_types=1);

namespace func\unit;

use Nekit44\AdmitadPhpApi\Api;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{

    public function testToken()
    {
        $api = new Api('Y2IyODFkOTE4YTM3ZTM0NmI0NWU5YWVhMWM2ZWI3O4443hhOGIyNGRlOGI4MTgyYTBkZGQyZTg5ZjViMQ==');
        self::assertEquals(
            'Y2IyODFkOTE4YTM3ZTM0NmI0NWU5YWVhMWM2ZWI3O4443hhOGIyNGRlOGI4MTgyYTBkZGQyZTg5ZjViMQ==',
            $api->getAccessToken()
        );
    }
}