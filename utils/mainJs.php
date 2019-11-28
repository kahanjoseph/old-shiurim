<script>
(function(){
    'use strict';

    // $( document ).ready(function() {
    //     $.ajax({
    //         url: "<?=$file_padder?>/utils/getDropboxFiles.php", 
    //         data: {}, 
    //         beforeSend: function(){
    //             $("#audioContainer").html('<img id="loading-img" src="' + <?=json_encode($file_padder)?> + '/media/gif-animations-replace-loading-screen-14.gif">');
    //         },
    //         error: function(xhr,status,error){
    //             console.log(xhr);
    //             console.log(status);
    //             console.log(error);
    //             $("#audioContainer").html('<p>'+status+'</p><p>'+error+'</p><h3>There was a error loading the files</h3>');
    //         },
    //         success: function(xhr){
    //             $("#audioContainer").html(xhr);
    //         }
    //     });
    // });

    $('.dropboxItem').each(function(){
        var that = this;
        $(that).click(function(){
            $("#audioContainer").empty();
            try {
                $.ajax({
                    url: "<?=$file_padder?>/utils/getDropboxFiles.php", 
                    data: {url : $(that).attr('dropboxurl').replace(new RegExp(".*dropbox.com/home"),'').replace('%20', ' ')}, 
                    beforeSend: function(){
                        $("#audioContainer").html('<img id="loading-img" src="' + <?=json_encode($file_padder)?> + '/media/Material-Loading-Animation.gif">');
                    },
                    error: function(xhr,status,error){
                        console.log(xhr);
                        console.log(status);
                        console.log(error);
                        $("#audioContainer").html('<p>'+status+'</p><p>'+error+'</p><h3>There was a error loading the files</h3>');
                    },
                    success: function(xhr){
                        $("#audioContainer").html(xhr);
                    }
                });
                // $.get("<!--?=$file_padder?-->/utils/getDropboxFiles.php", {url : $(that).attr('dropboxurl')}, function(data){
                //     $("#audioContainer").html(data);
                // });
            } catch (error) {
                console.error(error);
                $("#audioContainer").html(error);
            }           
        })
    });

    $('#searchAudios button').click(function(){
        console.log($('#searchAudios input').val());
        $("#audioContainer").empty();
        try {
            $.ajax({
                url: "<?=$file_padder?>/utils/getDropboxFiles.php", 
                data: {search : $('#searchAudios input').val()}, 
                beforeSend: function(){
                    $("#audioContainer").html('<img id="loading-img" src="' + <?=json_encode($file_padder)?> + '/media/Material-Loading-Animation.gif">');
                },
                success: function(xhr){
                    $("#audioContainer").html(xhr);
                }
            });
            // $.get("<!--?=$file_padder?-->/utils/getDropboxFiles.php", {search : $('#searchAudios input').val()}, function(data){
            //     $("#audioContainer").html(data);
            // });
        } catch (error) {
            console.error(error);
        }
    });
}())
</script>
<?php

?>