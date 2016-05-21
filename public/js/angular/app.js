angular.module('components', []).directive('uppercased', function() {
    return {
        require : 'ngModel',
        link: function(scope, element, attrs, modelCtrl) {
            modelCtrl.$parsers.push(function(input) {
                return input ? input.toUpperCase() : "";
            });
            element.css("text-transform","uppercase");
        }
    };
});

var App = angular.module('App', ['ui.router','components']);







App.config(function ($stateProvider, $urlRouterProvider, $controllerProvider, $compileProvider, $filterProvider, $provide, $httpProvider) {

    App.controller = $controllerProvider.register;
    App.directive = $compileProvider.directive;
    App.filter = $filterProvider.register;
    App.factory = $provide.factory;
    App.service = $provide.service;
    App.constant = $provide.constant;
    App.value = $provide.value;



    //var oldWhiteList = $compileProvider.imgSrcSanitizationWhitelist();
    $compileProvider.imgSrcSanitizationWhitelist(/^\s*(http|https?|ftp|file|blob|mailto|chrome-extension|app):|data:image\//);
    $compileProvider.aHrefSanitizationWhitelist(/^\s*(http|https?|ftp|file|blob|mailto|chrome-extension|app):|data:image\//);

    $stateProvider

        .state('Usuario', {
            url: '/',
            template: '<div ui-view></div>'
        })
        .state('Reportes.primarios', {
            url: 'Reportes/primarios',
            templateUrl: 'templates/reportes/primarios.html',
            controller: 'ReportePrimario',
            resolve: loadSequence('fileDownload')

        })
        .state('Reportes.intermedios', {
            url: 'Reportes/intermedios',
            templateUrl: 'templates/reportes/intermedios.html',
            controller: 'HojaUno',
        });


    
});

App.directive('uppercase', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attrs, modelCtrl) {
            modelCtrl.$parsers.push(function (input) {
                return input ? input.toUpperCase() : "";
            });
            element.css("text-transform", "uppercase");
        }
    };
});
App.service('Request', function ($http, $q, CONFIG) {
    this.urlBase = 'Product/Product';

    this.catalogs = function (parametros) {
        var defered = $q.defer();

        $http({
            method: 'POST',
            url: CONFIG.APIURL + 'Catalogos/get',
            data: parametros
        }).then(function successCallback(response) {
            defered.resolve(response);
        }, function errorCallback(response) {
            swal("Error", "A ocurrido un error", "error");
            defered.reject(response);
        });
        return defered.promise;
    };

    this.call = function (data) {
        var defered = $q.defer();

        $http({
            method: data.method,
            url: CONFIG.APIURL + data.url,
            data: data.data,
            cache: false
        }).then(function successCallback(response) {

            if (response.data.response == 'success') {
                if (angular.isUndefined(data.tituloNotificacionCorrecto)) {
                    data.tituloNotificacionCorrecto = ''
                }
                if (angular.isUndefined(data.notificacionCorrecto)) {

                    $.notify({
                        // options
                        title: data.tituloNotificacionCorrecto,
                        message: response.data.message
                    },{
                        // settings

                        type: "success",
                        offset: {
                            x : 20, y : 80
                        },
                        z_index: 1031,
                        delay: 5000,

                    });


                    /* $.bootstrapGrowl(response.data.message, {
                     offset: {from: 'top', amount: 70}, // 'top', or 'bottom'
                     type: 'success', // (null, 'info', 'danger', 'success')
                     });*/
                    //swal(data.tituloNotificacionCorrecto, response.data.message, "success");
                } else if (!angular.isUndefined(data.notificacionCorrecto) && data.notificacionCorrecto) {

                    $.notify({
                        // options
                        title: data.tituloNotificacionCorrecto,
                        message: response.data.message
                    },{
                        // settings

                        type: "success",
                        offset: {
                            x : 20, y : 80
                        },
                        z_index: 1031,
                        delay: 5000,

                    });

                    /*$.bootstrapGrowl(response.data.message, {
                     offset: {from: 'top', amount: 70}, // 'top', or 'bottom'
                     type: 'success', // (null, 'info', 'danger', 'success')
                     });*/
                    // swal(data.tituloNotificacionCorrecto, response.data.message, "success");
                }
            }
            $.log.info("RESPONSE SUCCESS",CONFIG.APIURL + data.url, response);
            defered.resolve(response);
        }, function errorCallback(response) {

            if (angular.isUndefined(data.tituloNotificacionError)) {
                data.tituloNotificacionError = ''
            }

            if (angular.isUndefined(data.notificacionError)) {
                swal(data.tituloNotificacionError, response.data.message, "error");
            } else if (!angular.isUndefined(data.notificacionError) && data.notificacionError) {
                swal(data.tituloNotificacionError, response.data.message, "error");
            }
            $.log.error("RESPONSE ERROR",CONFIG.APIURL + data.url, response);
            defered.reject(response);
        });
        return defered.promise;
    };


    this.obtener = function (data) {
        var defered = $q.defer();
        this.call({
            method: 'GET',
            url: data.url || (this.urlBase + '/' + data.id),
            notificacionCorrecto: angular.isUndefined(data.notificacionCorrecto) ? true : data.notificacionCorrecto,
            notificacionError: angular.isUndefined(data.notificacionError) ? true : data.notificacionError
        }).then(function (response) {
            defered.resolve(response);
        }).catch(function (response) {
            defered.reject(response);
        });
        return defered.promise;
    };

    this.listar = function (data) {
        var defered = $q.defer();
        this.call({
            method: 'POST',
            url: data.url || (this.urlBase + '/listar'),
            data: data.data,
            notificacionCorrecto: angular.isUndefined(data.notificacionCorrecto) ? true : data.notificacionCorrecto,
            notificacionError: angular.isUndefined(data.notificacionError) ? true : data.notificacionError
        }).then(function (response) {
            defered.resolve(response);
        }).catch(function (response) {
            defered.reject(response);
        });
        return defered.promise;
    };

    this.actualizar = function (data) {
        var defered = $q.defer();
        this.call({
            method: 'PUT',
            url: data.url || (this.urlBase + '/' + data.id),
            data: data.data,
            notificacionCorrecto: angular.isUndefined(data.notificacionCorrecto) ? true : data.notificacionCorrecto,
            notificacionError: angular.isUndefined(data.notificacionError) ? true : data.notificacionError
        }).then(function (response) {
            defered.resolve(response);
        }).catch(function (response) {
            defered.reject(response);
        });
        return defered.promise;
    };

    this.registrar = function (data) {
        var defered = $q.defer();
        this.call({
            method: 'POST',
            url: data.url || this.urlBase,
            data: data.data,
            notificacionCorrecto: angular.isUndefined(data.notificacionCorrecto) ? true : data.notificacionCorrecto,
            notificacionError: angular.isUndefined(data.notificacionError) ? true : data.notificacionError
        }).then(function (response) {
            defered.resolve(response);
        }).catch(function (response) {
            defered.reject(response);
        });
        return defered.promise;
    };

    this.eliminar = function (data) {
        var defered = $q.defer();
        this.call({
            method: 'DELETE',
            url: data.url || (this.urlBase + '/' + data.id),
            notificacionCorrecto: angular.isUndefined(data.notificacionCorrecto) ? true : data.notificacionCorrecto,
            notificacionError: angular.isUndefined(data.notificacionError) ? true : data.notificacionError
        }).then(function (response) {
            defered.resolve(response);
        }).catch(function (response) {
            defered.reject(response);
        });
        return defered.promise;
    };

});

App.service('Formulario', function ($http, $q, CONFIG) {

    this.agregarErrores = function (form, errores) {
        this.validator = $("#formSuive").validate();
        this.validator.showErrors(errores);
    };

    this.limpiarErrores = function () {

    }
});

App.service('FormatoService', function ($http, $q, Request) {

    this.urlBase = 'Formato/primario';

    this.listar = function () {
        var defered = $q.defer();

        Request.call({
            method: 'GET',
            url: this.urlBase + 'listar'
        }).then(function (response) {
            defered.resolve(response);
        }).catch(function (response) {
            defered.reject(response);
        });
        return defered.promise;
    };


    this.generar = function (id) {
        var defered = $q.defer();

        Request.call({
            method: 'GET',
            url: this.urlBase + 'generar/' + id
        }).then(function (response) {
            defered.resolve(response);
        }).catch(function (response) {
            defered.reject(response);
        });
        return defered.promise;
    };


});
App.controller('ReportePrimario', function ($scope) {
    $scope.adscripcion = {};
});


