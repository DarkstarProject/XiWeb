$(document).ready(function() {

	//When the DOM is ready, initialize the dataTable to show who is online
    var ahTable = $('#auctionHouse').DataTable({
    	"processing": true,
        "serverSide": true,
        "ajax": "services/getAuctionHouse.php",
        "columns": [
			{"orderable": false, "width": "10%"},
			null,
			null,
			{"width": "10%"},
			null,
			{"orderable": false},
			{"orderable": false}
		],
		"order": [[ 1, "asc" ]],
		"processing": false
    });

    $.get("services/getAuctionCount.php", function(data){
        $("#auctionH2").text("There are " + parseFloat($.trim(data)).toLocaleString('en') + " items in the Auction House.");
    });

    //Every 10 seconds, refresh the table
    setInterval( function () {
    	$.get("services/getAuctionCount.php", function(data){
        	$("#auctionH2").text("There are " + parseFloat($.trim(data)).toLocaleString('en') + " items in the Auction House.");
    	});
    	ahTable.ajax.reload(null, false);
	}, 10000 );

} );