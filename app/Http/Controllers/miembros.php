<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\MiembrosIglesia;


class miembros extends Controller
{
    
    
    public function busqueda(Request $request) {
        $busqueda = $request->all();
        $busqueda = $busqueda['valor'];
        $prueba = MiembrosIglesia::busqueda($busqueda);
        return response()->json(['success' => $prueba]);
    }
    
    

    public function list() {

        $_aMiembros = MiembrosIglesia::list();        
        $_aMiembros = json_decode($_aMiembros);
        return view('miembros')->with('miembros',$_aMiembros);
    }
    public function miembroId($id) {
        
        $_aDatos = MiembrosIglesia::dataId($id);
        return view('miembro')->with('datos',$_aDatos);
        
    }

    public function agregar() {
        $_sNombre = $_POST['nombre'];
        $_sEmail = $_POST['email'];
        $_iTelefono = $_POST['telefono'];
        $_dNacimiento = $_POST['nacimiento'];
        $_dInscripcion = $_POST['inscripcion'];        
        $_cGenero = $_POST['genero'];
        $mensaje;


        if($_dNacimiento == "") {
            $_dNacimiento = null;
        }
        if($_dInscripcion == "") {
            $_dInscripcion = null;
        }
        /*========================================
            AQUI EMPEZARAN LAS VALIDACIONES
            DE LOS CORREOS Y NUMEROS DE TELEFONO
            PARA COMPROBAR QUE NO HAYA UNO EXISTENTE
            EN LA BASE DE DATOS
        ==========================================*/

        $resultEmail = MiembrosIglesia::comprobarEmail($_sEmail);
        $resultTelefono = MiembrosIglesia::comprobarTelefono($_iTelefono);
        if($resultTelefono > 0) {
            $mensaje = 'telefono';
        }
        if($resultEmail > 0) {
            $mensaje = 'correo';
        }
        if($resultEmail > 0 && $resultTelefono > 0) {
            $mensaje = 'tc';
        }
        if(($resultEmail == 0 && $resultTelefono == 0) && ($_sEmail == null || $_iTelefono == null || $_dNacimiento == null|| $_dInscripcion == null) ) {
            MiembrosIglesia::agregar($_sNombre,$_sEmail,$_iTelefono,$_dNacimiento,$_dInscripcion,$_cGenero);
            $mensaje = "correcto";
        }
        return back()->with('estado',$mensaje);
    }

    public function borrar($id) {
        MiembrosIglesia::borrar($id);
        return redirect('./lista');
    }


    public function editar() {
        $_iId = $_POST['id'];
        $_sNombre = $_POST['nombre'];
        $_sEmail = $_POST['email'];
        $_iTelefono = $_POST['telefono'];
        $_dNacimiento = $_POST['nacimiento'];
        $_dInscripcion = $_POST['inscripcion'];        
        $_cGenero = $_POST['genero'];
        $correoValido;
        $telefonoValido;
        $mensaje;

        //$listEmail = MiembrosIglesia::comprobarEmail($_sEmail);
        $emailId = MiembrosIglesia::emailId($_iId);
        $emailId = $emailId[0]->correo;
        
        $telefonoId = MiembrosIglesia::telefonoId($_iId);
        $telefonoId = $telefonoId[0]->telefono;

        if($_dNacimiento == "") {
            $_dNacimiento = null;
        }
        if($_dInscripcion == "") {
            $_dInscripcion = null;
        }

        /*==============================
                CONDICIONALES PARA 
                COMPROBAR SI EL CORREO
                NO SE ENCUENTRA REPETIDO
                EN LA BASE DE DATOS
        ================================*/
        if(($_sEmail != $emailId) && $_sEmail != "") {
            $resultEmail = MiembrosIglesia::comprobarEmail($_sEmail);
            if($resultEmail == 0) {
                $correoValido = true;
            }
            else {
                $correoValido = false;
            }
        }
        else {
            $correoValido = true;
        }
        /*==============================
                CONDICIONALES PARA 
                COMPROBAR SI EL TELEFONO
                NO SE ENCUENTRA REPETIDO
                EN LA BASE DE DATOS
        ================================*/
        if(($_iTelefono != $telefonoId) && $_iTelefono != "") {
            $resultTelefono = MiembrosIglesia::comprobarTelefono($_iTelefono);
            if($resultTelefono == 0) {
                $telefonoValido = true;
            }
            else {
                $telefonoValido = false;
            }
        }
        else {
            $telefonoValido = true;
        }
        /*=========================================
                MENSAJES Y ACCIONES SEGUN 
                EL RESULTADO DE LOS CONDICIONALES
                ANTERIORES  
        ===========================================*/

        if(!$correoValido && $telefonoValido) {
            $mensaje = 'El correo insertado: '.$_sEmail.' ya existe en la base de datos ';
        }
        elseif(!$telefonoValido && $correoValido) {
            $mensaje = 'El telefono insertado: '.$_iTelefono.' ya existe en la base de datos ';
        }
        elseif(!$correoValido && !$telefonoValido) {
            $mensaje = 'El correo y el teléfono ya existen en la base de datos.
            Teléfono: '.$_iTelefono.' Correo electrónico: '.$_sEmail;
        }
        // si todo está OK pasamos a la consulta de actualización
        elseif(($correoValido && $telefonoValido) && ($_sEmail == null || $_iTelefono == null || $_dNacimiento == null|| $_dInscripcion == null) ) {
            $result = MiembrosIglesia::updateMember($_iId,$_sNombre,$_sEmail,$_iTelefono,$_dNacimiento,$_dInscripcion,$_cGenero);   
            $mensaje = "Miembro editado correctamene!";
        }
        return back()->with('mensaje',$mensaje)->with('correo',$correoValido)->with('telefono',$telefonoValido);
    }
}
