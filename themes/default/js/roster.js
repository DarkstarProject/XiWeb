$(document).ready(function() {

	//When the DOM is ready, initialize the dataTable to show who is online
    var rosterTable = $('#onlineCharacters').DataTable({
    	"processing": true,
        "serverSide": true,
        "ajax": "getOnlineCharacters.php"
    });

    //Every 5 seconds, refresh the table
    setInterval( function () {
    	//rosterTable.ajax.reload();
	}, 500 );

} );