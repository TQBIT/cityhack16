<?php

    $conn = new  PDO('mysql:dbname=serendipity;host=127.0.0.1', 'root', '');
    function search2($lat, $long, $radius) {

        $stmt = $this->pdo->prepare("SELECT * FROM `offer`");
        $address = [$lat,$long];

        $distancePerDegree = 111.045; //km. 63 for miles
        $withinDistance = $radius;

        $latRange=[
            $address[0]-$withinDistance/$distancePerDegree,
            $address[0]+$withinDistance/$distancePerDegree
        ];

        $lonRange=[
            $address[1]-$withinDistance/abs(cos(deg2rad($address[0]))*$distancePerDegree),
            $address[1]+$withinDistance/abs(cos(deg2rad($address[0]))*$distancePerDegree)
        ];

        $stmt = $this->pdo->prepare("SELECT * FROM `offer` WHERE (`OfferLat` BETWEEN ? and ?) AND (`OfferLong` BETWEEN {$lonRange[0]} and {$lonRange[1]}) ");
        $stmt->execute(array($latRange[0], $latRange[1]));
        $points = $stmt->fetchAll();
        $events = array();

        if(empty($events)) {
            return json_encode(array(0, 'fail', 'no events found'));
        }

        // get distance from each found location

        // get bearing from each found loaction


        return json_encode($events);
    }


?>