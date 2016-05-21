"use strict";

App.controller("apiKeyController", function ($scope, Request) {
    Request.urlBase = "api/Key"
    $scope.log = {};
    $scope.logs = [];


    $scope.obtener = function () {
        Request.registrar({
            method : 'PUT',
            data: $scope.apikey
        }).then(function (response) {
            console.log(response.data);
            alert("<h4>KEY : " + response.data.key + "</h4>");

            $scope.key = response.data;
        });
    };


    $scope.listar = function (data) {

        Request.listar({notificacionError: false, data: data}).then(function (response) {


            $scope.logs = response.data;
            

        });
    };


});