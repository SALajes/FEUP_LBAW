let cu_sel = document.getElementById("cu_selector");

function resizor(){
	if (window.innerWidth < 768) cu_sel.className = "dropdown-menu";
	else cu_sel.className = "dropdown-menu show";
	console.log(cu_sel.className);
}

window.addEventListener("resize", resizor);
