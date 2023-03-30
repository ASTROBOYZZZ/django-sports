<?php
    $s = "abc\n567\0";
    for($i = 0; $i < 6; $i++) echo $s[$i]=="\n"?"<br>":$s[$i];
    echo $s;
?>