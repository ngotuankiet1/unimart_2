<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_cats extends Model
{
    //
    protected $fillable = [
        'name', 'parent_cat'
    ];

    public static function data_tree($data, $parent_cat = 0, $lever = 1, &$result)
    {
        if(count($data) > 0){
            foreach($data as $item){
                if($item->parent_cat == $parent_cat){
                    $item->lever = $lever;
                    $result[] = $item;
                    $parent = $item->id;
                    self::data_tree($data,$parent,$lever+1,$result);
                }
            }
        }
    }
}
