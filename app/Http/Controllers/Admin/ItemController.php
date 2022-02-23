<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\ItemAdminService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected $itemService;
    public function __construct(ItemAdminService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function index()
    {
        return view('admin.items.list', [
            'title' => 'Danh sach item',
            'items' => $this->itemService->getAllItems()
        ]);
    }

    public function show($itemId)
    {
        return view('admin.items.view', [
            'title' => 'Chi tiet item',
            'item' => $this->itemService->getItem($itemId)
        ]);
    }
}
