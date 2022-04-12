<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CategoryAdminService;
use App\Http\Services\ItemAdminService;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class CategoryController extends Controller
{
    protected $auctionService, $itemService;

    public function __construct(CategoryAdminService $categoryService, ItemAdminService $itemService)
    {
        $this->categoryService = $categoryService;
        $this->itemService = $itemService;
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
            'type' => $type
        ]);

        $categoryId = $category->category_id;
        $countAttribute = $request->count_number;

        return redirect()->route('listCategories')->with('message','追加しました！');
    }

    public function insertCategory($countAttribute, $categoryId)
    {
        return view('admin.categories.insertCategoryValue', [
            'title' => 'カテゴリーの価値を追加する',
            'count' => $countAttribute,
            'categoryId' => $categoryId
        ]);
    }

    public function edit($categoryId) 
    {
        return view('admin.categories.edit',[
            'title' => 'カテゴリー編集',
            'category' => $this->categoryService->getCategory($categoryId),
        ]);
    }

    public function update(Request $request) 
    {
        $categoryId = $request->category_id;
        $image = $request->thumb;
        $name = $request->name;
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
            $category->type = $type;
            $category->update();
        }

        return redirect()->route('listCategories')->with('info','編集しました！');
    }

    public function view($categoryId) 
    {
        return view('admin.categories.view', [
            'title' => 'カテゴリー詳細',
            'category' => $this->categoryService->getCategory($categoryId),
            'countItems' => $this->itemService->getCountItems($categoryId),
            'items' => $this->itemService->getListItems($categoryId),
        ]);
    }

    public function destroy($categoryId)
    {
        $countItem = Item::where('category_id', '=', $categoryId)
            ->count('category_id');
      
        if ($countItem == 0) {
            Category::find($categoryId)->delete();
        } else {
            return redirect()->route('listCategories')->with('warning','削除できません！');
        }
        return redirect()->route('listCategories')->with('message','削除しました！');
    }
}
