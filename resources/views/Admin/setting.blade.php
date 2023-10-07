@extends('Admin.layout.app')
@section('title')
    <title>{{ __('all.updatesetting') }}</title>
    {{-- jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('pagetitle')
    <div class="d-flex justify-content-between">
        <div class="pagetitle col">
            <h1>{{ __('all.setting') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{ __('all.Home') }}</a></li>
                    <li class="breadcrumb-item ">{{ __('all.setting') }}</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection
@section('section')
    <section class="section">
        <div class="row">

            <div class="col-lg-12">
                <div class="card p-5">
                    <div class="card-body">

                        <form id="form">
                            <div class="row mb-3">
                                <div class="col-sm-6 ">
                                    <label for="inputEmail3" class="form-label">{{ __('all.phone') }}</label>
                                    <input type="text" value="{{ $setting->phone }}" class="form-control" name="phone"
                                        id="inputText">
                                    <span class="invalid-feedback" id="invalid_feedback_phone">
                                    </span>
                                </div>
                                <div class="col-sm-6 ">
                                    <label for="inputEmail3" class="form-label">{{ __('all.email') }}</label>
                                    <input type="email" value="{{ $setting->email }}" class="form-control" name="email"
                                        id="inputText">
                                    <span class="invalid-feedback" id="invalid_feedback_email">
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6 ">
                                    <label for="inputEmail3" class="form-label">{{ __('all.NameEN') }}</label>
                                    <input type="text" value="{{ $setting->name_en }}" class="form-control"
                                        name="name_en" id="inputText">
                                    <span class="invalid-feedback" id="invalid_feedback_name_en">
                                    </span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="form-label">{{ __('all.NameAR') }}</label>
                                    <input type="text" value="{{ $setting->name_ar }}" class="form-control"
                                        name="name_ar" id="inputText">
                                    <span class="invalid-feedback" id="invalid_feedback_name_ar">
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6 ">
                                    <label for="inputEmail3" class="form-label">{{ __('all.descriptionEN') }}</label>
                                    <textarea class="ckeditor form-control " type="text" name="Description_en" id="descriptionen">{!! $setting->description_en !!}</textarea>
                                    <span class="invalid-feedback" id="invalid_feedback_description_en">
                                    </span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="form-label">{{ __('all.descriptionAR') }}</label>
                                    <textarea class="ckeditor form-control " type="text" name="Description_ar" id="descriptionar">{!! $setting->description_ar !!}</textarea>
                                    <span class="invalid-feedback" id="invalid_feedback_description_ar">
                                    </span>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="form-label">{{ __('all.logo') }}</label>
                                    <input type="file" class="form-control imageinput" name="logo" id="inputText">
                                    <span class="invalid-feedback " id="invalid_feedback_logo">
                                    </span>
                                    <img id="blah" src="{{ asset($setting->logo) }}" alt="your image"
                                        style="margin-top: 10px" width="150" height="150" />
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail3" class="form-label">{{ __('all.location') }}</label>
                                    <input type="text" value="{{ $setting->location }}" class="form-control"
                                        name="location" id="inputText">
                                    <span class="invalid-feedback" id="invalid_feedback_location">
                                    </span>
                                </div>
                            </div>


                            <div class="text-center">
                                <button class="btn btn-primary" id="btn-save">{{ __('all.Update') }}</button>
                                <div class="spinner-border text-primary" role="status" hidden>
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
@section('script')
    <script src=" https://ajax.googleapis.com/ajax/libs/jQuery/3.3.1/jQuery.min.js "></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/super-build/ckeditor.js"></script>

    <script>
        $('#form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            formData.append('_token', "{{ csrf_token() }}")
            formData.append("description_ar", descriptionar.getData());
            formData.append("description_en", descriptionen.getData());
            $.ajax({
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                enctype: 'multipart/form-data',
                url: "{{ route('seeting.update') }}",
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
                        $('#logosetting').attr('src', data.logo);
                        toastr["success"](data.message)
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
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

                    } else {

                        toastr["success"](data.message)
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
                    window[`${val.id}`] = newEditor
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endsection
