<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->messageRequired = config('message.MSG_01');
    }

    public function index()
    {
        $slider = Slider::all();
        return view('admin.sliders.list', [
            'title' => 'スライダー一覧',
            'sliders' => $slider,
        ]);
    }

    public function create()
    {
        return view('admin.sliders.create', [
            'title' => 'スライダー追加',
        ]);
    }

    public function sliderValidation($request)
    {
        $rules = [
            'thumb'=>'required',
        ];

        $messages = [
            'required' => $this->messageRequired,
        ];

        $validated = Validator::make($request, $rules, $messages);

        return $validated;
    }

    public function store(Request $request) {

        $validated = $this->sliderValidation($request->all());

        if ($validated->fails()) {
            return redirect(url()->previous())
                ->withErrors($validated)
                ->withInput();
        }

        $new = Slider::create([
            'image' => $request['thumb'],
            'type' => $request['type']
        ]);

        return redirect()->route('listSliders')->with('message','追加しました！');
    }

    public function edit($sliderId)
    {
        $slider = Slider::where('slider_id', $sliderId)
            ->get()
            ->toArray();

        return view('admin.sliders.create', [
            'title' => 'スライダー編集',
            'slider' => $slider
        ]);
    }

    public function delete($sliderId)
    {
        $delete = Slider::findOrFail($sliderId)->delete();
        return redirect()->route('listSliders')->with('message','削除しました！');
    }

    public function update(Request $request)
    {
        $sliderId = $request->slider_id;

        $validated = $this->sliderValidation($request->all());

        if ($validated->fails()) {
            return redirect(url()->previous())
                ->withErrors($validated)
                ->withInput();
        }

        $sliderUpdate = Slider::findOrFail($sliderId);

        if ($sliderUpdate) {
            $sliderUpdate->image = $request['thumb'];
            $sliderUpdate->type = $request['type'];
            $sliderUpdate->update();
        }

        return redirect()->route('listSliders')->with('info','編集しました！');
    }
}
