<?php

namespace App\Http\Services;

use App\Models\News;
use Illuminate\Support\Facades\Validator;

class NewAdminService implements NewAdminServiceInterface
{
    public function __construct()
    {
        $this->messageRequired = config('message.MSG_01');
        $this->messageErrorMax = config('message.MSG_03');
    }

    public function getListNews()
    {
        $news = News::with('users')
            ->get()
            ->toArray();

        return $news;
    }

    public function newValidation($request) 
    {
        $rules = [
            'content'=>'required',
            'title' => 'required|max:255',
        ];

        $messages = [
            'required' => $this->messageRequired,
            'max' => sprintf($this->messageErrorMax, ':max')
        ];

        $attributes = [
            'content' => 'コンテンツ',
            'title' => 'テーマ'
        ];

        $validated = Validator::make($request, $rules, $messages, $attributes);

        return $validated;
    }

    public function getInfoNew($newId)
    {
        $new = News::findOrFail($newId);
        $newInfo = [
            'new_id' => $newId,
            'user_id' => $new->user_id,
            'content' => $new->content,
            'title' => $new->title,
        ];

        return $newInfo;
    }
}
