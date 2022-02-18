<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'categories';
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_id',
        'name',
        'name_en',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function auction()
    {
        return $this->hasMany(Auction::class, 'category_id', 'category_id');
    }

    public function categoryValues()
    {
        return $this->hasMany(CategoryValue::class, 'category_id', 'category_id');
    }
}