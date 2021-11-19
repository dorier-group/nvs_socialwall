<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    protected $table = 'parent_ring';

  
    protected $fillable = ['groups'];

    protected  $primaryKey = 'id';

}

?>
