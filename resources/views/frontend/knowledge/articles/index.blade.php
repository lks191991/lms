@extends('frontend.layouts.app')

@section('title', 'Knowledge Base Articles')

@section('content')
<section class="knowledge-base-banner">	
    <div class="container">
        <div class="caption">
            <h1 class="heading">Knowledge Base</h1>
            <h3 class="heading-sub-text">Great minds find answers here, <br>Click any topic that interests you</h3>
        </div>	
    </div>
</section>
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="Knowledge-card">
                    <div class="Knowledge-card-image">
                        <a href="#" title=""><img src="{{asset('images/knowledge-image-1.jpg')}}" alt="" class="img-fluid"></a>
                    </div>
                    <div class="Knowledge-card-body">
                        <h3><a href="#" title="History: Slave trade in Ghana">History: Slave trade in Ghana</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
                    </div>
                    <div class="Knowledge-card-footer">
                        <p>by <a href="#">Kofi Omane</a></p>
                        <p>12/12/2020</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="Knowledge-card">
                    <div class="Knowledge-card-image">
                        <a href="#" title=""><img src="images/knowledge-image-2.jpg" alt="" class="img-fluid"></a>
                    </div>
                    <div class="Knowledge-card-body">
                        <h3><a href="#" title="Tradition: Values & Ethics in our tradions">Tradition: Values & Ethics in our tradions</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
                    </div>
                    <div class="Knowledge-card-footer">
                        <p>by <a href="#">Teacher Ama</a></p>
                        <p>12/12/2020</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="Knowledge-card">
                    <div class="Knowledge-card-image">
                        <a href="#" title=""><img src="images/knowledge-image-3.jpg" alt="" class="img-fluid"></a>
                    </div>
                    <div class="Knowledge-card-body">
                        <h3><a href="#" title="Animal Science: Predators & preys">Animal Science: Predators & preys</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
                    </div>
                    <div class="Knowledge-card-footer">
                        <p>by <a href="#">Kofi Baboni</a></p>
                        <p>12/12/2020</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="Knowledge-card">
                    <div class="Knowledge-card-image">
                        <a href="#" title=""><img src="images/knowledge-image-4.jpg" alt="" class="img-fluid"></a>
                    </div>
                    <div class="Knowledge-card-body">
                        <h3><a href="#" title="Geography: Discover Ghana">Geography: Discover Ghana</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
                    </div>
                    <div class="Knowledge-card-footer">
                        <p>by <a href="#">Nii Alonte</a></p>
                        <p>12/12/2020</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="Knowledge-card">
                    <div class="Knowledge-card-image">
                        <a href="#" title=""><img src="images/knowledge-image-5.jpg" alt="" class="img-fluid"></a>
                    </div>
                    <div class="Knowledge-card-body">
                        <h3><a href="#" title="Economics: Scarcity in society and why economics matters">Economics: Scarcity in society and why economics matters</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
                    </div>
                    <div class="Knowledge-card-footer">
                        <p>by <a href="#">Kwame Santo</a></p>
                        <p>12/12/2020</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="Knowledge-card">
                    <div class="Knowledge-card-image">
                        <a href="#" title=""><img src="images/knowledge-image-6.jpg" alt="" class="img-fluid"></a>
                    </div>
                    <div class="Knowledge-card-body">
                        <h3><a href="#" title="Agriculture: Commercial agric and Cocoa farming">Agriculture: Commercial agric and Cocoa farming</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
                    </div>
                    <div class="Knowledge-card-footer">
                        <p>by <a href="#">Sir Awudu kakari</a></p>
                        <p>12/12/2020</p>
                    </div>
                </div>
            </div>
        </div>

<!--        <div class="paging">
            <ul class="pagination">
                <li class="page-item disabled"><a class="page-link" href="#">&lsaquo;&lsaquo; Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next &rsaquo;&rsaquo;</a></li>
            </ul>
        </div>	-->

    </div>
</section>	

@endsection
