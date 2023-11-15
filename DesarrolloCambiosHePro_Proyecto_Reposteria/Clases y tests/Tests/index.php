<!DOCTYPE html>
<html>
<head>
  <style>
    #dropzone {
      width: 300px;
      height: 300px;
      border: 3px dashed gray;
      margin: 10px;
    }

    #dropzone img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  </style>
  <script>
    function allowDrop(ev) {
      ev.preventDefault();
    }

    function drag(ev) {
      ev.dataTransfer.setData("text", ev.target.src);
      ev.dataTransfer.setDragImage(ev.target, 0, 0);
    }

    function drop(ev) {
      ev.preventDefault();
      var data = ev.dataTransfer.getData("text");
      var img = document.createElement("img");
      img.src = data;
      ev.target.appendChild(img);
    }
  </script>
</head>
<body>
  <div id="dropzone" ondrop="drop(event)" ondragover="allowDrop(event)">
    <p>Drop an image here</p>
  </div>
  <img src="https://www.w3schools.com/html/img_logo.gif" draggable="true" ondragstart="drag(event)" width="336" height="69">
</body>
</html>
