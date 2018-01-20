$("#buttonGeneral").click(function(){
	$("#buttonGeneral").removeClass("active");
	$("#buttonSkills").removeClass("active");
	$("#buttonSpells").removeClass("active");
	$("#buttonInventory").removeClass("active");
	$("#buttonGeneral").addClass("active");

	$("#viewGeneral").show();
	$("#viewSkills").hide();

});

$("#buttonSkills").click(function(){
	$("#buttonGeneral").removeClass("active");
	$("#buttonSkills").removeClass("active");
	$("#buttonSpells").removeClass("active");
	$("#buttonInventory").removeClass("active");
	$("#buttonSkills").addClass("active");

	$("#viewGeneral").hide();
	$("#viewSkills").show();

});

$("#buttonSpells").click(function(){
	$("#buttonGeneral").removeClass("active");
	$("#buttonSkills").removeClass("active");
	$("#buttonSpells").removeClass("active");
	$("#buttonInventory").removeClass("active");
	$("#buttonSpells").addClass("active");

	$("#viewGeneral").hide();
	$("#viewSkills").hide();

});

$("#buttonInventory").click(function(){
	$("#buttonGeneral").removeClass("active");
	$("#buttonSkills").removeClass("active");
	$("#buttonSpells").removeClass("active");
	$("#buttonInventory").removeClass("active");
	$("#buttonInventory").addClass("active");

	$("#viewGeneral").hide();
	$("#viewSkills").hide();

});