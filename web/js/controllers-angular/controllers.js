/**
 * Created by Ivany on 31.05.2016.
 */

var restModule = angular.module('restModule', ['ngRoute', 'ngResource']);

restModule.factory( 'Report', function($resource) {
    return $resource('../reports/:id',
        {id: "@id"},
        {
            ListReport: { method: "GET", params: {},isArray: true },
            GetReport: { method: "GET", params: { id: 0 } },
            CreateReport: { method: "POST", params: { message: "not message", host: 0, code: 777 } },
            UpdateReport: { method: "PUT", params: { message: "not message", host: 0, code: 777 } },
            DeleteReport: { method: "DELETE", params: { id: 0 } }
        }
    );
});
    restModule.controller('ReportAngularCtrl',['$scope','Report', function($scope, Report){
        $scope.requestGetList =  function(asn){
           $scope.getList = Report.ListReport();
        };

        $scope.saveReport = function(answer){
            Report.CreateReport({message:answer.message, host: answer.host, code: answer.code});
            $('#host').val('');
            $('#code').val('');
            $('#message').val('');
            $('#buttonAdd').css({'visibility':'hidden'});
            $('#resultCreate').css({'visibility': 'hidden'});
            $('#responseMessages').text('Сообщение отправлено!');
        };

        $scope.searchIdReport = function(answer){
            $scope.resultSearchId = Report.GetReport({id: answer.id},
                function success() {
                    $('#errorSearchId').css({'visibility': 'hidden'});
                    $('#resultSearch').css({'visibility': 'visible'});
                },
                function err() {
                    $('#resultSearch').css({'visibility': 'hidden'});
                    $('#errorSearchId').css({'visibility': 'visible'});
                });
        };
        $scope.deleteReport = function(answer){
            Report.DeleteReport({id:answer});
            $('#resultSearch').css({'visibility': 'hidden'});
            alert('Сообщение удалено!');
            $scope.getList = Report.ListReport();
        };

        $scope.UpdateReport = function(answer){
            Report.UpdateReport({id:idUpdate ,message:answer.message, host: answer.host, code: answer.code},
                function success() {
                    $('#myModal').modal('hide');
                    alert('Сообщение обновленно!');
                },
                function err() {
                    $('#myModal').modal('hide');
                    alert('Произошла ошибка при оновлении!');
                });

        }
    }
    ]);
