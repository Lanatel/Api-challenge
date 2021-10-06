<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Resources\WebsiteDataResource;
use App\Modules\WebsiteData\Storages\WebsiteDataStorage;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WebsiteDataController extends Controller
{
    protected WebsiteDataStorage $data;

    /**
     * WebsiteScoreController constructor.
     * @param $data
     */
    public function __construct(WebsiteDataStorage $data)
    {
        $this->data = $data;
    }

    public function index(): AnonymousResourceCollection
    {
        return WebsiteDataResource::collection($this->data->get());
    }

    public function update(): JsonResponse
    {
        $this->data->update();

        return response()->json();
    }
}
