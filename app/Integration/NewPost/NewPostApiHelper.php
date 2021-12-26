<?php

declare(strict_types=1);

namespace App\Integration\NewPost;

use GuzzleHttp\Utils;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NewPostApiHelper
{
    private const BASE_API_URL = 'https://api.novaposhta.ua/v2.0/json/';

    /**
     * @see https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/556d9130a0fe4f08e8f7ce48/console
     */
    public function getAreas(): Collection
    {
        try {
            $response = Http::post(self::BASE_API_URL.'Address/getAreas', [
                'apiKey' => Config::get('NEW_POST_API_KEY'),
                'modelName' => 'Address',
                'calledMethod' => 'getAreas',
            ]);
            return new Collection(Utils::jsonDecode($response->body(), true)['data'] ?? []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return Collection::empty();
    }

    /**
     * @see https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/556d885da0fe4f08e8f7ce46
     */
    public function getCities(): Collection
    {
        try {
            $response = Http::post(self::BASE_API_URL.'Address/getCities', [
                'apiKey' => Config::get('NEW_POST_API_KEY'),
                'modelName' => 'Address',
                'calledMethod' => 'getCities',
            ]);
            return new Collection(Utils::jsonDecode($response->body(), true)['data'] ?? []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return Collection::empty();
    }

    /**
     * @see https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/556d8211a0fe4f08e8f7ce45
     */
    public function getWarehouses(): Collection
    {
        try {
            $response = Http::post(self::BASE_API_URL.'Address/getWarehouses', [
                'apiKey' => Config::get('NEW_POST_API_KEY'),
                'modelName' => 'Address',
                'calledMethod' => 'getWarehouses',
            ]);
            return new Collection(Utils::jsonDecode($response->body(), true)['data'] ?? []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return Collection::empty();
    }

    /**
     * @see https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/556d8211a0fe4f08e8f7ce45
     */
    public function getWarehousesTypes(): Collection
    {
        try {
            $response = Http::post(self::BASE_API_URL.'Address/getWarehouseTypes', [
                'apiKey' => Config::get('NEW_POST_API_KEY'),
                'modelName' => 'Address',
                'calledMethod' => 'getWarehouseTypes',
            ]);
            return new Collection(Utils::jsonDecode($response->body(), true)['data'] ?? []);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return Collection::empty();
    }
}
