<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">{{__('all.NewProducts')}}</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <select class="input-select" id="Categures">
                                <option value="0">{{__('all.Categures')}}</option>
                                @foreach ($categ as $item)
                                        <option value="{{ $item->id }}">
                                            {{ app()->getLocale() == 'en' ? $item->name_en : $item->name_ar }}
                                        </option>
                                @endforeach
                            </select>

                        </ul>
                    </div>
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-1" id="products_slick">

                                @foreach ($newprodact as $item )
                                <div class="product col-md-3" >
                                    <div class="product-img">
                                        <img src="{{asset($item->image)}}" alt="">
                                        <div class="product-label">
                                            <span class="new">{{__('all.NEW')}}</span>
                                        </div>
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{(app()->getLocale() =="en") ? $item->Categure->name_en : $item->Categure->name_ar}}</p>
                                        <h3 class="product-name"><a href="#">{{(app()->getLocale() =="en") ? $item->name_en : $item->name_ar}}</a></h3>
                                        <h4 class="product-price">{{$item->price}}
                                             {{-- <del class="product-old-price">$990.00</del> --}}
                                            </h4>

                                        <div class="product-btns">
                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                        </div>
                                    </div>
                                    <div class="add-to-cart">
                                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                    </div>
                                </div>
                                @endforeach



                            </div>
                            {{-- <div id="slick-nav-1" class="products-slick-nav"></div> --}}
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
