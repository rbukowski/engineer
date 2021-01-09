<?php
if(!empty($_POST)) {
echo $_POST['login'].' '.hash('whirlpool',$_POST['password']);

} else {
    echo "Nic nie przyszło!";
}
?>