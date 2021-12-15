function onDragStart(event) {

  event
    .dataTransfer
    .setData('text/plain', event.target.id);

  event
    .currentTarget
    .style
    .backgroundColor = 'yellow';
}

function onDragOver(event) {
  event.preventDefault();
}

function onDrop(event) {
	
	event.preventDefault();
	
	const id = event.dataTransfer.getData('text');
    
    const draggableElement = document.getElementById(id);
    const dropzone = event.target;
    dropzone.appendChild(draggableElement);
    
    draggableElement.style.backgroundColor = "#4AAE9B";
    

	let mail = id;
	fetch("http://localhost/add.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
        },
        body: `mail=${id}`,
      })
	
	event
    .dataTransfer
    .clearData();
 }
 
 function onClickLogin (event){
 	 window.location = "login.php";
 }
 
 function onClickRegister (event){
 	 window.location = "register.php";
 }