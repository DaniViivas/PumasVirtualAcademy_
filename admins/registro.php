<?php
function frm_agregar_usuario() {
    include_once '../clases/clase_usuario.php';

    $html = '
    <div class="formdata">
        <div class="col-12" style="text-align: center; box-shadow: 5px 1px 12px -4px rgba(0,0,0,0.5); border: 1px solid black;">
            <h4>Gestión de Usuarios</h4>
          
            <form id="formularioUsuarios" name="formularioUsuarios" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="nombreUsuario" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="Usuario" name="Usuario" placeholder="Ingrese su usuario" required>
                    </div>
                 
             
                    <div class="col-12">
                        <label for="passwordUsuario" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="clave" name="clave" placeholder="Ingrese su contraseña" required>
                    </div>
       
                    <div class="col-12">
                        <button style="width: 20%;" class="btn btn-success" type="button" onclick="fnc_guardarUsuario();">Guardar</button>  
                        <input type="hidden" id="casofrm" name="casofrm" value="casoguardarUsuario">
                        <input type="hidden" id="idu" name="idu" value="">
                    </div>
                </div>
            </form>
        </div> 
        <div class="col-12" style="text-align: center; box-shadow: 5px 1px 12px -4px rgba(0,0,0,0.5); border: 1px solid black;">  
            <h4>Usuarios Registrados</h4>
            <div> 
                <table id="tbl_usuario" class="" style="width:100%; border: 1px solid black;">
                    <thead style="background: #BCC7D1;">
                        <tr>
                            <th>N.</th>
                            <th>usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';

    $usuario = new clase_usuario();
    $usuarios = $usuario->getUsuarios();
    $i = 1;
    foreach ($usuarios as $val) {
        $html .= '<tr>
                    <td>' . $i . '</td>
                    <td>' . $val['usuario'] . '</td>
                    <td>
                        <button type="button" class="btn-success" onclick="cargarInfoUsuario(' . $val['id_usuario'] . ')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 4 13H3a.5.5 0 0 1-.354-.854z"/>
                            </svg>
                        </button>
                        <button type="button" class="btn-outline-danger" onclick="eliminarUsuario(' . $val['id_usuario'] . ')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 .5.5V6h1.5a.5.5 0 0 1 .5.5v.5a.5.5 0 0 1-.5.5H13v6a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7h-.5a.5.5 0 0 1-.5-.5v-.5a.5.5 0 0 1 .5-.5H5V5.5zM4.5 2a.5.5 0 0 1 .5-.5H11a.5.5 0 0 1 .5.5V3h1a1 1 0 0 1 1 1v1h-1.5a.5.5 0 0 1-.5.5H5.5a.5.5 0 0 1-.5-.5H3V4a1 1 0 0 1 1-1h1.5V2z"/>
                            </svg>
                        </button>
                    </td>
                </tr>';
        $i++;
    }
    
    $html .= '</tbody>
                </table>
            </div>
        </div>
    </div>';
    
    echo $html;
}