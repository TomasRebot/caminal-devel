<template>
 <div class="col-md-12 col-sm-12 col-xs-12 animated fadeInRight">
    <div class="x_panel">
        <div class="x_title">
            <h4>Listado de usuarios</h4>
            <div class="clearfix"></div>
            <ul class="nav navbar-left panel_toolbox">
                <a href="" class="btn btn-sm btn-success">Nuevo</a>
                <a  id="deleteMultipleUsers" class="btn btn-sm btn-danger">Eliminar</a>
            </ul>
            <ul class="nav navbar-rigth panel_toolbox">
                <li><a  class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"></a>
            </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="table-responsive">
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                <tr class="headings">
                    <th>
                    <input type="checkbox" id="check-all" class="">
                    </th>
                    <th class="column-title">Nombre </th>
                    <th class="column-title">Email </th>
                    <th class="column-title">Rol </th>
                    <th class="column-title no-link last"><span class="nobr">Estado</span>
                    <th class="bulk-actions" colspan="7">
                        <a class="antoo" style="color:#fff; font-weight:500;">Usuarios  <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="even pointer">
                    <td class="a-center ">
                    <input type="checkbox" value="" class="" name="">
                    </td>
                    <td class=""><a href="">pepe</a></td>
                    <td class=""><a href="">pepe@gmail.com</a></td>
                    <td class=""><a href="">adminitrador</a></td>
                    <td class="last"><a href="#"><label class='badge badge-success'>activo</label></a>
                    </td>
                </tr>
                <tr class="even pointer">
                    <td class="a-center ">
                    <input type="checkbox" value="" class="" name="">
                    </td>
                    <td class=""><a href="">pepe</a></td>
                    <td class=""><a href="">pepe@gmail.com</a></td>
                    <td class=""><a href="">adminitrador</a></td>
                    <td class="last"><a href="#"><label class='badge badge-success'>activo</label></a>
                    </td>
                </tr>
                <tr class="even pointer">
                    <td class="a-center ">
                    <input type="checkbox" value="" class="" name="">
                    </td>
                    <td class=""><a href="">pepe</a></td>
                    <td class=""><a href="">pepe@gmail.com</a></td>
                    <td class=""><a href="">adminitrador</a></td>
                    <td class="last"><a href="#"><label class='badge badge-success'>activo</label></a>
                    </td>
                </tr>
                <tr class="even pointer">
                    <td class="a-center ">
                    <input type="checkbox" value="" class="" name="">
                    </td>
                    <td class=""><a href="">pepe</a></td>
                    <td class=""><a href="">pepe@gmail.com</a></td>
                    <td class=""><a href="">adminitrador</a></td>
                    <td class="last"><a href="#"><label class='badge badge-success'>activo</label></a>
                    </td>
                </tr>
                <tr class="even pointer">
                    <td class="a-center ">
                    <input type="checkbox" value="" class="" name="">
                    </td>
                    <td class=""><a href="">pepe</a></td>
                    <td class=""><a href="">pepe@gmail.com</a></td>
                    <td class=""><a href="">adminitrador</a></td>
                    <td class="last"><a href="#"><label class='badge badge-success'>activo</label></a>
                    </td>
                </tr>
                <tr class="even pointer">
                    <td class="a-center ">
                    <input type="checkbox" value="" class="" name="">
                    </td>
                    <td class=""><a href="">pepe</a></td>
                    <td class=""><a href="">pepe@gmail.com</a></td>
                    <td class=""><a href="">adminitrador</a></td>
                    <td class="last"><a href="#"><label class='badge badge-success'>activo</label></a>
                    </td>
                </tr>
                <tr class="even pointer">
                    <td class="a-center ">
                    <input type="checkbox" value="" class="" name="">
                    </td>
                    <td class=""><a href="">pepe</a></td>
                    <td class=""><a href="">pepe@gmail.com</a></td>
                    <td class=""><a href="">adminitrador</a></td>
                    <td class="last"><a href="#"><label class='badge badge-success'>activo</label></a>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        mounted() {
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                swalWithBootstrapButtons.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
                )
            }
            });





        }

    }
</script>
