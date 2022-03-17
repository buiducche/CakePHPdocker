<style>

.khung{
    padding: 10px;
    min-width: 100px;
    border: 1px solid lightgray;
    margin: 5px;
    border-radius:5px;
    position: relative;
}

.chatbox{
    height:590px;
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

input[type="file"] {
    display: none;
}

.custom-file-upload {
    font-size: 14px;
    background-color: #7FFF00;
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 6px;
    cursor: pointer;
    border-radius: 4px;
}
.custom-file-upload:focus,
.custom-file-upload:active:focus {
    outline: thin dotted;
    outline: 5px auto -webkit-focus-ring-color;
    outline-offset: -2px;
}
.custom-file-upload:hover,
.custom-file-upload:focus {
    color: #333;
    text-decoration: none;
}
.custom-file-upload:active {
    background-image: none;
    outline: 0;
    -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
    box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
}
.textarea{
    width: 100%;
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
            <?= $t_feed->create_at->format('d/m/Y H:i:s') ?>
        </span>
        <span>
            <?= $t_feed->update_at->format('d/m/Y H:i:s') ?>
        </span> 
        <div>
            <?= $t_feed->message ?>
        </div>    
    </p>
        <div>
            <?php if($t_feed->image_file_name) echo $this->Html->image($t_feed->image_file_name) ?>
        </div>
    </div>
    <?php endforeach; ?>
    </div>
    <script>
        setTimeout(() => {
            document.getElementById("chatbox").scrollTop = document.getElementById("chatbox").scrollHeight;
    }, 100);    
    </script>

    
    <?php
    echo $this->Form->create(null, ['type'=>'file','url' => ['action' => 'feed']]);
    // echo '<label for="file-upload" class="custom-file-upload">';
    // echo $this->Form->control('Photo',['type'=>'file']);
    // echo '</label>';
    echo '<div class="flex" style="justify-content: space-between;">';
    echo '<div><label class="custom-file-upload"><input name="image" type="file"/>Photo</label></div>';
    echo '<div><input class="submit" value="POST" type="submit"></div>';
    echo '</div>';
    ?>
    
    <div class="flex"> 
        <?php
        echo $this->Form->control('message', ['rows' => '3','label' => false,'placeholder' => "Enter your message here",'style'=>'width:100%;']);
        echo $this->Form->end();
        ?>
    </div>
 