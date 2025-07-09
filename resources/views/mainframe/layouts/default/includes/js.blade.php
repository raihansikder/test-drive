<?php

/** @noinspection SpellCheckingInspection */

/**
 * Define the list of JS to include
 *
 * @var string[] $scripts
 */
$scripts = [
    'mainframe/js/all.js',
    'mainframe/plugins/ckeditor/ckeditor.js', // v 4.22.1 full version
    'mainframe/templates/admin/plugins/select2-3.5.1/select2.js',
    'mainframe/js/plugins/datatables.1.10.2/dataTables.buttons.min.js',
    'mainframe/js/plugins/idle-timer.min.js',
    'mainframe/js/vue.min.js',
    'mainframe/js/axios.min.js',
    'mainframe/js/lodash.js',
    'mainframe/js/voca.min.js',
    'mainframe/js/plugins/slimscroll/slimscroll.js',
    'mainframe/plugins/autosize/autosize.min.js',
    'mainframe/js/mark.js(jquery.mark.min.js),datatables.mark.js',
    'mainframe/js/plugins/imagelightbox/imagelightbox.min.js',
    /**
     * Additional JS for Mainframe. A verson tag is added in the asset URL to
     * deal with browser caching issue.
     */
    'mainframe/js/mainframe.js?v='.date('Ymd'),
    'mainframe/js/validation.js?v='.date('Ymd'),
    'mainframe/js/after-loader.js?v='.date('Ymd'),
    'mainframe/js/custom.js?v='.date('Ymd'),
    // ⚠️ WARNING: Do not put project-specific JS here in this file. Instead, include them in project template
];

// Merge JS from mainframe config
$scripts = array_merge($scripts, config('mainframe.config.load.js'));
?>
@foreach($scripts as $script)
    <script type="text/javascript" src="{{asset($script)}}"></script>
@endforeach

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="{{asset('mainframe/js/html5shiv.min.js')}}"></script>
<script src="{{asset('mainframe/js/respond.min.js')}}"></script>
<![endif]-->

{{-- ionicicon --}}
<script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@latest/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@latest/dist/ionicons/ionicons.js"></script>

{{-- Enable vue dev tool on non-proudction environment --}}
<script>
    @if(config('app.env')!='production')
        Vue.config.devtools = true;
    @endif
</script>
