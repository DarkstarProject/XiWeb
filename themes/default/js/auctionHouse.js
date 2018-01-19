$(document).ready(function() {

	//When the DOM is ready, initialize the dataTable to show who is online
    var rosterTable = $('#auctionHouse').DataTable({
    	"processing": true,
        "serverSide": true,
        "ajax": "services/getAuctionHouse.php",
        "columns": [
			{"orderable": false, "width": "10%"},
			null,
			null,
			{"width": "10%"},
			null,
			null
		],
		"order": [[ 1, "asc" ]]
    });

} );