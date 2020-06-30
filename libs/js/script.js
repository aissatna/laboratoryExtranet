/*--------------------------------------------------------------*/
/* Function for Toggling sideBar
/*--------------------------------------------------------------*/
function toggleSideBar() {
    var sideBar = document.getElementById("js__sidebar");
    var main_page = document.getElementById("js__main-page");

    if (sideBar.style.width === '250px') {

        sideBar.style.width = '0px';
        main_page.style.opacity = '1';

    } else {
        sideBar.style.width = '250px';
        //sideBar.style.zIndex = '5';
        main_page.style.opacity = '0.6';
    }
}

$(document).ready(function () {
    /*--------------------------------------------------------------*/
    /* Show  delete-modal to confirm delete
    /*--------------------------------------------------------------*/
    $('#delete-modal').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });
    /*--------------------------------------------------------------*/
    /* Show  info-modal
    /*--------------------------------------------------------------*/
    $('#info-modal').on('show.bs.modal', function (e) {
       var antibodyID = $(e.relatedTarget).data('id');
       // Get antibody characterises
        $.ajax({
            type : 'post',
            url : 'antibody-modal-data.php', // fetch records
            data :  'antibodyID='+ antibodyID, //Pass $id
            success : function(data){
                $('.antibody-data').html(data);//Show fetched data from database
            }
        });
        // Get antibody designation
        $.ajax({
            type : 'post',
            url : 'antibody-modal-title.php', // fetch records
            data :  'antibodyID='+ antibodyID, //Pass $id
            success : function(data){
                $('.antibody-designation').html(data);//Show fetched data from database
            }
        });
    });
    /*--------------------------------------------------------------*/
    /* Transform table to data-table
    /*--------------------------------------------------------------*/
    $('#JS-data-table-species,' +
        '#JS-data-table-clones,' +
        '#JS-data-table-types,' +
        '#JS-data-table-fluorochromes,' +
        '#JS-data-table-providers,' +
        '#JS-data-table-projects,' +
        '#JS-data-table-antibodies')
        .each(function () {
            $(this).DataTable({
                "info": false,
                "responsive": true,

            });
        });
    /*--------------- get all checkbox in data table antibodies user -----------*/
    var table = $("#JS-data-table-antibodies-user").DataTable({
        "info": false,
        "responsive": true,
        // suprrimer plus tard
        "pageLength": 5,
        "lengthMenu": [5,10, 25, 50, 75]
    });
    $('#antibodies-user-form').on('submit', function (e) {
        var form = this;
        // Serialize form data
        var data = table.$('input').serialize();
        // Submit form data via Ajax
        $.redirect("preleve_antibody.php",
            {
                data_antibodies: data,
            },
            "POST", "_blank")

    });
    /*--------------------------------------------------------------*/
    /* Add antibody with multiselect  fields
    /*--------------------------------------------------------------*/
    $('#select_isotypes , ' +
        '#select_especes,' +
        '#select_clones,' +
        '#select_Fluorochromes')
        .multiselect({
            enableFiltering: true,
            buttonWidth: '100%',
            maxHeight: 400,
            includeSelectAllOption: true,
            enableCaseInsensitiveFiltering: true,
        });
});