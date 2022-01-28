<?php

    $data = file_get_contents('Products.json');

    // decode json to associative array
    $json_arr = json_decode($data, true);

    // delete data
    foreach ($json_arr as $key => $value)
    {
        unset($json_arr[$key]);
    }

    // rebase array
    $json_arr = array_values($json_arr);

    // encode array to json and save to file
    file_put_contents('Products.json', json_encode($json_arr));


?>