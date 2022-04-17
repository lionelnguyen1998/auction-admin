<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bid;

class BidController extends Controller
{
    public function destroy($bidId) 
    {
        Bid::where('bid_id', $bidId)->delete();
        return redirect()->back()->with('message','削除しました！');
    }
}
