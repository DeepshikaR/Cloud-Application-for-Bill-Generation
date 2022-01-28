<?php

    function addToPrdtList($s, $n, $q, $p)
    {
        $sno = $s;
        $name = $n;
        $quant = $q;
        $price = $p;
        $filename = "Products.json";

        $array = array(
                "SNO" => $sno,
                "Name" => $name,
                "Quant" => $quant,
                "Price" => $price
            );

        // encode array to json
        $json = json_encode($array);

        $handle = @fopen($filename, 'r+');
        
        if ($handle === null) {
            $handle = fopen($filename, 'w+');
        }

        if ($handle) {
            // seek to the end
            fseek($handle, 0, SEEK_END);

            // are we at the end of is the file empty
            if (ftell($handle) > 0) {
                // move back a byte
                fseek($handle, -2, SEEK_END);
                
                
                if(fread($handle,1) == '}')


                    // add the trailing comma
                    fwrite($handle, ',', 1);

                // add the new json string
                fwrite($handle, $json . ']');
            } else {
                // write the first event inside an array
                fwrite($handle, $json);
            }

            // close the handle on the file
            fclose($handle);
        }
    }
?>
