<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeEdit;

class ContactEditController extends Controller
{
    public function contactCreate(){
        $contact = HomeEdit::where('pages' , 'contact')->first();
        $content = $contact->content ?? [];

        return view('admin.pages.contactForm' , compact('contact' , 'content'));
    }

    public function contactUpdate(Request $request){
       
        $contact = HomeEdit::where('pages', $request->pages)->first();
        if(!$contact){
            $contact = new HomeEdit();
        }

        $oldContent = $contact->content ?? [];

        // Contact Banner

        $contactData = [];

        $contactData['contact_banner'] = [
            'subtitle' => $request->contact_banner_subtitle,
            'title1' => $request->contact_banner_title,
            'title2' => $request->contact_banner_title_second,
            'color_title' => $request->contact_banner_title_third,
            'desc' => $request->contact_banner_description,
            'btn_text1' => $request->contact_banner_btn1_text,
            'btn_url1' => $request->contact_banner_btn1_link,
            'btn_text2' => $request->contact_banner_btn2_text,
            'btn_url2' => $request->contact_banner_btn2_link,
            'banner_img' => $request->contact_banner_image,
        ];

        if($request->hasFile('contact_banner_image')){
            $contactData['contact_banner']['image'] = $request->file('contact_banner_image')->store('uploads' , 'public');
        } else {
            $contactData['contact_banner']['image'] = $oldContent['contact_banner']['image'] ?? null;
        }

        // Contact Info Section

        $contactInfoItems = [];

        foreach($request->contact_info_items ?? [] as $item){
            if(!empty($item['title'] ?? '') || !empty($item['subtitle'] ?? '') || !empty($item['icon'])){
                $contactInfoItems[] = [
                    'title' => $item['title'] ?? '',
                    'subtitle' => $item['subtitle'] ?? '',
                    'icon' => $item['icon'] ?? '',
                ];
            }
        }
        
        $contactData['contact_info'] = [
            'items' => $contactInfoItems,
        ];

        // Contact Form 

        $contactForm = [];

        $contactData['contact_form'] = [
            'subtitle' => $request->contact_form_subtitle,
            'title' => $request->contact_form_title,
            'color_title' => $request->contact_form_sec_title,
            'desc' => $request->contact_form_description,
            'point1' => $request->contact_form_point1,
            'point2' => $request->contact_form_point2,
            'point3' => $request->contact_form_point3,
            'btn_text' => $request->contact_form_btn_text,
            'btn_url' => $request->contact_form_btn_url,
        ];

        // Contact Visit Us
        
        $contactVisit = [];

        $contactData['contact_visit'] = [
            'subtitle' => $request->contact_visit_subtitle,
            'title' => $request->contact_visit_title,
            'desc' => $request->contact_visit_description,
            'locationTitle' => $request->contact_visit_location_title,
            'locationSubtitle' => $request->contact_visit_location_subtitle,
            'timingTitle' => $request->contact_visit_timing_title,
            'timingSubtitle' => $request->contact_visit_timing_subtitle,
            'contactTitle' => $request->contact_visit_contact_title,
            'contactSubtitle' => $request->contact_visit_contact_subtitle,
            'btn_text' => $request->contact_visit_btn_text,
            'btn_url' => $request->contact_visit_btn_link,
        ];

        HomeEdit::updateOrCreate(
            ['pages' => $request->pages],
            ['content' => $contactData]
        );

        return back()->with('success' , 'Contact Page Updated Successfully');

    }

}