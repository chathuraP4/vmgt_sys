<?php $this->load->view('admin/partials/admin_header.php'); ?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Vehicle Model</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="row">
            <div class="col-md-7 col-sm-7 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>All Models</h2>
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
                                    <th>Type</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th style="width:20% ;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $x = 0;
                                foreach ($models as $t) {

                                    echo "<tr>";
                                    echo "<td>$t->id</td>";
                                    echo "<td>$t->type</td>";
                                    echo "<td>$t->brand_name</td>";
                                    echo "<td>$t->model</td>";
                                    echo "<th>";
                                    echo "<button class='btn btn-warning btn-xs'  onclick='editmodel(" . $t->id . ")' >Edit</button>";
                                    echo "<button class='btn btn-danger btn-xs'  onclick='deletemodel(" . $t->id . ")'>Delete</button>";
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
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Add New Models</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <fieldset>
                            <div class="form-group">
                                    <label for="type_id"> Type:</label>
                                    <?= $types ?>
                                </div>
                                <div class="form-group">
                                    <label for="brand_id"> Brand:</label>
                                    <select id="brand_id"name='brand_id' class="form-control">
                                        <option value="0">SELECT BRAND </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="model_id">Model Id:</label>
                                    <input class="form-control" name="model_id" id="model_id" type="text" value='<?= $max_no ?>' readonly required>
                                    <input class="form-control" name="hid" id="hid" type="hidden" value="0">
                                </div>
                                <div class="form-group">
                                    <label for="model_name">Model Name:</label>
                                    <input class="form-control" name="model_name" id="model_name" type="text" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary" id="send_form">Add Brand</button>
                                </div>
                            </fieldset>
                        </div>
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
                Brand_id: {
                    required: true
                },
                Brand_name: {
                    required: true
                }
            },
            messages: {

                firsName: {
                    required: "Please provide a valid model Id",
                },
                lastName: {
                    required: "Please provide a valid model Name ",
                }

            },
            submitHandler: function(form) {
                $.ajax({
                    url: "<?php echo base_url('admin/Vehi_model/create') ?>",
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

    function editmodel(id) {
        $.ajax({
            url: "<?php echo base_url('admin/Vehi_model/edit_model') ?>",
            type: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                $("#hid").val(response.success[0]['id']);
                $("#model_id").val(response.success[0]['id']);
                $("#model_name").val(response.success[0]['model']);
                $("#send_form").html('Update model');
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

    function deletemodel(id) {
        if (confirm('Are you Sure ?')) {
            $.ajax({
                url: "<?php echo base_url('admin/Vehi_model/delete_model') ?>",
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

    $("#type_id").change(function(){
        $.ajax({
                url: "<?php echo base_url('admin/Vehi_model/select_brand') ?>",
                type: "POST",
                data: {
                    id: $(this).val()
                },
                dataType: "json",
                success: function(response) {
                    $("#brand_id").html(response.success);
                },
                error: function(response) {
                    swal({
                        title: 'Oops! Your work not success!',
                        icon: 'error',
                        dangerMode: true,
                    });
                }
            });
    });
</script>