<?php

namespace App\Http\Services;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\Comment;
use App\Models\Item;
use App\Models\Category;
use App\Models\CategoryValue;
use App\Models\ItemValue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuctionAdminService implements AuctionAdminServiceInterface
{
    public function getListAuctions()
    {
        $auctions = Auction::with('category', 'users')
            ->get()
            ->toArray();

        return $auctions;
    }

    public function getDetailAuctions($auctionId)
    {
        $auctions = Auction::with('category', 'items', 'comments')
            ->where('auction_id', $auctionId)
            ->get()
            ->toArray();
        return $auctions;
    }

    public function getSellingUser($auctionId)
    {
        $userSelling = Auction::with('users')
            ->where('auction_id', $auctionId)
            ->get()
            ->toArray();
        return $userSelling;
    }

    public function getSellingUserItem($auctionId)
    {
        $userSelling = Item::with('users')
            ->where('auction_id', $auctionId)
            ->get()
            ->toArray();
        return $userSelling;
    }

    public function getMaxPrice($auctionId) 
    {
        $price = Bid::where('auction_id', $auctionId)
            ->max('price');
        return $price;
    }

    public function getBids($auctionId) 
    {
        $bids = Bid::with('users')
            ->where('auction_id', $auctionId)
            ->orderBy('updated_at', 'desc')
            ->get()
            ->toArray();
        return $bids;
    }

    public function getComments($auctionId) 
    {
        $comments = Comment::with('users')
            ->where('auction_id', $auctionId)
            ->orderBy('updated_at', 'desc')
            ->get()
            ->toArray();
        return $comments;
    }

    public function getInfor($auctionId)
    {
        $categoryId = Auction::findOrFail($auctionId)->category_id;

        $itemId = Item::where('auction_id', $auctionId)
            ->where('category_id', $categoryId)
            ->get()
            ->pluck('item_id');    
     
        $itemInfor = ItemValue::where('item_id', $itemId)
            ->get()
            ->pluck('value', 'category_value_id')
            ->toArray();

        return $itemInfor;
    }

    public function getCategoryValueName($auctionId)
    {
        $categoryId = Auction::findOrFail($auctionId)->category_id;

        $categoryValue = CategoryValue::where('category_id', $categoryId)
            ->get()
            ->pluck('name', 'category_value_id')
            ->toArray();

        return $categoryValue;
    }

    //general auction
    public function getGeneralInfo()
    {
        $countAuction = Auction::count('auction_id');

        $status1 = Auction::where('status', 1)
            ->count('auction_id');
        $status2 = Auction::where('status', 2)
            ->count('auction_id');
        $status4 = Auction::where('status', 4)
            ->count('auction_id');

        $auctionInfo = [
            'all' => $countAuction,
            'status1' => $status1,
            'status2' => $status2,
            'status4' => $status4
        ];

        return $auctionInfo;
    }
}
