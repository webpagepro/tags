<pre>
<?php

class Database
{
    // server info
private $server = 'localhost';
private $user = '';
private $pass = '';
private $dbase = '';

private $sql; 

	 function __construct()
   {
	        $this->sql = new mysqli($this->server, $this->user, $this->pass, $this->dbase);
          $error_message = $this->sql->connect_error;
          if($error_message != NULL)
          {
              include '../errors/db_error_connect.php';
              exit;
          }
     }

public function display_db_error($error_message)
    {
        global $app_path;
        include '../../errors/db_error.php';
    }

public function ExecuteQuery($Q, $IO = false)
 {
                //Store sql variable locally
                $sql = $this->sql;
                //init results array and store them after executing the sql query
                $results_array = array();
                $result = $sql->query($Q);
                //If there is no expected array of results, just return the $result (true or false depending if it worked!)

                if($IO)
                {
                     return $result;
                }

                else{
                        //if query was successful, store and return the results
                        if($result)
                        {
                                while ($row = $result->fetch_assoc())
                                {
                                    $results_array[] = $row;
                                }
                                return $results_array;
                        }

                        else{
                                //not successful, return nothing
                                return null;
                        }
                }
    }

    public function tags($Q)
    {
        $sql = $this->sql;
        $result = $sql->query($Q);

        if(! $Q)
        {
           return NULL;
        }

        while($row = $result->fetch_assoc())
        {
           $id[] = $row;
        }

        return $id;

    }
  /*      if($I0)
        {
              return false;
        }

      else if($code)
        {
           if($result->num_rows == 0)
           {
               $category_id = 99;
             $default = "----------";

          }

        }

      */

      function get_asset($asset_id)
      {
          $sql = $this->sql;
          $query = "SELECT * FROM assets WHERE asset_id = '$asset_id'";
          $stmt = $sql->query($query);
          if ($stmt == false)
          {
              display_db_error($sql->error);
          }

            $asset = $stmt->fetch_assoc();
            return $asset;
      }







    //called when object is deleted - close sql connection
    public function __destruct(){
                $this->sql->close();
        }

        /*
          function insertAssets($asset_id, $category_id)
           {
                  $sql=$this->sql;

                  $query = "INSERT INTO assets(asset_id, category_id)
                  VALUES($asset_id, $category_id)";
                  if($row = $sql->query($query))
                  {
                     $result = $row->asset_id;
                  }
                   return $result;
            }
        */




}



//connect to the database
//$conn = new Database();
//if($conn)
//{echo "connected";}
//echo "<br>";
//$query = "SELECT * FROM assets";


  //print_r($db);


// show errors (remove this line if on a live site)
//mysqli_report(MYSQLI_REPORT_ERROR);


/*
// server info
$server = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'leads';

// connect to the database
$mysqli = new mysqli($server, $user, $pass, $db);

// show errors (remove this line if on a live site)
mysqli_report(MYSQLI_REPORT_ERROR);
*/
?>
</pre>
