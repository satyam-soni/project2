<?php
//checking the connection
require_once 'dtConnect.php';
 ?>

<!DOCTYPE html>
<html>
<head>
<title>DATA TABLE CRUD OPERATION</title>

    <!--link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.3/dt-1.10.19/b-1.5.4/sl-1.2.7/datatables.min.css"/>-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
      <div class="container">
      <div class="row">
      <div class="col-md-12">
<center>
      <font color="red">
      <h1><b><class="page-header">Employee Data</b></h1>
      </font>

</center>
<div class="removeMessages"></div>


<button type="button" class="btn btn-primary pull pull-right" data-toggle="modal" data-target="#addMember" id="addMemberModelButton">
<span class="glyphicon glyphicon-plus-sign">AddMember</span>
</button>

<br/>
<br/>
<br/>
        <table class="table" id="managememberTable">
          <thead>
            <tr>
                 <th>SNo.</th>
                 <th>Name</th>
                 <th>Address</th>
                 <th>Contact</th>
                 <th>Active</th>
                 <th>Option</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>


       <div class="modal" tabindex="-1" role="dialog" id="addMember">
       <div class="modal-dialog" role="document">
       <div class="modal-content">
       <div class="modal-header">
  <center>
          <h5 class="modal-title"><b>Employee Data</b></h5>
  </center>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
      </div>

            <form class="form-horizontal" action="create.php" method="post" id="createMemberForm">
            <div class="modal-body">
            <div class="messages"></div>




              <!--input ttpe="submit" name="submit" value="upload_file"/>
            </center>
              <!--img src="https://www.gettyimages.com/gi-resources/images/CreativeLandingPage/HP_Sept_24_2018/CR3_GettyImages-159018836.jpg" class="rounded mx-auto d-block" alt="...">-->


            <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
            </div>
            </div>
            <div class="form-group">
            <label for="address" class="col-sm-2 control-label">Address</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="address" name="address" placeholder="address">
            </div>
            </div>


            <div class="form-group">
            <label for="contact" class="col-sm-2 control-label">Contact</label>
            <div class="col-sm-10">
            <input type="number" class="form-control" id="contact" name="contact" placeholder="contact number" pattern="[7-9]{1}[0-9]{9}" autocomplete="off"
             oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
             maxlength = "10"  />
            <span id="messages" style="color:red"></span><br><br/>
            </div>
            </div>


            <div class="form-group">
            <label for="active" class="col-sm-2 control-label">Active</label>
            <div class="col-sm-10">
            <select class="form-control" name="active" id="active">
            <option value="">----SELECT-----</option>
            <option value="1">ACTIVE</option>
            <option value="2">INACTIVE</option>
        </div>
        </div>
      <div class="form-group form-check">
         <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Add Data</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
       </form>
      </div>
    </div>
  </div>



<!--remove action -->

<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Remove Member</h4>
  </div>
  <div class="modal-body">
  <p>Do you really want to remove ?</p>
  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <button type="button" class="btn btn-primary" id="removeBtn">Save changes</button>
  </div>
  </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove modal -->

<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>

</body>
</html>
<script>

// global the manage memeber table
var manageMemberTable;

$(document).ready(function() {
    manageMemberTable = $("#manageMemberTable").DataTable({
      "ajax": "php_action/retrieve.php",
"order": []
});

    $("#addMemberModalBtn").on('click', function() {
        // reset the form
        $("#createMemberForm")[0].reset();
        // remove the error
        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        // empty the message div
        $(".messages").html("");

        // submit form
        $("#createMemberForm").unbind('submit').bind('submit', function() {

            $(".text-danger").remove();

            var form = $(this);

            // validation
            var name = $("#name").val();
            var address = $("#address").val();
            var contact = $("#contact").val();
            var active = $("#active").val();

            if(name == "") {
                $("#name").closest('.form-group').addClass('has-error');
                $("#name").after('The Name field is required');
            } else {
                $("#name").closest('.form-group').removeClass('has-error');
                $("#name").closest('.form-group').addClass('has-success');
            }

            if(address == "") {
                $("#address").closest('.form-group').addClass('has-error');
                $("#address").after('The Address field is required');
            } else {
                $("#address").closest('.form-group').removeClass('has-error');
                $("#address").closest('.form-group').addClass('has-success');
            }

            if(contact == "") {
                $("#contact").closest('.form-group').addClass('has-error');
                $("#contact").after('The Contact field is required');
            } else {
                $("#contact").closest('.form-group').removeClass('has-error');
                $("#contact").closest('.form-group').addClass('has-success');
            }

            if(active == "") {
                $("#active").closest('.form-group').addClass('has-error');
                $("#active").after('The Active field is required');
            } else {
                $("#active").closest('.form-group').removeClass('has-error');
                $("#active").closest('.form-group').addClass('has-success');
            }

            if(name && address && contact && active) {
                //submi the form to server
                $.ajax({
                    url : form.attr('action'),
                    type : form.attr('method'),
                    data : form.serialize(),
                    dataType : 'json',
                    success:function(response) {

                        // remove the error
                        $(".form-group").removeClass('has-error').removeClass('has-success');

                        if(response.success == true) {
                            $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                             '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                             '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                            '</div>');

                            // reset the form
                            $("#createMemberForm")[0].reset();

                            // reload the datatables
                            manageMemberTable.ajax.reload(null, false);
                            // this function is built in function of datatables;
                        } else {
                            $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                             '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                             '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                            '</div>');
                        } // /else
                    } // success
                }); // ajax subit
            } /// if


            return false;
        }); // /submit form for create member
    }); // /add modal

});

