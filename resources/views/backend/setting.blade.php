@extends('backend.layouts.layout-2')

@section('content')
<h4 class="font-weight-bold py-3 mb-4">
    <span class="text-muted font-weight-light">Settings /</span> Update Settings
</h4>
<div class="card mb-4">
    <h6 class="card-header">
        Update Settings
    </h6>
    <div class="card-body">
        @includeif('backend.message')
        <form action="{{route('backend.settings.store')}}" method = "post">
            @csrf

            <div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-right">Admin Email</label>
                <div class="col-sm-10">
                    <input type="email" name="admin_email" placeholder="Admin Email" value="{{ $settings['admin_email'] }}" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-right">Contact Email</label>
                <div class="col-sm-10">
                    <input type="email" name="contact_email" placeholder="Contact Email" value="{{ $settings['contact_email'] }}" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-right">Records Per Page</label>
                <div class="col-sm-10">
                    <select name="records_per_page" placeholder="Records Per Page" class="custom-select" required>
                        <option value="10" @if($settings['records_per_page'] == '10' ) selected @endif>10</option>
                        <option value="25" @if($settings['records_per_page'] == '25' ) selected @endif>25</option>
                        <option value="50" @if($settings['records_per_page'] == '50' ) selected @endif>50</option>
                        <option value="100" @if($settings['records_per_page'] == '100' ) selected @endif>100</option>
                    </select>
                    
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-right">Default Meta Title</label>
                <div class="col-sm-10">
                    <input type="text" name="default_meta_title" placeholder="Default Meta Title" value="{{ $settings['default_meta_title'] }}" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-right">Default Meta Keywords</label>
                <div class="col-sm-10">
                    <input type="text" name="default_meta_keywords" placeholder="Default Meta Keywords" value="{{ $settings['default_meta_keywords'] }}" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-right">Default Meta Description</label>
                <div class="col-sm-10">
                    <textarea name="default_meta_description" placeholder="Default Meta Description" class="form-control">{{ $settings['default_meta_description'] }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-2 text-sm-right">Default Meta Robots</label>
                <div class="col-sm-10">
                    <input type="text" name="default_meta_robot" placeholder="Default Meta Robots" value="{{ $settings['default_meta_robot'] }}" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection