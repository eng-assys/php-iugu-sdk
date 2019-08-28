<?php

namespace Iugu\Request;

use Iugu\Environment;
use Iugu\Request\Exceptions\IuguRequestException;
use Iugu\Request\Exceptions\IuguUnprocessableEntityException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;

abstract class AbstractRequest
{

    protected $environment;

    /**
     * AbstractRequest constructor.
     *
     * @param Environment $environment
     */
    public function __construct(Environment $environment = null)
    {
        $this->environment = $environment;
    }

    private function send($url, $method, $body, $query, $unserialize)
    {
        $options = [];

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->handleAuthorization()
        ];

        $request_params = [
            'headers' => $headers,
            'json' => $this->removeEmptyKeys($body),
            'query' => $query
        ];

        $request_params = array_filter($request_params);

        $guzzle_client = new GuzzleClient($options);

        $exceptionMessage = null;

        try {
            $callback = $guzzle_client->request($method, $url, $request_params);
            $jsonBody = $callback->getBody();
            $statusCode = $callback->getStatusCode();
        } catch (RequestException | ServerException $ex) {
            $jsonBody = $ex->getResponse()->getBody();
            $exceptionMessage = $ex->getMessage();
            $statusCode = $ex->getResponse()->getStatusCode();
        }

        return $this->readResponse($statusCode, $jsonBody, $exceptionMessage, $unserialize);
    }

    /**
     * @param $method
     * @param $url
     * @param \JsonSerializable|null $content
     *
     * @return mixed
     *
     * @throws \Iugu\Request\IuguRequestException
     * @throws \RuntimeException
     */
    protected function sendRequest($method, $url, \JsonSerializable $content = null, $unserialize = true)
    {
        return $this->send($url, $method, json_encode($content), null, $unserialize);
    }

    public function get($url, $query = [], $unserialize = true)
    {
        return $this->send($url, 'GET', null, $query, $unserialize);
    }

    public function post($url, $body = [], $query = [], $unserialize = true)
    {
        return $this->send($url, 'POST', $body, $query, $unserialize);
    }

    public function put($url, $body = [], $query = [], $unserialize = true)
    {
        return $this->send($url, 'PUT', $body, $query, $unserialize);
    }

    public function delete($url, $body = [], $query = [], $unserialize = true)
    {
        return $this->send($url, 'DELETE', $body, $query, $unserialize);
    }

    /**
     * @param $statusCode
     * @param $responseBody
     * @param $exceptionMessage
     *
     * @return mixed
     *
     * @throws IuguRequestException
     * @throws IuguUnprocessableEntityException
     */
    protected function readResponse($statusCode, $responseBody, $exceptionMessage, $unserialize)
    {
        switch ($statusCode) {
            case 200:
            case 201:
                $decodedResponse = json_decode($responseBody);
                return (!empty($decodedResponse) && $unserialize) ?
                    $this->unserialize($responseBody) : $decodedResponse;
            case 400:
                $exception = new IuguRequestException('Request Error', $statusCode);
                $exception->setIuguError($responseBody);
                throw $exception;
            case 404:
                $exception = new IuguRequestException('Resource not found', $statusCode);
                $exception->setIuguError($responseBody);
                throw $exception;
            case 422:
                $exception = new IuguUnprocessableEntityException($exceptionMessage, $statusCode);
                $exception->setIuguError($responseBody);
                throw $exception;
            default:
                $exceptionMessage = empty($exceptionMessage) ? 'Unknown status' : $exceptionMessage;
                throw new IuguRequestException($exceptionMessage, $statusCode);
        }
    }

    private function handleAuthorization()
    {
        return 'Basic ' . base64_encode("{$this->environment->getApiToken()}:");
    }

    private function removeEmptyKeys($data)
    {
        $data = !is_array($data) ? json_decode($data, true) : $data;
        if (!$data) return [];
        foreach ($data as $key => $value) {
            if (gettype($data[$key]) == 'array') {
                $data[$key] = $this->removeEmptyKeys($data[$key]);
            } else if ($value == null) {
                unset($data[$key]);
            }
        }
        return $data;
    }

    /**
     * 
     * @return mixed
     */
    public abstract function execute();

    /**
     * @param $json
     *
     * @return mixed
     */
    protected abstract function unserialize($json);
}
