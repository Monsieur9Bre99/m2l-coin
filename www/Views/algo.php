<?php

    $string = "Hello";
    $string = str_replace("e", 3, $string); // H3llo
    echo $string;

    echo "<br>";
    $cat = 'vvgf';
    $loc = '';
    $critere = "abc";

    $tab = [$critere];
    if ($cat !== '') 
    {
        $tab[] = $cat;
    }
    if ($loc !== '') 
    {
        $tab[] = $loc;
    }

    //$tab = array($critere .($cat === '' ? "" : ,$cat ).($loc === '' ? "" : ",$loc"));
               var_dump($tab);