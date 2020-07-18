$(document).ready( function () {
    $('#table_posts').DataTable({
        "responsive": true,
        "searching": false,
        "info": false,
        "lengthChange" : false,
        "pageLength": 25,
    });
});