<?php

namespace App\Modules\WebsiteData\Storages;

use Illuminate\Support\Collection;

interface WebsiteDataStorage
{
    /**
     * Get Collection of objects with websites data from the storage.
     *
     * @return Collection
     */
    public function get(): Collection;

    /**
     * Call website data provider to refresh data and store it to the storage.
     *
     * @return bool
     */
    public function update(): bool;
}
