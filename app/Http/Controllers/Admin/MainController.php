<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\AuctionAdminService;
use App\Models\Auction;

class MainController extends Controller
{
    protected $auctionService;
    public function __construct(AuctionAdminService $auctionService)
    {
        $this->auctionService = $auctionService;
    }

    public function index() 
    {
        $auction = Auction::get()
            ->toArray();
        if ($auction) {
            $auctions = Auction::where('auction_id', '<>', 3)
                ->get();
        
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
                    $auction->reason = 'Đã quá thời gian duyệt';
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
        }
        
        return view('admin.home', [
            'title' => 'ホームページ',
            'general' => $this->auctionService->getGeneralInfo()
        ]);
    }
}
