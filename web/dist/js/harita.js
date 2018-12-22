$(function(){
	$(".uzbekistan div").click(function(e){
		$("path").css("fill","#ffde00");
		var a=$(this).attr("class");
		$("path#"+a).css("fill","#ffa200");
		if (!$("#input [value="+a+"]").attr("selected")){
			$('#input option').removeAttr('selected');
			// $("#input [value="+a+"]").attr("selected", "selected");
			$("#input [value="+a+"]").prop('selected', true);
		}else{
			alert("Bu joyni tanlab bo'lgansiz!");
		}
		if(a=="qoraqalpoq"){
			$(".location").css("left","110px"). css("top","105px");
			$("#vloyat").html("Qoraqalpog'iston</br> Respublikasi");
		}
		if(a=="xorazm"){
			$(".location").css("left","180px"). css("top","165px");
			$("#vloyat").html("Xorazm");
		}
		if(a=="buxoro"){
			$(".location").css("left","290px"). css("top","235px");
			$("#vloyat").html("Buxoro");
		}
		if(a=="navoiy"){
			$(".location").css("left","340px"). css("top","220px");
			$("#vloyat").html("Navoiy");
		}
		if(a=="qashqa"){
			karta("Qashqadaryo",355,290);
		}
		if(a=="surxon"){
			karta("Surxondaryo",390,330);
		}
		if(a=="samarqand"){
			karta("Samarqand",370,240);
		}
		if(a=="jizzah"){
			karta("Jizzax",415,200);
		}
		if(a=="sirdaryo"){
			karta("Sirdaryo",445,210);
		}
		if(a=="tosh_v"){
			karta("Toshkent<br>viloyati",485,175);
		}
		if(a=="toshkent"){
			karta("Toshkent",465,165);
		}
		if(a=="namangan"){
			karta("Namangan",525,185);
		}
		if(a=="andijon"){
			karta("Andijon",570,190);
		}
		if(a=="fargona"){
			karta("Farg'ona",550,202);
		}
		function karta($nom,$left,$top){
			$(".location").css("left",$left+"px"). css("top",$top+"px");
			$("#vloyat").html($nom);
		}
	});
	$("#input").change(function(){
		alert($(this).val());
		$("path").css("fill","#ffde00");
		var a=$(this).val();
		$("path#"+a).css("fill","#ffa200");
		if(a=="qoraqalpoq"){
			$(".location").css("left","110px"). css("top","105px");
			$("#vloyat").html("Qoraqalpog'iston</br> Respublikasi");
		}
		if(a=="xorazm"){
			$(".location").css("left","180px"). css("top","165px");
			$("#vloyat").html("Xorazm");
		}
		if(a=="buxoro"){
			$(".location").css("left","290px"). css("top","235px");
			$("#vloyat").html("Buxoro");
		}
		if(a=="navoiy"){
			$(".location").css("left","340px"). css("top","220px");
			$("#vloyat").html("Navoiy");
		}
		if(a=="qashqa"){
			karta("Qashqadaryo",355,290);
		}
		if(a=="surxon"){
			karta("Surxondaryo",390,330);
		}
		if(a=="samarqand"){
			karta("Samarqand",370,240);
		}
		if(a=="jizzah"){
			karta("Jizzax",415,200);
		}
		if(a=="sirdaryo"){
			karta("Sirdaryo",445,210);
		}
		if(a=="tosh_v"){
			karta("Toshkent<br>viloyati",485,175);
		}
		if(a=="toshkent"){
			karta("Toshkent",465,165);
		}
		if(a=="namangan"){
			karta("Namangan",525,185);
		}
		if(a=="andijon"){
			karta("Andijon",570,190);
		}
		if(a=="fargona"){
			karta("Farg'ona",550,202);
		}
		function karta($nom,$left,$top){
			$(".location").css("left",$left+"px"). css("top",$top+"px");
			$("#vloyat").html($nom);
		}
	});
});