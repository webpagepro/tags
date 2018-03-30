

<div class="col-sm-7 col-sm-offset-3 col-md-21 col-md-offset-2 main">

<h3>Asset Category</h3>
 <table class="table table-striped table-responsive">

    <form class="form-horizontal" action="index.php" method="post" id="asset_edit_form">
        <input type="hidden" name="action" value="asset_edit" />

     <input type="hidden" name= "aid" value="<?=$asset_id;?>" />
        <tr>Current Category:&nbsp;&nbsp;<?=$category_name; ?></tr>


        <tr>
               <th>Code:&nbsp;&nbsp;</th> <th><?=$ass_id; ?></th>
    <tr>
         <input type="hidden" name="aid" value="<?=$ass_id;?>" />
           <tr><th>Select:&nbsp;&nbsp;</th>
          <td>  <select name="cid">
          <?php foreach ( $categories as $category ) : ?>
              <option value="<?=$category['category_id']; ?>">
                  <?=$category['category_name']; ?>
              </option>

          <?php endforeach; ?>
        </select>   </td> </tr>
         <tr>
                <th>&nbsp;</th>
              <td> <input type="submit" value="Submit" class="btn btn-primary pull-right"/> </td>

      </tr>
    </form>

 </table>


</div>
