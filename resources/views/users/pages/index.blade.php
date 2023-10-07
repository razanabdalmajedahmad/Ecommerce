@extends('users.layout')
@section('content')
    @include('users.alllayout.newprodact')
    {{-- @include('users.alllayout.top') --}}
    {{-- Categures --}}
@section('secript')
    <script>
        $('#Categures').on('change', function() {
            var categure_id = $(this).val();
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}")
            formData.append('categure_id', categure_id)
            $.ajax({
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                url: "{{ route('filter_categure') }}",
                data: formData,
                success: function(data) {
                    if (data.status) {
                        if (data.count > 0) {

                            $('#products_slick').empty()
                            var row = "";
                            for (let i = 0; i < data.data.length; i++) {
                                if ("{{ app()->getLocale() }}" == "en") {
                                    var cate = data.data[i].categure_name_en
                                    var name = data.data[i].name_en
                                } else {
                                    var cate = data.data[i].categure_name_ar
                                    var name = data.data[i].name_ar
                                }
                                row = row.concat(`<div class="product col-md-3">
                                    <div class="product-img">
                                        <img src="${data.data[i].logo}" alt="">
                                        <div class="product-label">
                                            <span class="new">NEW</span>
                                        </div>
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">${cate}</p>
                                        <h3 class="product-name"><a href="#">${name}</a></h3>
                                        <h4 class="product-price">${data.data[i].price}
                                             {{-- <del class="product-old-price">$990.00</del> --}}
                                            </h4>

                                        <div class="product-btns">
                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                        </div>
                                    </div>
                                    <div class="add-to-cart">
                                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                    </div>
                                </div>`);
                            };
                            $('#products_slick').append(row);
                        } else {
                            $('#products_slick').empty()
                            $('#products_slick').append("{{ __('all.datatable.zeroRecords') }}");
                        }
                    }
                },
            });

        })
    </script>
@endsection
@endsection
