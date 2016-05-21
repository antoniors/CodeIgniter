angular.module('components', []).directive('uppercased', function () {
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

var App = angular.module('App', ['ui.router', 'components']);


App.config(function ($stateProvider, $urlRouterProvider, $controllerProvider, $compileProvider, $filterProvider, $provide, $httpProvider) {

    App.controller = $controllerProvider.register;
    App.directive = $compileProvider.directive;
    App.filter = $filterProvider.register;
    App.factory = $provide.factory;
    App.service = $provide.service;
    App.constant = $provide.constant;
    App.value = $provide.value;


    $compileProvider.imgSrcSanitizationWhitelist(/^\s*(http|https?|ftp|file|blob|mailto|chrome-extension|app):|data:image\//);
    $compileProvider.aHrefSanitizationWhitelist(/^\s*(http|https?|ftp|file|blob|mailto|chrome-extension|app):|data:image\//);


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

App.constant('CONFIG', {
    APIURL: APIURL
});

App.service('Request', function ($http, $q, CONFIG) {
    this.urlBase = '';

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
            headers: {"X-API-KEY": "8k8884wgckscg0g0o4kgs8owk8gso8g8soc4c8cc"},
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
                    }, {
                        // settings

                        type: "success",
                        offset: {
                            x: 20, y: 80
                        },
                        z_index: 1031,
                        delay: 5000,

                    });


                } else if (!angular.isUndefined(data.notificacionCorrecto) && data.notificacionCorrecto) {

                    $.notify({
                        // options
                        title: data.tituloNotificacionCorrecto,
                        message: response.data.message
                    }, {
                        // settings

                        type: "success",
                        offset: {
                            x: 20, y: 80
                        },
                        z_index: 1031,
                        delay: 5000,

                    });


                }
            }
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
            defered.reject(response);
        });
        return defered.promise;
    };


    this.obtener = function (data) {
        var defered = $q.defer();
        this.call({
            method: data.method || 'GET',
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
            method: data.method || 'GET',
            url: data.url || (this.urlBase + ''),
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
            method: data.method || 'PUT',
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
            method: data.method || 'POST',
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
            method: data.method || 'DELETE',
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



