<?php
// Define folder path
$folder = '../imagenes/Productos/';

// Get all files in the directory
$files = scandir($folder);

// Map files to their modification time
$files = array_combine($files, array_map(function($file) use ($folder) {
  return filemtime($folder . $file);
}, $files));

// Sort files by modification time in descending order
arsort($files);

// Get the name of the last modified file
$last_name = key($files);
$data = array(
    'name' => $files
);
$json_data = json_encode($data);
echo $json_data;
?>