<input id="btnPrint" type="button" class="btn btn-default print-btn"
       value="{{ $text ?? "Print" }}"
       onclick="printPage()"/>
<script type="text/javascript">
    function printPage() {
        var printButton = document.getElementById("btnPrint");
        printButton.style.display = 'none';
        window.print();
        printButton.style.display = 'show';
    }
</script>
