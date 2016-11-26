<?php
    include('direction_distance.php');
    function search2($lat, $long, $radius) {

        $conn = new  PDO('mysql:dbname=serendipity;host=127.0.0.1', 'root', '');
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
        $sql = "SELECT * FROM offer WHERE (OfferLat BETWEEN {$latRange[0]} and {$latRange[1]}) AND (OfferLong BETWEEN {$lonRange[0]} and {$lonRange[1]})";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $points = $stmt->fetchAll();

        if(empty($points)) {
            return json_encode(array(0, 'fail', 'no events found'));
        }

        // get distance from each found location
        foreach($points as $point) {
            $bearing = getRhumbLineBearing($lat, $long, $point['OfferLat'], $point['OfferLong']);
            $distance = DistAB($lat, $long, $point['OfferLat'], $point['OfferLong']);
            $events[] = array($point['OID'], $point['UID'], $point['OfferName'], $point['OfferDesc'], $point['OfferLat'], $point['OfferLong'], $point['ImageURL'], $point['OfferLimit'], $bearing, $distance);
        }
        return json_encode($events);
    }


?>