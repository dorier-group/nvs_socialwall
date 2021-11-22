<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplyModel extends Model
{
    protected $table = 'reply_entry';

  
    protected $fillable = ['frm_id','message','created_at','updated_at'];

    protected  $primaryKey = 'id';

}

?>


