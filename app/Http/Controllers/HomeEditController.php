<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeEdit;

class HomeEditController extends Controller
{
    public function create(){
        $home = HomeEdit::first();
        $content = $home->content ?? [];

        return view('admin.pages.homeform', compact('home' , 'content'));
    }

        public function update(Request $request){

            $home = HomeEdit::first();

            if(!$home){
                $home = new HomeEdit();
            }

            $oldContent = $home->content ?? [];

            $data = [];

            // Home Banner

            $data['home_banner'] = [
                'subtitle' => $request->home_banner_subtitle,
                'title1' => $request->home_banner_title1,
                'title2' => $request->home_banner_title2,
                'color_title' => $request->home_banner_color_title,
                'desc' => $request->home_banner_desc,
                'btn_text1' => $request->home_banner_btn_text1,
                'btn_url1' => $request->home_banner_btn_url1,
                'btn_text2' => $request->home_banner_btn_text2,
                'btn_url2' => $request->home_banner_btn_url2,
            ];

            if($request->hasFile('banner_img')){
                $data['home_banner']['image'] = $request->file('banner_img')->store('uploads' , 'public');
            } else {
                $data['home_banner']['image'] = $oldContent['home_banner']['image'] ?? null;
            }

            // Why Choose Us

            $wcuItems = [];

            foreach($request->home_wcu_items ?? [] as $item){
                if(!empty($item['title'] ?? '') || !empty($item['desc'] ?? '') || !empty($item['icon'] ?? '')){
                    $wcuItems[] = [
                        'title' => $item['title'] ?? '',
                        'desc' => $item['desc'] ?? '',
                        'icon' => $item['icon'] ?? '',
                    ];
                }
            }

             $data['home_wcu'] = [

                'home_wcu_title' => $request->home_wcu_title,
                'home_wcu_subtitle' => $request->home_wcu_subtitle,
                'items' => $wcuItems,

            ];

            // How It Works

            
            $hiwItems = [];

            foreach($request->home_hiw_items ?? [] as $item){
                if(!empty($item['title'] ?? '') || !empty($item['desc'] ?? '') || !empty($item['icon'] ?? '') || !empty($item['step'] ?? '')){
                    $hiwItems[] = [
                        'title' => $item['title'] ?? '',
                        'desc' => $item['desc'] ?? '',
                        'icon' => $item['icon'] ?? '',
                        'step' => $item['step'] ?? '',
                    ];
                }
            }
            
            $data['home_hiw'] = [

                'home_hiw_subtitle'=> $request->home_hiw_subtitle,
                'home_hiw_title'=> $request->home_hiw_title,
                'home_hiw_desc'=> $request->home_hiw_desc,
                'home_hiw_btn_text'=> $request->home_hiw_btn_text,
                'home_hiw_btn_url'=> $request->home_hiw_btn_url,
                'items' => $hiwItems,

            ];

            // Special Offer Banner

            $data['home_specialOffer'] = [

                'home_offer_subtitle' => $request->home_offer_subtitle,
                'home_offer_title' => $request->home_offer_title,
                'home_offer_desc' => $request->home_offer_desc,
                'home_offer_btn_text' => $request->home_offer_btn_text,
                'home_offer_btn_url' => $request->home_offer_btn_url,

            ];

            if($request->hasFile('home_offer_img')){
                $data['home_specialOffer']['image'] = $request->file('home_offer_img')->store('uploads' , 'public');
            } else {
                $data['home_specialOffer']['image'] = $oldContent['home_specialOffer']['image'] ?? null;
            }

            // Testomonial Section

            $testomItems = [];

            foreach($request->home_testom_items ?? [] as $index => $item){

                $imagePath = '';

                if($request->hasFile("home_testom_items.$index.image")){
                    $file = $request->file("home_testom_items.$index.image");
                    $imagePath = $file->store('uploads', 'public');
                } else {
                    $imagePath = $item['old_image'] ?? '';
                }

                if(!empty($item['desc'] ?? '') || 
                !empty($item['rating'] ?? '') || 
                !empty($item['name'] ?? '') || 
                !empty($item['emotion'] ?? '') || 
                !empty($imagePath))
                {
                    $testomItems[] = [
                        'desc' => $item['desc'] ?? '',
                        'rating' => $item['rating'] ?? '',
                        'name' => $item['name'] ?? '',
                        'emotion' => $item['emotion'] ?? '',
                        'image' => $imagePath,
                    ];
                }
            }
            
            $data['home_testom'] = [
                'home_testi_subtitle' => $request->home_testi_subtitle,
                'home_testi_title' => $request->home_testi_title,
                'items' => $testomItems,
            ];

            // FAQ Section

            $faqItems = [];

            foreach($request->home_faq_items ?? [] as $item){
                if(!empty($item['question'] ?? '') || !empty($item['answer'])){
                    $faqItems[] = [
                        'question' => $item['question'] ?? '',
                        'answer' => $item['answer'] ?? '',
                    ];
                }
            }
            
            $data['home_faq'] = [
                'home_faq_subtitle' => $request->home_faq_subtitle,
                'home_faq_title' => $request->home_faq_title,
                'home_faq_desc' => $request->home_faq_desc,
                'home_faq_btn_text' => $request->home_faq_btn_text,
                'home_faq_btn_link' => $request->home_faq_btn_link,
                'items' => $faqItems,
            ];

            HomeEdit::updateOrCreate(
                ['pages' => $request->pages],
                ['content' => $data]
            );
            
            $home->content = $data;
            $home->save();

            return back()->with('success', 'Home page updated successfully');

        }

}