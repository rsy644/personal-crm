function save_values_to_session(name){
	var inputs = ['status', 'warmth', 'contact', 'company', 'role', 'stage', 'action', 'company-town', 'company-postcode', 'company-type', 'role', 'feedback'];
	var index = inputs.indexOf(name);
	if(name != undefined){
		var element = inputs.splice(index, 1);
	}
	var inputPairs = {};
	console.log('here');

	for(var i = 0; i <= inputs.length; i++){
		var inputValue = $('.' + inputs[i]).val();
		inputPairs["" + inputs[i] + ""] = inputValue;
	};
	console.log(inputPairs);

	// Send Ajax request to session.php, with the value set as the input field name in the POST data
	$.post("/session.php", inputPairs);

	 // possibly remove this section

	 // if(name != 'company'){
	 // 	window.location = "http://127.0.0.1:8000/" + name + "s/create";
	 // } else {
	 // 	window.location = "http://127.0.0.1:8000/companies/create";		
	 // }
}

function delete_values(type, name){
	if(type != 'company'){
		window.location = "http://127.0.0.1:8000/" + type + "s/" + name + "/delete";
	} else {
		window.location = "http://127.0.0.1:8000/companies/" + name + "/delete";
	}
}

function save_values_to_contact_session(){
	var inputs = ['contact', 'telephone'];
	var inputPairs = {};
	for(var i = 0; i < inputs.length; i++){
		var inputValue = $('.' + inputs[i]).val();
		inputPairs["" + inputs[i] + ""] = inputValue;
	};
	console.log(inputPairs);

	// Send Ajax request to session.php, with the value set as the input field name in the POST data
	$.post("/session.php", inputPairs);

	window.location = "http://127.0.0.1:8000/agencies/create";		

}

function save_values_to_agency_session(){
	console.log('here');
	var inputs = ['agency'];
	var inputPairs = {};
	for(var i = 0; i < inputs.length; i++){
		var inputValue = $('.' + inputs[i]).val();
		inputPairs["" + inputs[i] + ""] = inputValue;
	};
	console.log(inputPairs);

	// Send Ajax request to session.php, with the value set as the input field name in the POST data
	$.post("/session.php", inputPairs);

	window.location = "http://127.0.0.1:8000/contacts/create";		

}
