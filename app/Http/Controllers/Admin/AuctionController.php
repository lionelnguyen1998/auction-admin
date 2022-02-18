<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\AuctionAdminService;
use App\Models\Auction;
use Illuminate\Http\Request;

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
    public function index()
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
}
