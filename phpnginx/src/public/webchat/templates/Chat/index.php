<style>

.khung{
    padding: 10px;
    min-width: 100px;
    display: flex;
    border: 1px solid lightgray;
    margin: 5px;
    border-radius:5px;
    position: relative;
}

.chatbox{
    height:600px;
    overflow-y: scroll;
    overflow-x: hidden;
}

.flex{
    display: flex;
}
.submit{
    position: relative;
    display: flex;
    flex-direction: row-reverse;
}
</style>

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
        <span>
            <?= $t_feed->update_at->format('d/m/Y H:i:s') ?>
        </span>
    </p>
   
    </div>
    <?php endforeach; ?>
    </div>
    <script>
        setTimeout(() => {
            document.getElementById("chatbox").scrollTop = document.getElementById("chatbox").scrollHeight;
    }, 100);
        
    </script>


    <?php
    echo $this->Form->create(null, ['url' => ['action' => 'feed']]);
    echo '<div class="submit"><input value="POST" type="submit"></div>'
    ?>
    <div class="flex"> 
        <?php
        echo $this->Form->control('message', ['rows' => '3','label' => false,'placeholder' => "Enter your message here",'style'=>'width:1080px;']);
        echo $this->Form->end();
        ?>
    </div>
 