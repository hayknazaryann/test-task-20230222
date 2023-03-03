<?php

namespace App\Repositories;
use App\Models\JsonData;
use App\Repositories\Interfaces\JsonDataRepositoryInterface;

class JsonDataRepository implements JsonDataRepositoryInterface
{
    public function allJsonData()
    {
        return current_user()->jsonData()->paginate(10);
    }

    public function storeJsonData($data)
    {
        return current_user()->jsonData()->create($data);
    }

    public function findJsonData($code)
    {
        return JsonData::find($code);
    }

    public function updateJsonData($data, $code)
    {
        $jsonData = current_user()->jsonData()->where(['code' => $code])->first();
        if ($jsonData) {
            $jsonData->data = $data['data'];
            return $jsonData->save();
        }
        return false;
    }

    public function destroyJsonData($code)
    {
        $jsonData = current_user()->jsonData()->where(['code' => $code])->first();
        $jsonData->delete();
    }
}