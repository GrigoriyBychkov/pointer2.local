<?php

class PointsController{

    static function indexAction(){
        $view = new View('views/index.phtml');
        $data = Array();
        $name = $_POST['name'];
        $ip = $_POST['ip'];
        $data['clickByNames'] = Points::getCountClicksByName($name);
        $data['clicksByIp'] = Points::getCountClicksByIp($ip);
        $data['ips'] = Points::getAllIps();
        $data['pointsNames'] = Points::getAllPointsNames();
        $data['currentName'] = $name;
        $data['currentIp'] = $ip;


        return $view->render($data);
    }

    static function saveAction(){
        foreach ($_POST['clicks'] as $item){
            Points::savePointToDataBase($item['name'], $_SERVER['REMOTE_ADDR'], $item['time']);
        }
    }




}