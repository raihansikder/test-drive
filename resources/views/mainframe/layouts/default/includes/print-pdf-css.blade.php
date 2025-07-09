<style>
    /********************************************************************************
     * Note - Custom minimal css for print and pdf generation using the same template
     *******************************************************************************/
    @font-face {
        font-family: "solaiman-lipi";
        src: url("{{asset('project/css/fonts/solaiman-lipi.ttf')}}");
    }

    @font-face {
        font-family: "inter";
        src: url("{{asset('project/css/fonts/Inter-Regular.ttf')}}");

    }

    @media print {
        #printPageButton {
            display: none;
        }
    }

    .bangla {font-family: solaiman-lipi, serif;}

    body, html, h1, h2, h3, h4, h5, h6, input, textarea {
        font-family: "inter", "Roboto", "Arial", sans-serif;
    !important;
        color: #333;
        font-weight: normal;

    }

    body, table, tr, th, td, thead, tbody {
        font-size: 10px !important;
    }

    body {
        margin: 0;
        font-style: normal;
        font-weight: inherit;
        line-height: 1.5;
        color: #000000;
        text-align: left;
        background-color: #fff
    }

    h1, h2, h3, h4, h5, h6 {
        margin: 10px 0;
        font-weight: bold;
    }

    h1 {
        font-size: 24px;
    }

    h2 {
        font-size: 20px;
    }

    h3 {
        font-size: 16px;
    }

    h4 {
        font-size: 14px;
        font-weight: bold;
    }

    h5 {
        font-size: 10px;
        font-weight: bold;
    }

    .small, small {
        font-size: 9px;

    }

    @page {
        margin: 1rem;
        size: portrait;
    }

    hr {
        /*margin-top: 1rem;*/
        margin-top: 0;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid rgba(0, 0, 0, .3)
    }

    a {
        color: #0056b3;
        text-decoration: none;
        background-color: transparent
    }

    a:hover {
        color: #0056b3;
        text-decoration: underline
    }

    img {
        vertical-align: middle;
        border-style: none
    }

    label, .label {font-weight: bold}

    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 10px;
        color: #000000;
    }

    td, th {
        text-align: inherit;
        padding: 3px;
        vertical-align: top;
        border: 1px solid #f3f3f3;
    }

    th, td.label {
        background-color: #f5f5f6;
    }

    th {border-bottom: #dddddd;}

    .no-border, .borderless {
        border: 0;
    }

    .no-padding {
        padding: 0;
    }

    .no-margin {
        margin: 0;
    }

    table.no-border, table.no-border tr, table.no-border tr th, table.no-border tr td {
        border: 0;
    }

    table.padding, table.padding tr, table.padding tr th, table.padding tr td {
        padding: 3px;
    }

    table.no-padding-l, table.no-padding-l tr, table.no-padding-l tr th, table.no-padding-l tr td {
        padding-left: 0;
    }

    table.bordered, table.bordered tr, table.bordered tr th, table.bordered tr td {
        border: 1px solid #f3f3f3;
        /*padding: 5px;*/
    }

    table.no-padding, table.no-padding tr, table.no-padding tr th, table.no-padding tr td {
        padding: 0;
    }

    .container {
        width: 760px;
        padding: 5px 30px 30px;
        margin-right: auto;
        margin-left: auto
    }

    .no-border {
        border: 0;
    }


</style>
