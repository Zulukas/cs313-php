function changePhoto() {
	var selection = document.selection.animals.value;
	var portrait = null;

	if (selection === "dog") {
		portrait = "husky.jpeg";
	}
	else if (selection === "cat") {
		portrait = "purrito.jpg";
	}
	else if (selection === "pig") {
		portrait = "patsy.png";
	}
	else if (selection === "geico") {
		portrait = "geico.jpg";
	}
	else if (selection === "kangaroo") {
		portrait = "kangaroo.jpg";
	}
	else if (selection === "sloth") {
		portrait = "salazar.jpg";
	}
	else if (selection === "DavidBowie") {
		portrait = "davidbowie.jpg";
	}

	$('#astronautphoto').attr("src", portrait);
}