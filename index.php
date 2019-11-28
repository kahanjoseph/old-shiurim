<?php
$file_padder = "/shiurim";
require_once('vendor/autoload.php');
require_once('included.php');

require_once('utils/dropboxApp.php');

//$temporaryLink = $dropbox->getTemporaryLink("id:ztXlu8ZnaDAAAAAAAAAHGg");

require_once("UI/header.php");
//echo "<pre>"; var_dump($items); echo "</pre>";

//echo "<br><br>";
?>
<div class="container">
  <div class="row">
    <div id="audioContainer" class="mt-5 col"><!--?=dropboxAudios($items, $dropbox);?--> </div>
</div>
</div>
<?php
//$cursor = $listFolderContents->getCursor();
//$audios = [];
require_once("utils/mainJs.php");
require_once("UI/footer.php"); 
?>