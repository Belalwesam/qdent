<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 'index')
    {
        //

        $setting = Settings::first();
        if ($page == 'index') {
            $page_title = 'Settings';
            $page_description = 'Edit Settings';
            return view('admin.setting.catEdit', compact('setting','page_description','page_title'));
        } elseif ($page == 'privacy') {
            $page_title = 'Privacy';
            $page_description = 'Edit Privacy';
            return view('admin.setting.privacy', compact('setting','page_description','page_title'));
        }elseif ($page == 'terms') {
            $page_title = 'Terms';
            $page_description = 'Edit Terms';
            return view('admin.setting.terms', compact('setting','page_description','page_title'));
        }elseif ($page == 'about') {
            $page_title = 'About';
            $page_description = 'Edit About';
            return view('admin.setting.about', compact('setting','page_description','page_title'));
        }
    }

    public function terms()
    {
        $setting = Settings::first();
        $page_title = 'Terms';
        $page_description = 'Edit Terms';
        return view('admin.setting.terms', compact('setting','page_description','page_title'));
    }

    public function privacy()
    {
        $setting = Settings::first();
        $page_title = 'Privacy';
        $page_description = 'Edit Privacy';
        return view('admin.setting.privacy', compact('setting','page_description','page_title'));
    }

    public function about()
    {
        $setting = Settings::first();
        $page_title = 'About';
        $page_description = 'Edit About';
        return view('admin.setting.about', compact('setting','page_description','page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $settings)
    {
        $setting = Settings::first();
        $setting->update($request->all());
        return response()->json([
            'status'  => true,
            'message' => 'Updated Successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
