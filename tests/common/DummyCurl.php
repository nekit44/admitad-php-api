<?php
declare(strict_types=1);

namespace tests\common;

use Curl\Curl;

class DummyCurl extends Curl
{

    /**
     * @param $url
     * @param $data
     * @param $follow_303_with_post
     * @return $this
     */
    public function post($url, $data = '', $follow_303_with_post = false): self
    {
        $this->response =  new \stdClass();
        return $this;
    }

}