<?php
declare(strict_types=1);

namespace Nekit44\AdmitadPhpApi\Methods;

use Nekit44\AdmitadPhpApi\Constants\Method as MethodConst;

class Method extends BaseMethod
{
    public function get(string $url, int $limit = 5, int $offset = 0, array $params = [])
    {
        return $this->api->methods($url, MethodConst::GET, $limit, $offset, $params);
    }

    public function post(string $url, array $params)
    {
        return $this->api->methods(url: $url, method: MethodConst::POST, params: $params);
    }
}