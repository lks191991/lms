@php ob_start() @endphp
@php 
	$inputType = 'text';
@endphp 
 <div class="card cartCountJs" style="display:block;" id="cart-id-{{$category->id}}-{{$garment->id}}" data-category_id="{{$category->id}}" data-garment_id="{{$garment->id}}">
    <div class="card-header" >
      <div class="container-fluid" onclick="shopObj.nextDesign({{$category->id}},{{$garment->id}})">
        <h3> {{$garment->name}} </h3>
      </div>
    </div>        
    <div class="container-fluid">
    <div class="card-body" style="display:none;">
      <div class="gray-bg shopbackdesign">
        <div class="shop-title">
          <h4> What's Your Favorite Back Design? </h4>
          <span class="heading-sub"> All our designs can be customised with your own text and colours</span> 
        </div>
        <div class="back-design-sec">
          <ul class="back-design-item">
          @if(isset($back_options) && !empty($back_options))
          @foreach($back_options as $option)
            <li>
            <div class="design-item-info back-js-class" data-category_id="{{$category->id}}" data-garment_id="{{$garment->id}}" data-option_id="{{$option->productoption->id}}" onclick="shopObj.selectBackDesign(this)">
                <span class="back-img" >
				<img class="img-fluid img-fly-" src="{{asset('uploads/images/product_option/thumbnails/'.$option->productoption->image)}}" alt="{{$option->productoption->name}}"> 
				
                </span>
                <span class="info-icon">
                <a class="icon-d option_info" href="javascript:void(0);" data-target="option_{{$option->productoption->id}}" title="{{$option->productoption->name}}"><i class="fas fa-info"></i></a>
                <a class="icon-d checked-i" href="javascript:void(0);"><i class="fas fa-check"></i></a>
                </span>
           
            </div>
            </li>
            @endforeach
            @endif
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="gray-bg shopfrontback">
            <div class="shop-title">
              <h4> What Would You Like On The Front? </h4>
              <span class="heading-sub"> For more information click <a href="#"><i class="fas fa-info"></i></a></span> </div>
            <div class="back-design-sec">
              <ul class="back-design-item">
              @if(isset($front_options) && !empty($front_options))
                @foreach($front_options as $option)
                <li>
                  <div class="design-item-info front-js-class" data-category_id="{{$category->id}}" data-garment_id="{{$garment->id}}" data-option_id="{{$option->productoption->id}}" onclick="shopObj.selectFrontDesign(this)">
				  <span class="back-img"><img class="img-fluid" src="{{asset('uploads/images/product_option/thumbnails/'.$option->productoption->image)}}" alt="{{$option->productoption->name}}"> </span>
                    <h4> {{$option->productoption->name}}</h4>
                    <span class="info-icon"><a class="icon-d" href="javascript:void(0);"><i class="fas fa-info"></i></a><a class="icon-d checked-i" href="javascript:void(0);"><i class="fas fa-check"></i></a></span>
					
					</div>
                </li>
                @endforeach
              @endif
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="gray-bg shopfrontback">
            <div class="shop-title">
              <h4> Would You Like Something Extra? </h4>
              <span class="heading-sub"> You can add multiple extras, simply click each one you desire</span> </div>
            <div class="back-design-sec">
              <ul class="back-design-item">
            @if(isset($extra_options) && !empty($extra_options))
                @foreach($extra_options as $option)
                <li>
                  <div class="design-item-info extra-js-class" data-category_id="{{$category->id}}" data-garment_id="{{$garment->id}}" data-option_id="{{$option->productoption->id}}" onclick="shopObj.selectExtraDesign(this)">
				  <span class="back-img"><img class="img-fluid" src="{{asset('uploads/images/product_option/thumbnails/'.$option->productoption->image)}}" alt="{{$option->productoption->name}}"> </span>
                    <h4> {{$option->productoption->name}}</h4>
                    <span class="info-icon"><a class="icon-d" href="javascript:void(0);"><i class="fas fa-info"></i></a><a class="icon-d checked-i" href="javascript:void(0);"><i class="fas fa-check"></i></a></span>
					
					</div>
                </li>
                @endforeach
            @endif  
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="garment-sec-cont">
        <div class="row">
          <div class="col-md-7">
            <div class="garment-left">
               <h2>{{$garment->name}}</h2>
    <p>{!! $garment->description !!}</p>cord feed. 280gsm, double fabric hood with ribbed cuff & hem.</p>
              <h5>Select Garment Colour</h5>
              <span class="multiple-info">You can select multiple colours for your garment</span>
              <ul class="select-color">
			  
			  
   @foreach($product_colors as $color)
   

