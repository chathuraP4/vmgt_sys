<?php $this->load->view('admin/partials/admin_header.php'); ?>
<style type="text/css">
    .error {
        color: #d92550;
        padding-top: 10px;
    }
</style>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>ALL VEHICALS</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <hr>
        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> Add A new Vehicle</a>

        <div class="row">
            <form class="needs-validation" enctype="multipart/form-data" id="ajax_form" method="POST" action="javascript:void(0)">
                <div class="col-md-8 col-md-offset-2">
                    <div class="collapse" id="collapseExample">
                        <fieldset>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Vehicle Type</label>
                                    <select class="form-control" name="vtype" id="vtype">
                                        <?= $vtypes ?>
                                    </select>
                                </div>
                                <div class="col-xs-6">
                                    <label>Vehicle brand</label>
                                    <select class="form-control" name="vbrand" id="vbrand">
                                        <option class='dropdown-item option1' value=''>SELECT BRAND</option>
                                    </select>
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Vehicle Model</label>
                                    <select class="form-control" name="vmodel" id="vmodel">
                                        <option class='dropdown-item option1' value=''>SELECT MODEL</option>
                                    </select>
                                </div>
                                <div class="col-xs-6">
                                    <label>Vehicle Category</label>
                                    <select class="form-control" name="category">
                                        <option value=''>SELECT CATEGOORY</option>
                                        <option value="Subcompact">Subcompact</option>
                                        <option value="Compact">Compact</option>
                                        <option value="Mid-size">Mid-size</option>
                                        <option value="Full-size">Full-size</option>
                                        <option value="Mini-Van">Mini-Van</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Fuel Type</label>
                                    <select class="form-control" name="fuel_type" id="fuel_type">
                                        <option value=''>SELECT FUEL TYPE</option>
                                        <option value="Petrol">Petrol</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Electric">Electric</option>
                                    </select>
                                </div>
                                <div class="col-xs-6">
                                    <label for="mileage">Mileage:</label>
                                    <input type="text" step="any" class="form-control" name="mileage" placeholder="Mileage(km)" required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Selling Price</label>
                                    <input type="number" step="any" class="form-control" name="sell_price" placeholder="Selling Price" required>
                                </div>
                                <div class="col-xs-6">
                                    <label>Buying Price</label>
                                    <input type="number" step="any" class="form-control" name="b_price" placeholder="Buying Price" required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="gear">Gear Type:</label>
                                    <select name="gear" id="gear" class="form-control">
                                        <option value="auto">Auto</option>
                                        <option value="manual">Manual</option>
                                    </select>
                                </div>

                                <div class="col-xs-6">
                                    <label>Engine Number</label>
                                    <input class="form-control" name="e_no" placeholder="Engine Number" required>
                                </div>

                            </div>

                            <br>

                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Chassis Number</label>
                                    <input class="form-control" name="c_no" placeholder="Chassis Number" required>
                                </div>
                                <div class="col-xs-6">
                                    <label>Add Date</label>
                                    <input type="Date" class="form-control" name="add_date" value="<?php echo date("Y-m-d"); ?>">
                                </div>

                            </div>

                            <br>

                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Color</label>
                                    <input type="text" class="form-control" name="colors" placeholder="Colors" required>
                                </div>
                                <div class="col-xs-6">
                                    <label>Sold Date</label>
                                    <input type="date" class="form-control" name="sold_date" value="<?php echo date("Y-m-d"); ?>">
                                </div>

                            </div>
                            <br>

                            <div class="row">
                                <div class="col-xs-6">
                                    <label>No of Doors</label>
                                    <input type="number" class="form-control" name="doors" placeholder="No of Doors" required>
                                </div>
                                <div class="col-xs-6">
                                    <label>Registration Year</label>
                                    <input type="number" class="form-control" name="registration_year" placeholder="Registration Year (YYYY)" value="<?php echo date("Y"); ?>">
                                </div>

                            </div>

                            <br>

                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Insurance ID</label>
                                    <input type="number" class="form-control" name="insurance_id" placeholder="Insurance ID" required>
                                </div>
                                <div class="col-xs-6"><label>No of seats</label>
                                    <input type="number" class="form-control" name="seats" placeholder="No of seats" required>
                                </div>

                            </div>
                            <br>

                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Image</label>
                                    <input name="file" id="file" type="file" class="form-control-file" accept="image/*" required>
                                </div>
                                <div class="col-xs-6">
                                    <label>Tank Capacity</label>
                                    <input type="number" step="any" class="form-control" name="tank" placeholder="Tank Capacity(litters)" required>
                                </div>
                            </div>
                            <br>
                            <div class="row">

                                <div class="col-xs-6">
                                    <label for="gear">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="available">Available</option>
                                        <option value="not available">Not Available</option>

                                    </select>
                                </div>
                            </div>
                            <br>
                            <button type="submit" name="submit" class="btn btn-primary" id="send_form">Add New Vehicle</button>

                        </fieldset>
                        <br>
                    </div>

                </div> <!-- /row -->
            </form>

            <!-- all models -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>All Car Models</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Type</th>
                                        <th>Brand</th>
                                        <th>Model</th>
                                        <th>Category</th>
                                        <th>Mileage</th>
                                        <th>Fuel Type</th>
                                        <th>Selling Price</th>
                                        <th>Color</th>
                                        <th>Add date</th>
                                        <th>Reg Year</th>
                                        <th>Gears</th>
                                        <th>Doors</th>
                                        <th>Seats</th>
                                        <th>Engine No</th>
                                        <th>Chasis No</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Type</th>
                                        <th>Brand</th>
                                        <th>Model</th>
                                        <th>Category</th>
                                        <th>Mileage</th>
                                        <th>Fuel Type</th>
                                        <th>Selling Price</th>
                                        <th>Color</th>
                                        <th>Add date</th>
                                        <th>Reg Year</th>
                                        <th>Gears</th>
                                        <th>Doors</th>
                                        <th>Seats</th>
                                        <th>Engine No</th>
                                        <th>Chasis No</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($vehicles as $vehicle) : ?>

                                        <tr class="<?php if ($vehicle['status'] != "available") echo 'danger';
                                                    else echo 'success' ?>">

                                            <td><?php echo $vehicle['vehicle_id']; ?></td>
                                            <td><?php echo $vehicle['type']; ?></td>
                                            <td><?php echo $vehicle['brand']; ?></td>
                                            <td><?php echo $vehicle['model']; ?></td>
                                            <td><?php echo $vehicle['category']; ?></td>
                                            <td><?php echo $vehicle['mileage']; ?></td>
                                            <td><?php echo $vehicle['fuel_type']; ?></td>
                                            <td><?php echo $vehicle['selling_price']; ?></td>
                                            <td><?php echo $vehicle['color']; ?></td>
                                            <td><?php $date = new DateTime($vehicle['add_date']);
                                                echo $date->format('m/d/Y'); ?></td>
                                            <td><?php echo $vehicle['registration_year']; ?></td>
                                            <td><?php echo $vehicle['gear']; ?></td>
                                            <td><?php echo $vehicle['doors']; ?></td>
                                            <td><?php echo $vehicle['seats']; ?></td>
                                            <td><?php echo $vehicle['engine_no']; ?></td>
                                            <td><?php echo $vehicle['chesis_no']; ?></td>
                                            <td width="100">
                                                
                                                <img class="img-responsive" src="<?php echo $vehicle['image']; ?>">
                                            </td>
                                            <td><?php if ($vehicle['sold_date'] === NULL) {
                                                    echo 'Not Sold';
                                                } else {
                                                    $date = new DateTime($vehicle['sold_date']);
                                                    echo $date->format('m/d/Y');
                                                } ?></td>
                                            <td>
                                                <?php if ($vehicle['status'] == "available") : ?>
                                                    <?php echo form_open('admin/vehicles/sell/'); ?>
                                                    <input type="hidden" name="vehicle_id" value="<?php echo $vehicle['vehicle_id']; ?>">
                                                    <button class="btn btn-xs btn-success" type="submit" name="btn-sell">Sell</button>
                                                    </form>
                                                <?php endif ?>

                                                <?php if ($this->session->userdata('type') == "admin") : ?>

                                                    <?php echo form_open('admin/Vehicles/DeleteVehicle/'); ?>
                                                    <input type="hidden" name="vehicle_id" value="<?php echo $vehicle['vehicle_id']; ?>">
                                                    <button onclick="return confirm('Records of this Vehicle will be deleted, continue?')" class="btn btn-xs btn-danger" type="submit" name="btn-delete">Delete</button>
                                                    </form>
                                                <?php endif; ?>
                                            </td>

                                            

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div> <!-- /content -->
                    </div><!-- /x-panel -->
                </div> <!-- /col -->
            </div> <!-- /row -->
            <!-- Sweet alert msg  -->
            <div class="form-row">
                <div id="msg_div">
                    <span id="res_message">
                    </span>
                </div>
            </div>

            <!--  -->

        </div>
    </div> <!-- /.col-right -->
    <!-- /page content -->

    <?php $this->load->view('admin/partials/admin_footer.php'); ?>



    <?php if ($this->session->flashdata('message') != NULL) : ?>
        <script>
            swal({
                title: "Success",
                text: "<?php echo $this->session->flashdata('message'); ?>",
                type: "success",
                timer: 1500,
                showConfirmButton: false
            });
        </script>
    <?php endif ?>

    <script src="<?php echo base_url("assets/vendors/datatables.net/js/jquery.dataTables.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/vendors/datatables.net-buttons/js/buttons.flash.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/vendors/datatables.net-buttons/js/buttons.html5.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/vendors/datatables.net-buttons/js/buttons.print.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"); ?>"></script>
    <script src="<?php echo base_url("assets/vendors/datatables.net-scroller/js/datatables.scroller.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/vendors/jszip/dist/jszip.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/vendors/pdfmake/build/pdfmake.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/vendors/pdfmake/build/vfs_fonts.js"); ?>"></script>


    <script>
        $(document).ready(function() {
            var handleDataTableButtons = function() {
                if ($("#datatable-responsive").length) {
                    $("#datatable-responsive").DataTable({
                        aaSorting: [
                            [0, 'desc']
                        ],

                        dom: "Blfrtip",
                        buttons: [{
                                extend: "copy",
                                className: "btn-sm",
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ,14, 15,  17]
                                }
                            },
                            {
                                extend: "csv",
                                className: "btn-sm",
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ,14, 15,  17]
                                }
                            },
                            {
                                extend: "excel",
                                className: "btn-sm",
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ,14, 15,  17]
                                }
                            },
                            {
                                extend: "pdf",
                                className: "btn-sm",
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ,14, 15,  17]
                                }
                            },
                            {
                                extend: "print",
                                className: "btn-sm",
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ,14, 15,  17]
                                }
                            },
                        ],
                        responsive: true,
                    });
                }
            };

            TableManageButtons = function() {
                "use strict";
                return {

                    init: function() {
                        handleDataTableButtons();
                    }
                };
            }();

            TableManageButtons.init();
        });
    </script>
    

    <?php if ($this->session->flashdata('message') != NULL) : ?>
        <script>
            
            swal({
                title: "Success",
                text: "<?php echo $this->session->flashdata('message'); ?>",
                type: "success",
                showConfirmButton: true
			  
            
            });
        </script>
    <?php endif ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



    <script type="text/javascript">
        $("#vtype").change(function() {
            $.ajax({
                url: "<?php echo base_url('admin/Vehicles/load_brands') ?>",
                type: "POST",
                data: {
                    type: $(this).val()
                },
                dataType: "json",
                success: function(response) {
                    $("#vbrand").html(response.data);

                },
                error: function(response) {
                    alert(JSON.stringify(response));
                }
            });
        });


        $("#vbrand").change(function() {
            $.ajax({
                url: "<?php echo base_url('admin/Vehicles/load_models') ?>",
                type: "POST",
                data: {
                    brand: $(this).val()
                },
                dataType: "json",
                success: function(response) {
                    $("#vmodel").html(response.data);

                },
                error: function(response) {
                    alert(JSON.stringify(response));
                }
            });

        });



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
                    vtype: {
                        required: true
                    },
                    vbrand: {
                        required: true
                    },
                    vmodel: {
                        required: true
                    },
                    category: {
                        required: true
                    },
                    mileage: {
                        required: true
                    },
                    b_price: {
                        required: true
                    },
                    gear: {
                        required: true
                    },
                    e_no: {
                        required: true
                    },
                    c_no: {
                        required: true
                    },
                    add_date: {
                        required: true
                    },
                    doors: {
                        required: true
                    },
                    add_date: {
                        required: true
                    },
                    registration_year: {
                        required: true
                    },
                    insurance_id: {
                        required: true
                    },
                    seats: {
                        required: true
                    },
                    tank: {
                        required: true
                    },
                    featured: {
                        required: true
                    },
                },
                messages: {

                    vtype: {
                        required: "Please Select a Type",
                    },
                    vbrand: {
                        required: "Please Select a Brand",
                    },
                    vmodel: {
                        required: "Please Select a Model",
                    },
                    category: {
                        required: "Please Select a Category",
                    }

                },
                submitHandler: function(form) {
                    var data = new FormData($("#ajax_form")[0]);
                    $.ajax({
                        url: "<?php echo base_url('admin/Vehicles/create') ?>",
                        type: "POST",
                        data: data,
                        dataType: "json",
                        processData: false,
                        contentType: false,
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
    </script>