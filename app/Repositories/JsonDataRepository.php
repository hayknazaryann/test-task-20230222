<?php

namespace App\Repositories;
use App\Models\JsonData;
use App\Repositories\Interfaces\JsonDataRepositoryInterface;

class JsonDataRepository implements JsonDataRepositoryInterface
{
    public function allJsonData()
    {
        return current_user()->jsonData()->paginate(2);
    }

    public function storeJsonData($data)
    {
        return current_user()->jsonData()->create($data);
    }

    public function findJsonData($uuid)
    {
        return JsonData::find($uuid);
    }

    public function updateJsonData($code, $uuid)
    {
        $jsonData = current_user()->jsonData()->where(['uuid' => $uuid])->first();
        if ($jsonData) {
            $data = $jsonData->data;
            eval($code);
            $jsonData->data = $data;
            return $jsonData->save();
        }
        return false;
    }

    public function destroyJsonData($uuid)
    {
        $jsonData = current_user()->jsonData()->where(['uuid' => $uuid])->first();
        $jsonData->delete();
    }
}