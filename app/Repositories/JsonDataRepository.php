<?php

namespace App\Repositories;
use App\Models\JsonData;
use App\Repositories\Interfaces\JsonDataRepositoryInterface;

class JsonDataRepository implements JsonDataRepositoryInterface
{
    public function allJsonData()
    {
        return current_user()->jsonData()->paginate(5);
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
        $jsonData->data = $data['data'];
        $jsonData->save();
    }

    public function destroyJsonData($code)
    {
        $jsonData = current_user()->jsonData()->where(['code' => $code])->first();
        $jsonData->delete();
    }
}