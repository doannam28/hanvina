@foreach($customers as $customer)
    <div class="col-12 col-md-4 p-3">
        <div class="item-wp">
            <div class="img-container">
                <div class="div-boxshadow">
                    @foreach(collect($customer->images)->values() as $key => $image)
                        @if($key <= 2)
                            <div data-client-id="{{$customer->id}}" class="img-wp image-customer col-4 p-1 position-relative ">
                                <img class="w-100 h-100" style="object-fit: cover"
                                     src="{{config('app.DOMAIN_IMG').Utility::thumb($image['image'],120,85)}}" alt="{{$customer->name}}">
                                @if($key == 2 && count($customer->images) > 3)
                                    <div class="position-absolute  top-0 start-0 w-100 h-100 p-1 m-0 ">
                                        <div class="image-count w-100 h-100">
                                            +{{count($customer->images)}}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="wp-content mt-3 font-14-mobile fs-6 text-align-justify">
                            {{$customer->content}}
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-12 d-flex justify-content-start align-items-center ">
                        <div class="avatar">
                            <img class="img-circle img-avata"
                                 src="{{Storage::disk('admin')->url($customer->avatar)}}" alt="avatar">
                        </div>
                        <div class="d-flex ">
                            <div class="highlight p-2 font-16-mobile fs-5  customer-name text-two-line">{{$customer->name}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
