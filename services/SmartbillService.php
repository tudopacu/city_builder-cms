<?php

namespace app\services;

use yii\base\Component;
use Yii;

/**
 * SmartbillService handles communication with the Smartbill invoicing API.
 *
 * Configuration example in params.php:
 * 'smartbill' => [
 *     'username' => 'your-smartbill-email@example.com',
 *     'token'    => 'your-smartbill-api-token',
 *     'cif'      => 'RO12345678',
 *     'series'   => 'FCMS',
 * ],
 */
class SmartbillService extends Component
{
    const API_BASE_URL = 'https://ws.smartbill.ro/SBORO/api';

    /** @var string Smartbill account email (username) */
    public $username;

    /** @var string Smartbill API token */
    public $token;

    /** @var string Company fiscal code (CIF) */
    public $cif;

    /** @var string Default invoice series */
    public $series = 'FCMS';

    /**
     * Issues an invoice via the Smartbill API.
     *
     * @param array $data Invoice data including:
     *   - client: array with 'name', 'email', 'address' keys
     *   - products: array of product lines, each with 'name', 'quantity', 'price', 'vatName'
     *   - description: optional invoice description
     *   - currency: optional currency code (default RON)
     *
     * @return array|null Parsed response from Smartbill API, or null on failure
     */
    public function issueInvoice(array $data)
    {
        $payload = [
            'companyVatCode' => $this->cif,
            'client' => $data['client'],
            'issueDate' => date('Y-m-d'),
            'seriesName' => $this->series,
            'currency' => $data['currency'] ?? 'RON',
            'language' => 'RO',
            'precision' => 2,
            'products' => $data['products'],
        ];

        if (!empty($data['description'])) {
            $payload['mentions'] = $data['description'];
        }

        return $this->request('POST', '/invoice', $payload);
    }

    /**
     * Retrieves invoice details from the Smartbill API.
     *
     * @param string $series Invoice series
     * @param string $number Invoice number
     *
     * @return array|null Parsed response from Smartbill API, or null on failure
     */
    public function getInvoice($series, $number)
    {
        return $this->request('GET', '/invoice', null, [
            'cif'        => $this->cif,
            'seriesname' => $series,
            'number'     => $number,
        ]);
    }

    /**
     * Cancels an existing invoice via the Smartbill API.
     *
     * @param string $series Invoice series
     * @param string $number Invoice number
     *
     * @return array|null Parsed response from Smartbill API, or null on failure
     */
    public function cancelInvoice($series, $number)
    {
        return $this->request('PUT', '/invoice/cancel', null, [
            'cif'        => $this->cif,
            'seriesname' => $series,
            'number'     => $number,
        ]);
    }

    /**
     * Executes an HTTP request to the Smartbill API.
     *
     * @param string     $method   HTTP method (GET, POST, PUT, DELETE)
     * @param string     $endpoint API endpoint path
     * @param array|null $body     Request body for POST/PUT requests
     * @param array      $query    Query string parameters
     *
     * @return array|null Decoded JSON response, or null on error
     */
    protected function request($method, $endpoint, $body = null, $query = [])
    {
        $url = self::API_BASE_URL . $endpoint;
        if (!empty($query)) {
            $url .= '?' . http_build_query($query);
        }

        $credentials = base64_encode($this->username . ':' . $this->token);

        $headers = [
            'Authorization: Basic ' . $credentials,
            'Content-Type: application/json',
            'Accept: application/json',
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

        if ($body !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error    = curl_error($ch);
        curl_close($ch);

        if ($error) {
            Yii::error('Smartbill API cURL error: ' . $error, __METHOD__);
            return null;
        }

        $decoded = json_decode($response, true);

        if ($httpCode < 200 || $httpCode >= 300) {
            Yii::error(
                'Smartbill API error ' . $httpCode . ': ' . $response,
                __METHOD__
            );
            return null;
        }

        return $decoded;
    }
}
