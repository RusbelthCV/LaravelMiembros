$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('keyup','#busqueda',function(){
        let busqueda = {
            'valor' : $('#busqueda').val()
        };
        $.ajax({
            data: busqueda,
            url: 'busqueda',
            method: 'POST',
            success: function(response) {
                let tamañoArray = response.success;
                let nacimiento;
                let inscripcion;
                let htmlResult = tamañoArray.map(function(el){
                    if(el.genero == 'H') {
                        genero = '<i class="fa fa-mars fa-2x" aria-hidden="true"></i>';                        
                    }
                    else {
                        genero = '<i class="fa fa-venus fa-2x" aria-hidden="true"></i>';                        
                    }
                    if(el.nacimiento == null) {
                        nacimiento = "";
                    }
                    else {
                        nacimiento = el.nacimiento;
                    }
                    if(el.inscripcion == null) {
                        inscripcion = "";
                    }
                    else {
                        inscripcion = el.inscripcion;
                    }
                    let tags = "<tr class = 'bg-info text-light'>"+
                    "<td></td>"+
                    "<td>"+el.nombre+"</td>"+
                    "<td>"+genero+"</td>"+
                    "<td>"+el.correo+"</td>"+
                    "<td>"+el.telefono+"</td>"+
                    "<td>"+nacimiento+"</td>"+
                    "<td>"+inscripcion+"</td>"+
                    "<td><a class='btn btn-success btn-lg' href = './editar/"+el.id+"'><i class='fa fa-pencil-square-o fa-2x' aria-hidden='true'></i></a></td>"+
                    "<td><a class='btn btn-danger btn-lg' href = './borrar/"+el.id+"'><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></td>"+
                    "</tr>";
                    return tags;
                })
                $('#resultados').html(
                    htmlResult
                );
                console.log(response.success);
            }
        });
    });
});