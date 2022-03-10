<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\BrandAdminService;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Item;

class BrandController extends Controller
{
    protected $brandService;
    public function __construct(BrandAdminService $brandService) 
    {
        $this->brandService = $brandService;
    }

    public function index()
    {
        return view('admin.brands.list', [
            'title' => 'ブランド一覧',
            'brands' => $this->brandService->getListBrands()
        ]);
    }

    public function create()
    {
        return view('admin.brands.create', [
            'title' => 'ブランド追加'
        ]);
    }

    public function store(Request $request) 
    {
        $name = $request->name;
        $nameEn = $request->name_en;
        $brandInfo = $request->brand_info;

        $validated = $this->brandService->brandValidation($request->all());

        if ($validated->fails()) {
            return redirect(url()->previous())
                ->withErrors($validated)
                ->withInput();
        }
        
        $brand = Brand::create([
            'name' => $name,
            'name_en' => $nameEn ?? null,
            'brand_info' => $brandInfo ?? null
        ]);

        return redirect()->route('listBrands')->with('message', '追加しました！');
    }

    public function edit($brandId)
    {
        return view('admin.brands.edit', [
            'title' => 'ブランド編集',
            'brand' => $this->brandService->getBrand($brandId)
        ]);
    }

    public function update(Request $request) 
    {
        $name = $request->name;
        $nameEn = $request->name_en;
        $brandInfo = $request->brand_info;
        $brandId = $request->brand_id;

        $validated = $this->brandValidation($request->all());

        if ($validated->fails()) {
            return redirect(url()->previous())
                ->withErrors($validated)
                ->withInput();
        }
        
        $brand = Brand::findOrFail($brandId);

        if ($brand) {
            $brand->name = $name;
            $brand->name_en = $nameEn ?? null;
            $brand->brand_info = $brandInfo ?? null;
            $brand->update();
        }

        return redirect()->route('listBrands')->with('info', '編集しました！');
    }

    public function destroy($brandId) 
    {
        $countItem = Item::where('brand_id', '=', $brandId)
            ->count('category_id');

        if ($countItem == 0) {
            $brand = Brand::findOrFail($brandId)->delete();
        } else {
            return redirect()->back()->with('warning', '削除できません！');
        }

        return redirect()->route('listBrands')->with('message', '削除しました！');
    }
}
