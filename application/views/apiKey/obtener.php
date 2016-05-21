<div class="separator-tb">

</div>

<div class="row" ng-controller="apiKeyController">
    <div class="col-sm-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Usuario</div>
            <div class="panel-body">
                <div class="col-sm-8 col-md-offset-2">
                    <form class="form-horizontal" ng-submit="obtener()">
                        <div class="form-group">
                            <label for="nombre" class="col-sm-2 control-label">Level</label>
                            <div class="col-sm-10">
                                <input type="number" required class="form-control" ng-model="apikey.level" id="level" placeholder="Level">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Ignore Limits</label>
                            <div class="col-sm-10">
                                <input type="number" required class="form-control" ng-model="apikey.ignore_limits" id="ignore_limits" placeholder="Ignore Limits">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit"  class="btn btn-default btn-block">Registrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>



