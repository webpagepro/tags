function get_assets($category_id)
{
     global $db;
     $attributes = array();
     $sql = "SELECT a.asset_id, a.category_id, ata.attribute_id, attr.attribute_name, ata.attribute_value
                                                   FROM asset_to_attributes ata
                                                   JOIN assets a
                                                   ON a.asset_id = ata.asset_id
                                                   JOIN attributes attr
                                                   ON ata.attribute_id = attr.attribute_id
                                                   WHERE a.category_id = $category_id
                                                   ORDER BY a.asset_id ASC";

    $result = $db->query($sql);

    if($result == FALSE)
      {
         display_db_error($db->error);
         exit;
      }
    $attribute_cnt = category_lookup($category_id);
    $cnt = count($attribute_cnt);

   $assets = array();

    while($row = $result->fetch_assoc())
    {
              $asset_id = $row['asset_id'];
              $attribute_name = $row['attribute_name'];
              $attribute_value = $row['attribute_value'];

              if(! isset($assets[$asset_id]))
              {
                  $assets[$asset_id] = array();

                  $assets[$asset_id]['attributes'] =  array();
            }

            $assets[$asset_id]['attributes'][$attribute_name] = $attribute_value;



  //    echo "==============================<pre>";
      }  //  print_r($assets); echo "<br>";
      //  echo "===============================</pre>";
        return $assets;


}