<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clientes Ajax</title>
    <link href="<?php echo base_url('assests/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assests/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
  </head>

  <body>

  <div class="container">
    <h1>Clientes</h1>
    <br />
    <button class="btn btn-success" onclick="add_cliente()"><i class="glyphicon glyphicon-plus"></i>Agregar</button>
    <br />
    <br />
    <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
					<th>Registro</th>
					<th>Cedula</th>
					<th>Nombre</th>
					<th>Apellidos</th>
					<th>Telefono</th>

          <th style="width:125px;">Delete
          </p></th>
        </tr>
      </thead>

      <tbody>
			  <?php foreach($clientes as $cliente){?>
          <tr>
            <td><?php echo $cliente->registro;?></td>
            <td><?php echo $cliente->cedula;?></td>
            <td><?php echo $cliente->nombre;?></td>
            <td><?php echo $cliente->apellidos;?></td>
            <td><?php echo $cliente->telefono;?></td>
            <td>

            <button class="btn btn-danger" onclick="delete_cliente(<?php echo $cliente->registro;?>)"><i class="glyphicon glyphicon-remove"></i></button>

            </td>
          </tr>
				<?php }?>
       
      </tbody>

      
    </table>

  </div>

  <script src="<?php echo base_url('assests/jquery/jquery-3.1.0.min.js')?>"></script>
  <script src="<?php echo base_url('assests/bootstrap/js/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assests/datatables/js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assests/datatables/js/dataTables.bootstrap.js')?>"></script>


  <script type="text/javascript">
    $(document).ready( function () {
      $('#table_id').DataTable();
    } );

    var save_method; 
    var table;

    function add_cliente()
    {
      save_method = 'add';
      $('#form')[0].reset(); 
      $('#modal_form').modal('show'); 

    }

    function save()
    {
      var url;
      if(save_method == 'add')
      {
        url = "<?php echo site_url('cliente/cliente_add')?>";
      }

      // ajax adding data to database
      $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            //if success close modal and reload ajax table
            $('#modal_form').modal('hide');
          location.reload();// for reload a page
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert('Error al agregar');
        }
    });
    }

    function delete_cliente(id)
    {
      if(confirm('¿Esta seguro?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('cliente/cliente_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error al borrar');
            }
        });

      }
    }

  </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">cliente Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="registro"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Cedula</label>
              <div class="col-md-9">
                <input name="cedula" placeholder="Cedula" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Nombre</label>
              <div class="col-md-9">
                <input name="nombre" placeholder="Nombre" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Apellidos</label>
              <div class="col-md-9">
								<input name="apellidos" placeholder="Apellidos" class="form-control" type="text">

              </div>
            </div>
						<div class="form-group">
							<label class="control-label col-md-3">Telefono</label>
							<div class="col-md-9">
								<input name="telefono" placeholder="Telefono" class="form-control" type="text">

							</div>
						</div>

          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->

  </body>
</html>
