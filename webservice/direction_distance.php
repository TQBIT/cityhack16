<?php

function getRhumbLineBearing($lat1, $lon1, $lat2, $lon2) {
   //difference in longitudinal coordinates
   $dLon = deg2rad($lon2) - deg2rad($lon1);
 
   //difference in the phi of latitudinal coordinates
   $dPhi = log(tan(deg2rad($lat2) / 2 + pi() / 4) / tan(deg2rad($lat1) / 2 + pi() / 4));
 
   //we need to recalculate $dLon if it is greater than pi
   if(abs($dLon) > pi()) {
      if($dLon > 0) {
         $dLon = (2 * pi() - $dLon) * -1;
      }
      else {
         $dLon = 2 * pi() + $dLon;
      }
   }
   //return the angle, normalized
   return (rad2deg(atan2($dLon, $dPhi)) + 360) % 360;
}

function DistAB($lat_a, $long_a, $lat_b, $long_b) {
	$delta_lat = $lat_b - $lat_a;
    $delta_lon = $long_b - $long_a;

    $earth_radius = 6372.795477598;

    $alpha    = $delta_lat/2;
    $beta     = $delta_lon/2;
    $a        = sin(deg2rad($alpha)) * sin(deg2rad($alpha)) + cos(deg2rad($lat_a)) * cos(deg2rad($lat_b)) * sin(deg2rad($beta)) * sin(deg2rad($beta)) ;
    $c        = asin(min(1, sqrt($a)));
    $distance = 2*$earth_radius * $c;
    $distance = round($distance, 4);

    return $distance;
}

?>
