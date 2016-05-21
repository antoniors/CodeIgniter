<div class="separator-tb">

</div>

<div class="" ng-controller="UsuarioController" ng-init="listar()">
    <div class="col-sm-12">
        <div class="panel panel-default ">
            <div class="panel-heading">Lista de usuarios</div>
            <div class="panel-body">
                <table class="table table bordered table-hover">
                    <thead>
                    <tr>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Email
                        </th>
                    </tr>
                    </thead>
                    <tbod>
                        <tr ng-repeat="usuario in usuarios">
                            <td>
                                {{usuario.nombre}}
                            </td>
                            <td>
                                {{usuario.email}}
                            </td>
                        </tr>
                    </tbod>
                </table>
            </div>
        </div>

    </div>
</div>



