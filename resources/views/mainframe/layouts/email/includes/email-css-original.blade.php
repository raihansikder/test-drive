<style>


    @media only screen and (max-width: 600px) {
        .inner-body {
            width: 100% !important;
        }

        .footer {
            width: 100% !important;
        }
    }

    @media only screen and (max-width: 500px) {
        .button {
            width: 100% !important;
        }
    }

    body, body *:not(html):not(style):not(br):not(tr):not(code) {
        font-family: 'Arial', Inter, Helvetica, sans-serif;
        box-sizing: border-box;
        color: #666;

    }

    body {
        height: 100%;
        hyphens: auto;
        font-size: 14px;
        line-height: 1.3;
        margin: 0;
        -moz-hyphens: auto;
        -ms-word-break: break-all;
        width: 100% !important;
        -webkit-hyphens: auto;
        -webkit-text-size-adjust: none;
        word-break: break-word;
    }

    p, ul, ol, blockquote {
        line-height: 1.4;
        text-align: left;
    }

    a {
        color: #3869D4;
    }

    a img {
        border: none;
    }

    /* Typography */

    h1 {

        font-size: 1.8em;
        font-weight: normal;
        margin: 10px 0;
        text-align: left;
    }

    h2 {

        font-size: 1.6em;
        margin: 10px 0;
        text-align: left;
    }

    h3 {

        font-size: 1.4em;
        font-weight: normal;
        margin: 10px 0;
        text-align: left;
    }

    p {
        color: #74787E;
        font-size: inherit;
        line-height: 1.5em;
        margin-top: 0;
        text-align: left;
    }

    p.sub {
        font-size: 10px;
    }

    img {
        max-width: 100%;
    }

    /* Layout */

    .wrapper {
        background-color: #f5f8fa;
        margin: 0;
        padding: 0;
        width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 100%;
    }

    .content {
        margin: 0;
        padding: 0;
        width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 100%;
    }

    /* Header */

    .header {
        padding: 10px 0;
        text-align: center;
    }

    .header a {
        color: #bbbfc3;
        font-weight: bold;
        text-decoration: none;
        text-shadow: 0 1px 0 white;
    }

    /* Body */

    .body {
        background-color: #FFFFFF;
        border-bottom: 1px solid #EDEFF2;
        border-top: 1px solid #EDEFF2;
        margin: 0;
        padding: 0;
        width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 100%;
    }

    .inner-body {
        background-color: #FFFFFF;
        margin: 0 auto;
        padding: 0;
        width: 650px;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 570px;
    }

    /* Subcopy */

    .subcopy {
        border-top: 1px solid #EDEFF2;
        margin-top: 25px;
        padding-top: 25px;
    }

    .subcopy p {
        font-size: 12px;
    }

    /* Footer */

    .footer {
        margin: 0 auto;
        padding: 0;
        text-align: center;
        width: 570px;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 570px;
    }

    .footer p {
        color: #AEAEAE;
        font-size: 12px;
        text-align: center;
    }

    /* Tables */

    table {
        border-collapse: collapse;
        width: 100%;
        margin: 20px auto;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 100%;
    }

    tr, td, th {
        vertical-align: top;
        padding: 7px;
        color: inherit;
        text-align: left;
        border-bottom: 1px solid #EDEFF2;
    }

    th {
        background-color: #f5f5f6;
        border-bottom: 1px solid #ddd;

    }

    .row-border-bottom {
        border-bottom: 1px lightgrey solid;
    }

    .content-cell {
        padding: 10px 35px;
    }

    /* Buttons */

    .action {
        margin: 30px auto;
        padding: 0;
        text-align: center;
        width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 100%;
    }

    .button {
        border-radius: 3px;
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
        color: #FFF;
        display: inline-block;
        text-decoration: none;
        -webkit-text-size-adjust: none;
    }

    .button-blue {
        color: white;
        background-color: royalblue;
        border-top: 10px solid royalblue;
        border-right: 18px solid royalblue;
        border-bottom: 10px solid royalblue;
        border-left: 18px solid royalblue;
    }

    .button-blue a, .button-blue a:active, .button-blue a:hover, .button-blue a:link, .button-blue a:visited, {
        color: white;
    }

    .button-green {
        background-color: #2ab27b;
        border-top: 10px solid #2ab27b;
        border-right: 18px solid #2ab27b;
        border-bottom: 10px solid #2ab27b;
        border-left: 18px solid #2ab27b;
    }

    .button-red {
        background-color: #bf5329;
        border-top: 10px solid #bf5329;
        border-right: 18px solid #bf5329;
        border-bottom: 10px solid #bf5329;
        border-left: 18px solid #bf5329;
    }

    /* Panels */

    .panel {
        margin: 0 0 21px;
    }

    .panel-content {
        background-color: #EDEFF2;
        padding: 16px;
    }

    .panel-item {
        padding: 0;
    }

    .panel-item p:last-of-type {
        margin-bottom: 0;
        padding-bottom: 0;
    }

    /* Promotions */

    .promotion {
        background-color: #FFFFFF;
        border: 2px dashed #9BA2AB;
        margin: 25px 0;
        padding: 24px;
        width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 100%;
    }

    .promotion h1 {
        text-align: center;
    }

    .promotion p {
        font-size: 15px;
        text-align: center;
    }

    .center {
        text-align: center;
    }

    table.no-border,
    table.no-border tr,
    table.no-border td td {
        border: 0;
    }

</style>
