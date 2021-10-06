<?php

namespace App\Modules\WebsiteData\Providers;

use App\Modules\WebsiteData\WebsiteData;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

abstract class WebsiteDataProvider
{
    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * List of website we need to get data for.
     * @var array
     */
    protected array $websites = [];

    /**
     * AbstractProvider constructor.
     */
    public function __construct()
    {
        $this->websites = config('websites');
    }

    /**
     * Url to get data from an api provider.
     *
     * @return string
     */
    abstract protected function getDataUrl(): string;

    /**
     * List of get parameters have to be provided to get response.
     *
     * @return array
     */
    abstract protected function getDataFields(): array;

    /**
     * @param array $response
     * @return Collection
     */
    abstract protected function mapResponseToCollection(array $response): Collection;

    /**
     * Get a instance of the Guzzle HTTP client.
     *
     * @return Client
     */
    protected function getHttpClient(): Client
    {
        if (is_null($this->httpClient)) {
            $this->httpClient = new Client();
        }

        return $this->httpClient;
    }

    /**
     * @return array
     * @throws GuzzleException
     */
    public function getWebsiteDataResponse(): array
    {
        $response = $this->getHttpClient()->get($this->getDataUrl(), [
            'query' => $this->getDataFields()
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * @return Collection
     * @throws GuzzleException
     */
    public function data(): Collection
    {
        return $this->mapResponseToCollection(
            $this->getWebsiteDataResponse()
        );
    }
}
