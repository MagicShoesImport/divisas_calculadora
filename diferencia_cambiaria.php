<?php
//Activamos el almacenamiento en el buffer


?>
<!--==================================================================================================================-->
<style>
   label {
            color: white;
        }
        
        .dataTables_info {
            color: white; /* Cambiar el color a blanco */
        }


/*Estilos CSS para colocar (placeholder Bs.) en los campos*/
.input-container {
  position: relative;
}
.currency-symbol {
  position: absolute;
  left: 10px;
  top: 10px; 
  pointer-events: none; /* Para que la clase no interfiera con el input */
  color: #888; /* Color del símbolo */
  transition: opacity 0.2s; /* Animación suave */
}
.form-control:focus + .currency-symbol,
.form-control:not(:placeholder-shown) + .currency-symbol {
  opacity: 0.5; /* Cambia la opacidad al enfocar*/
}

</style>
<section class="content">
  <div class="container-fluid">



    <!--==---------------------------------------------------------------------------------==-->
    <div class="card card-primary" id="card_header" style="margin-bottom: 2px;">
      <div class="card-header">
        <b>Diferencia Cambiaria</b>
  <button class="btn btn-danger float-right" onclick="limpiar();">
                    <i class="fa fa-eraser"></i>Limpiar
                </button>
        </div>
      </div>
    </div>

    <!--==---------------------------------------------------------------------------------==-->


    <!--========================================== Tabla ==========================================-->
    <div class="container-fluid" id="tabla">
      <div class="row">
        <div class="col-12">
          <div class="card" id="listadoregistros">
 <form role="form" name="formularioREG_EDIT" id="formularioREG_EDIT" method="POST">
            <div class="card-body" id="contenedorDatatable" style="background:  #243443 ;">
        <!--======== Campos ocultos ========-->
        <input type="hidden" name="id_diferencia" id="id_diferencia" class="form-control" readonly> 
  <div class="row">
  <div class="form-group col-md-2 col-xs-12">
    <label>Tasa BCV</label>
  
     <div class="input-container">
      <span class="currency-symbol">Bs.</span>
      <input type="text" name="tasabcv" id="tasabcv" class="form-control" 
      onpaste="manejarPegado(event)" >

    </div>
  </div>
 <div class="form-group col-md-2 col-sm-6 col-xs-1">
    <label>Banco a retirar</label>
    <select name="metodo_retiro_bancario" id="metodo_retiro_bancario" class="form-control" >
      <option value="">Seleccione el Metodo de Retiro Bancario</option>
      <option value="0,0">Banesco</option>
      <option value="1,25">Bancamiga</option>
      <option value="1,5">BNC/Bco.Tesoro</option>

    </select>
  </div>
  <div class="form-group col-md-2 col-sm-6 col-xs-1">
    <label>Metodo de Retiro</label>
    <select name="metodo_retiro" id="metodo_retiro" class="form-control" onchange="mostrarTasaCambio()">
      <option value="">Seleccione el Metodo de Retiro</option>
      <option value="3,1">Wally</option>
      <option value="3,8">Zinli</option>
      <option value="6,3">Kontigo</option>
      <option value="3,81">Efectivo</option>
    </select>
  </div>

 <div class="form-group col-md-2 col-xs-12" id="tasaCambioContainer" style="display: none;">
    <label>Tasa de Cambio</label>

     <div class="input-container">
      <span class="currency-symbol">$</span>
      <input type="text" name="tasa_cambio" id="tasa_cambio" class="form-control" 
      onpaste="manejarPegado(event)" >

    </div>
  </div>

  <div class="form-group col-md-2 col-sm-6 col-xs-1">
    <label>Tasa de Venta $</label>
     <div class="input-container">
      <span class="currency-symbol">$</span>
      <input type="text" name="tasaventa" id="tasaventa" class="form-control" 
      onpaste="manejarPegado(event)" >

    </div>
  </div>

  <div class="form-group col-md-1 col-xs-12 d-flex align-items-end">
    <button type="button" class="btn btn-primary btn-sm" onclick="CalcularDiferencia()">Calcular Diferencia</button>
  </div>
</div>

