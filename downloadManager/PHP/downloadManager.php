<div class="row justify-content-between align-items-center py-3 border-bottom mb-4">
    <h3>Download Manager 🚀</h3>

    <a class="btn btn-primary btn-sm" href="<?php echo DOMAIN_ADMIN; ?>configure-plugin/downloadManager">Button settings</a>


</div>
<style>
    .dm-list {
        margin: 100px 0;
        display: block;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .dm-list li {
        display: grid;
        grid-template-columns: 50px 1fr 50px 100px 80px;
        align-items: center;
        padding: 5px 0;
        border-bottom: solid 1px #ddd;
        gap: 10px;
    }

    .dm-list .thumb {
        width: 40px;
        height: 40px;
        background: #000;
        margin-right: 10px;
    }
</style>

<ul class="dm-list">

    <?php foreach (glob(PATH_CONTENT . 'downloadManagerFolder/*.*') as $file) {

        $basename = pathinfo($file)['basename'];
        $ext = pathinfo($file)['extension'];

        echo '<li><div class="thumb"';

        if ($ext === 'jpg' || $ext === 'webp' || $ext === 'gif' || $ext === 'png' || $ext === 'jpeg' || $ext === 'bmp') {
            echo 'style="background:url(' . DOMAIN . HTML_PATH_CONTENT . 'downloadManagerFolder/' . $basename . ');background-size:cover;"';
        };

        echo '></div> ' . $basename . ' <button class="btn btn-primary btn-sm copy-link" data-link="' . DOMAIN . HTML_PATH_CONTENT . 'downloadManagerFolder/' . $basename . '">Copy</button><button class="btn btn-primary btn-sm shortcode" data-shortcode="' . $basename . '">shortcode</button>
        
        <form class="d-flex" method="post">
        <input type="hidden" id="jstokenCSRF" name="tokenCSRF" value="' . $tokenCSRF . '">
        <input  type="hidden" name="nameFile" value="' . $basename . '">
        <button class="btn btn-sm btn-danger" name="deleteFile" type="submit" onclick="return confirm(`Are you sure you want to delete this item?`);">Delete</button></form>
        </li>';
    }; ?>

</ul>

<script>
    var copyLinks = document.querySelectorAll('.copy-link');
    for (var i = 0; i < copyLinks.length; i++) {
        copyLinks[i].addEventListener('click', function(e) {
            e.preventDefault();
            var dataLink = this.getAttribute('data-link');
            
            if (navigator.clipboard) {
                navigator.clipboard.writeText(dataLink).then(function() {
                    alert("Link copied to clipboard");
                }).catch(function(err) {
                    console.error('Unable to copy text to clipboard', err);
                });
            } else {
                // Jeśli Clipboard API nie jest obsługiwane, użyj alternatywnej metody
                var textArea = document.createElement('textarea');
                textArea.value = dataLink;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                alert("Link copied to clipboard");
            }
        });
    }

    var shortcodes = document.querySelectorAll('.shortcode');
    for (var j = 0; j < shortcodes.length; j++) {
        shortcodes[j].addEventListener('click', function(e) {
            e.preventDefault();
            var dataShortcode = this.getAttribute('data-shortcode');
            
            if (navigator.clipboard) {
                navigator.clipboard.writeText('[% dm="' + dataShortcode + '" %]').then(function() {
                    alert("Shortcode copied to clipboard");
                }).catch(function(err) {
                    console.error('Unable to copy text to clipboard', err);
                });
            } else {
                // Jeśli Clipboard API nie jest obsługiwane, użyj alternatywnej metody
                var textArea = document.createElement('textarea');
                textArea.value = '[% dm="' + dataShortcode + '" %]';
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                alert("Shortcode copied to clipboard");
            }
        });
    }
</script>

<br>
<script type='text/javascript' src='https://storage.ko-fi.com/cdn/widget/Widget_2.js'></script>
<script type='text/javascript'>
    kofiwidget2.init('you like it? Buy me coffe', '#e02828', 'I3I2RHQZS');
    kofiwidget2.draw();
</script>