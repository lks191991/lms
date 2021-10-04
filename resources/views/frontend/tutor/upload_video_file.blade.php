@extends('frontend.layouts.app')
@section('header-styles')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/dropzone/dropzone.css')}}">
<style>
    .dz-clickable{cursor: pointer; }
    .dropzone{border: 3px dashed rgba(24, 28, 33, 0.06);}
    .dz-message {
        margin: 3rem 0;
    }
    .progress-bar {
        transition:width 0.6s ease !important;
    }
    .progress-bar-animated {
        -webkit-animation:progress-bar-stripes 1s linear infinite !important;
        animation:progress-bar-stripes 1s linear infinite !important;
    }
    .uploaded_video.item-row:hover {
        box-shadow: none;
    }
</style>
@endsection

@section('content')
<section class="content-top-wrapper bg-white upload-video-wraper pb-3">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-lg-8 col-xl-9">
            <h5 class="font-weight-bold py-3">
                <span class="text-muted font-weight-light">Lectures /</span> Upload Video file
            </h5>                
          </div>
        </div>
        <div class="row">
            <div class="col">
                                  
                <div class="uploaded_video item-row item-row-lectures history-row-count" id="history-row-{{$video->id}}">
                    <div class="row align-items-center align-items-xl-start">
                        <div class="col flex-grow-0">
                            <figure class="item-row-image"><img src="{{asset('/uploads/schools/'.$video->school->logo)}}" alt=""></figure>
                        </div>

                        <div class="col flex-grow-1">
                            <div class="lecture-title">
                                <h3 class="heading">
                                    {!!$video->title!!}
                                </h3>
                                <p class="heading-sub-text">{{$video->sub_title}}</p>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>        
<section class="tab-card ">
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card mb-5">           
                <div class="card-body">
                    <h5 class="card-title">Upload video file for your Lecture</h5>  
                    
                    <div class="row">
                        <div class="col">
                            <div class="dropzone dz-clickable">                   
                                <div class="dz-message ml-4">
                                    @if($video_thumb)
                                    <div class="video-preview mb-3">
                                        <img src="{{$video_thumb}}" />
                                    </div>
                                    <p>If you want to replace your existing video, you can upload you new video file here.</p>
                                    @endif
                                    <button class="btn btn-success fileinput-button dz-clickable">
                                        <i class="fas fa-plus"></i>
                                        <span>Add file...</span>
                                    </button>
                                    <div class="table table-striped" class="files" id="previews">
                                        <div id="template" class="file-row">
                                            <!-- This is used as the file preview template -->
                                            <div>
                                                <span class="preview"><img data-dz-thumbnail /></span>
                                            </div>
                                            <div>
                                                <p class="name" data-dz-name></p>
                                                <strong class="error text-danger" data-dz-errormessage></strong>
                                                <strong class="dz-success text-success"></strong>
                                            </div>
                                            <div>
                                                <p class="size" data-dz-size></p>

                                                <div class="progress active my-4" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:0%;" data-dz-uploadprogress></div>
                                                </div>
                                                <p class="text-center text-info warning">Sending, please wait...</p>
                                            </div>
                                            <div>
                                                <button class="btn btn-primary start">
                                                    <i class="fas fa-upload"></i>
                                                    <span>Start Uploading</span>
                                                </button>
                                                <!--                                    <button data-dz-remove class="btn btn-warning cancel">
                                                                                        <i class="fas fa-ban"></i>
                                                                                        <span>Cancel</span>
                                                                                    </button>-->
                                                <button data-dz-remove class="btn btn-danger delete">
                                                    <i class="fas fa-trash"></i>
                                                    <span>Delete</span>
                                                </button>

                                                <a href="{{route('frontend.profile')}}" class="btn btn-primary view_detail" style="display:none;">
                                                    <i class="fas fa-video"></i>
                                                    <span>View All Lectures</span>
                                                </a>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</section>
@include('frontend.includes.contact_banner')

@endsection

@section('footer-scripts')

<script src="{{asset('assets/vendor/libs/dropzone/dropzone.js')}}"></script>
<script type="text/javascript">

// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

var myDropzone = new Dropzone(document.body, {// Make the whole body a dropzone
    url: "/admin/upload-video", // Set the url
    acceptedFiles: "video/*",
    maxFilesize: 900, /* you can upload only 200mb  */
    maxFiles: 1,
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.

    success: function (file, response)
    {
        // Do what you want to do with your response
        // This return statement is necessary to remove progress bar after uploading.
        if (response.status == 'success') {
            $(file.previewElement).find('.dz-success').text(response.message);
            $(file.previewElement).find('.delete').hide();
            $(file.previewElement).find('.view_detail').css("display", "inline-block");

            var thumbnail = response.thumbnail;
            $('.video-preview img').attr('src', thumbnail);

            file.previewElement.querySelector(".start").remove();
        } else {
            $(file.previewElement).addClass("dz-error").find('.error').text(response.message);
        }

        $('.warning').hide();
    },
    error: function (file, message) {
        var msg = 'Something went wrong, please try later.';
        if (typeof message == "object") {
            if (message.status == 'error') {
                msg = message.message;
            }
        }
        else {
            msg = message;
        }

        $(file.previewElement).addClass("dz-error").find('.error').text(msg);
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
        $('.warning').hide();
    }
});



myDropzone.on("addedfile", function (file) {
    $('.fileinput-button').attr('disabled', 'disabled').fadeOut();
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function () {
        myDropzone.enqueueFile(file);
    };
    $('.warning').hide();
});

// Update the total progress bar
myDropzone.on("totaluploadprogress", function (progress) {
    $("#total-progress .progress-bar").width(progress + "%");
});

myDropzone.on("sending", function (file, xhr, formData) {
    formData.append('video_id', "{{$video->uuid}}");
    // Show the total progress bar when upload starts
    $("#total-progress").fadeTo('fast', '1');
    $('.warning').show();
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
});

// Hide the total progress bar when nothing's uploading anymore
myDropzone.on("queuecomplete", function (progress) {
    //document.getElementById("#total-progress").style.opacity = "0";
    $("#total-progress").fadeTo('fast', '0');
    $(".view-detail").fadeTo('fast', '1');

});

myDropzone.on("removedfile", function (file) {
    if (this.files.length == 0) {
        $('.fileinput-button').removeAttr('disabled').fadeIn();
    }
});


$(".start").click(function () {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
});

</script>
@endsection