<!-- Contenedor para mostrar los resultados -->
  <div class="row">
<div id="resultados" ></div>
<div class="form-group col-md-3 col-sm-6 col-xs-1">
    <label>% Total de Retiro</label>
  
    <div class="input-container">
     
      <input type="text" name="porcentaje_total" id="porcentaje_total" class="form-control" 
      onpaste="manejarPegado(event)" readonly >

    </div>
</div>

<div class="form-group col-md-3 col-sm-6 col-xs-1">
    <label>Tasa Final Compra</label>
  
    <div class="input-container">
     
      <input type="text" name="tasa_final_compra" id="tasa_final_compra" class="form-control" 
      onpaste="manejarPegado(event)" readonly >

    </div>
</div>
 <div class="form-group col-md-3 col-sm-6 col-xs-1">
    <label>Diferencia en Bs</label>
    
<div class="input-container">
    
      <input type="text" name="diferenciabs" id="diferenciabs" class="form-control" 
      onpaste="manejarPegado(event)" readonly >

    </div>

</div>

<div class="form-group col-md-3 col-sm-6 col-xs-1">
    <label>Brecha Profit en %</label>
  
    <div class="input-container">
     
      <input type="text" name="brecha_porcentaje" id="brecha_porcentaje" class="form-control" 
      onpaste="manejarPegado(event)" readonly >

    </div>
</div>


</div>

<hr>


 <div class="row">
  <div class="form-group col-md-2 col-sm-6 col-xs-1">
    <label>Cant $ Comprados</label>
    
     <div class="input-container">
      <span class="currency-symbol">$</span>
      <input type="text" name="cant_comprado" id="cant_comprado" class="form-control" 
      onpaste="manejarPegado(event)"   >

    </div>
  </div>

  <div class="form-group col-md-2 col-sm-6 col-xs-1">
    <label>Cant Bs Invertidos</label>
   

     <div class="input-container">
   
      <input type="text" name="cant_bs_comprado" id="cant_bs_comprado" class="form-control" 
      onpaste="manejarPegado(event)" onblur="CalcularInvRecibido()"  >

    </div>
  </div>

<div class="form-group col-md-2 col-sm-6 col-xs-1">
    <label>$ Final Recibido</label>

     <div class="input-container">
    
      <input type="text" name="dolares_final_recibido" id="dolares_final_recibido" class="form-control" 
      onpaste="manejarPegado(event)"  readonly>

    </div>
</div>

<div class="form-group col-md-2 col-sm-6 col-xs-1">
    <label>Bs Final Inv en $</label>

     <div class="input-container">
    
      <input type="text" name="bs_final_inv" id="bs_final_inv" class="form-control" 
      onpaste="manejarPegado(event)"  readonly>

    </div>
</div>

  <div class="form-group col-md-2 col-sm-6 col-xs-1">
    <label>Brecha % Profit Neto</label>

     <div class="input-container">
    
      <input type="text" name="resultado1" id="resultado1" class="form-control" 
      onpaste="manejarPegado(event)"  readonly>

    </div>
</div>

<div class="form-group col-md-2 col-sm-6 col-xs-1">
    <label>Ganancias en $</label>


     <div class="input-container">
           <input type="text" name="resultado2" id="resultado2" class="form-control" 
      onpaste="manejarPegado(event)" readonly >

    </div>
</div>

  <div class="form-group col-md-2 col-sm-6 col-xs-1">
    <label>Ganancias en Bs</label>


     <div class="input-container">
           <input type="text" name="resultado3" id="resultado3" class="form-control" 
      onpaste="manejarPegado(event)" readonly >

    </div>
</div>
   <div class="form-group col-md-1 col-xs-12 d-flex align-items-end">
    <button type="button" class="btn btn-success btn-sm" onclick="CalcularGanancia()">Calcular Ganancia</button>
  </div>


</div>


</form>

   

              </div>
            </div>   
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Fin Contenido PHP-->
  <?php
  require 'footer.php';
  ?>

  <script type="text/javascript" src="scripts/diferencia_cambiaria.js<?php echo '?r='.date('Y-m-d H:i:s');?>"></script>

  <?php 
  ob_end_flush();
?>
