//codigo js del datatable esto le da los botones de exportar y estilos a las tablas que muestran los productos, proveedores y usuarios

$(document).ready(function() {
    $('#TablaUsuarios').DataTable({
        columnDefs:[{
            "defaultContent":"-",
            "targets":"_all"
        }],
        "processing":true,
        "derverside":true,
        "language": {
            "url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        
        
        'dom': 'Blfrtip',
        'bProcessing': true,
        'bAutoWidth': false,
         buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "responsieve":"true",
        "destroy": true,
        "displayLength": 10,
        "order":[[0,"desc"]]
    });
});

