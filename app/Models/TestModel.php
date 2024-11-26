<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    //

    static public function test(){
        return self::find();
    }
    static public function test2(){
        return self::find();
    }
}
