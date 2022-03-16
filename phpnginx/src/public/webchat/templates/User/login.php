<h1>Login</h1>
<?php
    echo $this->Form->create();
    // Hard code the user for now.
    echo $this->Form->control('name');
    echo $this->Form->control('password');
    echo $this->Form->button(__('Login'));
    echo $this->Form->end();
?>
    <a href="<?= $this->Url->build('/user/regist') ?>"><span>Regist User</span></a>
