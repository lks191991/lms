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
      <td  style="padding: 15px;">
     <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
          <tbody>
            <tr>
              <td align="left" style="font-size:18px; font-weight: bold; padding:10px 0px;">Hi Admin,</td>
            </tr>
           
            <tr>
              <td align="center"><table width="100%"  cellspacing="0" cellpadding="10">
                  <tbody>
                    <tr>
                      <td width="25%"> Full Name </td>
                      <td width="75%"> {{$data->your_name,""}} </td>
                    </tr>
                     
                    <tr>
                      <td width="25%"> Mobile number </td>
                      <td width="75%"> {{$data->mobile_number,""}} </td>
                    </tr>
					
					<tr>
                      <td width="25%"> Email </td>
                      <td width="75%"> {{$data->email,""}} </td>
                    </tr>
					
                    <tr>
                      <td width="25%"> Message </td>
                      <td width="75%"> {{$data->message,""}} </td>
                    </tr>
					
					
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td align="left" style="font-size:18px; font-weight: bold; padding:10px 0px; line-height: 24px;">Thanks, <br>
                {{ env('APP_NAME', 'Bright Horizon') }} Team</td>
            </tr>
          </tbody>
        </table></td>
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
                       
                      <td style="font-family: 'arial';">{{ env('APP_NAME', 'Bright Horizon') }} (c) {{date('Y')}} All rights reserved </td>
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