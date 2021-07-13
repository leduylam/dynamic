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
}
