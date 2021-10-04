<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
//use Illuminate\Support\Facades\Config;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendEmailtoSchoolmanager extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    

    /**
     * Create a new message instance.
     *
     */
    public function __construct($data)
    {
        $this->data = $data;
       
	}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 
		$mail_content = $this->data->toArray();
		
		//$this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
		$this->subject("Manager Registration Successful");
		
		return $this->view('emails.school.NewSchoolManagerEmailTpl', compact('mail_content'));
    }
}
