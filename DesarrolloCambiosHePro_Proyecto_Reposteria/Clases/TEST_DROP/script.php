<?php
// // Define a function to handle the drop event
// function drop_handler($event) {
//   // Prevent the default action of the event
//   $event->preventDefault();
//   // Get the data that was transferred with the event
//   $data = $event->dataTransfer->getData("text");
//   // Get the element that was dropped
//   $target = $event->target;
//   // Append the data to the target element
//   $target->appendChild(document.createTextNode($data));
// }

// // Get the element that has the ondrop attribute
// $element = document.getElementById("droppable");
// // Remove the existing ondrop attribute
// $element->removeAttribute("ondrop");
// // Add a new ondrop attribute with the drop_handler function
// $element->setAttribute("ondrop", "drop_handler(event)");
?>
