<?php

$i=0;
while ($i<=10)
{
	try {
        echo "i=$i \n";
        sleep(8);
        $i++;
        set_time_limit(5);
        echo ini_get('max_execution_time');
        
        } 
        catch (Exception $e) {
		echo "$e\n";
	}
}


?>