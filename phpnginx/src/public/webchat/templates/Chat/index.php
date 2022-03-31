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
    height:270px;
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

.flex{
    display: flex;
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

.imagebox{
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    width: 150px;
}


video {
  max-width: 600px;
  height: 100%;
}

.avartar{
  background-color: #f8fafc;
  border: 1px solid #dbdbdb;
  border-radius: 50% 50% 0 50%;
  box-sizing: border-box;
  color: #1a1a1a;
  display: flex;
  height: 32px;
  justify-content: center;
  line-height: 19.5px;
  overflow: hidden;
  padding: 0;
  width: 32px;
}

.name{
  background-color: transparent;
  border-width: 0;
  color: #436475;
  cursor: pointer;
  display: inline;
  font-family: -apple-system,BlinkMacSystemFont,".SFNSDisplay-Regular","Segoe UI","Helvetica Neue","Hiragino Sans",ヒラギノ角ゴシック,"Hiragino Kaku Gothic ProN","ヒラギノ角ゴ  ProN W3",Meiryo,メイリオ,"MS PGothic","ＭＳ  Ｐゴシック",sans-serif;
  font-size: 100%;
  font-weight: 700;
  line-height: 19.5px;
  margin: 0;
  outline: 0;
  padding: 0;
  quotes: auto;
  white-space: nowrap;
}
#slide {
    width: auto;
    height: 100px;
    overflow-x: scroll;
    overflow-y: hidden;
    white-space: nowrap;
}

.ignore-css{
    all: unset;
}
</style>

<div class="chatbox" id="chatbox">    
    <?php foreach ($t_feed as $t_feed): ?>
        <div class="khung">    
            <p>
                <span class="name">
                    <?= $t_feed->name.'' ?>
                </span>

                <span>
                    <?= $t_feed->create_at->format('d/m/Y H:i:s') ?>
                </span>

                <span>
                    <?= "edited".$t_feed->update_at->format('d/m/Y H:i:s') ?>
                </span> 
            
                <div>
                    <?php 
                        if($t_feed->user_id == $user_id){
                            echo $this->Html->link('Edit', ['action' => 'edit', $t_feed->id]);
                            echo '&nbsp';
                            echo $this->Form->postLink(
                                'Delete',
                                ['action' => 'delete', $t_feed->id],
                                ['confirm' => 'Are you sure?']);
                        }

                    ?>
                </div>

                <div>
                    <span>
                    <?= $t_feed->message ?>
                    </span>
                    
                </div>    
            </p>
                    <?php 
                    //Video and image
                    if($t_feed->image_file_name){
                        if(substr($t_feed->image_file_name,0,5)=='video'){
                            echo "<div class=\"video\">";
                            echo $this->Html->media($t_feed->image_file_name,['alt' => 'video','controls' => true, 'type'=>"video/mp4"]);
                            echo "</div>"; 
                        }else{
                            echo "<div class=\"imagebox\">";
                            echo $this->Html->image($t_feed->image_file_name,['alt' => 'image']);
                            echo '<a href="/img/'.$t_feed->image_file_name.'" download >'.substr($t_feed->image_file_name,7).'</a>';
                            echo "</div>";
                            
                        }
                    } 
                    //stamp
                    if($t_feed->stamp_id){
                        
                        echo $this->Html->image("stamp/".$t_feed->stamp_id.".png",['alt' => 'image','type'=>'stamp']);
                    }    
                    ?>
        
        </div>
    <?php endforeach; ?>
    </div>
    <script>
        setTimeout(() => {
            document.getElementById("chatbox").scrollTop = document.getElementById("chatbox").scrollHeight;
    }, 100);

    function showimagename() {
      var name = document.getElementById('image_upload'); 
    //   alert('Selected image file: ' + name.files.item(0).name);
      const [file] = name.files
      if (file) {
        blah.src = URL.createObjectURL(file);
        blah.style.display = "block";
        }
    };   
    function showvideoname() {
      var name = document.getElementById('video_upload'); 
    //   alert('Selected video file: ' + name.files.item(0).name);
      const [file] = name.files
      if (file) {
        blvh.src = URL.createObjectURL(file);
        blvh.style.display = "block";
        }
    };  
    </script>
   
    
    <?php
    echo $this->Form->create(null, ['type'=>'file','url' => ['action' => 'feed']]);
    // echo '<label for="file-upload" class="custom-file-upload">';
    // echo $this->Form->control('Photo',['type'=>'file']);
    // echo '</label>';
    echo '<div id="slide">';
    
        for ($x = 1; $x <= 24; $x++) {
            echo '<button class="ignore-css" type="submit" name="stamp_id" value='.$x.'>';
            echo $this->Html->image("stamp/".$x.".png",['alt' => 'image','type'=>'image','value'=>$x]);
            echo '</button>';
          }
    
    echo '</div>';
    echo '<div class="flex" style="justify-content: space-between;">';
    echo '<div><span><label class="custom-file-upload"><input id="image_upload" name="image" type="file" onchange="showimagename()" />Photo</label></span>';
    echo '<span><label class="custom-file-upload"><input id="video_upload" name="video" type="file" onchange="showvideoname()" />Video</label></span></div>';
    echo '<div><input class="submit" value="POST" type="submit"></div>';
    echo '</div>';
    // echo $this->Form->control('stamp_id',['label'=>false,'type'=>'text']);

    ?>
    <img id="blah" src="#" class="imagebox" alt="image upload" style="display:none"/>

    <video id="blvh" src="#" type="video/mp4" style="display:none" width="320" height="240" controls>
    Your browser does not support the video tag.
    </video>

    <div class="flex"> 
        <?php
        echo $this->Form->control('message', ['rows' => '3','label' => false,'placeholder' => "Enter your message here",'style'=>'width:100%;']);
        echo $this->Form->end();
        ?>
    </div>
 