<?php
    $grandParents = getList('shiurim', [1]);
    $parents = getList('shiurim', [2]);
  ?>
  <div div class="container">
    <div class="row">
      <div class="col-3 pt-3">
        <button type="button" class="btn btn-success btn-block btn-lg">Add Folder</button>
        <button type="button" class="btn btn-warning btn-block btn-lg">Edit Folder</button>
        <button type="button" class="btn btn-danger btn-block btn-lg">Delete Folder</button>
      </div>
      <div class="col-9">
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
    <select class="form-control" id="levelSelector"  name="level">
      <option value="3">GrandChild</option>
      <option value="2">Parent</option>
      <option value="1">Grandparent</option>  
    </select>
  </div>

  <div class="form-group" id="grandparentSelectorGroup">
    <label for="grandparentSelector">Select Grandparent</label>
    <select class="form-control" id="grandparentSelector">
      <?php
        foreach($grandParents as $value):
      ?>
        <option value="<?=$value['id']?>"><?=$value['title']?></option>
      <?php
        endforeach;
      ?>
    </select>
  </div>
  
  <div class="form-group" id="parentSelectorGroup">
    <label for="parentSelector">Select Parent</label>
    <select class="form-control"  id="parentSelector">
    <?php
        foreach($parents as $value):
      ?>
        <option value="<?=$value['id']?>"><?=$value['title']?></option>
      <?php
        endforeach;
      ?>
    </select>
  </div>

  <input type="hidden" name="parent" id="hiddenParent">
</form>
  <button class="btn btn-primary btn-lg" id="addButton">Add Category</button>
  <div id="div1"></div>
      </div></div></div>
<script>
  (function(){
    'use strict';
    $( "#levelSelector" ).change(function() {
        if ($.inArray($('#levelSelector').val(), ['2', '3']) >= 0) {
          $('#parentSelectorGroup').addClass('hidden_selector');
          if ($('#levelSelector').val() == 3) {
            $('#grandparentSelectorGroup').addClass('hidden_selector');
          }else{
            $('#grandparentSelectorGroup').removeClass('hidden_selector');
          }
        }else{
          $('#parentSelectorGroup').removeClass('hidden_selector');
          $('#grandparentSelectorGroup').removeClass('hidden_selector');
        }
    });

    //Setting value of hidden parent
    $("#parentSelector").change(function(){
      if($( "#levelSelector" ).val("3")){
        $("hiddenParent").val($("#parentSelector").val());
      }
    });
    $("#grandparentSelector").change(function(){
      if($( "#levelSelector" ).val("2")){
        $("#hiddenParent").val($("#grandparentSelector").val());
      }
    });

    //Sending data to database
    $("#addButton").click(function(){
      $.ajax({url: "<?=$file_padder?>/utils/addCategory.php", data: $("form").serialize(), success: function(result){
        $("#div1").html(result);
      }});
    });

  }());
</script>