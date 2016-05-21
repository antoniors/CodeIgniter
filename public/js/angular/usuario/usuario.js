"use strict";

App.controller("UsuarioController", function ($scope, Request) {
    Request.urlBase = "api/UsuarioApi/usuarios"
    $scope.usuario = {};
    $scope.usuarios = [];


    $scope.registrar = function () {
        Request.registrar({
            data: $scope.usuario
        }).then(function (response) {
            $scope.usuario = response.data;
        });
    };


    $scope.listar = function (data) {

        Request.listar({notificacionError: false, data: data}).then(function (response) {

            $scope.usuarios = response.data;

        });
    };


});