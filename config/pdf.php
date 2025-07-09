<?php
/*
|--------------------------------------------------------------------------
| Laravel mPDF configuration file
|--------------------------------------------------------------------------
| https://github.com/mccarlosen/laravel-mpdf
|
*/
return [
    'mode' => 'utf-8',
    'format' => 'A4',
    'default_font_size' => '8',
    'default_font' => 'sans-serif',
    'margin_left' => 30,
    'margin_right' => 30,
    'margin_top' => 30,
    'margin_bottom' => 30,
    'margin_header' => 10,
    'margin_footer' => 10,
    'orientation' => 'P',
    'title' => env('APP_NAME'),
    'author' => env('APP_NAME'),
    'watermark' => '',
    'show_watermark' => false,
    'watermark_font' => 'sans-serif',
    'display_mode' => 'fullpage',
    'defaultCSS ' => base_path('public/project/css/print-pdf.css'),
    'watermark_text_alpha' => 0.1,
    'custom_font_dir' => base_path('public/mainframe/css/fonts/'), // don't forget the trailing slash!
    'custom_font_data' => [
        'solaiman-lipi' => [
            'R' => 'solaiman-lipi.ttf',             // regular font
            // 'B' => 'solaiman-lipi.ttf',          // optional: bold font
            //'I'  => 'ExampleFont-Italic.ttf',     // optional: italic font
            //'BI' => 'ExampleFont-Bold-Italic.ttf' // optional: bold-italic font
            'useOTL' => 0xFF,
        ],
        'inter' => [
            'R' => 'Inter-Regular.ttf',             // regular font
            'B' => 'Inter-Bold.ttf',          // optional: bold font
            //'I'  => 'ExampleFont-Italic.ttf',     // optional: italic font
            //'BI' => 'ExampleFont-Bold-Italic.ttf' // optional: bold-italic font
            // 'useOTL' => 0xFF,
        ],
        // ...add as many as you want.
    ],
    'auto_language_detection' => false,
    // 'temp_dir' => rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR),
    // 'temp_dir' => base_path('storage/fonts/'), //Note: For widows,xampp based implementation
    'pdfa' => false,
    'pdfaauto' => false,
    'use_active_forms' => false,
];
?>
