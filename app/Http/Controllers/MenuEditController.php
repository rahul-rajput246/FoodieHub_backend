<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeEdit;

class MenuEditController extends Controller
{
    public function menuCreate(){

        $menu = HomeEdit::where('pages', 'menu')->first();
        $content = $menu->content ?? [];

        return view('admin.pages.menuForm' , compact('menu' , 'content'));

    }

    public function menuUpdate(Request $request){
        $menu = HomeEdit::first();

        if(!$menu){
            $menu = new HomeEdit();
        }

        $oldContent = $menu->content ?? [];

        $menuData = [];

        // Menu Banner

        $menuData['menu_banner'] = [
            'subtitle' => $request->menu_banner_subtitle,
            'title1' => $request->menu_banner_title,
            'title2' => $request->menu_banner_title_second,
            'color_title' => $request->menu_banner_title_third,
            'desc' => $request->menu_banner_description,
            'btn_text1' => $request->menu_banner_btn1_text,
            'btn_url1' => $request->menu_banner_btn1_link,
            'btn_text2' => $request->menu_banner_btn2_text,
            'btn_url2' => $request->menu_banner_btn2_link,
            'banner_img' => $request->menu_banner_img,
        ];

        if($request->hasFile('menu_banner_image')){
            $menuData['menu_banner']['image'] = $request->file('menu_banner_image')->store('uploads' , 'public');
        } else {
            $menuData['menu_banner']['image'] = $oldContent['menu_banner']['image'] ?? null;
        }

        HomeEdit::updateOrCreate(
            ['pages' => $request->pages],
            ['content' => $menuData]
        );

        return back()->with('success' , 'Menu Page Updated successsfully');

    }

}
