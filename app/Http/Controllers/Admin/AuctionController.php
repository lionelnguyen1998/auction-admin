<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\AuctionAdminService;
use App\Http\Services\ItemAdminService;
use App\Models\Auction;
use App\Models\Item;
use App\Models\Image;
use App\Models\Bid;
use App\Models\Comment;
use App\Models\ItemValue;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuctionController extends Controller
{
    protected $auctionService, $itemService;

    public function __construct(AuctionAdminService $auctionService, ItemAdminService $itemService)
    {
        $this->auctionService = $auctionService;
        $this->itemService = $itemService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.auctions.list', [
            'title' => 'オークション一覧',
            'auctions' => $this->auctionService->getListAuctions()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($auctionId)
    {
        $itemId = Item::where('auction_id', $auctionId)
            ->get()
            ->pluck('item_id');

        $status = Auction::findOrFail($auctionId)->status;
        if ($status == 6) {
            $buy = $this->auctionService->getBuyInfo($auctionId);
        }
        return view('admin.auctions.view', [
            'title' => 'オークション詳細',
            'auction' => $this->auctionService->getDetailAuctions($auctionId),
            'maxPrice' => $this->auctionService->getMaxPrice($auctionId),
            'bids' => $this->auctionService->getBids($auctionId),
            'userSelling' => $this->auctionService->getSellingUserItem($auctionId),
            'comments' => $this->auctionService->getComments($auctionId),
            'item' => $this->itemService->getItem($itemId),
            'images' => $this->itemService->getImageLists($itemId),
            'buyInfo' => $buy ?? null,
        ]);
    }


    // duyet auctions
    public function list()
    {
        return view('admin.auctions.wait', [
            'title' => 'オークション評価',
            'auctions' => $this->auctionService->getListAuctions()
        ]);
    }

    //view autions wait ( xem thông tin auction cần phê duyệt)
    public function viewAuctionWait($auctionId)
    {
        $itemId = Item::where('auction_id', $auctionId)
            ->get()
            ->pluck('item_id');

        if (isset($itemId[0])) {
            return view('admin.auctions.viewAuctionWait', [
                'title' => 'オークション詳細',
                'auction' => $this->auctionService->getDetailAuctions($auctionId),
                'userSelling' => $this->auctionService->getSellingUser($auctionId),
                'item' => $this->itemService->getItem($itemId),
                'images' => $this->itemService->getImageLists($itemId),
            ]);
        } else {
            return view('admin.auctions.viewAuctionWait', [
                'title' => 'オークション詳細',
                'auction' => $this->auctionService->getDetailAuctions($auctionId),
                'userSelling' => $this->auctionService->getSellingUser($auctionId),
            ]);
        }
    }

    //accept auction
    public function accept($auctionId)
    {
        $auction = Auction::findOrFail($auctionId);
        $startDate = $auction->start_date;
        $auctionStatus = $auction->status;
        if ($auction) {
            $auction->status = 2;
            $auction->update();
        }
        return redirect()->route('listAuctions');
    }

    //delete auctions
    public function destroy($auctionId)
    {
        $itemId = Item::where('auction_id', '=', $auctionId)
            ->get()
            ->pluck('item_id')
            ->toArray();

        Item::where('item_id', '=', $itemId[0])->delete();
        Bid::where('auction_id', '=', $auctionId)->delete();
        Comment::where('auction_id', '=', $auctionId)->delete();
        Favorite::where('auction_id', '=', $auctionId)->delete();
        Auction::find($auctionId)->delete();

        return redirect()->route('listAuctions')->with('message', '削除しました！');
    }

    //reject auctions
    public function reject(Request $request)
    {
        $auctionId = $request->auction_id;
        $auction = Auction::findOrFail($auctionId);
        $itemId = Item::where('auction_id', '=', $auctionId)
            ->get()
            ->pluck('item_id')
            ->toArray();
       
        $reason = $request->reason;

        if ($reason == null) {
            return redirect()->back()->with('warning', '理由を入力しませんでした！');
        } else {
            $auction->reason = $reason;
            $auction->update();
        }

        $status = $auction->status;
        
        if ($auction) {
            $auction->status = 5;
            $auction->update();

            if (isset($itemId[0])) {
                Image::where('item_id', '=', $itemId[0])->delete();
                Item::where('item_id', '=', $itemId[0])->delete();
            }

            Auction::findOrFail($auctionId)->delete();
        }

        return redirect()->route('listAuctionsIsWait')->with('message', '削除しました！');
    }
}
