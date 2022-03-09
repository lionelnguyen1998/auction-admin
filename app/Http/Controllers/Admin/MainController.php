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
        $auctionId = Auction::get()
            ->pluck('auction_id')
            ->toArray();
        $updateStatus = Auction::updateStatus($auctionId);

        return view('admin.home', [
            'title' => 'ホームページ',
            'general' => $this->auctionService->getGeneralInfo()
        ]);
    }
}
