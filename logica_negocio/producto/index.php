<?php include '../../layouts/header.php'; ?>
<!-- C3 charts css -->
<link href="../../public/plugins/c3/c3.min.css" rel="stylesheet" type="text/css" />
<link href="../../public/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
 <link href="../../public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<?php include '../../layouts/headerStyle.php'; ?>
<style>
    
    div#registrar_producto {
        cursor: pointer;
    }
    .error_modificado li.parsley-required {
        position: absolute;
        margin-top: 42px;
        margin-left: -330px;
    }
</style>
<body class="fixed-left">

    <?php include '../../layouts/loader.php'; ?>

    <!-- Begin page -->
    <div id="wrapper">

    <?php include '../../layouts/navbar.php'; ?>

        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <?php include '../../layouts/topbar.php'; ?>
                 

                <!-- ==================
                     PAGE CONTENT START
                     ================== -->

                <div class="page-content-wrapper">

                    <div class="container-fluid">


                            <div class="row">
                            <div class="col-md-4 col-xl-4" >
                         
                            </div>

                            <div class="col-md-4 col-xl-4" id="registrar_producto">
                                <div class="mini-stat clearfix bg-white">
                                    <span class="mini-stat-icon bg-blue-grey mr-0 float-right"><i class="fas fa-gem"></i></span>
                                    <div class="mini-stat-info">
                                        <span class="counter text-blue-grey">Registrar</span>
                                        Nuevo producto
                                    </div>
                                    <div class="clearfix"></div>
                                     
                                </div>
                            </div>
                            
                               <div class="col-md-4 col-xl-4" >
                         
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card m-b-20">
                                    <div class="card-body" id="datos_tabla">
 

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->          

                    </div><!-- container -->

                </div> <!-- Page content Wrapper -->

            </div> <!-- content -->

            <?php include '../../layouts/footer.php'; ?>

            <!-- aca las modales-->
   
            <div class="modal fade" id="md_registrar_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro nuevo producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      
                     <form name="formulario_registro" id="formulario_registro">
                        <input type="hidden" id="ingreso_datos" name="ingreso_datos" value="si_registro">
                        <input type="hidden" id="llaveproducto" name="llaveproducto" value="si_registro">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" autocomplete="off" name="nombre" data-parsley-required-message="El nombre es requerido" id="nombre" class="form-control" required placeholder="Nombre del producto"/>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Stock</label>
                                <input type="number" autocomplete="off" name="stock" data-parsley-required-message="El stock es requerido" id="stock"  min="1"class="form-control" required placeholder="Ingrese su stock"/>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Precio</label>
                                <input  type="text" autocomplete="off" name="precio" data-parsley-required-message="Campo  requerido" id="precio" min="1" class="form-control" required placeholder="1.50"/>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Dimension</label>
                                <input type="text" autocomplete="off" name="dimension" data-parsley-required-message="Campo  requerido"  id="dimension" class="form-control" required placeholder="Ingrese su dimension"/>
                              </div>
                            </div>


                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Categoria</label>
                                <select id="idcategoria" name="idcategoria" class="form-control select2">

                                    <option value="20212614265800000058-2" >Figuras de Anime</option>

                                </select>               
                              </div>
                            </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Color</label>
                                <select id="color" name="color" class="form-control select2">

                                    <option value="1" >Multicolor</option>
                                    <option value="2" >Blanco y negro</option>

                                </select>               
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Material</label>
                                <select id="material" name="material" class="form-control select2">

                                    <option value="1" >Madera</option>
                                    <option value="2" >Acero</option>
                                    <option value="2" >Plastico</option>

                                </select>               
                              </div>
                            </div>

                          </div>
                     
                  </div>
                  <div class="modal-footer">
                    <button type="button"  class="btn btn-secondary btn_cerrar_class">Cerrar</button>
                    <button type="submit" id="boton_enviar"  class="btn btn-primary">Guardar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->


<?php include '../../layouts/footerScript.php'; ?>

    <!-- Peity chart JS -->
    <script src="../../public/plugins/peity-chart/jquery.peity.min.js"></script>

    <!--C3 Chart-->
    <script src="../../public/plugins/d3/d3.min.js"></script>
    <script src="../../public/plugins/c3/c3.min.js"></script>

    <!-- KNOB JS -->
    <script src="../../public/plugins/jquery-knob/excanvas.js"></script>
    <script src="../../public/plugins/jquery-knob/jquery.knob.js"></script>

    <!-- Page specific js -->
    <script src="../../public/assets/pages/dashboard.js"></script>

    <!-- Required datatable js -->
    <script src="../../public/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../public/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="../../public/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="../../public/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="../../public/plugins/datatables/jszip.min.js"></script>
    <script src="../../public/plugins/datatables/pdfmake.min.js"></script>
    <script src="../../public/plugins/datatables/vfs_fonts.js"></script>
    <script src="../../public/plugins/datatables/buttons.html5.min.js"></script>
    <script src="../../public/plugins/datatables/buttons.print.min.js"></script>
    <script src="../../public/plugins/datatables/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="../../public/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="../../public/plugins/datatables/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="../../public/assets/pages/datatables.init.js"></script>
        
    <!-- App js -->
    <script src="../../public/assets/js/app.js"></script>
    <script src="../../public/plugins/select2/js/select2.min.js"></script>
    

    
    
    <script src="../../public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <script src="funciones_producto.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>