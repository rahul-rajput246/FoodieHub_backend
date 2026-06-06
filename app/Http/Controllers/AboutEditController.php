<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeEdit;

class AboutEditController extends Controller
{
    public function aboutCreate(){

        $about = HomeEdit::where('pages' , 'about')->first();
        $content = $about->content ?? [];

        $about_spec = $content['about_special']['items'] ?? [];

        return view('admin.pages.aboutForm' , compact('about' , 'content' , 'about_spec'));

    }

    public function aboutUpdate(Request $request){

        $about = HomeEdit::where('pages', $request->pages)->first();

        if(!$about){
            $about = new HomeEdit();
        }

        $oldContent = $about->content ?? [];

        
        // About Banner

        $aboutData = [];

        $aboutData['about_banner'] = [
            'subtitle' => $request->about_banner_subtitle,
            'title1' => $request->about_banner_title,
            'title2' => $request->about_banner_title_second,
            'color_title' => $request->about_banner_title_third,
            'desc' => $request->about_banner_description,
            'btn_text1' => $request->about_banner_btn1_text,
            'btn_url1' => $request->about_banner_btn1_link,
            'btn_text2' => $request->about_banner_btn2_text,
            'btn_url2' => $request->about_banner_btn2_link,
            'banner_img' => $request->about_banner_image,
        ];

        if($request->hasFile('about_banner_image')){
            $aboutData['about_banner']['image'] = $request->file('about_banner_image')->store('uploads' , 'public');
        } else {
            $aboutData['about_banner']['image'] = $oldContent['about_banner']['image'] ?? null;
        }

        // About Our Story

        $aos = [];

        $aboutData['about_our_story'] = [
            'subtitle' => $request->about_our_story_subtitle,
            'title' => $request->about_our_story_title,
            'desc1' => $request->about_our_story_description1,
            'desc2' => $request->about_our_story_description2,
            'btn_text' => $request->about_our_story_btn1_text,
            'btn_url' => $request->about_our_story_btn1_link,
        ];

        if($request->hasFile('about_our_story_image')){
            $aboutData['about_our_story']['image'] = $request->file('about_our_story_image')->store('uploads' , 'public');
        } else{
            $aboutData['about_our_story']['image'] = $oldContent['about_our_story']['image'] ?? null;
        }

       // About Our Specialities

        $about_spec = [];
        
        foreach($request->about_spec_items ?? [] as $index => $item){

            $imagePath = '';

            if($request->hasFile("about_spec_items.$index.image")){
                $file = $request->file("about_spec_items.$index.image");
                $imagePath = $file->store('uploads', 'public');
            } else {
                $imagePath = $item['old_image'] ?? '';
            }

            if(!empty($item['box_title'] ?? '') || !empty($item['box_desc'] ?? '') || !empty($imagePath)){
                $about_spec[] = [
                    'box_title' => $item['box_title'] ?? '',
                    'box_desc' => $item['box_desc'] ?? '',
                    'image' => $imagePath,
                ];
            }
        }

        $aboutData['about_special'] = [
            'subtitle' => $request->about_our_spec_subtitle,
            'title' => $request->about_our_spec_title,
            'desc' => $request->about_our_spec_description,
            'items' => $about_spec,
        ];


        // About Special Offer Section

        $about_special_offer = [];

        $aboutData['aboutOffer'] = [
            'subtitle' => $request->about_offer_subtitle,
            'title' => $request->about_offer_title,
            'desc' => $request->about_offer_description,
            'btn_text1' => $request->about_offer_btn_text,
            'btn_url1' => $request->about_offer_btn_link,
            'btn_text2' => $request->about_offer_btn_text2,
            'btn_url2' => $request->about_offer_btn_link2,
        ];

        HomeEdit::updateOrCreate(
            ['pages' => $request->pages],
            ['content' => $aboutData]
        );

        return back()->with('success' , 'About Page Updated Successfully');

    }

}
