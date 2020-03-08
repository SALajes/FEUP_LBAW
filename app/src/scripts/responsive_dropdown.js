let cu_sel = document.getElementById("cu_selector");

function responsive_dropdown(){
	if (window.innerWidth < 768) cu_sel.className = "dropdown-menu";
	else cu_sel.className = "dropdown-menu show";
}

window.addEventListener("resize", responsive_dropdown);
responsive_dropdown();
