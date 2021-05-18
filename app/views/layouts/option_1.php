
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $this->siteTitle()?></title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=PROOT?>css/table-option_1.css" media="screen" title="no title" charset="utf-8" >
        <link rel="stylesheet" type="text/css" href="<?=PROOT?>node_modules/datatables.net-dt/css/jquery.dataTables.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?=PROOT?>node_modules/datatables.net-dt/js/dataTables.dataTables.js">
            $(document).ready(function(){
                console.log('Started..')
                //$('[data-toggle="tooltip"]').tooltip();
                $('#selectedColumn').DataTable({
                    "aaSorting": [],
                    columnDefs: [{
                        orderable: false,
                        targets: 3
                    }]
                });
                $('.dataTables_length').addClass('bs-select');
                $('#selectedColumn tfoot th').each( function () {
                    var title = $(this).text();
                    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
                } );

                // DataTable
                var table = $('#selectedColumn').DataTable({
                    initComplete: function () {
                        // Apply the search
                        console.log('Working...')
                        this.api().columns().every( function () {
                            var that = this;

                            $( 'input', this.footer() ).on( 'keyup change clear', function () {
                                if ( that.search() !== this.value ) {
                                    that
                                        .search( this.value )
                                        .draw();
                                }
                            } );
                        } );
                    }
                });
            });
        </script>
        <?=$this->content('head'); ?>
    </head>
    <body>
    <?php include 'main_manu.php' ?>
    <div class="container-fluid" style="min-height:calc(100% - 125px);">
        <?=$this->content('body'); ?>
    </div>

    </body>
</html>


