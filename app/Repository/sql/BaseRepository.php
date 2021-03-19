<?php   

namespace App\Repository\sql;   

use App\Repository\contracts\BaseRepositoryInterface; 

class BaseRepository implements BaseRepositoryInterface 
{     
    /**
    *
    * @return Collection
    */
    public function all($model)
    {
        return $model->all();
    }

    public function find($model, $id){
        return $model->find($id);
    }
}