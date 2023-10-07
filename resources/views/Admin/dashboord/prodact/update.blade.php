@extends('Admin.layout.app')
@section('title')
    <title>{{ __('all.updateprodact') }}</title>
    <style>
        .content {
            position: relative;
        }

        .mainImage {
            width: 100%
        }

        .startButton {
            position: absolute;
            left: 50%;
            top: 50%;
            z-index: 2;
            transform: translate(-50%, -50%);
        }

        /* #size{
                            width: 100%!important;
                        } */
    </style>
    {{-- jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('pagetitle')
    <div class="d-flex justify-content-between">
        <div class="pagetitle col">
            <h1>{{ __('all.Prodacts') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{ __('all.Home') }}</a></li>
                    <li class="breadcrumb-item ">{{ __('all.Prodacts') }}</li>
                    <li class="breadcrumb-item active"><a>{{ __('all.updateprodact') }}</a></li>
                </ol>
            </nav>
        </div>
        <div>
            <a class="btn btn-primary" href="{{ route('prodact_list') }}">{{ __('all.Back') }}</a>
        </div>
    </div>
@endsection
@section('section')
    <section class="section">
        <div class="row">

            <div class="col-lg-8">
                <div class="card p-5">
                    <div class="card-body">

                        <form id="form">
                            <div class="row mb-3">
                                <div class="col-sm-6 ">
                                    <label for="inputEmail3" class="form-label">{{ __('all.NameEN') }}</label>
                                    <input type="text" class="form-control" value="{{$prodact->name_en}}" name="name_en" id="inputText">
                                    <span class="invalid-feedback" id="invalid_feedback_name_en">
                                    </span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="form-label">{{ __('all.NameAR') }}</label>
                                    <input type="text" class="form-control" value="{{$prodact->name_ar}}" name="name_ar" id="inputText">
                                    <span class="invalid-feedback" id="invalid_feedback_name_ar">
                                    </span>
                                    <input type="text" class="form-control" value="{{$prodact->id}}" name="id" hidden>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6 ">
                                    <label for="inputEmail3" class="form-label">{{ __('all.descriptionEN') }}</label>
                                    <textarea class="ckeditor form-control " type="text" name="Description_en" id="descriptionen">{!!$prodact->description_en!!}</textarea>
                                    <span class="invalid-feedback" id="invalid_feedback_description_en">
                                    </span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="form-label">{{ __('all.descriptionAR') }}</label>
                                    <textarea class="ckeditor form-control "  type="text" name="Description_ar" id="descriptionar">{!!$prodact->description_ar!!}</textarea>
                                    <span class="invalid-feedback" id="invalid_feedback_description_ar">
                                    </span>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6 ">
                                    <label for="inputEmail3" class="form-label">{{ __('all.price') }}</label>
                                    <input type="number" class="form-control" name="price" value="{{$prodact->price}}" id="inputText">
                                    <span class="invalid-feedback" id="invalid_feedback_price">
                                    </span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="form-label">{{ __('all.Quantity') }}</label>
                                    <input type="number" class="form-control" name="quantity" value="{{$prodact->quantity}}" id="inputText">
                                    <span class="invalid-feedback" id="invalid_feedback_quantity">
                                    </span>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6 ">
                                    <label for="inputEmail3" class="form-label">{{ __('all.Categures') }}</label>
                                    <select name="categure" class="form-control">
                                        @foreach ($categ as $item)
                                            <option @if($prodact->categure == $item->id) selected @endif value="{{ $item->id }}">
                                                {{ app()->getLocale() == 'en' ? $item->name_en : $item->name_ar }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback" id="invalid_feedback_categure">
                                    </span>
                                </div>
                                <div class="col-sm-6 ">
                                    <label for="inputEmail3" class="form-label">{{ __('all.Condition') }}</label>
                                    <select name="condition" id="condition" class="form-control">
                                        <option @if($prodact->condition == "new") selected @endif value="new">{{ __('all.New') }}</option>
                                        <option @if($prodact->condition == "featured") selected @endif   value="featured">{{ __('all.Featured') }}</option>
                                        <option @if($prodact->condition == "hot") selected @endif  value="hot">{{ __('all.Hot') }}</option>
                                        <option @if($prodact->condition == "cuts") selected @endif   value="cuts">{{ __('all.Cuts') }}</option>
                                    </select>
                                    <span class="invalid-feedback" id="invalid_feedback_condition">
                                    </span>
                                </div>

                            </div>
                            <div class="row mb-3" @if($prodact->condition == "cuts") @else hidden @endif  id="cuts">
                                <div class="col-sm-6 ">
                                    <label for="inputEmail3" class="form-label">{{ __('all.Discount') }}%</label>
                                    <input type="number"  value="{{$prodact->discount}}"  class="form-control" name="discount" id="inputText">
                                    <span class="invalid-feedback" id="invalid_feedback_discount">
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6 ">
                                    <label for="inputEmail3" class="form-label">{{ __('all.Status') }}</label>
                                    <select name="status" class="form-control">
                                        <option @if($prodact->status == "ctive") selected @endif  value="active">{{ __('all.Active') }}</option>
                                        <option  @if($prodact->status == "inactive") selected @endif value="inactive">{{ __('all.Inactive') }}</option>
                                    </select>
                                    <span class="invalid-feedback" id="invalid_feedback_status">
                                    </span>
                                </div>
                                <div class="col-sm-6 ">
                                    <label for="inputEmail3" class="form-label">{{ __('all.Size') }}</label>
                                    <select name="size[]" id="size" class="form-control" multiple>
                                        <option @if(in_array('S',$size)) selected @endif  value="S">{{ __('all.Small') }}</option>

                                        <option @if(in_array('M',$size)) selected @endif  value="M">{{ __('all.Medium') }}</option>
                                        <option @if(in_array('L',$size)) selected @endif  value="L">{{ __('all.Large') }}</option>
                                        <option @if(in_array('XL',$size)) selected @endif  value="XL">{{ __('all.ExtraLarge') }}</option>
                                    </select>
                                    <span class="invalid-feedback" id="invalid_feedback_size">
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="form-label">{{ __('all.Image') }}</label>
                                    <input type="file" class="form-control imageinput" name="image" id="inputText">
                                    <span class="invalid-feedback " id="invalid_feedback_image">
                                    </span>
                                    <img id="blah" src="{{asset($prodact->image)}}" alt="your image" style="margin-top: 10px"
                                        width="150" height="150" />
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="form-label">{{ __('all.Video') }}</label>
                                    <input type="file" class="form-control videoinput" name="video" id="inputText"
                                        accept="video/mp4">
                                    <video width="150" height="150" id="video" @if(!$prodact->video) hidden @endif controls>
                                        <source src="{{asset($prodact->video)}}" id="videosrc" type="video/mp4">
                                    </video>
                                </div>
                            </div>


                            <div class="text-center">
                                <button class="btn btn-primary" id="btn-save">{{__('all.Update')}}</button>
                                <div class="spinner-border text-primary" role="status" hidden>
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card p-5">
                    <div class="card-body">
                        <div class="row mb-3">
                            <form id="test" enctype="multipart/form-data">
                                <input type="file" class="form-control imageinputmul" id="files" name="images[]"
                                    multiple>
                            </form>

                        </div>
                        <div class="row" id="contentall">

                        </div>
                        <div class="row" id="contentall1">
                            @php
                                $i=0;
                            @endphp
                            @foreach ($prodact->images as $item)
                            <div class="col-sm-6 col-md-6 col-lg-12 mb-3 content " id="content1{{$item->id}}">
                                <input type="text" name="images_id[]" class="images_id" value="{{$item->id}}" hidden/>
                                <img class="mainImage" id="mainImage{{$item->id}}"  src="{{asset($item->path)}}" alt="logo">
                                <button class="startButton btn btn-danger btn-sm" onclick="deletfun2({{$item->id}})"  style="color: #fff" width="40px"><i class="bi bi-trash"></i></button>
                                </div>
                                <div hidden>
                                    {{$i++}}
                                </div>

                            @endforeach


                        </div>


                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
@section('script')
    <script src=" https://ajax.googleapis.com/ajax/libs/jQuery/3.3.1/jQuery.min.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/super-build/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            $('#size').select2({
                placeholder: "{{ __('all.selectoption') }}",
                width: "100%"
            });
        });
    </script>


    <script>
        $('#form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            var ins = document.getElementById('files').files.length;
            for (var x = 0; x < ins; x++) {
                formData.append("images[]", document.getElementById('files').files[x]);
            }
            var id=$(".images_id").length
            for (var i = 0; i < id; i++) {
                formData.append("images_id[]", document.getElementsByClassName('images_id')[i].value);
            }
            formData.append('_token', "{{ csrf_token() }}")
            formData.append("description_ar", descriptionar.getData());
            formData.append("description_en", descriptionen.getData());
            $.ajax({
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                enctype: 'multipart/form-data',
                url: "{{ route('prodact_update_post') }}",
                data: formData,
                beforeSend: function() {
                    $('.invalid-feedback').empty()
                    $('#alert-error').attr('hidden', 'hidden')
                    $('#btn-save').attr('hidden', 'hidden')
                    $('.spinner-border').attr('hidden', false)
                },
                complete: function() {
                    $('#btn-save').attr('hidden', false)
                    $('.spinner-border').attr('hidden', 'hidden')
                },
                success: function(data) {
                    if (data.status) {
                        window.location.href = "{{ route('prodact_list') }}";
                    } else {
                        $('.invalid-feedback').css('display', 'none')
                        toastr["warning"]('warning', data.message);


                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                },
                error: function(xhr) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $('#invalid_feedback_' + key).empty()
                        $('#invalid_feedback_' + key).append(value)
                        $('.invalid-feedback').css('display', 'inline')
                    });
                }
            });
        })
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#invalid_feedback_image').css('display', 'none')
                    $('#blah').attr('src', e.target.result);
                    $('#blah').attr('hidden', false);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".imageinput").change(function() {
            readURL(this);

        });
    </script>
    <script>
        function deletfun2(id){
            $('#content1'+id).remove();
        }
    </script>
    <script>
        function readURLvideo(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var video = document.getElementById("video");
                    video.src = e.target.result;
                    $('#video').attr('hidden', false);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".videoinput").change(function() {
            readURLvideo(this);
        });
    </script>
    <script>
        $('#condition').change(function() {
            if ($(this).val() == "cuts") {
                $('#cuts').attr('hidden', false)
            } else {
                $('#cuts').attr('hidden', true)
            }

        });
    </script>
    <script>
        function readURLimage(input) {
            if (input.files) {
                $('#contentall').empty()
                var row = "";
                for (let i = 0; i < input.files.length; i++) {
                    row = row.concat('<div class="col-sm-6 col-md-6 col-lg-12 mb-3 content " id="content' + i + '">' +
                        '<img class="mainImage" id="mainImage' + i + '"  src="" alt="logo">' +
                        '<button class="startButton btn btn-danger btn-sm" onclick="deletfun(' + i +
                        ')"  style="color: #fff" width="40px"><i class="bi bi-trash"></i></button>' +
                        '</div>');
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#mainImage' + i).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
                $('#contentall').append(row)
            }
        }

        $('.imageinputmul').change(function() {
            readURLimage(this);
        });

        function deletfun(id) {
            const dt = new DataTransfer()
            const input = document.getElementById('files')
            const {
                files
            } = input
            for (let i = 0; i < files.length; i++) {
                const file = files[i]
                if (id != i)
                    dt.items.add(file)
            }
            input.files = dt.files
            const e = new Event("change");
            input.dispatchEvent(e);
        }
    </script>
    <script type="text/javascript">
        document.querySelectorAll('.ckeditor').forEach(function(val) {


            CKEDITOR.ClassicEditor.create(val, {
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic',
                            'bulletedList', 'numberedList', '|',
                            'outdent', 'indent', '|',
                            'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', '|', 'undo', 'redo',
                        ],
                        shouldNotGroupWhenFull: true
                    },
                    list: {
                        properties: {
                            styles: true,
                            startIndex: true,
                            reversed: true
                        }
                    },
                    heading: {
                        options: [{
                                model: 'paragraph',
                                title: 'Paragraph',
                                class: 'ck-heading_paragraph'
                            },
                            {
                                model: 'heading1',
                                view: 'h1',
                                title: 'Heading 1',
                                class: 'ck-heading_heading1'
                            },
                            {
                                model: 'heading2',
                                view: 'h2',
                                title: 'Heading 2',
                                class: 'ck-heading_heading2'
                            },
                            {
                                model: 'heading3',
                                view: 'h3',
                                title: 'Heading 3',
                                class: 'ck-heading_heading3'
                            },
                            {
                                model: 'heading4',
                                view: 'h4',
                                title: 'Heading 4',
                                class: 'ck-heading_heading4'
                            },
                            {
                                model: 'heading5',
                                view: 'h5',
                                title: 'Heading 5',
                                class: 'ck-heading_heading5'
                            },
                            {
                                model: 'heading6',
                                view: 'h6',
                                title: 'Heading 6',
                                class: 'ck-heading_heading6'
                            }
                        ]
                    },
                    placeholder: val.placeholder,
                    fontFamily: {
                        options: [
                            'default',
                            'Arial, Helvetica, sans-serif',
                            'Courier New, Courier, monospace',
                            'Georgia, serif',
                            'Lucida Sans Unicode, Lucida Grande, sans-serif',
                            'Tahoma, Geneva, sans-serif',
                            'Times New Roman, Times, serif',
                            'Trebuchet MS, Helvetica, sans-serif',
                            'Verdana, Geneva, sans-serif'
                        ],
                        supportAllValues: true
                    },
                    fontSize: {
                        options: [10, 12, 14, 'default', 18, 20, 22],
                        supportAllValues: true
                    },
                    htmlSupport: {
                        allow: [{
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }]
                    },
                    htmlEmbed: {
                        showPreviews: true
                    },
                    link: {
                        decorators: {
                            addTargetToExternalLinks: true,
                            defaultProtocol: 'https://',
                            toggleDownloadable: {
                                mode: 'manual',
                                label: 'Downloadable',
                                attributes: {
                                    download: 'file'
                                }
                            }
                        }
                    },
                    mention: {
                        feeds: [{
                            marker: '@',
                            feed: [
                                '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy',
                                '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake',
                                '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum',
                                '@pudding', '@sesame', '@snaps', '@soufflé',
                                '@sugar', '@sweet', '@topping', '@wafer'
                            ],
                            minimumCharacters: 1
                        }]
                    },
                    removePlugins: [

                        'CKBox',
                        'CKFinder',
                        'EasyImage',
                        'RealTimeCollaborativeComments',
                        'RealTimeCollaborativeTrackChanges',
                        'RealTimeCollaborativeRevisionHistory',
                        'PresenceList',
                        'Comments',
                        'TrackChanges',
                        'TrackChangesData',
                        'RevisionHistory',
                        'Pagination',
                        'WProofreader',
                        'MathType',
                        'SlashCommand',
                        'Template',
                        'DocumentOutline',
                        'FormatPainter',
                        'TableOfContents'
                    ]
                }).then(newEditor => {
                    console.log('Editor was initialized', newEditor);
                    editor = newEditor;
                    window[`${val.id}`]=newEditor
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endsection
