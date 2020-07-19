<?php
require_once '../connection.php';
?>
<form class="form-group">
    <?php 
      if($_SESSION[shu]=='site profile' || $_SESSION[shu]=='package' || $_SESSION[shu]=='package place' || $_SESSION[shu]=='assignvehiclename' || $_SESSION[shu]=='assignfoodtype'|| $_SESSION[shu]=='assignroomtype' || $_SESSION[shu]=='requesthotelconformation' || $_SESSION[shu]=='requesttaxiconformation' || $_SESSION[shu]=='packagebill' || $_SESSION[shu]=='custompackagebill' || $_SESSION[shu]=="assignamenities")
      {
      }
      else
     {
    ?>
         Search  : <input type="search" autocomplete="off" onkeyup="takedata('<?php echo $_SESSION[shu]; ?>','search',this.value);" name="search" placeholder="Search here" class="admin-form animated fadeInUp" />
    <?php 
    }
    ?>
</form>
