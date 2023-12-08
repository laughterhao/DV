<?php
if ($_FILES["myFile"]["error"] == 0) {
    if (move_uploaded_file($_FILES["myFile"]["tmp_name"], "./" . $_FILES["myFile"]["name"])) {
        echo "Upload success!<br>";
    } else {
        echo "Upload fail!<br>";
    }
}
echo 'Here is some more debugging info:';
print_r($_FILES);
