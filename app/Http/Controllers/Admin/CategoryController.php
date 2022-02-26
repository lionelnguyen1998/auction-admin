<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CategoryAdminService;
use App\Http\Services\ItemAdminService;
use App\Http\Services\CategoryValueAdminService;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryValue;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    protected $auctionService, $itemService, $categoyValueService;

    public function __construct(CategoryAdminService $categoryService, ItemAdminService $itemService, CategoryValueAdminService $categoyValueService)
    {
        $this->categoryService = $categoryService;
        $this->itemService = $itemService;
        $this->categoyValueService = $categoyValueService;
    }

    //list category
    public function index()
    {
        return view('admin.categories.list', [
            'title' => 'カテゴリー一覧',
            'categories' => $this->categoryService->getCategoryList()
        ]);
    }

    public function create()
    {
        return view('admin.categories.create', [
            'title' => 'カテゴリー追加'
        ]);
    }

    public function store(Request $request)
    {
        $icon = $request->thumb;
        $name = $request->name;
        $nameEn = $request->name_en;

        $validated = $this->categoryService->categoryValidation($request->all());

        if ($validated->fails()) {
            return redirect(url()->previous())
                ->withErrors($validated)
                ->withInput();
        }
        
        $category = Category::create([
            'image' => $icon,
            'name' => $name,
            'name_en' => $nameEn ?? null
        ]);
        $categoryId = $category->category_id;
    
        $categoryValues = CategoryValue::create([
            'category_id' => $categoryId,
            'name' => $request->name ?? null
        ]);

        Session::flash('success', '成功する追加');

        return redirect()->route('listCategories');
    }

    public function edit($categoryId) 
    {
        return view('admin.categories.edit',[
            'title' => 'カテゴリー編集',
            'category' => $this->categoryService->getCategory($categoryId)
        ]);
    }

    public function update(Request $request) 
    {
        $categoryId = $request->category_id;
        $image = $request->thumb;
        $name = $request->name;
        $nameEn = $request->name_en;

        $validated = $this->categoryService->categoryValidation($request->all());

        if ($validated->fails()) {
            return redirect(url()->previous())
                ->withErrors($validated)
                ->withInput();
        }

        $category = Category::findOrFail($categoryId);

        if ($category) {
            $category->image = $image ?? null;
            $category->name = $name;
            $category->name_en = $nameEn ?? null;
            $category->update();
        }
        return redirect()->route('listCategories');
    }

    public function view($categoryId) 
    {
        return view('admin.categories.view', [
            'title' => 'カテゴリー詳細',
            'category' => $this->categoryService->getCategory($categoryId),
            'countItems' => $this->itemService->getCountItems($categoryId),
            'items' => $this->itemService->getListItems($categoryId),
            'categoryValues' => $this->categoyValueService->getListValues($categoryId)
        ]);
    }

    public function destroy($categoryId)
    {
        $category = Category::find($categoryId)->delete();
        return redirect()->route('listCategories');
    }
}
