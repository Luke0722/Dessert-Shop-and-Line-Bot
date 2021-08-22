<?php @session_start();
header("Content-Type:text/html;charset=utf-8");
 include_once 'update_admin.php';

if(!isset($_SESSION['aId']) || !isset($_SESSION['Account']) || !isset($_SESSION['Password'])){
	header("location: login.php");
}

 $result = mysqli_query($db_link, "SELECT * FROM admin");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>荻瑟特 BE</title>
<link type='text/css' rel='stylesheet' href="../general.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- New -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

</head>
<body>
<?php include('header.php'); ?>
 <br>
 <br>
    <div class="container">
    <div class="row">
        <div class="col-md-12">
          <div class="center title">
            <h2 style="text-align: center; ">Manage Admin</h2>
            <hr class="short">
          </div>
        </div>
      </div>
        <div class="table-wrapper">
        <div id="table-scroll">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
      <h2>Manage <b>Admin</b></h2>
     </div>
     <div class="col-sm-6">
     <button type="button" id = "openAdd" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addAdmin"><i class="material-icons">&#xE147;</i><span>Add New Employee</span></bottom>
 
     </div>
                </div>
   </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Account</th>
                        <th>Authority</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
    <?php
                while($row = mysqli_fetch_array($result))
                {
                ?>
     <tr id = "<?php echo $row['aId']; ?>">
      <td data-target = "aId"><?php echo $row["aId"]; ?></td>
      <td data-target = "aName"><?php echo $row["aName"]; ?></td>
      <td data-target = "aAccount"><?php echo $row["aAccount"]; ?></td>
      <td data-target = "rName"><?php echo $row["rName"]; ?></td>
      <td>
       <a href = "#" data-role = "update" data-id = "<?php echo $row['aId']; ?>"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
       <a href = "update_admin.php?del=<?php echo $row['aId']; ?>" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
      </td>
     </tr>
                <?php 
                    } 
                ?>
    <?php
    
     // close connection database
     mysqli_close($db_link);
                ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
 <!-- Edit Modal HTML -->  
 <div id="addAdmin" class="modal fade"  tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
   <div class="modal-content">
     <div class="modal-header">      
      <h4 class="modal-title">Add Admin</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">  
     <form method="post" action="update_admin.php">   
      <div class="form-group">
       <label>Name</label>
       <input type="text" class="form-control" name="aName" placeholder="Enter name" required>
      </div>
      <div class="form-group">
       <label>Account</label>
       <textarea class="form-control" name="aAccount" placeholder="Enter  Account" required></textarea>
      </div> 
      <div class="form-group">
       <label>Password</label>
       <textarea class="form-control" name="aPassword" placeholder="Enter Password" required></textarea>
      </div> 
      <div class="form-group">
       <label>Authority</label>
       <select class="form-select form-select-sm" id = "rName" aria-label=".form-select-sm example" name="rName">
            <option value="一般管理員">一般管理員</option>
            <option value="進階管理員">進階管理員</option>
       </select>
      </div> 
     </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <input type="submit" class="btn btn-success" name="add" value="Add">
     </div>
    </form>
   </div>
  </div>
 </div>
 <!-- Edit Modal HTML -->
 <div id="edit" class="modal fade">
  <div class="modal-dialog">
   <div class="modal-content">
    <form>
     <div class="modal-header">      
      <h4 class="modal-title">Edit Admin</h4>
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>     
     <div class="modal-body">     
      <div class="form-group">
       <label>Name</label>
       <input type="text" class="form-control" id = "aName" name = "aName" required>
      </div>
      <div class="form-group">
       <label>Account</label>
       <textarea class="form-control" id = "aAccount" name = "aAccount" required></textarea>
      </div>
      <div class="form-group">
       <label>Authority</label>
       <?php if ($_SESSION['authority'] == "一般管理員"){
           echo "<select id = 'rName'  onchange='changeText(this.value)' class='form-select form-select-sm' aria-label='.form-select-sm example' name='rName' disabled>";
           echo "<option value='' selected disabled hidden>沒有權限</option>";
           echo "<option value='一般管理員'>一般管理員</option>";
           echo "<option value='進階管理員'>進階管理員</option>";
           echo "</select>";}
           else{
            echo "<select id = 'rName'  onchange='changeText(this.value)' class='form-select form-select-sm' aria-label='.form-select-sm example' name='rName'>";
            echo "<option value='' selected disabled hidden>Choose here</option>";
            echo "<option value='一般管理員'>一般管理員</option>";
            echo "<option value='進階管理員'>進階管理員</option>";
            echo "</select>";
           }
       ?>    
      </div> 
      <input type="hidden" id ="userId" class = "form-control">
     </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
        <a href = "#" id = "save" type="submit" name="save" class="btn btn-success">Save</a>
     </div>
    </form>
   </div>
  </div>
 </div>

 <script>

    $(document).ready(function(){
        
        //關閉就重新整理
        $('#edit').on('hidden.bs.modal', function () {
            location.reload();
        });
        

        //回傳對應資料到編輯室窗中
        $(document).on('click', 'a[data-role = update]', function(){
           var id = $(this).data('id');
           var aName = $('#'+id).children('td[data-target = aName]').text();
           var aAccount = $('#'+id).children('td[data-target = aAccount]').text();
           var rName = $('#'+id).children('td[data-target = rName]').text();

           $("#id").val(id);
           $("#aName").val(aName);
           $("#aAccount").val(aAccount);
           $("#rName").val(rName);
           $("#userId").val(id);
           $("#edit").modal('toggle');
        });

        //select選項 changed
        $("select").change(function () {
          var rName = $(this).find(":selected").val();

        //get data from 編輯室窗
        $('#save').click(function(){
            var id = $('#userId').val();
            var aName = $("#aName").val();
            var aAccount = $("#aAccount").val();
            
            $.ajax({
                url: 'update_admin.php',
                method: 'POST',
                data: {aName: aName, aAccount: aAccount, rName: rName, id: id},
                success: function(response){
                    //頁面update
                    $('#'+id).children('td[data-target = aName]').text(aName);
                    $('#'+id).children('td[data-target = aAccount]').text(aAccount);
                    $('#'+id).children('td[data-target = rName]').text(rName);

                    $('#edit').modal('toggle');

                }
            })
        });  
      });

    });
    </script>
    
