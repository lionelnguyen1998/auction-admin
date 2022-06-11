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
            'title' => __('message.news.list'),
            'news' => $this->newService->getListNews()
        ]);
    }

    public function create()
    {
        return view('admin.news.create', [
            'title' => __('message.news.add_page')
        ]);
    }

    public function store(Request $request)
    {
        $content = $request->content;
        $userId = auth()->user()->user_id;
        $title = $request->title;

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
        ]);

        return redirect()->route('listNews')->with('message', __('message.toast.add'));
    }

    public function edit($newId)
    {
        return view('admin.news.create', [
            'title' => __('message.news.edit'),
            'new' => $this->newService->getInfoNew($newId)
        ]);
    }

    public function delete($newId)
    {
        $delete = News::findOrFail($newId)->delete();
        return redirect()->route('listNews')->with('message', __('message.toast.delete'));
    }

    public function update(Request $request, $newId)
    {
        $userId = $request->user_id;
        $title = $request->title;
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
            $newUpdate->content = $content;
            $newUpdate->update();
        }

        return redirect()->route('listNews')->with('info', __('message.toast.edit'));
    }

    public function view($newId)
    {
        return view('admin.news.create', [
            'title' => __('message.title.news_detail'),
            'newView' => $this->newService->getInfoNew($newId)
        ]);
    }
}
