<?php
namespace App\Repository\contracts;


/**
* Interface BaseRepositoryInterface
* @package App\Repository\contracts
*/
interface BaseRepositoryInterface
{

   public function all($model);

   public function find($model, $id);
}