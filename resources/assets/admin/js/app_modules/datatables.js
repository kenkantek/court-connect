$(document).ready(function() {
    
    var table         = $('#datatables');
    
    var pageLength    = 10;
    var processing    = true;
    var serverSide    = true;
    var requestType   = 'GET';
    
       var links       = $('div[data-links]').data('links');


    window.oTable = table.DataTable({

        // Internationalisation. For more info refer to http://datatables.net/manual/i18n
        'language': {
            'aria': {
                'sortAscending': ': orderby asc',
                'sortDescending': ': orderby desc'
            },
            'emptyTable': 'There is no data to display',
            'info': 'Show from _START_ - _END_ in _TOTAL_ records',
            'infoEmpty': 'No record found',
            'infoFiltered': '(filtered from _MAX_ records)',
            'lengthMenu': '_MENU_',
            'search': '',
            'zeroRecords': 'No record found',
            'processing': 'Loading data from server'
        },

        'bStateSave': true,
        'aoColumnDefs': [
            {
                'bSortable': false,
                'aTargets': ['no-sort'] // <-- gets last column and turns off sorting
            },
            {
                'bSearchable': false,
                'aTargets': ['no-search'] // <-- gets last column and turns off sorting
            }
        ],

        'lengthMenu': [
            [10, 30, 50, -1],
            [10, 30, 50, 'All'] // change per page values here
        ],
        // set the initial value
        'pageLength': pageLength,
        'processing': processing,
        'serverSide': serverSide,
        'bServerSide': serverSide,
        'bDeferRender': true,
        'bProcessing': true,
        ajax: {
            url: laroute.route(links.datatables),
            type: requestType,
            data: function (d) {
                d.groupFilter = window.groupFilter;
            }
        },
        'fnInitComplete': function() {
            $('.checkboxes').uniform();
        },
        'fnDrawCallback': function( oSettings ) {
            $('.checkboxes').uniform();
        },
        dom: '<"datatable-header"Tfl>t<"datatable-footer"ip>'
    });

    window.oTable.on('draw.dt', function () {
        $('.tip').tooltip({ placement:'top' });
        if ($.fn.editable) {
            $('.editable').editable();
        }
    });

    var tableWrapper       = $('#datatables_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
    var tableColumnToggler = $('#datatables_column_toggler');

    table.find('.group-checkable').change(function () {
        var set     = $(this).attr('data-set');
        var checked = $(this).prop('checked');
        $(set).each(function () {
            if (checked) {
                $(this).prop('checked', true);
                $(this).closest('tr').addClass('selected');
            } else {
                $(this).prop('checked', false);
                $(this).closest('tr').removeClass('selected');
            }
        });
        $.uniform.update(set);
    });
    table.on( 'click', 'tr', function () {

        var checkbox = table.find('.checkboxes');
        checkbox.prop('checked', false);
        $.uniform.update(checkbox);

        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.find('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            $(this).find('.checkboxes').prop('checked', true);
            $.uniform.update($(this).find('.checkboxes'));
        }
         
    } );
    /* modify datatable control inputs */
    tableWrapper.find('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 85
    }); // initialize select2 dropdown

    $('.dataTables_filter input[type=search]').attr('placeholder', 'Type to filter...');

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
    table.on('click', ' tbody td .row-details', function () {
        var nTr = $(this).parents('tr')[0];
        if (window.oTable.fnIsOpen(nTr)) {
            /* This row is already open - close it */
            $(this).addClass('row-details-close').removeClass('row-details-open');
            window.oTable.fnClose(nTr);
        } else {
            /* Open this row */
            $(this).addClass('row-details-open').removeClass('row-details-close');
            window.oTable.fnOpen(nTr, null, 'details');
        }
    });

    
   
});
