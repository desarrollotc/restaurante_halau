<?php 
   require_once './config/APP.php'; 
   require_once './controllers/MenuController.php';
   $cons = new MenuController();
   $cons2 = $cons->Listar_menu_Controller();

   ?>
Menu vista

<table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Menú</th>
      <th scope="col">Precio</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Accion</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($cons2 as $value) { ?>
    <tr>
      <th scope="row" value="<?php print $value['id_menu'];?>"></th>
      <td><?php print $value['nombre_menu'];?></td>
      <td><?php print $value['precio_menu'];?></td>
      <td><?php print $value['cantidad_menu'];?></td>
      <td><span class="badge badge-sm bg-gradient-warning" onclick="ObtenerInfoCx($Value)">Gestionar</span></td>
    </tr>
    <?php } ?>
  </tbody>
</table>