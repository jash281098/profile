<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php echo validation_errors();
 ?>

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
         <script type = "text/javascript" src = "https://code.jquery.com/jquery-3.3.1.min.js"></script>
         <script type = "text/javascript" src = "https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.min.js"></script>
        <script type="text/javascript" src = "<?php echo base_url();?>js\validate.js"></script>
    
    </head>
    <body>
    <form method="post" id="form" action="">
        <img src="<?php echo base_url(); ?>img\<?php echo $resul->image ; ?>" class="form-control" style="width:200px ;height:200px;">
        <input type="file" id="avatar" name="avatar"
        class="form-control col-md-2" accept="image/png, image/jpeg">
        <h2>Personal Details</h2>
        <div class="form-row">
            <div class="form-group col-md-6 ">
                <label for="first">Firstname</label>
                <input type="text" class="form-control" id="first" name="first" value="<?php echo $resul->first_name;?>" placeholder="FIRST">
            </div>

             <div class="form-group col-md-6">   
        	   <label for="last">lastname</label>
                <input type="text"class="form-control"  id="last" name="last" value="<?php echo $resul->last_name;?>" placeholder="LAST">
            </div>
        </div>

        <div class="form-group">
    	   <label for="num">Contact</label>
            <input type="number" class="form-control" id="num" value="<?php echo $resul->mobile;?>" name="num" >
        </div>

        <div class="form-group">
    	<label for="alt">Alt-Contact</label>
            <input type="number" class="form-control" id=alt value="<?php echo $resul->secondary_mobile;?>" name="alt">
        </div>

        <div class="form-group">
    	   <label for="email">Primary Email-id</label>
            <input type="email" class="form-control" id="email" value="<?php echo $resul->email;?>" name="email">
        </div>

         <div class="form-group">
           <label for="email">Secondary Email-id</label>
            <input type="email" class="form-control" id="email" value="<?php echo $resul->secondary_email;?>" name="sec_email">
        </div>

        <h2>Address Details</h2>
    
        <div class="form-group">
           <label for="address">Address</label>
            <textarea name="address"   class="form-control"><?php echo $add->address_1;?></textarea>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
               <label for="">State</label>
               <select name="state" required  id="state" class="form-control">
                    <option value=""> Select State</option>
                   <?php
                   // echo print_r($state);exit;
                    foreach($state as $row){
                        //echo print_r($row);exit;
                        echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                        
                    }

                   ?>
               </select>
            </div>

            <div class="form-group col-md-4">
                <label for="">City</label>
                <select name="city" required id="city" class="form-control">
                    <option value=""> Select City</option>
                </select>
             </div>

            <div class="form-group col-md-4">
               <label for="pincode">Pin Code</label>
               <input type="num" name="pincode" value="<?php echo $add->pincode;?>" class="form-control">
            </div>
        </div>


    <input type="submit" class="btn btn-primary" name="submit">
    
</form>

   
       
        
         
        
        
    </body>    
</html>


<script >

    
    
    $('#state').change(function(){
        var state_id=$('#state').val();
        if(state_id!=''){
                $.ajax({
                    url:"<?php echo base_url();?>wel/fetch_city",
                    method:"post",
                    data:{state_id:state_id},
                    success:function(data){
                        $('#city').html(data);
                    }
                })
        }
    })
</script>