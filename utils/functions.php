<?php
    //Check if string contains value from array
    function contains($str, array $arr)
    {
        foreach($arr as $a) {
            if (stripos($str,$a) !== false) return true;
        }
        return false;
    }

    function dropboxAudios($items, $dropbox){
        $file_extensions = ['.mp3', '.m4a'];
        if(empty($items)){
            echo "<h1>No Results</h1>";
        }else{
            foreach ($items as $value){
                if(contains($value->name, $file_extensions))
                {
                try {
                        echo '<div class="alert alert-secondary"><h4>'. substr($value->name, 0, -4) .'</h4><p>'.substr($value->client_modified, 0, -10).'</p>';
                        echo '<audio controls><source src="' . $dropbox->getTemporaryLink($value->id)->link . '" type="audio/mpeg"></audio></div>';
                    } catch (Exception $e) {
                        echo 'Caught exception: ',  $e->getMessage(), "\n";
                    }
                }
            }
        }
    }
?>
<script>
</script>