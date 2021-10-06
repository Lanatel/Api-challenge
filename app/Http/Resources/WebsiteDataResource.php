<?php

namespace App\Http\Resources;

use App\Modules\WebsiteData\WebsiteData;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property WebsiteData $resource */
class WebsiteDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->resource->getName(),
            'trustFlowScore' => $this->resource->getTrustFlowScore(),
        ];
    }
}