<li class="garment-color-js-class " data-primary_color="{{$color['primary_color']['id']}}" 
		 data-category_id="{{$category->id}}"  
		 data-garment_id="{{$garment->id}}" 
         data-second_color="@if(isset($color['second_color']['id'])){{$color['second_color']['id']}}@else @endif" 
         data-size="{{strtoupper($color['size_availabled'])}}" 
         data-image="{{asset('uploads/images/'.$color['main_image'])}}" 
         onclick="shopObj.selectGarmentColor(this);">
		 
    <div style="background-color: {{$color['primary_color']['code']}}" class="color-box" title="{{strtoupper($color['color_name'])}}" 
         >
         @if(isset($color['second_color']['id']))
        <span style="border-bottom-color:{{$color['second_color']['code']}};" class="color"></span>
        @endif
		
		 
    </div>
</li>                                
@endforeach  
                
              </ul>
             
  <!-- Modal Start -->
  <div class="modal fade" id="size-guide-{{ $category->id }}-{{ $garment->id }}" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">Size Guide</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          {!! $garment->size_guide !!}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal End -->
  
             
              <div class="size-guide"> <a class="btn" onclick="shopObj.showSizeGuide({{$category->id}},{{$garment->id}})" href="javascript:void(0);">Size Guide</a> </div>
              <h5>Select Print Colour</h5>
              <ul class="select-color">
			  
                @foreach($print_colors as $p_color)
                <li class="print-color-js-class" data-option_id="{{$p_color->id}}" 
					data-category_id="{{$category->id}}" 
					data-garment_id="{{$garment->id}}"
					onclick="shopObj.selectPrintColor(this);">
					
                    <span style="background-color: {{$p_color->colour_code}}" class="simplecolor" title="{{$p_color->colour_code}}">
                    </span>
					
                </li>
                @endforeach
                
              </ul>
              <div class="required-info"> <sup>*</sup> We have made every effort to make the colours on screen as close as possible to our garments, however please note that the colours shown are for illustrative purpose only and may differ from actual product colours. <br>
                <strong>Colour swatch cards are available for accurate colours upon request.</strong> </div>
            </div>
          </div>
          <div class="col-md-5">
                    <div class="available-size-view">
                      <div class="not-available">APPLE GREEN is not available in XS,XXXL,4XL,5XL</div>
                      <div class="shop-size-slider owl-carousel owl-theme">
                        <div class="item"> <img class="img-fluid" src="{{asset('images/available-size-view.jpg')}}" alt="available-size-view"> </div>
                        
                        <div class="item"> <img class="img-fluid" src="{{asset('images/available-size-view.jpg')}}" alt="available-size-view"> </div>
                        
                      </div>
                    </div>
                  </div>
        </div>
      </div>
	  <div class="d-flex pt-6 justify-content-center">
        <button type="button" class="btn btn-primary prev-js" id="cart-next-id-{{$category->id}}-{{$garment->id}}" onclick="shopObj.nextDesign({{$category->id}},{{$garment->id}},'prev')">PREV <i class="far fa-arrow-alt-circle-right"></i></button>
      
        <button type="button" class="btn btn-primary next-js" id="cart-next-id-{{$category->id}}-{{$garment->id}}" onclick="shopObj.nextDesign({{$category->id}},{{$garment->id}},'next')">NEXT <i class="far fa-arrow-alt-circle-right"></i></button>
      </div>
    </div>
    </div>
	
	<input type="{{$inputType}}" class="garment-input-js" name="data[{{$category->id}}][{{$garment->id}}][garment][back]" value=""/>
	 
	<input type="{{$inputType}}" class="garment-input-js" name="data[{{$category->id}}][{{$garment->id}}][garment][front]" value=""/>
	
	<input type="{{$inputType}}" class="garment-input-js" name="data[{{$category->id}}][{{$garment->id}}][garment][extra]" value=""/>
	
	<input type="{{$inputType}}" class="garment-input-js" name="data[{{$category->id}}][{{$garment->id}}][garment][garment_color]" value=""/>
	
	<input type="{{$inputType}}" class="garment-input-js" name="data[{{$category->id}}][{{$garment->id}}][garment][print_color]" value=""/>
	
    </div>
	  
	

 @php 
 $content = ob_get_contents();
 $result['resultHtml'] = $content;
 $result['print_colors'] = $print_colors;
 
 ob_end_clean();
 echo json_encode($result);
 @endphp 