"use strict";

App.controller("LogController", function ($scope, Request) {
    Request.urlBase = "api/LogApi/logs"
    $scope.log = {};
    $scope.logs = [];

    $scope.listar = function (data) {

        Request.listar({notificacionError: false, data: data}).then(function (response) {

            $scope.logs = response.data;

        });
    };


});