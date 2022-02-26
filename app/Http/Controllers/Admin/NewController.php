<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Services\NewAdminService;
use App\Models\News;

use Illuminate\Http\Request;

class NewController extends Controller
{
    protected $newService;
    public function __construct(NewAdminService $newService)
    {
        $this->newService = $newService;
    }

    public function index()
    {
        return view('admin.news.list', [
            'title' => 'ニュース一覧',
            'news' => $this->newService->getListNews()
        ]);
    }

    public function create()
    {
        return view('admin.news.create', [
            'title' => 'ニュース追加'
        ]);
    }

    public function store(Request $request)
    {
        $content = $request->content;
        $userId = auth()->user()->user_id;
        $title = $request->title;
        $titleEn = $request->title_en;

        $validated = $this->newService->newValidation($request->all());

        if ($validated->fails()) {
            return redirect(url()->previous())
                ->withErrors($validated)
                ->withInput();
        }

        $new = News::create([
            'user_id' => $userId,
            'content' => $content,
            'title' => $title,
            'title_en' => $titleEn ?? null
        ]);

        return redirect()->route('listNews');
    }

    public function edit($newId)
    {
        return view('admin.news.create', [
            'title' => 'ニュース編集',
            'new' => $this->newService->getInfoNew($newId)
        ]);
    }

    public function delete($newId)
    {
        $delete = News::findOrFail($newId)->delete();
        return redirect()->route('listNews');
    }

    public function update(Request $request, $newId)
    {
        $userId = $request->user_id;
        $title = $request->title;
        $titleEn = $request->title_en;
        $content = $request->content;

        $validated = $this->newService->newValidation($request->all());

        if ($validated->fails()) {
            return redirect(url()->previous())
                ->withErrors($validated)
                ->withInput();
        }

        $newUpdate = News::findOrFail($newId);

        if ($newUpdate) {
            $newUpdate->user_id = $userId;
            $newUpdate->title = $title;
            $newUpdate->title_en = $titleEn ?? null;
            $newUpdate->content = $content;
            $newUpdate->update();
        }

        return redirect()->route('listNews');
    }

    public function view($newId)
    {
        return view('admin.news.create', [
            'title' => 'ニュース詳細',
            'newView' => $this->newService->getInfoNew($newId)
        ]);
    }
}
