<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\ItemAdminService;
use App\Http\Services\AuctionAdminService;
use App\Models\Item;
use App\Models\Image;
use App\Models\Brand;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected $itemService, $auctionService;
    public function __construct(ItemAdminService $itemService, AuctionAdminService $auctionService)
    {
        $this->itemService = $itemService;
        $this->auctionService = $auctionService;
    }

    public function index()
    {
        return view('admin.items.list', [
            'title' => 'アイテム',
            'items' => $this->itemService->getAllItems()
        ]);
    }

    public function show($itemId)
    {
        $auctionId = Item::findOrFail($itemId)->auction_id;
        return view('admin.items.view', [
            'title' => 'アイテムの詳細',
            'item' => $this->itemService->getItem($itemId),
            'images' => $this->itemService->getImageLists($itemId),
        ]);
    }
}
