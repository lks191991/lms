<section class="content-top-wrapper bg-white">
    <div class="container">	
        <div class="search-school">
            <form action="{{route('frontend.search')}}" method="GET">
                @csrf
                <div class="row align-items-center mt-3 mb-2">
                    <div class="col-md-6 text-left">
                        <label for="email" class="mb-2 mb-md-0">  Search for a class</label>                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group m-0">
                            <input type="text" class="form-control" id="search_input" name="search_input" value="{{Request::input('search_input')}}" required="">
                            <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>

            <div id="searchForMainDiv" class="search-school-result mb-3 @if(!empty(Request::input('search_input'))) '' @else d-none @endif">Showing results for <strong>‘<span id="searchFor">{{Request::input('search_input')}}</span>’</strong>
                <p class="total_record">
                    <small>Total 
                        <span class="text-info font-italic"><strong>{{$total_items['schools']}}</strong> Schools</span>, 
                        <span class="text-info font-italic"><strong>{{$total_items['courses']}}</strong> Courses</span> and 
                        <span class="text-info font-italic"><strong>{{$total_items['classes']}}</strong> Classes</span> found.</small></p>
            </div>

        </div>
    </div>
</section>