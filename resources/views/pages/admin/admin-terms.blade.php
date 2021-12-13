@extends("layouts.adminLayout")
@section('content')
    <div class="container">
        <div class="px-3">
            <div class="card">
                <div class="card-content">
                    <p class="title is-size-5">Edit Terms of Service Page</p>
                    <!-- Create the editor container -->
                    <div id="editor-terms" style="max-height:60rem;"></div>
                    <footer class="mt-5">
                        <button id="terms-save-change-btn" class="button is-link">
                            <span class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                            </span>
                            <span>Save Changes</span>
                        </button>
                        <button class="button is-danger">
                            <span class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <span>Save Changes</span>
                        </button>
                        {{-- <button class="button is-loading">Loading</button> --}}
                    </footer>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <!-- Initialize Quill editor -->
    <script>
        var termsSaveChangeBtn, toolbarOptions, editorTerms, termsContents;

        termsSaveChangeBtn = document.querySelector("#terms-save-change-btn");

        toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike', 'link'], // toggled buttons
            ['blockquote', 'code-block', 'image'],

            [{
                'header': 1
            }, {
                'header': 2
            }], // custom button values
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }],
            [{
                'script': 'sub'
            }, {
                'script': 'super'
            }], // superscript/subscript
            [{
                'indent': '-1'
            }, {
                'indent': '+1'
            }], // outdent/indent
            [{
                'direction': 'rtl'
            }], // text direction

            [{
                'size': ['small', false, 'large', 'huge']
            }], // custom dropdown
            [{
                'header': [1, 2, 3, 4, 5, 6, false]
            }],

            [{
                'color': []
            }, {
                'background': []
            }], // dropdown with defaults from theme
            [{
                'font': []
            }],
            [{
                'align': []
            }],

            ['clean'] // remove formatting button
        ];

        editorTerms = new Quill('#editor-terms', {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions,
                imageResize: {
                    displaySize: true
                }
            }
        });

        termsSaveChangeBtn.onclick = function() {
            termsContents = document.querySelector("#editor-terms .ql-editor").innerHTML;
            console.log(termsContents);
        };

    </script>
@stop
