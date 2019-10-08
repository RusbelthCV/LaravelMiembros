<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class MiembrosIglesia extends Model
{

    public static function list() {       
        $result = DB::table('miembros')->select('*')->get();
        return $result;
    }

    public static function borrar($id) {
        DB::table('miembros')->where('id',$id)->delete();
    }

    public static function busqueda($busqueda) {
        return DB::table('miembros')->select('*')->where('nombre','like','%'.$busqueda.'%')->get();
    }

    public static function agregar($nombre,$email,$telefono,$nacimiento,$inscripcion,$genero) {
        DB::table('miembros')->insert(['nombre' => $nombre , 'correo' => $email , 'telefono' => $telefono , 'nacimiento' => $nacimiento , 'inscripcion' => $inscripcion , 'genero' => $genero]);
    }

    public static function dataId($id) {
        $result = DB::table('miembros')->select('*')->where('id',$id)->get();
        return $result;
    }
    public static function updateMember($id,$nombre,$email,$telefono,$nacimiento,$inscripcion,$genero) {
        $result = DB::table('miembros')->where('id',$id)->update(['nombre'=>$nombre , 'correo'=>$email , 'telefono'=>$telefono , 'nacimiento'=>$nacimiento , 'inscripcion' => $inscripcion , 'genero'=>$genero]);
    }
    public static function comprobarEmail($email) {
        $result = DB::table('miembros')->select('*')->where('correo',$email)->count();
        return $result;
    }

    public static function comprobarTelefono($telefono) {
        $result = DB::table('miembros')->select('*')->where('telefono',$telefono)->count();
        return $result;
    }
    public static function emailId($id) {
        $email = DB::table('miembros')->select('correo')->where('id',$id)->get();
        return $email;
    }

    public static function telefonoId($id) {
        $telf = DB::table('miembros')->select('telefono')->where('id',$id)->get();
        return $telf;
    }

}
