<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
//use Illuminate\Support\Facades\Config;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendContactInquiry extends Mailable
{
    //use Queueable, SerializesModels;

    public $data;
    
    /**
     * Create a new message instance.
     *
     */
    public function __construct($data)
    {
        $this->data        = $data;
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 
		
		$data 		= $this->data;   
		
        return $this->from($data->email)->subject("New contact inquiry")->view('emails.sendContactInquiry', compact('data'));
    }
}
