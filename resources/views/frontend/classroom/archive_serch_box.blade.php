
<div class="archive-card">
    <div class="row">
        <div class="col-md-4">
            <h3 class="sub-heading">Watch previous lessons</h3>
            <div class="heading-sub-text">Go back in time to revise or learn what you missed</div>
            <form class="mt-4">			
                <div class="form-group">
                    <div class="custom-select-outer">
                    <select class="custom-select" onchange="classroomObj.archiveSearch('year')" id="semesterYear">
                        <option class="d-none" value=""><strong>Year</strong></option>
                        @if(!empty($years))
                        @foreach($years as $year)
							@if(!empty($year->year))
                             <option value="{{$year->year}}" {{date('Y',strtotime($defaultVideo->play_on)) == $year->year ? 'selected' : ''}}><strong>{{$year->year}}</strong></option>
						    @endif
                        @endforeach
                        @endif
                    </select>
                </div>
                </div>
                <div class="form-group">	
                    <div class="custom-select-outer">        
                    <select class="custom-select" onchange="classroomObj.getSemesterDateRange('semester')" id="semesterSelect">
                        <option class="d-none" data-datebegin="" data-dateend="" value="" >{{$defaultVideo->school->category_name}}</option>
						@foreach($dateRangeArray->semesters as $semesters)
						 <option data-datebegin="{{$semesters->date_begin}}" data-dateend="{{$semesters->date_end}}" value="{{$semesters->id}}" {{$semesters->id == $dateRangeArray->defaultSemesterId ? 'selected' : ''}} >{{$semesters->semester}}</option>
						@endforeach
                    </select>
                </div>  				
                </div>  				
            </form>
        </div>
        <div class="col-md-8 text-center">

            <div class="calender">
                <input class="date" value="" onchange="classroomObj.archiveSearch('daterange', true)" type="text" name="date" id="semesterDate" style="display:none" />
            </div>
        </div>
        <div class="col-12 pt-5 d-none" id="semesterBtnSearchBox">
            <button type="button" id="archibeSearch" onclick="classroomObj.archiveSearch('search', true)" class="btn btn-primary w-100  ">JOIN</button>
        </div>
    </div>
</div>


@section('footer-scripts')

<script>
    $(document).ready(function () {
        $(".date").flatpickr({
            inline: true,
            monthSelectorType: 'static',
            yearSelectorType: 'static',
			minDate:'{{date("Y-m-01",strtotime($defaultVideo->play_on))}}',
			maxDate:'{{date("Y-m-t",strtotime($defaultVideo->play_on))}}',
            locale: {
                firstDayOfWeek: 1
            },
			defaultDate: '{{$defaultVideo->play_on}}',
            enable: [
                function (date) {
                    // return true to enable
                    var from = new Date('{{date("Y-m-01",strtotime($defaultVideo->play_on))}} 00:00:00');
                    var to = new Date('{{date("Y-m-t",strtotime($defaultVideo->play_on))}} 23:59:59');

                    if (date.getTime() >= from.getTime() && date.getTime() <= to.getTime()) {
						var dateRange = @php echo json_encode($dateRangeArray->dateRange); @endphp;
						if (dateRange[moment(date).format('YYYY-MM-DD')]) {
                                                return true;
                                            }
                       /*  if (date.getDay() !== 0 && date.getDay() !== 6) {
                            return true;
                        } */
                    }
                }
            ]
        });
    });
</script>
@endsection
