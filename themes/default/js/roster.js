$(document).ready(function() {

	//When the DOM is ready, initialize the dataTable to show who is online
    var rosterTable = $('#onlineCharacters').DataTable({
    	"processing": true,
        "serverSide": true,
        "ajax": "services/getOnlineCharacters.php",
        columns: [
            null,
            null,
            {"type": "num"},
            null
        ],
        "processing": false
    });

    $.get("services/getOnlineCount.php", function(data){
        $("#onlineH2").text("There are " + $.trim(data) + " characters online.");
    });

    //Every 10 seconds, refresh the table
    setInterval( function () {
        $.get("services/getOnlineCount.php", function(data){
            $("#onlineH2").text("There are " + $.trim(data) + " characters online.");
        });
    	rosterTable.ajax.reload(null, false);
	}, 10000 );

} );