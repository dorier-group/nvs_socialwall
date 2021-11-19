<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryDetails extends Model
{
    protected $table = 'category_details';

  
    protected $fillable = ['p_id','message','file','type','created_at','updated_at'];

    protected  $primaryKey = 'id';

}

?>

