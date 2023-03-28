<?php
declare(strict_types=1);

namespace Nekit44\AdmitadPhpApi\Methods;

use Nekit44\AdmitadPhpApi\Api;

abstract class BaseMethod
{
    public function __construct(protected Api $api)
    {
    }
}