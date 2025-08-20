@php
    $invoiceWidth = getSetting("invoice_paper_width",66);

    $totalPixels = $invoiceWidth*3.78;

    $width = "width={$totalPixels}";
//    $width = "width=200";
@endphp

<script>
    $(document).on('click', '.print', function(e) {
        window.print();
        return false;
    });

    $(document).on("click", ".orderPrint", function (e) {
        let printRoute = $(this).attr("data-print_route");

        printPosOrder(printRoute);

        return false;
    });

    function printPosOrder(printRoute) {
        window.open(printRoute, "_blank", "toolbar=no,scrollbars=yes,resizable=yes,{{ $width }}");
    }
</script>
