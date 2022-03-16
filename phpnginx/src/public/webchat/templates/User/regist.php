<h1>Regist user</h1>
<?php
    echo $this->Form->create();
    // Hard code the user for now.
    echo $this->Form->control('email');
    echo $this->Form->control('name');
    echo $this->Form->control('password');
    echo $this->Form->button(__('Regist'));
    echo $this->Form->end();
?>
    <a href="<?= $this->Url->build('/user/login') ?>"><span>Login User</span></a>