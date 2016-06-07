<script> window.idUpdate   = 0 ;</script>
<?php

/* @var $this yii\web\View */

$this->title = 'REST API';
?>
<html ng-app="restModule">
<head>
    <title>Application</title>
    <meta charset="utf-8">
    <script src="//code.jquery.com/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular-route.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular-resource.js"></script>
    <script src="../../web/js/controllers-angular/controllers.js"></script>

</head>
<body >

<div class="container" ng-controller="ReportAngularCtrl"  >

    <div class="row">

        <div class="col-lg-3"  >
            <button class="btn-success" id="createButton"> Создать</button>
            <div id="resultCreate" style="visibility: hidden">
                <br>
                <div class="form-group">
                    <label>Хост</label>
                    <input ng-model="answer.host"  type="text" onclick="listener()"  onmouseout="listener()" onmousemove="listener()" class="form-control" id="host" placeholder="Введите хост">
                </div>
                <div class="form-group">
                    <label>Код</label>
                    <input type="number"  ng-model="answer.code" onclick="listener()"   onmouseout="listener()" onmousemove="listener()"  class="form-control" id="code" placeholder="Введите код">
                </div>
                <div class="form-group">
                    <label>Сообщение</label>
                    <input type="text"  ng-model="answer.message" onclick="listener()" onmouseout="listener()" onmousemove="listener()" class="form-control"  id="message" placeholder="Введите сообщение">
                </div>
                <button ng-click="saveReport(answer)" class="btn btn-success" id="buttonAdd"  style="visibility: hidden"> Добавить</button>
            </div>
            <div id="responseMessages">
            </div>

        </div>
        <div class="col-lg-6 " align="center" >
            <button ng-click="requestGetList()"  class="btn-info" id="buttonReview"> Показать</button>
            <br>
            <br>
            <div class="col-lg-12 MyScroll" id="twoBlockHidden" style="visibility: hidden">
                <input type="text" ng-model="query" placeholder="расширенный поиск по Id">
                <table width="100%">
                    <tr>
                        <th width="5%">id</th>
                        <th width="20%">Хост</th>
                        <th width="20%">Код</th>
                        <th width="45%">Сообщение</th>
                        <th width="5%"> </th>
                        <th width="5%"> </th>
                    </tr>
                </table>
                <br>


                    <table width="100%">
                        <tr ng-repeat=" value in getList | filter:{id:query}">
                            <td width="5%">{{value.id}} </td>
                            <td width="20%">{{value.host}}</td>
                            <td width="20%"> {{value.code }}</td>
                            <td width="45%"> {{value.message }}</td>
                            <td width="5%"> <span style="cursor: pointer" onclick="openModal(id)" class="glyphicon glyphicon-pencil" data-toggle="modal" data-target=".bs-example-modal-sm" id="{{value.id}}"></span></td>
                            <td width="5%"><span style="cursor: pointer" ng-click="deleteReport(value.id)" class="glyphicon glyphicon-remove"  id="{{value.id}}"></span></td>
                        </tr>
                    </table><br>

                  </div>
                    </div>

        <div class="col-lg-3"  >
                        <input id="searchId" ng-model="answer.id" type="number" name="searchId" placeholder="Найти по Id">
                        <button id="buttonIdSearch" class="btn-warning" ng-click="searchIdReport(answer)"> Поиск</button>
                        <br><br>
                        <div id="resultSearch" style="visibility: hidden">
                            <table width="100%">
                                <tr>
                                    <th width="5%">id</th>
                                    <th width="20%">Хост</th>
                                    <th width="20%">Код</th>
                                    <th width="45%">Сообщение</th>
                                    <th width="5%"> </th>
                                    <th width="5%"> </th>
                                </tr>
                            </table>
                            <table width="100%" >
                                <tr>
                                    <td width="5%" >{{resultSearchId.id}} </td>
                                    <td width="20%" >{{resultSearchId.host}}</td>
                                    <td width="20%" > {{resultSearchId.code }}</td>
                                    <td width="45%" > {{resultSearchId.message }}</td>
                                    <td width="5%" > <span style="cursor: pointer" onclick="openModal(id)"
                                    <td width="5%"> <span style="cursor: pointer" onclick="openModal(id)" class="glyphicon glyphicon-pencil" data-toggle="modal" data-target=".bs-example-modal-sm" id="{{resultSearchId.id}}"></span></td>
                                    <td width="5%"><span style="cursor: pointer" ng-click="deleteReport(resultSearchId.id)" class="glyphicon glyphicon-remove"  id="{{resultSearchId.id}}"></span></td>
                                </tr>
                            </table>
                        </div>
                        <div id="errorSearchId" style="visibility: hidden">
                        <p>Елемента с id = {{answer.id}}  не найденно!</p>
                       </div>
                    </div>
         </div>
</div>
            <div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1"
                 role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" ng-controller="ReportAngularCtrl" >
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="container">
                            <div class="col-lg-12">
                                <input type="number" id="idUpdate" value="" style="visibility: hidden">
                        <div class="form-group">

                            <label>Код</label><br>
                        <input type="number" ng-model="answer.code" id="codeUpdane" value="">
                        </div>
                        <div class="form-group">
                            <label>Хост</label><br>
                            <input type="text" ng-model="answer.host"  id="hostUpdane" value="">
                        </div>
                        <div class="form-group">
                            <label>Сообщение</label><br>
                            <input type="text" id="messageUpdane" ng-model="answer.message"  value="">
                        </div>
                                <button class="btn btn-success"  ng-click="UpdateReport(answer)" id="buttonUpdateOk">Обновить</button>
                                <button class="btn btn-danger"  id="buttonUpdateCancel">Отмена</button>

                        </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                function listener(){
                    if($('#host').val().length > 0 && $('#code').val().length > 0 && $('#message').val().length > 0){
                        $('#buttonAdd').css({'visibility':'visible'});
                    }
                }
                function openModal(id){
                    $.ajax({
                        url:"../reports/"+id,
                        type:"GET",
                        data:({}),
                        dataType:"json",
                        success: updateReport
                    });
                }
                function updateReport(data){
                    report = JSON.stringify(data);
                    console.log(''+report);
                    $('#codeUpdane').val(data.code);
                    $('#hostUpdane').val(data.host);
                    $('#messageUpdane').val(data.message);
                    idUpdate = data.id;
                }

                $(document).ready(function(){
                    $('#createButton').bind('click',function(){
                        $('#resultCreate').css({'visibility': 'visible'});
                    });

                    $('#buttonReview').bind('click',function(){
                        $('#twoBlockHidden').css({'visibility':'visible'});
                    });
                    $('#buttonUpdateCancel').bind('click',function(){
                        $('#myModal').modal('hide')
                    });

                });
            </script>
            </body>
            </html>