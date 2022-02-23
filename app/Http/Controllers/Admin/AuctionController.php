<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\AuctionAdminService;
use App\Models\Auction;
use App\Models\AuctionStatus;
use App\Models\AuctionDeny;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuctionController extends Controller
{
    protected $auctionService;

    public function __construct(AuctionAdminService $auctionService)
    {
        $this->auctionService = $auctionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.auctions.list', [
            'title' => 'Danh sách phiên đấu giá',
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
        return view('admin.auctions.view', [
            'title' => 'Chi tiết phiên đấu giá',
            'auction' => $this->auctionService->getDetailAuctions($auctionId),
            'maxPrice' => $this->auctionService->getMaxPrice($auctionId),
            'bids' => $this->auctionService->getBids($auctionId),
            'userSelling' => $this->auctionService->getSellingUser($auctionId),
            'comments' => $this->auctionService->getComments($auctionId),
            'infors' => $this->auctionService->getInfor($auctionId),
            'categoryValueName' => $this->auctionService->getCategoryValueName($auctionId)
        ]);
    }


    // duyet auctions
    public function list()
    {
        return view('admin.auctions.wait', [
            'title' => 'Duyệt phiên đấu giá',
            'auctions' => $this->auctionService->getListAuctionsWait()
        ]);
    }

    //view autions wait ( xem thông tin auction cần phê duyệt)
    public function viewAuctionWait($auctionId)
    {
        return view('admin.auctions.viewAuctionWait', [
            'title' => 'Chi tiết phiên đấu giá',
            'auction' => $this->auctionService->getDetailAuctions($auctionId),
            'userSelling' => $this->auctionService->getSellingUser($auctionId),
            'infors' => $this->auctionService->getInfor($auctionId),
            'categoryValueName' => $this->auctionService->getCategoryValueName($auctionId)
        ]);
    }

    //accept auction
    public function accept($auctionStatusId)
    {
        $auctionId = AuctionStatus::find($auctionStatusId)->auction_id;
        $startDate = Auction::find($auctionId)->start_date;
        $auctionStatus = AuctionStatus::find($auctionStatusId);
        if ($auctionStatus) {
            if ($startDate < now()) {
                $auctionStatus->status = 2;
            } else {
                $auctionStatus->status = 1;
            }
            $auctionStatus->update();
        }
        return redirect()->route('listAuctions');
    }

    //delete auctions
    public function destroy($auctionId)
    {
        $auctions = Auction::find($auctionId)->delete();
        return redirect()->route('listAuctions');
    }

    //reject auctions
    public function reject(Request $request)
    {
        $auctionId = $request->auction_id;
        $auctionStatusId = $request->auction_status_id;
        $reason = $request->reason;
        $deny = AuctionDeny::create([
            'auction_id' => $auctionId,
            'reason' => $reason ?? ''
        ]);

        $statusId = AuctionStatus::findOrFail($auctionStatusId);
        if ($statusId) {
            $statusId->status = 5;
            $statusId->update();
            $auctionDelete = Auction::findOrFail($auctionId)->delete();
        }

        return redirect()->route('listAuctionsIsWait');
    }
}
