<?php
declare(strict_types=1);

namespace Nekit44\AdmitadPhpApi;

use Curl\Curl;
use Nekit44\AdmitadPhpApi\Constants\Method;
use Nekit44\AdmitadPhpApi\Exception\ApiException;
use Nekit44\AdmitadPhpApi\Exception\NotFoundException;
use stdClass;


class Api
{
    const HOST = 'https://api.admitad.com';
    private ?string $accessToken;
    private Curl $curl;
    private ?string $basicToken;


    /**
     * @param ?string $accessToken
     */
    public function __construct(string $accessToken = null, $curl = new Curl())
    {
        $this->accessToken = $accessToken;
        $this->curl = $curl;
        $this->curl->setHeader('Host', 'api.admitad.com');
    }

    /**
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    /**
     * @return string|null
     */
    public function getBasicToken(): ?string
    {
        return $this->basicToken;
    }

    /**
     * @param string $base64_encode
     * @return $this
     */
    public function setBasicToken(string $base64_encode): self
    {
        $this->basicToken = $base64_encode;
        return $this;
    }

    /**
     * @param string $accessToken
     * @return $this
     */
    public function setAccessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @param string $language
     * @return $this
     */
    public function setLanguage(string $language): self
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @param string $clientId
     * @param string $scope
     * @return stdClass
     * @throws ApiException
     */
    public function authorizedByBasicToken(string $clientId, string $scope): stdClass
    {
        $this->curl->setHeader('Authorization', "Basic {$this->getBasicToken()}");
        return $this->authorized($clientId, $scope);
    }

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $scope
     * @return stdClass
     * @throws ApiException
     */
    public function authorizedByClientIdAndSecret(string $clientId, string $clientSecret, string $scope): stdClass
    {
        $this->setBasicToken(base64_encode("$clientId:$clientSecret"));
        $this->curl->setHeader('Authorization', "Basic {$this->getBasicToken()}");
        return $this->authorized($clientId, $scope);
    }


    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $refreshToken
     * @return stdClass
     * @throws ApiException
     */
    public function refreshToken(string $clientId, string $clientSecret, string $refreshToken): stdClass
    {
        $this->curl->setHeader('Content-Type', 'application/x-www-form-urlencoded;charset=UTF-8');
        return $this->send($this->curl, Method::POST, '/token/', [
            'grant_type' => 'refresh_token',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'refresh_token' => $refreshToken,
        ]);
    }

    /**
     * @param string $url
     * @param string $method
     * @param int $limit
     * @param int $offset
     * @param array $params
     * @return mixed
     * @throws ApiException
     */
    public function methods(string $url, string $method, int $limit = 5, int $offset = 0, array $params = []): mixed
    {
        $this->curl->setHeader('Authorization', "Bearer {$this->getAccessToken()}");
        $requestDataDefault = [
            'limit' => $limit,
            'offset' => $offset
        ];
        $requestData = array_merge($requestDataDefault, $params);
        return $this->send($this->curl, $method, $url, $requestData);
    }

    /**
     * @param Curl $curl
     * @param string $method
     * @param string $url
     * @param array $data
     * @return mixed|null
     * @throws ApiException
     */
    private function send(Curl $curl, string $method, string $url, array $data): mixed
    {
        $curl->{$method}(self::HOST . $url, $data);
        if (!$curl->error) {
            return $curl->response;
        }
        if ($curl->httpStatusCode == 404) throw new NotFoundException('Not found 404');
        throw new ApiException('Failed: ' . $curl?->response?->error_description ?? $curl->httpStatusCode . ' response code');
    }

    /**
     * @param string $clientId
     * @param string $scope
     * @return mixed|null
     * @throws ApiException
     */
    private function authorized(string $clientId, string $scope): mixed
    {
        $this->curl->setHeader('Content-Type', 'application/x-www-form-urlencoded;charset=UTF-8');
        return $this->send($this->curl, Method::POST, '/token/', [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'scope' => $scope,
        ]);
    }
}