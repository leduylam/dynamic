<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'categories';
    /**
     * @var array
     */
    protected $fillable = ['sku', 'name', 'parent_id_1', 'parent_id_2', 'image', 'description', 'status'];

    public function parentId1(){
        return $this->hasMany('App\Models\Category', 'parent_id_1');
    }

    public static function categoryDetail($name){
        $categoryDetail = Category::select('id', 'name')->with(['parentId1' => function($query){
            $query->select('id','parent_id_1', 'parent_id_2');
        }])->where('name', $name)->first()->toArray();
        // dd($categoryDetail); die;
        $catIds = array();
        $catIds[] = $categoryDetail['id'];
        foreach($categoryDetail['parent_id1'] as $index => $parent_id1){
            $catIds[] = $parent_id1['id'];
        }
        // dd($catIds); die;
        return array('catIds' => $catIds, 'categoryDetail' => $categoryDetail);
    }
}
