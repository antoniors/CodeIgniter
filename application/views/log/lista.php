<div class="separator-tb">

</div>

<div class="" ng-controller="LogController" ng-init="listar()">
    <div class="col-sm-12">
        <div class="panel panel-default ">
            <div class="panel-heading">Lista de usuarios</div>
            <div class="panel-body">
                <table class="table table bordered table-hover">
                    <thead>
                    <tr>
                        <th>
                            IP address
                        </th>
                        <th>
                            Method
                        </th>
                        <th>
                            Params
                        </th>
                        <th>
                            Response Code
                        </th>
                        <th>
                            Uri
                        </th>
                    </tr>
                    </thead>
                    <tbod>
                        <tr ng-repeat="log in logs">
                            <td>
                                {{log.ip_address}}
                            </td>
                            <td>
                                {{log.method}}
                            </td>
                            <td>
                                {{log.params}}
                            </td>
                            <td>
                                {{log.response_code}}
                            </td>
                            <td>
                                {{log.uri}}
                            </td>
                        </tr>
                    </tbod>
                </table>
            </div>
        </div>

    </div>
</div>



