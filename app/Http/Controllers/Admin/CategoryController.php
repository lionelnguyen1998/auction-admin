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
use Carbon\Carbon;

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
        $type = $request->type;

        $validated = $this->categoryService->categoryValidation($request->all());

        if ($validated->fails()) {
            return redirect(url()->previous())
                ->withErrors($validated)
                ->withInput();
        }
    
        $category = Category::create([
            'image' => $icon,
            'name' => $name,
            'name_en' => $nameEn ?? null,
            'type' => $type
        ]);

        $categoryId = $category->category_id;
        $countAttribute = $request->count_number;

        return redirect()->route('insertCategoryValue', ['count_number' => $countAttribute, 'category_id' => $categoryId]);
    }

    public function insertCategory($countAttribute, $categoryId)
    {
        return view('admin.categories.insertCategoryValue', [
            'title' => 'カテゴリーの価値を追加する',
            'count' => $countAttribute,
            'categoryId' => $categoryId
        ]);
    }

    public function storeCategoryValue(Request $request)
    {
        $categoryId = $request->category_id;
        $categoryValue = $request->except('category_id', '_token');
        foreach ($categoryValue as $key => $value) {
            if ($value != null) {
                CategoryValue::create([
                    'category_id' => $categoryId,
                    'name' => $value
                ]);
            }
        }
        return redirect()->route('listCategories');
    }

    public function edit($categoryId) 
    {
        return view('admin.categories.edit',[
            'title' => 'カテゴリー編集',
            'category' => $this->categoryService->getCategory($categoryId),
            'categoryValues' => $this->categoyValueService->getListValues($categoryId)
        ]);
    }

    public function update(Request $request) 
    {
        $categoryId = $request->category_id;
        $image = $request->thumb;
        $name = $request->name;
        $nameEn = $request->name_en;
        $type = $request->type;

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
            $category->type = $type;
            $category->update();
        }

        $categoryValueRequest = $request->except('name', 'name_en', 'thumb', '_token', 'category_id', 'type');

        $categoryValues = CategoryValue::where('category_id', $categoryId)
            ->get();

        foreach ($categoryValues as $key => $categoryValue) 
        {
            foreach ($categoryValueRequest as $k => $v) {
                if ($key == $k) {
                    if ($v != null) {
                        $categoryValue->name = $v;
                        $categoryValue->update();
                    } else {
                        $categoryValue->delete();
                    }
                }
            }
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
