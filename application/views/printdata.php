<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Pagination with Search Filter in CodeIgniter</title>
  
    <style type="text/css">
    a {
     padding-left: 5px;
     padding-right: 5px;
     margin-left: 5px;
     margin-right: 5px;
    }
    </style>
  </head>
  <body>

   <!-- Search form (start) -->
   <form method='get' action="<?= base_url() ?>index.php/wel/loadRecord" >
     <input type='text' name='search' value='<?= $search ?>'>
     <input type='text' name='first' value='<?= $search ?>' placeholder="FirstName">
     <input type='text' name='last' value='<?= $search ?>' placeholder="LastName"><input type='submit' name='submit' value='Submit'>
     <a href="<?php echo base_url('wel/index');?>">Clear</a>
        </form>
   <br/>

   <!-- Posts List -->
   <table border='1' width='100%' style='border-collapse: collapse;'>
    <tr>
      <th>Sno.</th>
      <th>First</th>
      <th>Last</th>
      <th>Action</th>
    </tr>
    <?php
    $sno = $row+1;
    $i=0;
    foreach($result as $data){
    ?>

      <tr>
        <td><?php echo $sno;?></td>
        <td><?php echo $data['first_name'];?></td>
        <td><?php echo $data['last_name'];?></td>
        <td><a class="badge badge-success" href="<?php echo base_url('wel/update/'.$result[$i]['id']); ?>">Update</a></td>
      </tr>


    <?php
      $sno++;
      $i++;

    }
    if(count($result) == 0){
      echo "<tr>";
      echo "<td colspan='3'>No record found.</td>";
      echo "</tr>";
    }
    ?>
   </table>

   <!-- Paginate -->
   <div style='margin-top: 10px;'>
   <?= $pagination; ?>
   </div>

 </body>
</html>