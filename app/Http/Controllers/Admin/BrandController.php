<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\BrandAdminService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Brand;

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
            'title' => 'Danh sách thương hiệu',
            'brands' => $this->brandService->getListBrands()
        ]);
    }

    public function create()
    {
        return view('admin.brands.create', [
            'title' => 'Thêm thương hiệu'
        ]);
    }

    public function brandValidation($request) 
    {
        $rules = [
            'name_en' => "nullable|max:255",
            'brand_info' => "nullable"
        ];

        if (isset($request["brand_id"])) {
            $brandId = $request["brand_id"];
            $rules['name'] = "required|max:255|min:0|unique:brands,name,$brandId,brand_id,deleted_at,NULL";
        } else {
            $rules['name'] = "required|max:255|min:0|unique:brands,name";
        }

        $messages = [
            'required' => '必須項目が未入力です。',
            'max' => ':max文字以下入力してください。 ',
            'unique' => '既に使用されています。',
            'min' => ':attributeは少なくとも:minでなければなりません。'
        ];

        $attributes = [
            'name' => 'brand'
        ];

        $validated = Validator::make($request, $rules, $messages, $attributes);

        return $validated;
    }

    public function store(Request $request) 
    {
        $name = $request->name;
        $nameEn = $request->name_en;
        $brandInfo = $request->brand_info;

        $validated = $this->brandValidation($request->all());

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

        return redirect("admin/brands/list");
    }

    public function edit($brandId)
    {
        return view('admin.brands.edit', [
            'title' => 'Chỉnh sửa thương hiệu',
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

        return redirect("admin/brands/list");
    }

    public function destroy($brandId) 
    {
        $brand = Brand::findOrFail($brandId)->delete();
        return redirect("admin/brands/list");
    }
}
