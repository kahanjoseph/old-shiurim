<?php
    $folders = json_encode(getList('shiurim'));
  ?>
  <div div class="container-fluid">
    <div class="row">
      <div class="col-md-6 p-5" id="main-content">
        <h1>Add Folder</h1>
  <form>
  <div class="form-group">
    <label for="exampleFormControlInput1">URL of category</label>
    <input type="text" class="form-control" id="urlOfCategory" placeholder="URL of category" required  name="url">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Name of category</label>
    <input type="text" class="form-control" id="nameOfCategory" placeholder="Name of category" name="title" required>
  </div>
  <div class="form-group">
    <label for="levelSelector">Folder Type</label>
    <select class="form-control" id="levelSelector" name="level">
      <option value="2">Child</option>
      <option value="1">Parent</option>
    </select>
  </div>

  <div class="form-group" id="parentSelectorGroup">
    <label for="parentSelector">Select Parent</label>
    <select class="form-control" id="parentSelector" name="parent">
    </select>
  </div>
</form>
  <div class="row"><div class="col-lg-6"><button class="btn btn-success btn-lg btn-block " id="addButton">Add Folder</button></div></div>
      </div>
      <div class="col-md-6 p-5 border-left border-primary" id="side-content">
        <h1>Edit Folder</h1>
        <div class="form-group" id="selectEditUI">
            <label for="editSelector">Select Folder</label>
            <select class="form-control" id="editSelector"  name="level">
            </select>
        </div>
        <div><div class="form-group">
            <label for="editURL" class="text-warning">URL of category</label>
            <input type="text" class="form-control" id="editURL" required placeholder="URL of category" name="url">
        </div>
        <div class="form-group">
            <label for="editName" class="text-warning">Name of category</label>
            <input type="text" class="form-control" id="editName" placeholder="name of category" required  name="title">
        </div>
        <div class="row">
            <div class="col-lg-6 pb-2 pb-lg-0"><button type="button" class="btn btn-warning btn-block btn-lg" id="edit-page">Edit Folder</button></div>
            <div class="col-lg-6"><button type="button" class="btn btn-danger btn-block btn-lg" id="delete-page">Delete Folder</button></div>
        </div>
      </div>
    </div>
  </div>
  <div id="div1"></div>
  <div id="hiddenDiv" style="display:none;"></div>
<script>
  (function(folders){
    'use strict';
    console.log(folders);
    //Populate parent & edit selectors

    function populateSelects(this_folders){
        this_folders.forEach(element => {
            $('#editSelector').append('<option value="' + element.id + '">' + element.title + '</option>');
            if(element.level === '1'){
                $('#parentSelector').append('<option value="' + element.id + '">' + element.title + '</option>');
            }
        });
    };

    function updateEditFields(){
        $.getJSON("<?=$file_padder?>/utils/getFolder.php", {item: $("#editSelector").val()}, (result)=>{
            $('#editURL').val(result['url']);
            $('#editName').val(result['title']);
            console.log(result);
        });
    }

    $( document ).ready(function() {
        populateSelects(folders);
        updateEditFields();
    });

    //Hiding parent selector
    $("#levelSelector").change(function(){
        $("#parentSelectorGroup").toggleClass('hidden_selector');
        if($("#levelSelector").val() === '1'){
            $("#parentSelector").val($("#parentSelector option:first").val());
        }
    });

    //Loading Item to edit
    $("#editSelector").change(()=>{
        if($("#editSelector").val() !== ''){
            updateEditFields();
        }
    });

    //Sending data to database
    $("#addButton").click(function(){
        if($('#nameOfCategory').val() !== ''){
            $.ajax({url: "<?=$file_padder?>/utils/addCategory.php", data: $("form").serialize(), success: function(result){
                $('#editSelector').empty();
                $('#parentSelector').empty();
                $('#hiddenDiv').html(result);
                populateSelects(JSON.parse(result));
                //Clearing Form
                $('#nameOfCategory').val('');
                $('#urlOfCategory').val('');
            }});
        }
    });

    //Edit Folder
    $('#edit-page').click(()=>{
        if($('#editName').val() !== ''){
            $.getJSON("<?=$file_padder?>/utils/editFolder.php", {title: $('#editName').val(), url: $('#editURL').val(), id : $('#editSelector').val()}, function(result){
                $('#editSelector').empty();
                $('#parentSelector').empty();
                $('#editURL').val('');
                $('#editName').val('');
                populateSelects(result);
                updateEditFields();
            });
        }
    })

    //Open delete modal
    $('#delete-page').click(()=>{
        $.fancybox.open('<div class="message"><h2>Are You sure you want to delete</h2><h3 class="">"' + $('#editSelector option:selected').text() + '"?</h3><img class="centered-img" src="<?=$file_padder?>/media/download (2).png">' +
            `<div class="row">
                <div class="col-sm-6 pb-2 pb-md-0"><button type="button" class="btn btn-success btn-block btn-lg" id="dont-delete">No</button></div>
                <div class="col-sm-6"><button type="button" class="btn btn-danger btn-block btn-lg" id="yes-delete">Delete Folder</button></div>
            </div></div>`
        )
    })

    //Delete
    $('body').on('click', '#yes-delete', () => {
        $.getJSON("<?=$file_padder?>/utils/getFolderList.php", (result)=>{
            if (!result.some(e => e.parent === $("#editSelector").val())) {
                $.get("<?=$file_padder?>/utils/deleteFolder.php", {item: $("#editSelector").val()}, ()=>{
                    for( var i = 0; i < result.length; i++){
                        if ( result[i].id === $("#editSelector").val()) {
                            result.splice(i, 1);
                        }
                    }
                    $('#editURL').val('');
                    $('#editName').val('');
                    $('#editSelector').empty();
                    $('#parentSelector').empty();
                    $.fancybox.close();
                    populateSelects(result);
                });
            }else{
                $.fancybox.close();
                $.fancybox.open('<div class="message"><h2>You can\'t delete a folder that has children.</h2></div>');
            }
        })
    });

    $('body').on('click', '#dont-delete', () => {
        $.fancybox.close();
    });
  }(JSON.parse('<?=$folders?>')));
</script>