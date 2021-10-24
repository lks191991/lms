@if (session('status'))
	<div class="row">
		<div class="col-lg-12">
			<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Success!</strong> {{ session('status') }}
			</div>
		</div>
	</div>
@endif
	
@if (session('warning'))
	<div class="row">
		<div class="col-lg-12">
			<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Warning!</strong> {{ session('warning') }}
			</div>
		</div>
	</div>
@endif

@if ($message = Session::get('success'))
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <strong>{!! $message !!}</strong>
        </div>
    </div>
</div>
@endif

@if ($message = Session::get('error'))
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <strong>{!! $message !!}</strong>
        </div>
    </div>
</div>
@endif


@section('custom-js')
<script type="text/javascript">
$(".alert-dismissible").fadeTo(5000, 500).slideUp(500, function(){
    $(".alert-dismissible").slideUp(500);
});
</script>
@endsection

