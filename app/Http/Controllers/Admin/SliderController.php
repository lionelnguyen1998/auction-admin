<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function index()
    {
        $slider = Slider::all();
        return view('admin.sliders.list', [
            'title' => __('message.slider.list'),
            'sliders' => $slider,
        ]);
    }

    public function create()
    {
        return view('admin.sliders.create', [
            'title' => __('message.slider.add_page'),
        ]);
    }

    public function sliderValidation($request)
    {
        $rules = [
            'thumb'=>'required',
        ];

        if (isset($request["slider_id"])) {
            $sliderId = $request["slider_id"];
            $rules['type'] = "unique:sliders,type,$sliderId,slider_id";
        } else {
            $rules['type'] = "unique:sliders,type";
        }

        $messages = [
            'required' => __('message.validation.required'),
            'unique' => __('message.validation.uniqueSlider'),
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

        return redirect()->route('listSliders')->with('message', __('message.toast.add'));
    }

    public function edit($sliderId)
    {
        $slider = Slider::where('slider_id', $sliderId)
            ->get()
            ->toArray();

        return view('admin.sliders.create', [
            'title' => __('message.slider.edit'),
            'slider' => $slider
        ]);
    }

    public function delete($sliderId)
    {
        $delete = Slider::findOrFail($sliderId)->delete();
        return redirect()->route('listSliders')->with('message', __('message.toast.delete'));
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

        return redirect()->route('listSliders')->with('info', __('message.toast.edit'));
    }
}