</body>
<?php include("footer.php"); ?>
</html>      
<style>
    body {
        color: #566787;
  background: #f5f5f5;
  font-family: 'Varela Round', sans-serif;
  font-size: 16px;
 }

 #table-scroll {
  height:450px;
  overflow:auto;  
  font-size: 14px;
}
 .table-wrapper {
        background: #fff;
        padding: 20px 25px;
        border-radius:1px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.247);
    }
 .table-title {        
  padding-bottom: 15px;
  padding: 16px 30px;
  border-radius: 1px 1px 0 0;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.247);
    }
    .table-title h2 {
  margin: 5px 0 0;
  font-size: 24px;
 }
 .table-title .btn-group {
  float: right;
 }
 .table-title .btn {
  color: #fff;
  float: right;
  font-size: 13px;
  border: none;
  min-width: 50px;
  border-radius: 1px;
  border: none;
  outline: none !important;
  margin-left: 10px;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.247);
 }
 .table-title .btn i {
  float: left;
  font-size: 21px;
  margin-right: 5px;
 }
 .table-title .btn span {
  float: left;
  margin-top: 2px;
 }
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
  padding: 12px 15px;
  vertical-align: middle;
    }
 table.table tr th:first-child {
  width: 60px;
 }
 table.table tr th:last-child {
  width: 100px;
 }
    table.table-striped tbody tr:nth-of-type(odd) {
     background-color: #fcfcfc;
 }
 table.table-striped.table-hover tbody tr:hover {
  background: #f5f5f5;
 }
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    } 
    table.table td:last-child i {
  opacity: 0.9;
  font-size: 22px;
        margin: 0 5px;
    }
 table.table td a {
  font-weight: bold;
  color: #566787;
  display: inline-block;
  text-decoration: none;
  outline: none !important;
 }
 table.table td a:hover {
  color: #2196F3;
 }
 table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #F44336;
    }
    table.table td i {
        font-size: 19px;
    }
 table.table .avatar {
  border-radius: 1px;
  vertical-align: middle;
  margin-right: 10px;
 }
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 1px !important;
        text-align: center;
        padding: 0 6px;
    }
    .pagination li a:hover {
        color: #666;
    } 
    .pagination li.active a, .pagination li.active a.page-link {
        background: #03A9F4;
    }
    .pagination li.active a:hover {        
        background: #0397d6;
    }
 .pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }    
 /* Modal styles */
 .modal .modal-dialog {
  max-width: 400px;
 }
 .modal .modal-header, .modal .modal-body, .modal .modal-footer {
  padding: 20px 30px;
 }
 .modal .modal-content {
  border-radius: 1px;
 }
 .modal .modal-footer {
  background: #ecf0f1;
  border-radius: 0 0 1px 1px;
 }
    .modal .modal-title {
        display: inline-block;
    }
 .modal .form-control {
  border-radius: 1px;
  box-shadow: none;
  border-color: #dddddd;
 }
 .modal textarea.form-control {
  resize: vertical;
 }
 .modal .btn {
  border-radius: 1px;
  min-width: 100px;
 } 
 .modal form label {
  font-weight: normal;

 } 
</style>                            