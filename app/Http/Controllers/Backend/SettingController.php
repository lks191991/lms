<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Auth;

class SettingController extends Controller
{
    /**
     * Display a user resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
        //get settings
        $settings = Setting::pluck('val','key_name');     
        //pr($settings); exit;
       return view('backend.setting', compact('settings'));
    }
	
	 /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
		$data = $request->all();
		
		
		
		foreach($data  as $key=>$val) {
			
			if($key != '_token') {
				$setting = Setting::where('key_name', $key)->first();
				$setting->key_name = $key;
				$setting->val = $val;
				$setting->updated_at = date('Y-m-d H:i:s');
				$setting->save();
			}
			
		}
	
		return redirect()->route('backend.settings.index')->with('success','Information Updated Successfully');
		
	}

}