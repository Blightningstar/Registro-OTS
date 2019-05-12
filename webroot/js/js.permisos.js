$(document).ready( function () {
    /**
     * When a checkbox is click, will send the row (permission id) and the column (rol id)
     * and some action (grant or remove), to the controller. In the controller the action is process with
     * storage procedures in whom a relation between the given rol and the given permission is created or 
     * removed. this will happend in the SEG_POSEE table.
     * 
     * @author Nathan González
     */
    $('#rightstable').on('change', '.checkbox', function (event) { 
         
        // The row and the column of the checkbox click it.
        var $vlo_fila = $(this).parent("td");     
        var vlo_col = $vlo_fila.parent().children().index($vlo_fila);
        var vlo_row = $vlo_fila.parent().parent().children().index($vlo_fila.parent()) + 1;
        // Table seek for its id.
        var vlo_Dttable = document.getElementById('rightstable');

        // The permission id.
        var vln_idPermiso = 0;
        vln_idPermiso = parseFloat(vlo_Dttable.rows[vlo_row].cells[4].innerHTML);
        
        document.getElementById('segpermiso').value = vln_idPermiso;
        document.getElementById('segrol').value = vlo_col; //SuperUser = 1, Administrator = 2, Student = 3.
        
        if($(this).is(":checked"))
            document.getElementById('tipo').value = "1"; // Grant a permission for some rol.
        else
            document.getElementById('tipo').value = "0"; // Remove a permission granted for some rol.

        document.getElementById('descripcion').value = vlo_Dttable.rows[vlo_row].cells[0].innerHTML; //Description of the process permission.

        // Define who rol will be have acess to the permission or who will be revoke that acess.
        if(vlo_col == 1)
            document.getElementById('rol').value = 'SuperUser';
        else{
            if(vlo_col == 2)
                document.getElementById('rol').value = 'Administrator';
            else
                document.getElementById('rol').value = 'Student';
        }

        document.getElementById('submitRequest').submit(); // Submit the request.
    });

    //Allows the user to hide/show rows by typing data in the queryTextbox.
    $(document).ready(function(){
        $("#queryTextbox").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("tr").filter(function(){
                var excludeHeader = $(this).attr("id") == "headTr"; //Keeps header safe.
                if(!excludeHeader)
                    $(this).toggle(($(this).text().toLowerCase().indexOf(value) > -1));
            });
        });
    });
});