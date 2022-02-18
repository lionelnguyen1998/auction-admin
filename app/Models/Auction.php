<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Auction extends Model
{
    use HasFactory;
    use SoftDeletes; 
    protected $table = 'auctions';
    protected $primaryKey = 'auction_id';

    protected $fillable = [
        'auction_id',
        'category_id',
        'title',
        'title_en',
        'description',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function auctionStatus()
    {
        return $this->hasOne(AuctionStatus::class, 'auction_id', 'auction_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'auction_id', 'auction_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class, 'auction_id', 'auction_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'auction_id', 'auction_id');
    }
}
