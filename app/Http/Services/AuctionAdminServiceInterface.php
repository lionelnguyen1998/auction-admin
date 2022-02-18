<?php

namespace App\Http\Services;

interface AuctionAdminServiceInterface
{
    public function getListAuctions();
    public function getDetailAuctions($datas);
}
