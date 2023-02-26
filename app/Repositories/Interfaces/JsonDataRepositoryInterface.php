<?php

namespace App\Repositories\Interfaces;


Interface  JsonDataRepositoryInterface
{
    public function allJsonData();
    public function storeJsonData($data);
    public function findJsonData($code);
    public function updateJsonData($data, $code);
    public function destroyJsonData($code);
}