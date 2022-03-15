<style>

.khung{
    padding: 10px;
    min-width: 100px;
    display: flex;
    border: 1px solid lightgray;
    margin: 5px;
    border-radius:5px;
}

.chatbox{
    height:360px;
    overflow: scroll;
}

</style>
<?php
    echo $this->Form->create(null, ['url' => ['action' => 'feed']]);
    echo $this->Form->control('name');
    echo $this->Form->control('message', ['rows' => '3']);
    echo $this->Form->button(__('POST'));
    echo $this->Form->end();
?>
<div class="chatbox" id="chatbox">    
    <?php foreach ($t_feed as $t_feed): ?>
        <div class="khung">    
    <p>
        <span>
            <?= $t_feed->name.':' ?>
        </span>
        <span>
            <?= $t_feed->message ?>
        </span>
        <span>
            <?= $t_feed->create_at->format('d/m/Y H:i:s') ?>
        </span>
    </p>
   
    </div>
    <?php endforeach; ?>
    <script>
        setTimeout(() => {
            document.getElementById("chatbox").scrollTop = document.getElementById("chatbox").scrollHeight;
    }, 10);
        
    </script>