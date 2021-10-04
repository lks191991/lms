@extends('emails.layout')
@section('message')
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td style="padding: 15px; text-align: center;">
		  <table width="600" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;  border: solid 1px #e0e0e0;" align="center" class="main-table">			  
          <tbody>
            <tr>
              <td align="center" style="background-color: #f9f9f9; border-bottom: solid 1px #e0e0e0; padding:30px 15px;">
					<a href="{{url('/')}}" > 
						<img src="{{asset('images/logo.png')}}" alt="XtraClass"> </a>
				</td>
            </tr>
            <tr>
              <td style="font-family: 'arial';background-color: #fff; color: #000;  text-align: left; padding: 15px; font-size: 14px; line-height: 22px;">
				Hi,<br><br>
				  You have added as a tutor for {{$mail_content['school_name']}} school on {{ env('APP_NAME', 'XtraClass') }}. 
				</td>
            </tr>
			
            <tr>
              <td style="text-align: center; padding: 15px;">
				 	<a href="{{ route('login') }}" style="display: inline-block; margin: 0 auto; background-color: #3696fc; color: #fff; font-weight: bold;font-family: 'arial'; text-decoration: none; padding: 15px 30px; font-size: 18px; letter-spacing: 1px; text-transform: uppercase;">Login</a>
				 </td>
            </tr>
			 <tr>
              <td>&nbsp;</td>
            </tr>

             <tr>
              <td style="padding: 15px;">
                   if you have any problem to open above link, then please copy below url on your browser.
		<br/>
                    {{ route('login') }}
                </td>
            </tr> 
			 <tr>
              <td style="background-color: #f9f9f9; border-bottom: solid 1px #e0e0e0; padding:30px 15px;">
				 
				 <table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tbody>
					
					 
					<tr>
					  <td align="center" style=" padding: 2px;">
				  <table width="" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr>
                       
                      <td style="font-family: 'arial';">{{ env('APP_NAME', 'XtraClass') }} (c) {{date('Y')}} All rights reserved </td>
                    </tr>
                  </tbody>
                </table>
				</td>
					</tr>
					
					
				  </tbody>
				</table>

				 
				 </td>
            </tr> 
          </tbody>
        </table>
		</td>
    </tr>
  </tbody>
@endsection