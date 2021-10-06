<?php

namespace App\Modules\WebsiteData\Providers;

use App\Modules\WebsiteData\WebsiteData;
use Illuminate\Support\Collection;

class MajesticProvider extends WebsiteDataProvider
{
    /**
     * @return string
     */
    protected function getDataUrl(): string
    {
        return 'https://api.majestic.com/api/json';
    }

    /**
     * @return array
     */
    protected function getDataFields(): array
    {
        $items = [];

        for ($i = 0; $i < count($this->websites); $i++) {
            $items["item$i"] = $this->websites[$i];
        }

        return array_merge([
            'app_api_key' => config('services.majestic.key'),
            'cmd' => 'GetIndexItemInfo',
            'items' => count($this->websites),
            'datasource' => 'fresh'
        ], $items);
    }

    /**
     * @param array $response
     * @return Collection
     */
    protected function mapResponseToCollection(array $response): Collection
    {
        if (!isset($response['DataTables']['Results']['Data'])) {
            return collect();
        }

        $scores = [];

        foreach ($response['DataTables']['Results']['Data'] as $data) {
            if (isset($data['ResultCode']) && $data['ResultCode'] === 'OK') {
                $websiteScore = new WebsiteData();
                $websiteScore->setName($data['Item']);
                $websiteScore->setTrustFlowScore($data['TrustFlow']);
                $scores[] = $websiteScore;
            }
        }

        return collect($scores);
    }
}
