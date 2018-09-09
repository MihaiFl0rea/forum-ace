<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 8/26/2018
 * Time: 10:51 PM
 */
?>

<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>codemirror.min.js" ></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>xml.min.js" ></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>froala_editor.min.js" ></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>languages/ro.js" ></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/align.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/char_counter.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/code_beautifier.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/code_view.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/colors.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/draggable.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/emoticons.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/entities.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/file.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/font_size.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/font_family.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/fullscreen.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/image.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/image_manager.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/line_breaker.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/inline_style.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/link.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/lists.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/paragraph_format.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/paragraph_style.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/quick_insert.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/quote.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/table.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/save.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/url.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/video.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/help.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/print.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>third_party/spell_checker.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/special_characters.min.js"></script>
<script type="text/javascript" src="<?php echo assets_js_froala_url(); ?>plugins/word_paste.min.js"></script>

<script>
    /**
     * Initiate Froala Editor
     */
    $(function(){
        $('#article_body').froalaEditor({
            height: 300,
            // language: 'ro',
            // Set the file upload URL
            fileUploadURL: '../upload-file',
            // Set the image upload URL
            imageUploadURL: '../upload-image',
            // Set the image upload URL
            videoUploadURL: '../upload-file'
        })
    });

    /**
     * Handler function on image removing from Froala Editor
     */
    $(function() {
        // Catch the image being removed.
        $('#article_body')
            .froalaEditor({
                // other options?
            })
            .on('froalaEditor.image.removed', function (e, editor, $img) {
                $.ajax({
                    // Request method.
                    method: 'POST',

                    // Request URL.
                    url: '../delete-image',

                    // Request params.
                    data: {
                        src: $img.attr('src')
                    }
                })
                .done (function (data) {
                    console.log ('Image was deleted');
                })
                .fail (function (err) {
                    console.log ('Image delete problem: ' + JSON.stringify(err));
                })
            });
    });

    /**
     * Handler function on video removing from Froala Editor
     */
    $(function() {
        // Catch the image being removed.
        $('#article_body')
            .froalaEditor({
                // other options?
            })
            .on('froalaEditor.video.removed', function (e, editor, $vid) {
                // @todo: investigate why there are needed 2 ajax calls?!
                $.ajax({
                    // Request method.
                    method: 'POST',

                    // Request URL.
                    url: '../delete-file',

                    // Request params.
                    data: {
                        src: $vid.attr('src')
                    }
                })
                    .done (function (data) {
                        console.log ('Video was deleted');
                    })
                    .fail (function (err) {
                        console.log ('Video delete problem: ' + JSON.stringify(err));
                    })
            });
    });

    /**
     * Handler function on file removing from Froala Editor
     */
    $(function() {
        // Catch the file being removed.
        $('#article_body')
            .froalaEditor({
                // other options?
            })
            .on('froalaEditor.file.unlink', function (e, editor, file) {
                console.log('unlinking file');
                $.ajax({
                    // Request method.
                    method: 'POST',

                    // Request URL.
                    url: '../delete-file',

                    // Request params.
                    data: {
                        src: file.getAttribute('href')
                    }
                })
                .done (function (data) {
                    console.log ('File was deleted');
                })
                .fail (function (err) {
                    console.log ('File delete problem: ' + JSON.stringify(err));
                })
            });
    });
</script>