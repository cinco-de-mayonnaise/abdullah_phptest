<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pubs Viewer</title>
  </head>

  <?php 
    // init: connect to pubs database online
    $servername = "relational.fit.cvut.cz:3306";
    $username = "guest";
    $dbpassword = "relational";
    $dbname = "pubs";

    $pubs_inst = new mysqli($servername, $username, $dbpassword, $dbname);  // actual connecting here

    if ($pubs_inst->connect_error)  // check connection and stop if fail
    {
      die("Connection failed: " . $conn->connect_error);
    }

    // we are now ready to process statements.
  ?>

  <body>
    <h1>PUBS Data Viewer</h1>
    <p>With the power of the internet, we can now access the pubs database remotely (as long as you have internet lul). </p>

    <div>
      <form method="post">
        <textarea name="querystring" placeholder="Enter a SELECT Query"> </textarea> 
        <button type="submit" >Send Query</button>
      </form>
    </div>
    <br>

    <?php 
      $q = $_POST['querystring'];
      if ($q)  
      {
        // s is our sql query that we send to be processed by the sql server
        // prepared query should be unnecessary since the query is gonna be given by the end-user anyway, no substitutions or anything are happening here,
        //$s = $pubs_inst->prepare($q);
        //$s->bind_param();

        $result = $pubs_inst->query($q);

        if ($result->num_rows > 0)  // the query returned something, display it...
        {
          // start generating a table sheesh
          echo '<table border="1">';
          $columns = array();
          $resultset = array();
          while ($row = $result->fetch_assoc()) {
              if (empty($columns)) {
                  $columns = array_keys($row);
                  echo '<tr><th>'.implode('</th><th>', $columns).'</th></tr>';      // im not even gonna pretend i understand this part, stackoverflow ftw https://stackoverflow.com/questions/1853094/how-to-get-the-columns-names-along-with-resultset-in-php-mysql
              }
              $resultset[] = $row;
              echo '<tr><td>'.implode('</td><td>', $row).'</td></tr>';
          }
          echo '</table>';
        }
        else
        {
          echo "<p><b>The query did not return anything. </b></p>";
        }
      }
      // don't do anything if its empty.
    ?>

    <!-- Example table that we wanna emulate-->
     <!-- <table border="1">
      <tr>
        <th>Company</th>
        <th>Contact</th>
        <th>Country</th>
      </tr>
      <tr>
        <td>Alfreds Futterkiste</td>
        <td>Maria Anders</td>
        <td>Germany</td>
      </tr>
      <tr>
        <td>Centro comercial Moctezuma</td>
        <td>Francisco Chang</td>
        <td>Mexico</td>
      </tr>
    </table>  -->
  </body>
</html>