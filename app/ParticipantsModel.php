<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParticipantsModel extends Model
{
    protected $table = 'participants';

  
    protected $fillable = ['groups','participants_name'];

    protected  $primaryKey = 'id';

}

?>



