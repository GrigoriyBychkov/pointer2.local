<?php


//["REDIRECT_URL"]=> "/asdf/asdf"
//["REDIRECT_QUERY_STRING"]=> "fff=gggg&fgh=fff"
//["REQUEST_METHOD"]=> "GET"
//["QUERY_STRING"]=> "fff=gggg&fgh=fff"


$str = $_SERVER["QUERY_STRING"];

// Рекомендуемый подход
parse_str($str, $params);



$paths = explode("/", $_SERVER['REQUEST_URI']);

require('models/db.php');
require('controllers/pointsController.php');
require('views/indexView.php');
require('models/pointsModel.php');

var_dump($paths);
if ($paths[1] == 'point_save') {
    echo PointsController::saveAction();
}  else if($paths[1] == ''){
    echo PointsController::indexAction();
}




