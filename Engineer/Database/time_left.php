<?php

    function GetTimeLeft($end_date){

        date_default_timezone_set("Europe/London");
        $current_date = new DateTime("now");
        
        $diff = date_diff($current_date, $end_date);

        $time_left = "";

        if($diff->y > 0) { $time_left .= $diff->y; if($diff->y ==1) { $time_left .= " Year ";   } else { $time_left .= " Years ";   } }
        if($diff->m > 0) { $time_left .= $diff->m; if($diff->m ==1) { $time_left .= " Month ";  } else { $time_left .= " Months ";  } }
        if($diff->d > 0) { $time_left .= $diff->d; if($diff->d ==1) { $time_left .= " Day ";    } else { $time_left .= " Days ";    } }
        if($diff->h > 0) { $time_left .= $diff->h; if($diff->h ==1) { $time_left .= " Hour ";   } else { $time_left .= " Hours ";   } }
        if($diff->i > 0) { $time_left .= $diff->i; if($diff->i ==1) { $time_left .= " Minute "; } else { $time_left .= " Minutes "; } }
        if($diff->s > 0) { $time_left .= $diff->s; if($diff->s ==1) { $time_left .= " Second "; } else { $time_left .= " Seconds "; } }

        return $time_left;
    }

?>