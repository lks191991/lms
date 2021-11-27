<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Payment;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Tutor;
use App\Models\Subject;
use App\Models\UserSubscription;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Session;
use Stripe;
use Validator;
use Auth;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show Student profile.
     *
     */
    public function index(Request $request)
    {
		$data = $request->all();
		
		if(!$data['sid'])
		{
		return redirect()->route('course-details',[$subject->id])->with('error', 'Something went wrong.');
		}
		
		$subject = Subject::with('topics','subject_class')->where('uuid', '=', $data['sid'])->where('status', '=', 1)->orderBy('created_at','DESC')->first();
		
		
		$course = Course::where('status', '=', 1)->where('id', '=', $subject->course_id)->first();
		if(!$subject)
		{
		return redirect()->route('course-details',[$subject->id])->with('error', 'Something went wrong.');
		}
		
		$userSubscription = UserSubscription::where("user_id",Auth::user()->id)->where("course_id",$subject->course_id)->where("subject_id",$subject->id)->count();
		if($userSubscription > 0)
		{
		return redirect()->route('course-details',[$subject->id])->with('error', 'Course already in your learning aacount.');
		}
		return view('frontend.payment',compact('subject','course'));
    }
	
	/**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
		$data = $request->all();
		
		$subject = Subject::with('topics','subject_class')->where('uuid', '=', $data['sid'])->where('status', '=', 1)->orderBy('created_at','DESC')->first();
		$price = $subject->subject_price;
		$amount = $price * 100;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $result = Stripe\Charge::create ([
                "amount" => $amount,
                "currency" => "inr",
                "source" => $request->stripeToken,
                "description" => "Test payment." 
        ]);
		
		$payment = new Payment();
		$userSubscription = new UserSubscription();
		if($result['status'] == 'succeeded')
		{
			$payment->transaction_id = $result['id'];
			$payment->amount = $price;
			$payment->payment_status = 'Success';
			if($payment->save())
			{
				$userSubscription->user_id = Auth::user()->id;
				$userSubscription->course_id = $subject->course_id;
				$userSubscription->subject_id = $subject->id;
				$userSubscription->payment_id = $price;
				$userSubscription->price = $price;
				$userSubscription->status = 'Success';
				$userSubscription->save();
				
				return redirect()->route('frontend.paymentSuccess')->with('success', 'your payment has been successfully processed.');
			}
		}
		else
		{
			$payment->transaction_id = $result['id'];
			$payment->amount = $result['id'];
			$payment->payment_status = 'Faild';
			$payment->save();
			return redirect()->route('frontend.paymentFaild')->with('error', 'Course not available currently');
		}
		
    }
	
	public function paymentSuccess(Request $request)
    {
		return view('frontend.payment-success');
	}
	
	public function paymentFaild(Request $request)
    {
		return view('frontend.payment-faild');
	}
	
	
	
	public function myPayment(Request $request)
    {
		$user = Auth::user();
		$data = UserSubscription::with('course','subject','user','payment')->where("user_id",$user->id)->paginate(20);
		return view('frontend.my-payment',compact('data'));
	}
	
}
