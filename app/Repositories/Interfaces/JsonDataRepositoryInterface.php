<?php

namespace App\Repositories\Interfaces;


Interface  JsonDataRepositoryInterface
{
    public function allJsonData();
    public function storeJsonData($data);
    public function findJsonData($uuid);
    public function updateJsonData($code, $uuid);
    public function destroyJsonData($uuid);
}