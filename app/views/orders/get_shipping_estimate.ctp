<?php

    if($shippingEstimate==null || $shippingEstimate<=0){
        echo "<span class='compactValue' style='color: green; margin-left: 0px; margin-top: 2px; font-size: 0.8em;'>invalid postcode</span>";
    }else{
        echo "<span class='compactValue' style='color: green; margin-top: 10px;'>$".$shippingEstimate."</span>";
    }
?>