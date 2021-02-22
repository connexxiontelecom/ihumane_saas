/*
 Template Name: Dashor - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesdesign
 Website: www.themesdesign.in
 File: Datatable js
 */

$(document).ready(function() {
    $('#datatable').DataTable();
    //Buttons examples
    let table = $('#datatable-buttons').DataTable({
        // lengthChange: false,
        // dom: "Blf<'clear'>rtip",
        dom:
          "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
            {
                extend: 'copy',
                text: "<i class='fa fa-copy'></i> Copy",
                titleAttr: "Copy to Clipboard",
                exportOptions: { columns: ":not(:last-child)" }
            },
            {
                extend: 'excelHtml5',
                text: "<i class='fa fa-file-excel'></i> Excel",
                titleAttr: "Export to Excel",
                exportOptions: { columns: ":not(:last-child)" }
            },
            {
                extend: 'pdfHtml5',
                text: "<i class='fa fa-file-pdf'></i> PDF",
                titleAttr: "Export to PDF",
                exportOptions: { columns: ":not(:last-child)" }
            },
            {
                extend: 'print',
                text: "<i class='fa fa-print'></i> Print",
                titleAttr: "Print Table",
                exportOptions: { columns: ":not(:last-child)" }
            },

        ],
        "order": []
    });
    table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

    let table2 = $('#datatable-buttons-2').DataTable({
        // lengthChange: false,
    dom:
      "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
		buttons: [
            {
                extend: 'copy',
                text: "<i class='fa fa-copy'></i> Copy",
                titleAttr: "Copy to Clipboard",
            },
            {
                extend: 'excelHtml5',
                text: "<i class='fa fa-file-excel'></i> Excel",
                titleAttr: "Export to Excel",
            },
            {
                extend: 'pdfHtml5',
                text: "<i class='fa fa-file-pdf'></i> PDF",
                titleAttr: "Export to PDF",
            },
            {
                extend: 'print',
                text: "<i class='fa fa-print'></i> Print",
                titleAttr: "Print Table",
            },

        ],
        "order": []
    });
    table2.buttons().container().appendTo('#datatable-buttons-2_wrapper .col-md-6:eq(0)');

    // $(document).ready(function() {
    //     $('#datatable2').DataTable();
    // } );
} );

