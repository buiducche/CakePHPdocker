<?php

    echo $this->Form->create($t_feed);
    echo $this->Form->control('name');
    echo $this->Form->control('message', ['rows' => '3']);
    echo $this->Form->button(__('POST'));
    echo $this->Form->end();
?>