// global the manage memeber table


function removeMember(id = null) {
    if(id) {
        // click on remove button
        $("#removeBtn").unbind('click').bind('click', function() {
            $.ajax({
                url: 'php_action/remove.php',
                type: 'post',
                data: {member_id : id},
                dataType: 'json',
                success:function(response) {
                    if(response.success == true) {
                        $(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                             '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                             '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                            '</div>');

                        // refresh the table
                        manageMemberTable.ajax.reload(null, false);

                        // close the modal
                        $("#removeMemberModal").modal('hide');

                    } else {
                        $(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                             '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                             '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                            '</div>');
                    }
                }
            });
        }); // click remove btn
    } else {
        alert('Error: Refresh the page again');
    }
}


function editMember(id = null) {
    if(id) {

        // remove the error
        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-danger").remove();
        // empty the message div
        $(".edit-messages").html("");

        // remove the id
        $("#member_id").remove();

        // fetch the member data
        $.ajax({
            url: 'update_member.php',
            type: 'post',
            data: {member_id : id},
            dataType: 'json',
            success:function(response) {
                $("#editName").val(response.name);

                $("#editAddress").val(response.address);

                $("#editContact").val(response.contact);

                $("#editActive").val(response.active);

                // mmeber id
                $(".editMemberModal").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

                // here update the member data
                $("#updateMemberForm").unbind('submit').bind('submit', function() {
                    // remove error messages
                    $(".text-danger").remove();

                    var form = $(this);

                    // validation
                    var editName = $("#editName").val();
                    var editAddress = $("#editAddress").val();
                    var editContact = $("#editContact").val();
                    var editActive = $("#editActive").val();

                    if(editName == "") {
                        $("#editName").closest('.form-group').addClass('has-error');
                        $("#editName").after('<p class="text-danger">The Name field is required</p>');
                    } else {
                        $("#editName").closest('.form-group').removeClass('has-error');
                        $("#editName").closest('.form-group').addClass('has-success');
                    }

                    if(editAddress == "") {
                        $("#editAddress").closest('.form-group').addClass('has-error');
                        $("#editAddress").after('<p class="text-danger">The Address field is required</p>');
                    } else {
                        $("#editAddress").closest('.form-group').removeClass('has-error');
                        $("#editAddress").closest('.form-group').addClass('has-success');
                    }

                    if(editContact == "") {
                        $("#editContact").closest('.form-group').addClass('has-error');
                        $("#editContact").after('<p class="text-danger">The Contact field is required</p>');
                    } else {
                        $("#editContact").closest('.form-group').removeClass('has-error');
                        $("#editContact").closest('.form-group').addClass('has-success');
                    }

                    if(editActive == "") {
                        $("#editActive").closest('.form-group').addClass('has-error');
                        $("#editActive").after('<p class="text-danger">The Active field is required</p>');
                    } else {
                        $("#editActive").closest('.form-group').removeClass('has-error');
                        $("#editActive").closest('.form-group').addClass('has-success');
                    }

                    if(editName && editAddress && editContact && editActive) {
                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
                            dataType: 'json',
                            success:function(response) {
                                if(response.success == true) {
                                    $(".edit-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                     '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                     '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                    '</div>');

                                    // reload the datatables
                                    manageMemberTable.ajax.reload(null, false);
                                    // this function is built in function of datatables;

                                    // remove the error
                                    $(".form-group").removeClass('has-success').removeClass('has-error');
                                    $(".text-danger").remove();
                                } else {
                                    $(".edit-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                                     '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                     '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                                    '</div>')
                                }
                            } // /success
                        }); // /ajax
                    } // /if

                    return false;
                });

            } // /success
        }); // /fetch selected member info

    } else {
        alert("Error : Refresh the page again");
    }
}


</script>
