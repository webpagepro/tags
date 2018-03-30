<?php

class CategoryDB
{
  private $server = '';
private $user = '';
private $pass = '';
private $dbase = '';
 private $db; private $cdb;
  public $error_message;

  function __construct(){
        $this->cdb = new mysqli($this->server, $this->user, $this->pass, $this->dbase);
        // $error_message = self::cbd->connect_error;
         if($this->error_message != NULL)
         {
             include '../errors/db_error_connect.php';
             exit;
         }
         if(!$this->cdb){ echo "CategoryDB - NOT CONNECTED"; }
        else{
           // echo "CategoryDB - CONNECTED";
            }
         return $this->cdb;
 }


public function get_categories()
    {
      //$db = $this->cdb; //new Database();
       $query = 'SELECT * FROM categories ORDER BY category_id';
       $result = $this->cdb->query($query);

    if ($result == false) {
           print_r($this->cdb->error);
       }

  return $result;
}


public function get_category_name($category_id)
 {
   //global $db;
   $this->cdb = new CategoryDB();
  //$category_name = array();

   $query = "SELECT * FROM categories WHERE category_id = $category_id";
   // $result = $db->query($query);
      $result = $cdb->query($query);

     if($result == false)
       {
          print_r($cdb->error);
          exit;
       }

   $category = $result->fetch_assoc();
   $category_name = $category['category_name'];
   return $category_name;

 }

public function edit_category($cid, $cname)
  {

    $query = 'UPDATE categories
          SET categories.category_name = ?
          WHERE categories.category_id = ?';

    $stmt = $db->prepare($query);

    if($stmt != false)
    {
      $stmt->bind_params("si", $cname, $cid);
      $result = $stmt->execute();
    }

    else
    {
        print_r($db->error);
    }
}

public function get_category($category_id)
{
//  $this->sql = $this->cdb; //$cdb = new Database();
  $sql = new Database();
   $query = "SELECT * FROM categories
             WHERE category_id = $category_id";
  // $stmt = $cdb->prepare($category_id);

 $category = $sql->ExecuteQuery($category_id);
   # code...
   //break;

  //$stmt->excecute();
  // $category->free();
   return $category;
}

function get_category_name_from_categories($category_id)
{
   $db = new Database();
    //global $db;
   // $category_name = array();
    $query = "SELECT category_name FROM categories WHERE category_id = $category_id";
  //  $result = $db->query($query);
  $result = $db->ExecuteQuery($query);
   if($result == false)
      {
           print_r($db->error);
           exit;
      }

  //  $category = $result->fetch_assoc();
  //  $category_name = $category['category_name'];
    return $result;//$category_name;
  }

public function add_category($name)
{
  $db = $this->cdb;
     $query = "INSERT INTO categories
              (category_name)
              VALUES('$name')";
     $stmt = $db->prepare($query);
     $stmt->bind_param('i',$_POST['asset_id']);
     $stmt->execute();
   $stmt->close();

 }

 public function delete_category($category_id)
 {
     $db = $this->cdb;
     $q = "DELETE FROM categories WHERE category_id = ? LIMIT 1";
     $stmt = $db->prepare($q);
     $stmt->bind_param('i', $category_id);
     $stmt->execute();
     $stmt->close();
}

/****************************************************************/
 public function category_lookup($category_id)
 {
   $db = $this->cdb; //new CategoryDB();
 //4lobal $db;
 //$db = new Database();
   $q = "SELECT cta.category_id, cta.attribute_id
         FROM category_to_attributes cta
         WHERE cta.category_id = $category_id
         GROUP BY cta.attribute_id
         ORDER BY cta.attribute_id ASC";
        $attributes = array();
        $result = $this->cdb->query($q);//$result = $db->query($q);
    for ($i = 0; $i<$result->num_rows; $i++)
      {
           $attribute = $result->fetch_assoc();
           $attributes[] = $attribute;
      }

     return $attributes;//$attributes;
 }

 //public function category_attributes

 public function get_category_id_by_asset($id)
 {
  // $db = $this->cdb;
  $q = "SELECT category_id FROM assets WHERE asset_id = $id";
  //$stmt = $this->db->prepare($q);

//  $stmt->bind_param("i", $id);
  if( $result = $this->cdb->query($q))
  {
     $category_id[] = $result;


    return $category_id;
//  //while($stmt->fetch())
  }

//  }
//  $stmt->close();
//}
  }



}
 ?>
