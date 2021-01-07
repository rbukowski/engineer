<?php
if(!empty($POST)) {
    echo $_POST['nick'].' '.hash('whirlpool',$_POST['password']);

} else {
    echo "Nic nie przyszło!";
}
?>