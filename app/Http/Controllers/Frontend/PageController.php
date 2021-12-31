<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactInquiry;
use App\Models\Setting;
use App\Mail\sendContactInquiry;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Auth;

class PageController extends Controller
{
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
	
    /**
     * Show How to access page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getHowToAccess()
    {	
        return view('frontend.pages.how_to_access');
    }
        
    /**
     * Show Contact page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getContact()
    {	
        return view('frontend.pages.contact');
    }

    

    /**
     * Send  Contact email and save data in table .
     *
     */
    public function sendContact(Request $request)
    {	

        $validator = Validator::make($request->all(), [
			'your_name' => 'required',
			'mobile_number' => 'required|numeric',
			'email' => 'required|email|max:255',
			'message' => 'required',
		]);

        if ($validator->fails()) {
            return redirect()->route('frontend.contactUs')->withErrors($validator)->withInput();
        }

         $contactInquiry =  new ContactInquiry;
         $contactInquiry->your_name     = $request->input('your_name');
         $contactInquiry->mobile_number = $request->input('mobile_number');
         $contactInquiry->email         = $request->input('email');
         $contactInquiry->message       = $request->input('message');
         $contactInquiry->sending_as    = $request->input('sending_as');
         $contactInquiry->save();

       
        
        $data = (object) array(
                'your_name'      => $request->input('your_name'),
                'mobile_number'  => $request->input('mobile_number'),
                'email'          => $request->input('email'),
                'message'        => $request->input('message'),
            );
        $setting = Setting::where('key_name','admin_email')->first(); 
        $sendTo = 'sunil.sharma@dotsquares.com';
        //$sendTo = 'xtraclass@mailinator.com';
	
		Mail::to($setting->val, "New contact inquiry")->send(new sendContactInquiry($data));    

         return redirect()->route('frontend.contactUs')->with('success',"Your enquiry has been sent successfully.");

    }
    
    public function saveNewsletter(Request $request)
    {	

        $validator = Validator::make($request->all(), [
			'email' => 'required|email|max:255',
		]);

        if ($validator->fails()) {
            return redirect()->route('home')->withErrors($validator)->withInput();
        }

        $data = Newsletter::where("email",$request->input('email'))->first();
        if(isset($data))
        {
            return redirect()->route('home')->with('success',"Your email has been successfully saved.");
        }
         else
         {
            $contactInquiry =  new Newsletter;
            $contactInquiry->email   = $request->input('email');
            $contactInquiry->save();
     
            return redirect()->route('home')->with('success',"Your email has been successfully saved.");
         }

    }
    
}
