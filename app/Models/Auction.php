<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Models\AuctionStatus;

class Auction extends Model
{
    use HasFactory;
    use SoftDeletes; 
    protected $table = 'auctions';
    protected $primaryKey = 'auction_id';

    protected $fillable = [
        'auction_id',
        'category_id',
        'selling_user_id',
        'item_id',
        'title',
        'start_date',
        'end_date',
        'status',
        'reason',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'selling_user_id', 'user_id');
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

    public function updateStatus($auctionId)
    {
        $auctions = Auction::findOrFail($auctionId);
        
        foreach ($auctions as $key => $value) {
            $auction = Auction::findOrFail($value->auction_id);
            if ($auction && ($value->status != 4) && ($value->status != 6)) {
                if ($value->start_date <= now() && $value->end_date > now()) {
                    $auction->status = 1;
                    $auction->update();
                } elseif ($value->end_date <= now()) {
                    $auction->status = 3;
                    $auction->update();
                } else {
                    $auction->status = 2;
                    $auction->update();
                }
            }
                
            if (($value->status == 4) && ($value->end_date < now())) {
                $auction->status = 5;
                $auction->reason = 'Da qua thoi gian';
                $auction->update();

                $itemId = Item::where('auction_id', '=', $value->auction_id)
                    ->get()
                    ->pluck('item_id')
                    ->toArray();

                if (isset($itemId[0])) {
                    Image::where('item_id', '=', $itemId[0])->delete();
                    Item::where('item_id', '=', $itemId[0])->delete();
                }
    
                Auction::findOrFail($value->auction_id)->delete();
            }
        }
        
        return true;
    }
}
