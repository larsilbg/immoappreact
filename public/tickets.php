<?php 
require_once __DIR__ . '/../config/application.config.php';
$users = getAlliDs();
?>
<html>
	<head>
		<link rel="stylesheet" href="style.css"/>
	</head>
	<body>
		<script src="javascript.js"></script>
		<div class ="ticket-window">
			<div class="new-tickets">
    			To-do
				<?php 
				    foreach($users as $userID) {
				        echo "<div id=\"draggable-$userID\" class=\"tickets\" draggable=\"true\" ondragstart=\"onDragStart(event);\">" . $userID . "</div>";
    			    }
    			?>
  			</div>
			<div class="work-dropzone" ondragover="onDragOver(event);" ondrop="onDrop(event);">
    			In Work...
  			</div>
  			<div class="done-dropzone" ondragover="onDragOver(event);" ondrop="onDrop(event);">
    			Done
  			</div>
		</div>
	</body>
</html>