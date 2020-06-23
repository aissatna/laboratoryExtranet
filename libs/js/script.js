/*--------------------------------------------------------------*/

/* Function for Toggling sideBar
/*--------------------------------------------------------------*/
function toggleSideBar() {
    var sideBar = document.getElementById("js__sidebar");
    var main_page = document.getElementById("js__main-page");

    if (sideBar.style.width === '250px') {

        sideBar.style.width = '0px';
        main_page.style.opacity='1';

      //  main_page.style.marginLeft = '0px';
    } else {
        sideBar.style.width = '250px';
        //sideBar.style.zIndex = '5';
        main_page.style.opacity = '0.6';

    }
}

/*--------------------------------------------------------------*/
/* Show  delete-modal to confirm delete
/*--------------------------------------------------------------*/
$('#confirm-delete').on('show.bs.modal', function (e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

    $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
});
/*--------------------------------------------------------------*/
/* Transform table to data-table
/*--------------------------------------------------------------*/
$(document).ready(function () {
    $('#JS-data-table-species,' +
        '#JS-data-table-clones,' +
        '#JS-data-table-types,' +
        '#JS-data-table-fluorochromes,' +
        '#JS-data-table-providers,' +
        '#JS-data-table-projects,' +
        '#JS-data-table-antibodies')
        .each(function () {
            $(this).DataTable();
        })
});
/***********************/
$(document).ready(function() {
    $('#select_isotypes , ' +
        '#select_especes,' +
        '#select_clones,' +
        '#select_Fluorochromes')
        .multiselect({
        enableFiltering: true,
        buttonWidth: '100%',
        maxHeight:400,
        includeSelectAllOption: true,
        enableCaseInsensitiveFiltering:true,


    });
});
