<h1>ReName</h1>
<?php
    echo $this->Form->create();
    // Hard code the user for now.
    echo $this->Form->control('new name');
    echo $this->Form->button(__('ReName'));
    echo $this->Form->end();
?>
    <a href="<?= $this->Url->build('/chat') ?>"><span>Back to the Chat</span></a>