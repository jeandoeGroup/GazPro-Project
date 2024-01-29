<?php

if(isset($message_box)){
    foreach($message_box as $message_box){
        echo '
        <div class="message form">
            <span>'.$message_box.'</span>
            <i class="bx bx-x" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}

?>