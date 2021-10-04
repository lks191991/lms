<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
//use Illuminate\Support\Facades\Config;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendEmailtoNewuser extends Mailable
{
    //use Queueable, SerializesModels;

    public $data;
    public $rejister_as;

    /**
     * Create a new message instance.
     *
     */
    public function __construct($data,$rejister_as)
    {
        $this->data        = $data;
        $this->rejister_as = $rejister_as;
		
		
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 
		$mail_content = $this->data->toArray();
		$rejister_as  = $this->rejister_as;
		
		//$this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
		$this->subject("Registration Successful");

        return $this->view('emails.student.NewStudentEmailTpl', compact('mail_content','rejister_as'));
    }
}
