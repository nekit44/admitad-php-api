<?php
declare(strict_types=1);

namespace tests\func\test;

use Nekit44\AdmitadPhpApi\Api;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    public function testDoesntExistClientId()
    {
        $api = new Api();
        $clientId = 'cb281d918a37e346b45e9aea1c6eb7';
        $secret = 'a0f8a8b24de8b8182a0ddd2e89f5b1';
        $this->expectExceptionMessage("Failed: client_id cb281d918a37e346b45e9aea1c6eb7 doesn't exist");
        $api->authorizedByClientIdAndSecret($clientId, $secret, 'advcampaigns banners websites');
    }

}