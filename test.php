<?php

$itemBarcode = "55.2555";
if ((strlen($itemBarcode) == 8 || strlen($itemBarcode) == 9) && substr($itemBarcode, -5, 1) == ".") {
    echo "loko";
} else {
    echo "putana";
}