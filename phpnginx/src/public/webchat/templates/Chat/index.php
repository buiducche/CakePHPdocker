<style>
    .bound {
        padding: 10px;
        min-width: 100px;
        min-height: 60px;
        border: 1px solid lightgray;
        margin: 5px;
        border-radius: 5px;
        position: relative;
    }

    .chatbox {
        height: 370px;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    .edit_delete {
        display: none;
        position: absolute;
        color: #000;
        background: #ff0;
        right: 0px;
        bottom: -5px;
        padding: 5px;
        border-radius: 5px;
    }

    .bound:hover .edit_delete {
        display: block;
    }

    .flex {
        display: flex;
    }

    .submit {
        position: relative;
        display: flex;
        flex-direction: row-reverse;
    }

    .flex {
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

    .textarea {
        width: 100%;
    }

    .imagebox {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        width: 150px;
    }

    video {
        max-width: 600px;
        height: 100%;
    }

    .avartar {
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

    .name {
        background-color: transparent;
        border-width: 0;
        color: #436475;
        cursor: pointer;
        display: inline;
        font-family: -apple-system, BlinkMacSystemFont, ".SFNSDisplay-Regular", "Segoe UI", "Helvetica Neue", "Hiragino Sans", ヒラギノ角ゴシック, "Hiragino Kaku Gothic ProN", "ヒラギノ角ゴ  ProN W3", Meiryo, メイリオ, "MS PGothic", "ＭＳ  Ｐゴシック", sans-serif;
        font-size: 100%;
        font-weight: 700;
        line-height: 19.5px;
        margin: 0;
        outline: 0;
        padding: 0;
        quotes: auto;
        white-space: nowrap;
    }

    .slide {
        width: auto;
        height: 100px;
        overflow-x: scroll;
        overflow-y: hidden;
        white-space: nowrap;
    }

    .ignore-css {
        all: unset;
    }

    .post_time span {
        display: none;
        position: absolute;
        color: #fff;
        background: #000;
        padding: 5px;
        top: -50px;
        left: -65px;
        min-width: 140px;
        overflow: visible;
        border-radius: 5px;

    }

    .post_time {
        font-size: 11px;
        line-height: 16.5px;
        position: relative;
    }

    .post_time:hover span {
        display: block;
        text-align: center;
    }
</style>
<!-- Load chat -->
<div class="chatbox" id="chatbox">
    <?php foreach ($t_feed as $t_feed) : ?>
        <div class="bound">

            <div class="flex" style="justify-content: space-between;">
                <div class="name">
                    <?= $t_feed->name . '' ?>
                </div>
                <div class="post_time">
                    <?= $t_feed->create_at->format('d/m H:i') ?>
                    <span>
                        <?= "Posted:" . $t_feed->create_at->format('d/m/Y H:i') ?>
                        <br>
                        <?= "Edited:" . $t_feed->update_at->format('d/m/Y H:i') ?>
                    </span>
                </div>
            </div>
            <p>
            <div>
                <span style="word-wrap: break-word">
                    <?= nl2br($t_feed->message) ?>
                </span>

            </div>
            </p>
            <?php
            //Display video and image
            if ($t_feed->image_file_name) {
                if (substr($t_feed->image_file_name, 0, 5) == 'video') {
                    echo "<div class=\"video\">";
                    echo $this->Html->media($t_feed->image_file_name, ['alt' => 'video', 'controls' => true, 'type' => "video/mp4"]);
                    echo "</div>";
                } else {
                    echo "<div class=\"imagebox\">";
                    echo $this->Html->image($t_feed->image_file_name, ['alt' => 'image']);
                    echo '<a href="/img/' . $t_feed->image_file_name . '" download >' . substr(substr($t_feed->image_file_name, 7), -12, 12) . '</a>';
                    echo "</div>";
                }
            }
            //Stamp list
            if ($t_feed->stamp_id) {
                echo $this->Html->image("stamp/" . $t_feed->stamp_id . ".png", ['alt' => 'image', 'type' => 'stamp']);
            }
            //Edit and delete own feed
            if ($t_feed->user_id == $user_id) {
                echo '<div class="edit_delete">';
                echo $this->Html->link('Edit', ['action' => 'edit', $t_feed->id]);
                echo '&nbsp';
                echo $this->Form->postLink(
                    'Delete',
                    ['action' => 'delete', $t_feed->id],
                    ['confirm' => 'Are you sure?']
                );
                echo '</div>';
            }
            ?>
        </div>
    <?php endforeach; ?>
</div>
<script>
    //Go to bottom of the chat
    setTimeout(() => {
        document.getElementById("chatbox").scrollTop = document.getElementById("chatbox").scrollHeight;
    }, 100);
    //Preview image
    function showimage() {
        var name = document.getElementById('image_upload');
        const [file] = name.files
        if (file) {
            blah.src = URL.createObjectURL(file);
            blah.style.display = "block";
        }
    };
    //Preview video
    function showvideo() {
        var name = document.getElementById('video_upload');
        const [file] = name.files
        if (file) {
            blvh.src = URL.createObjectURL(file);
            blvh.style.display = "block";
        }
    };
</script>
<!-- POST FORM -->
<?= $this->Form->create(null, ['type' => 'file', 'url' => ['action' => 'feed']]); ?>
<div class="slide">
    <?php
    for ($x = 1; $x <= 24; $x++) {
        echo '<button class="ignore-css" type="submit" name="stamp_id" value=' . $x . '>';
        echo $this->Html->image("stamp/" . $x . ".png", ['alt' => 'image', 'type' => 'image', 'value' => $x]);
        echo '</button>';
    }
    ?>
</div>
<div class="flex" style="justify-content: space-between;">
    <div><span><label class="custom-file-upload"><input id="image_upload" name="image" type="file" onchange="showimage()" />Photo</label></span>
        <span><label class="custom-file-upload"><input id="video_upload" name="video" type="file" onchange="showvideo()" />Video</label></span>
    </div>
    <div><input class="submit" value="POST" type="submit"></div>
</div>

<img id="blah" src="#" class="imagebox" alt="image upload" style="display:none" />
<video id="blvh" src="#" type="video/mp4" style="display:none" width="320" height="240" controls>
    Your browser does not support the video tag.
</video>

<div class="flex">
    <?php
    echo $this->Form->control('message', ['rows' => '3', 'label' => false, 'placeholder' => "Enter your message here", 'style' => 'width:100%;']);
    echo $this->Form->end();
    ?>
</div>
