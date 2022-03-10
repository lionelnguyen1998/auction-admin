<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\AuctionAdminService;
use App\Http\Services\ItemAdminService;
use App\Models\Auction;
use App\Models\Item;
use App\Models\ItemValue;
use App\Models\AuctionStatus;
use App\Models\AuctionDeny;
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

        return view('admin.auctions.view', [
            'title' => 'オークション詳細',
            'auction' => $this->auctionService->getDetailAuctions($auctionId),
            'maxPrice' => $this->auctionService->getMaxPrice($auctionId),
            'bids' => $this->auctionService->getBids($auctionId),
            'userSelling' => $this->auctionService->getSellingUser($auctionId),
            'comments' => $this->auctionService->getComments($auctionId),
            'infors' => $this->auctionService->getInfor($auctionId),
            'categoryValueName' => $this->auctionService->getCategoryValueName($auctionId),
            'images' => $this->itemService->getImageLists($itemId)
        ]);
    }


    // duyet auctions
    public function list()
    {
        return view('admin.auctions.wait', [
            'title' => 'オークション評価',
            'auctions' => $this->auctionService->getListAuctionsWait()
        ]);
    }

    //view autions wait ( xem thông tin auction cần phê duyệt)
    public function viewAuctionWait($auctionId)
    {
        $itemId = Item::where('auction_id', $auctionId)
            ->get()
            ->pluck('item_id');

        return view('admin.auctions.viewAuctionWait', [
            'title' => 'オークション詳細',
            'auction' => $this->auctionService->getDetailAuctions($auctionId),
            'userSelling' => $this->auctionService->getSellingUser($auctionId),
            'infors' => $this->auctionService->getInfor($auctionId),
            'categoryValueName' => $this->auctionService->getCategoryValueName($auctionId),
            'images' => $this->itemService->getImageLists($itemId)
        ]);
    }

    //accept auction
    public function accept($auctionStatusId)
    {
        $auctionId = AuctionStatus::find($auctionStatusId)->auction_id;
        $startDate = Auction::find($auctionId)->start_date;
        $auctionStatus = AuctionStatus::find($auctionStatusId);
        if ($auctionStatus) {
            $auctionStatus->status = 2;
            $auctionStatus->update();
        }
        return redirect()->route('listAuctions');
    }

    //delete auctions
    public function destroy($auctionId)
    {
        $auctions = Auction::find($auctionId)->delete();
        return redirect()->route('listAuctions')->with('message', '削除しました！');
    }

    //reject auctions
    public function reject(Request $request)
    {
        $auctionId = $request->auction_id;
        $itemId = Item::where('auction_id', '=', $auctionId)
            ->get()
            ->pluck('item_id')
            ->toArray();
       
        $auctionStatusId = $request->auction_status_id;
        $reason = $request->reason;

        if ($reason == null) {
            return redirect()->back()->with('warning', '理由を入力しませんでした！');
        } else {
            AuctionDeny::create([
                'auction_id' => $auctionId,
                'reason' => $reason
            ]);
        }

        $statusId = AuctionStatus::findOrFail($auctionStatusId);
        if ($statusId) {
            $statusId->status = 5;
            $statusId->update();
            ItemValue::where('item_id', '=', $itemId[0])->delete();
            Item::where('item_id', '=', $itemId[0])->delete();
            Auction::findOrFail($auctionId)->delete();
        }

        return redirect()->route('listAuctionsIsWait')->with('message', '削除しました！');
    }
}
