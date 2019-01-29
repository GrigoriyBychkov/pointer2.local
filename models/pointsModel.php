<?php
class Points{
    static function savePointToDataBase($name,$ip,$time){
        $db = DB::getPdo();
        $sth = $db->prepare("insert into `points` ( `ip`, `name`, `timestamp`) values ( :ip, :name, :time)");
        $sth->bindValue(':ip', $ip ,PDO::PARAM_STR);
        $sth->bindValue(':name', $name ,PDO::PARAM_STR);
        $sth->bindValue(':time', $time );
        $sth->execute();
    }

    static function getAllIps(){
        $db = DB::getPdo();
        $query =  "SELECT DISTINCT `ip` FROM `points` ";
        $sth = $db->prepare($query);
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    static function getAllPointsNames () {
        $db = DB::getPdo();
        $query =  "SELECT DISTINCT `name` FROM `points` ";
        $sth = $db->prepare($query);
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    static function getCountClicksByName ($name) {
        if($name == ''){
            return [];
        }
        $db = DB::getPdo();
        $query =  "SELECT name, ip, COUNT(id), COUNT(id)/((MAX(timestamp) - MIN(timestamp))/1000/60)
        as `clicks_per_minute`, (MAX(timestamp) - MIN(timestamp))/1000/60 as `minutes` FROM points
        where name = :name   GROUP BY  ip";
        $sth = $db->prepare($query);
        $sth->bindValue(':name', $name, PDO::PARAM_STR);
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }



    static function getCountClicksByIp ($ip) {
        if($ip == ''){
            return [];
        }
        $db = DB::getPdo();
        $query =  "SELECT name, ip, COUNT(id), COUNT(id)/((MAX(timestamp) - MIN(timestamp))/1000/60)
        as `clicks_per_minute`, (MAX(timestamp) - MIN(timestamp))/1000/60 as `minutes` FROM points
        where ip = :ip   GROUP BY  name";
        $sth = $db->prepare($query);
        $sth->bindValue(':ip', $ip, PDO::PARAM_STR);
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}