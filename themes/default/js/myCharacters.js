$("#buttonGeneral").click(function(){
	$("#buttonGeneral").removeClass("active");
	$("#buttonSkills").removeClass("active");
	$("#buttonSpells").removeClass("active");
	$("#buttonInventory").removeClass("active");
	$("#buttonJobs").removeClass("active");
	$("#buttonCurrencies").removeClass("active");
	$("#buttonGeneral").addClass("active");

	$("#viewGeneral").show();
	$("#viewSkills").hide();
	$("#viewSpells").hide();
	$("#viewInventory").hide();
	$("#viewJobs").hide();
	$("#viewCurrencies").hide();

});

$("#buttonSkills").click(function(){
	$("#buttonGeneral").removeClass("active");
	$("#buttonSkills").removeClass("active");
	$("#buttonSpells").removeClass("active");
	$("#buttonInventory").removeClass("active");
	$("#buttonJobs").removeClass("active");
	$("#buttonCurrencies").removeClass("active");
	$("#buttonSkills").addClass("active");

	$("#viewGeneral").hide();
	$("#viewSkills").show();
	$("#viewSpells").hide();
	$("#viewInventory").hide();
	$("#viewJobs").hide();
	$("#viewCurrencies").hide();

});

$("#buttonSpells").click(function(){
	$("#buttonGeneral").removeClass("active");
	$("#buttonSkills").removeClass("active");
	$("#buttonSpells").removeClass("active");
	$("#buttonInventory").removeClass("active");
	$("#buttonJobs").removeClass("active");
	$("#buttonCurrencies").removeClass("active");
	$("#buttonSpells").addClass("active");

	$("#viewGeneral").hide();
	$("#viewSkills").hide();
	$("#viewSpells").show();
	$("#viewInventory").hide();
	$("#viewJobs").hide();
	$("#viewCurrencies").hide();

});

$("#buttonInventory").click(function(){
	$("#buttonGeneral").removeClass("active");
	$("#buttonSkills").removeClass("active");
	$("#buttonSpells").removeClass("active");
	$("#buttonInventory").removeClass("active");
	$("#buttonJobs").removeClass("active");
	$("#buttonCurrencies").removeClass("active");
	$("#buttonInventory").addClass("active");

	$("#viewGeneral").hide();
	$("#viewSkills").hide();
	$("#viewSpells").hide();
	$("#viewInventory").show();
	$("#viewJobs").hide();
	$("#viewCurrencies").hide();

});

$("#buttonJobs").click(function(){
	$("#buttonGeneral").removeClass("active");
	$("#buttonSkills").removeClass("active");
	$("#buttonSpells").removeClass("active");
	$("#buttonInventory").removeClass("active");
	$("#buttonJobs").removeClass("active");
	$("#buttonCurrencies").removeClass("active");
	$("#buttonJobs").addClass("active");

	$("#viewGeneral").hide();
	$("#viewSkills").hide();
	$("#viewSpells").hide();
	$("#viewInventory").hide();
	$("#viewJobs").show();
	$("#viewCurrencies").hide();

});

$("#buttonCurrencies").click(function(){
	$("#buttonGeneral").removeClass("active");
	$("#buttonSkills").removeClass("active");
	$("#buttonSpells").removeClass("active");
	$("#buttonInventory").removeClass("active");
	$("#buttonJobs").removeClass("active");
	$("#buttonCurrencies").removeClass("active");
	$("#buttonCurrencies").addClass("active");

	$("#viewGeneral").hide();
	$("#viewSkills").hide();
	$("#viewSpells").hide();
	$("#viewInventory").hide();
	$("#viewJobs").hide();
	$("#viewCurrencies").show();

});

$(document).ready(function() {
    $('.tooltipster').tooltipster();

    $('.tooltipster').click(function(){
    	$('#characterEquipment').DataTable().search($(this).attr('alt')).draw();
    });

});