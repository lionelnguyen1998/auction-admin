<?php

namespace App\Http\Services;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\Comment;
use App\Models\Item;
use App\Models\Brand;
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
            ->orderBy('price', 'DESC')
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

        $item = Item::where('auction_id', $auctionId)
            ->get()
            ->firstOrFail();

            dd($item);

        return $item;
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

    // thông tin của phiên đấu giá thành công
    public function getBuyInfo($auctionId)
    {
        $maxPrice = $this->getMaxPrice($auctionId);
        $item = Item::where('auction_id', $auctionId)
            ->get()
            ->firstOrFail();

        $userBuyingId = Item::where('auction_id', $auctionId)
            ->pluck('buying_user_id')
            ->first();

        $userSelingId = Auction::findOrFail($auctionId)->selling_user_id;

        $itemInfo = Item::with('userBuying')
            ->where('auction_id', $auctionId)
            ->where('buying_user_id', $userBuyingId)
            ->get()
            ->first();
            
        $sellingInfo = Auction::with('users')
            ->where('auction_id', $auctionId)
            ->where('selling_user_id', $userSelingId)
            ->get()
            ->first();

        $brand = Brand::where('brand_id', $item->brand_id)
            ->get()
            ->pluck('name')
            ->firstOrFail();

        return [
            'item_info' => [
                'name' => $itemInfo->name,
                'selling_user' => [
                    'name' => $sellingInfo->users->name,
                    'email' => $sellingInfo->users->email,
                    'adress' => $sellingInfo->users->adress,
                    'phone' => $sellingInfo->users->phone
                ],
                'buying_user' => [
                    'name' => $itemInfo->userBuying->name,
                    'email' => $itemInfo->userBuying->email,
                    'address' => $itemInfo->userBuying->address,
                    'phone' => $itemInfo->userBuying->phone
                ],
                'brand' => $brand,
                'series' => $itemInfo->series,
                'starting_price' => $itemInfo->starting_price,
                'max_price' => $maxPrice,
                'selling_info' => $itemInfo->selling_info,
            ]
        ];
    }
}
