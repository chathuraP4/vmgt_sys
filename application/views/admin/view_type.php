<?php $this->load->view('admin/partials/admin_header.php'); ?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Type</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="row">
            <div class="col-md-7 col-sm-4 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>All Types</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width:20% ;">ID</th>
                                    <th>Name</th>
                                    <th style="width:20% ;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $x = 0;
                                foreach ($types as $t) {

                                    echo "<tr>";
                                    echo "<td>$t->id</td>";
                                    echo "<td>$t->type</td>";
                                    echo "<th>";
                                    echo "<button class='btn btn-warning btn-xs'  onclick='edittype(" . $t->id . ")' >Edit</button>";
                                    echo "<button class='btn btn-danger btn-xs'  onclick='deletetype(" . $t->id . ")'>Delete</button>";
                                    echo "</th>";
                                    echo "</tr>";
                                    $x++;
                                } ?>
                            </tbody>
                        </table>
                    </div> <!-- /content -->
                </div><!-- /x-panel -->
            </div> <!-- /col -->
            <form class="needs-validation" enctype="multipart/form-data" id="ajax_form" method="POST" action="javascript:void(0)">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Add New Types</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <fieldset>
                                <div class="form-group">
                                    <label for="type_id"> Type Id:</label>
                                    <input class="form-control" name="type_id" id="type_id" type="text" value='<?= $max_no?>' readonly required>
                                    <input class="form-control" name="hid" id="hid" type="hidden" value="0">
                                </div>
                                <div class="form-group">
                                    <label for="type_name"> Type Name:</label>
                                    <input class="form-control" name="type_name" id="type_name" type="text" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary" id="send_form">Add Type</button>
                                </div>
                            </fieldset>
            </form>
        </div> <!-- /content -->
    </div><!-- /x-panel -->
</div>
</div> <!-- /col -->
</div> <!-- /row -->
</div>
</div> <!-- /.col-right -->
<!-- /page content -->

<!-- Sweet alert msg  -->
<div class="form-row">
    <div id="msg_div">
        <span id="res_message">
        </span>
    </div>
</div>
<!--  -->


<?php $this->load->view('admin/partials/admin_footer.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
    // just for the demos, avoids form submit
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        //alert('fail');
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();


    if ($("#ajax_form").length > 0) {
        $("#ajax_form").validate({

            rules: {
                type_id: {
                    required: true
                },
                type_name: {
                    required: true
                }
            },
            messages: {

                firsName: {
                    required: "Please provide a valid Type Id",
                },
                lastName: {
                    required: "Please provide a valid Type Name ",
                }

            },
            submitHandler: function(form) {
                $.ajax({
                    url: "<?php echo base_url('admin/Vehi_Type/create') ?>",
                    type: "POST",
                    data: $('#ajax_form').serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            $('#res_message').html(response.msg);
                            $('#res_message').show();
                            var forms = document.getElementsByClassName('needs-validation');
                            form.classList.remove('was-validated');
                        } else {
                            $('#res_message').html(response.msg);
                            $('#res_message').show();
                        }
                    },
                    error: function(response) {
                        swal({
                            title: 'Oops! Your work not success!',
                            icon: 'error',
                            dangerMode: true,
                        });
                    }
                });
            }
        });
    }

    function edittype(id) {
        $.ajax({
            url: "<?php echo base_url('admin/Vehi_Type/edit_type') ?>",
            type: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                $("#hid").val(response.success[0]['id']);
                $("#type_id").val(response.success[0]['id']);
                $("#type_name").val(response.success[0]['type']);
                $("#send_form").html('Update Type');
            },
            error: function(response) {
                swal({
                    title: 'Oops! Your work not success!',
                    icon: 'error',
                    dangerMode: true,
                });
            }
        });
    }

    function deletetype(id) {
        if (confirm('Are you Sure ?')) {
            $.ajax({
                url: "<?php echo base_url('admin/Vehi_Type/delete_type') ?>",
                type: "POST",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        $('#res_message').html(response.msg);
                        $('#res_message').show();

                    } else {
                        $('#res_message').html(response.msg);
                        $('#res_message').show();
                    }
                },
                error: function(response) {
                    swal({
                        title: 'Oops! Your work not success!',
                        icon: 'error',
                        dangerMode: true,
                    });
                }
            });
        }
    }
</script>