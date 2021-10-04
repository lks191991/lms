@extends('backend.layouts.layout-2')

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-light">Institutions /</span> Edit Institution
    </h4>
	<div class="card mb-4">
        <h6 class="card-header">
            Edit Institution
        </h6>
        <div class="card-body">
			@includeif('backend.message')
			<form action="{{route('backend.categories.update', $category->id)}}" method = "POST">
            @csrf
            @method('PUT')
           <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-sm-right">Institution Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" placeholder="Category Name" class="form-control" value="{{$category->name}}" required>
                    </div>
                </div>
				
				<div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-right"></label>
                <div class="col-sm-10">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" name="status" value="1" class="custom-control-input" @if($category->status) checked @endif>
                        <span class="custom-control-label">Active</span>
                    </label>
                </div>
            </div>
				
                <div class="form-group row">
                    <div class="col-sm-10 ml-sm-auto">
                        <a href = "{{route('backend.categories.index')}}" class="btn btn-danger mr-2">Cancel</a> <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection