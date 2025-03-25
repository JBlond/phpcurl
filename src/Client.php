<?php

namespace jblond\phpcurl;

use CurlHandle;

/**
 *
 */
class Client
{
    /**
     * @var false|CurlHandle
     */
    protected false|CurlHandle $curl;

    protected array $curlOptions = [
        CURLOPT_HEADER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_CONNECTTIMEOUT => 0,
        CURLOPT_TIMEOUT => 600,
    ];

    /**
     * Client constructor.
     */
    public function __construct($curlOptions = "")
    {
        if (!empty($curlOptions)) {
            $this->setCurlOptions(array $curlOptions);
        }
        $this->curl = curl_init();
        curl_setopt_array(
            $this->curl,
            $this->getCurlOptions
        );
    }

    /**
     * @return bool|string|array
     */
    protected function sendRequest(): bool|string|array
    {
        $response = curl_exec($this->curl);
        if ($response === false) {
            $response = [
                'message' => curl_error($this->curl),
                'number' => curl_errno($this->curl)
            ];
        }
        curl_close($this->curl);
        return $response;
    }

    /**
     * @param string $url
     * @return bool|string|array
     */
    public function get(string $url): bool|string|array
    {
        curl_setopt_array(
            $this->curl,
            [
                CURLOPT_URL => $url,
            ]
        );
        return $this->sendRequest();
    }

    /**
     * @param $data
     * @return bool|string
     */
    public function post($url, $data): bool|string
    {
        curl_setopt_array(
            $this->curl,
            [
                CURLOPT_URL => $url,
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_POST => true
            ]
        );
        return $this->sendRequest();
    }

    /**
    * @param array $curlOptions
    */
    public function setCurlOptions(array $curlOptions): void
    {
        $this->curlOptions = $curlOptions;
    }

	/**
    * @return array $curlOptions
    */
    protected function getCurlOptions(): array
    {
        return $this->curlOptions; 
    }
}
