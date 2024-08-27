<div class="container-fluid">
    <div class="deals-tabs p-4">
        <div class="section-title text-start">
            <h2>Most Popular Packages</h2>
            <p>Grab the best deals on popular packages at the best price</p>
        </div>
        <div class="row justify-content-center">

            @foreach($mostPopularPackages as $Content)

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="single-deals-box">
                    <div class="deals-image">
                        <a href="{{url('deals-details')}}/{{$Content->id}}" class="d-block">
                            <img src="{{asset($Content->image)}}" alt="image">
                        </a>
                        <!-- <a href="javascript:void(0)" class="bookmark-save"></a> -->
                        <div class="discount" *ngIf="Content.discount">{{$Content->discount}}</div>
                    </div>
                    <div class="deals-content">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="rating">
                                <!-- <i class="Icon.icon}}" *ngFor="let Icon of Content.ratingStar"></i> -->
                                <i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star"></i>
                                <span class="count"></span>
                            </div>
                            <!-- <div class="status">
                            <span *ngIf="Content.trending"><i class='bx bx-trending-up'></i> Content.trending}}</span>
                        </div> -->
                        </div>
                        <h3><a href="{{url('deals-details')}}/{{$Content->id}}">{{$Content->title}}</a></h3>
                        <span class="location"><i class='bx bxs-map'></i> {{$Content->location}}</span>
                    </div>
                    <div class="box-footer">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="price">
                                <span class="new-price"><i class="fa fa-rupee"></i>{{$Content->amount}}</span>
                                <!-- <span class="old-price" *ngIf="Content.oldPrice">Content.oldPrice}}</span> -->
                            </div>
                            <a href="{{url('deals-details')}}/{{$Content->id}}" class="details-btn">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
