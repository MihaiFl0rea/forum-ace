/* Custom app scripts */

/**
 * Initiate datatable
 */
$(function(){
    $('#recent_companies, #recent_students, #all_companies, #all_students, #all_categories, #all_tags').DataTable();
});

/**
 * Initiate custom select2
 */
$(function(){
    $('#article_categories,#article_tags').select2({closeOnSelect:false});
});

/***
 * Get input file path and add it to the source of a image to preview it
 * @param input
 */
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#img_preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function(){
    /**
     * On-click handler to dynamically approve a user
     */
    $('button.approve-user').click(function() {
        var id = $(this).attr('id'),
            email = $(this).attr('data-email'),
            userTable = $(this).attr('data-table-name'),
            button = $(this),
            slashSign = button.closest('td').find('strong');

        $.post('admin/approve-user', {id: id, email: email, userTable: userTable}).done(function(response) {
            if (response == true) {
                button.closest('td').find('span').removeClass('badge-warning').addClass('badge-success').text('Approved');
                slashSign.remove();
                button.remove();
            }
        });
    });

    /**
     * On-click handler to dynamically delete data from db and also remove it from DOM
     */
    $('button.delete-company').click(function(){
        var id = $(this).attr('id'),
            logo = $(this).attr('data-logo');

        $.post('stergere-companie', {id: id, logo: logo}, function(){
            $("#company-record-" + id).fadeOut("slow", function() {
                // remove element
                $(this).remove();
            });
        });
    });

    /**
     * On-click handler to dynamically delete data from db and also remove it from DOM
     */
    $('button.delete-student').click(function(){
        var id = $(this).attr('id'),
            avatar = $(this).attr('data-avatar');

        $.post('stergere-student', {id: id, avatar: avatar}, function(){
            $("#student-record-" + id).fadeOut("slow", function() {
                // remove element
                $(this).remove();
            });
        });
    });

    /**
     * On-click handler to dynamically delete data from db and also remove it from DOM
     */
    $('button.delete-category').click(function(){
        var id = $(this).attr('id');

        $.post('stergere-categorie', {id: id}, function(){
            $("#category-record-" + id).fadeOut("slow", function() {
                // remove element
                $(this).remove();
            });
        });
    });

    /**
     * On-click handler to dynamically delete data from db and also remove it from DOM
     */
    $('button.delete-tag').click(function(){
        var id = $(this).attr('id');

        $.post('stergere-tag', {id: id}, function(){
            $("#tag-record-" + id).fadeOut("slow", function() {
                // remove element
                $(this).remove();
            });
        });
    });

    /**
     * Preview image (input file upload)
     */
    $('#poster').change(function(){
        // show image preview container
        var previewNode = $('#img_preview').closest('div');
        previewNode.attr('style','');
        // build image preview src
        readURL(this);
        // if no file has been chosen, hide image container
        if (!(this.files && this.files[0])) {
            previewNode.attr('style','display: none;');
        }
    });

    /**
     * Send Froala content as html to server to be further stored into db
     */
    $('#add_article_form').find('#submit').click(function(){
        var articleBody = $(this).find('#article_body').froalaEditor('html.get');
        $(this).find('#article_body').text(articleBody);
        $('#add_article_form').submit();
    });

    $('#edit_article_form').find('#submit').click(function(){
        var articleBody = $(this).find('#article_body').froalaEditor('html.get');
        $(this).find('#article_body').text(articleBody);
        $('#edit_article_form').submit();
    });

    /**---------------------
     * Article Comments logic
     * --------------------- */
    var articleCommentsContainer = $('article.comments');

    // display add comment textarea
    $('.add-comment-header').click(function(){
        $('#add_comment_form').toggle('slow');
    });

    /**
     * Adding a typical comment
     */
    $('#add_comment_form').submit(function(event){
        event.preventDefault();
        var form = $(this),
            textarea = form.find('textarea'),
            message = textarea.val(),
            id_article = textarea.attr('data-id');

        $.post('../adaugare-comentariu', {'id_article': id_article, 'comment': message, 'is_response': 0}, function(response){
            textarea.val('');
            form.toggle('slow');
            response = JSON.parse(response);
            // add the new comment as the first one in the list
            var commentsContainer = $('article.comments ul.media-list');
            commentsContainer.prepend('<li class="media">' + $('#typical_comment').html() + '</li>');

            // build the new comment's container
            var inserted_comment = commentsContainer.find('li').first();
            // map the new inserted comment into DOM
            map_inserted_comment(inserted_comment, response);
        });
    });

    /**
     * Map newly inserted comment into DOM
     * @param inserted_comment
     * @param response
     */
    function map_inserted_comment(inserted_comment, response)
    {
        inserted_comment.attr('id', 'row_comment_' + response.id_comment);
        inserted_comment.find('div').first().attr('id', 'comment_displayed_' + response.id_comment);
        // adding avatar
        inserted_comment.find('#comment_displayed_' + response.id_comment + ' img.avatar').attr('src', response.avatar);
        // adding name
        inserted_comment.find('.media-body .comment-author a').text(response.user_name);
        // adding comment date
        inserted_comment.find('.media-body span.timestamp').text(response.creation_date);
        // adding comment body
        inserted_comment.find('.media-body p.comment-body').html(response.comment);

        // make edit/delete buttons functional
        inserted_comment.find('span.edit-comment').attr('data-id', response.id_comment);
        inserted_comment.find('span.delete-comment').attr('data-id', response.id_comment);
        inserted_comment.children('div').eq(1).attr('id', 'comment_edited_' + response.id_comment);
        inserted_comment.find('#comment_edited_' + response.id_comment + ' textarea').val(response.comment);
        inserted_comment.find('.update-comment').attr('data-id', response.id_comment);
        inserted_comment.find('.cancel-editing').attr('data-id', response.id_comment);
    }

    /**
     * Adding a response comment
     */
    // first, display the textarea in which the comment will be written
    articleCommentsContainer.on('click', '.answer-to-comment', function(){
        var commentId = $(this).attr('data-id');
        // display new comment textarea
        $('#respond_to_' + commentId).removeClass('hidden');
    });
    // secondly, send to server the new updated message
    articleCommentsContainer.on('click', '.add-response-comment', function(){
        var commentId = $(this).attr('data-id'),
            textarea = $('#respond_to_' + commentId + ' textarea'),
            message = textarea.val(),
            id_article = textarea.attr('data-id'),
            commentLevel = $(this).attr('data-comment-level');

        $.post('../adaugare-comentariu', {'id_article': id_article, 'comment': message, 'is_response': commentId}, function(response){
            textarea.val('');
            $('#respond_to_' + commentId).addClass('hidden');
            response = JSON.parse(response);
            var mainContainer = $('#comment_displayed_' + commentId);

            // if another response has been already added, just add another element to the list
            if (mainContainer.find('ul.media-list').length) {
                mainContainer.find('.media-body ul.media-list').append('<li class="media comment-by-author">' + $('#typical_comment').html() + '</li>');
            } else {
                // otherwise, create the list
                mainContainer.find('.media-body').append('<ul class="media-list">'
                    + '<li class="media comment-by-author">' + $('#typical_comment').html() + '</li>' + '</ul>');
            }
            // map the inserted comment into DOM
            var inserted_comment = mainContainer.find('.media-body ul.media-list li').first();
            map_inserted_comment(inserted_comment, response);
        });
    });
    // or cancel the edit process
    articleCommentsContainer.on('click', '.cancel-adding-response', function(){
        var commentId = $(this).attr('data-id');
        // hide new comment textarea
        $('#respond_to_' + commentId).addClass('hidden');
    });

    /**
     * Edit a comment
     */
    // first, display the form with the current comment
    articleCommentsContainer.on('click', '.edit-comment', function(){
        var commentId = $(this).attr('data-id');
        $('#comment_edited_' + commentId).removeClass('hidden');
        $('#comment_displayed_' + commentId).addClass('hidden');
    });
    // secondly, send to server the new updated message
    articleCommentsContainer.on('click', '.update-comment', function(){
        var commentId = $(this).attr('data-id'),
            updatedComment = $('#comment_edited_' + commentId).find('textarea').val();

        $.post('../editare-comentariu', {'id_comment': commentId, 'updated_comment': updatedComment}, function(response){
            response = JSON.parse(response);

            $('#row_comment_' + commentId).find('.media-body p.comment-body').html(response.comment);
            $('#comment_edited_' + commentId).addClass('hidden');
            $('#comment_displayed_' + commentId).removeClass('hidden');
        });
    });
    // or cancel the edit process
    articleCommentsContainer.on('click', '.cancel-editing', function(){
        var commentId = $(this).attr('data-id');
        $('#comment_edited_' + commentId).addClass('hidden');
        $('#comment_displayed_' + commentId).removeClass('hidden');
    });

    /**
     * Delete a comment
     */
    articleCommentsContainer.on('click', '.delete-comment', function(){
        var commentId = $(this).attr('data-id');

        $.post('../stergere-comentariu', {'id_comment': commentId}, function(){
            $("#row_comment_" + commentId).fadeOut("slow", function() {
                // remove element
                $(this).remove();
            });
        })
    });

    /**
     * Adding a like / thumbs up
     */
    articleCommentsContainer.on('click', '.like-comment', function() {
        var commentId = $(this).attr('data-id'),
            likeContainer = $(this),
            commentContainer = $('#row_comment_' + commentId),
            commentParentList = commentContainer.parent('ul.media-list'),
            reviewId = likeContainer.attr('data-review-id');

        if (reviewId != null) {
            // if current user wants to withdraw its thumbs up
            $.post('../stergere-review-comentariu', {'id_review': reviewId}, function(){
                likeContainer.removeAttr('data-review-id');
                likeContainer.find('i').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
                likeContainer.find('span').text(parseInt(likeContainer.find('span').text(), 10) - 1);

                if (commentParentList.length > 1) {
                    var nextComment = commentContainer.next();
                    if (nextComment.length) {
                        nextComment.after(commentContainer.detach());
                    }
                }
            });
        } else {
            // adding thumbs up
            $.post('../adaugare-review-comentariu', {'id_comment': commentId, 'review': '1'}, function(response){
                if (!response.length) {
                    alert('You can NOT review your own comment!');
                    return false;
                }
                response = JSON.parse(response);

                likeContainer.attr('data-review-id', response.id_review_comment);
                likeContainer.find('i').removeClass('fa-thumbs-o-up').addClass('fa-thumbs-up');
                likeContainer.find('span').text(1 + parseInt(likeContainer.find('span').text(), 10));
                if (commentParentList.length > 1) {
                    var previousComment = commentContainer.prev();
                    if (previousComment.length) {
                        previousComment.before(commentContainer.detach());
                    }
                }
                // if comment was previously down-voted (and not by current user), remove thumbs down
                var dislikeContainer = likeContainer.next(),
                    dislikeReviewId = dislikeContainer.attr('data-review-id');

                if (dislikeContainer.find('i').hasClass('fa-thumbs-down') && (dislikeReviewId != null)) {
                    $.post('../stergere-review-comentariu', {'id_review': dislikeContainer.attr('data-review-id')}, function(){
                        dislikeContainer.removeAttr('data-review-id');
                        dislikeContainer.find('i').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
                        dislikeContainer.find('span').text(parseInt(dislikeContainer.find('span').text(), 10) - 1);
                    });
                }
            })
        }
    });

    /**
     * Adding a dislike / thumbs down
     */
    articleCommentsContainer.on('click', '.dislike-comment', function() {
        var commentId = $(this).attr('data-id'),
            dislikeContainer = $(this),
            commentContainer = $('#row_comment_' + commentId),
            commentParentList = commentContainer.parent('ul.media-list'),
            reviewId = dislikeContainer.attr('data-review-id');

        if (reviewId != null) {
            // if current user wants to withdraw its thumbs down
            $.post('../stergere-review-comentariu', {'id_review': reviewId}, function(){
                dislikeContainer.removeAttr('data-review-id');
                dislikeContainer.find('i').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
                dislikeContainer.find('span').text(parseInt(dislikeContainer.find('span').text(), 10) - 1);

                if (commentParentList.length > 1) {
                    var previousComment = commentContainer.prev();
                    if (previousComment.length) {
                        previousComment.before(commentContainer.detach());
                    }
                }
            });
        } else {
            // adding thumbs down
            $.post('../adaugare-review-comentariu', {'id_comment': commentId, 'review': '0'}, function(response){
                if (!response.length) {
                    alert('You can NOT review your own comment!');
                    return false;
                }
                response = JSON.parse(response);

                dislikeContainer.attr('data-review-id', response.id_review_comment);
                dislikeContainer.find('i').removeClass('fa-thumbs-o-down').addClass('fa-thumbs-down');
                dislikeContainer.find('span').text(1 + parseInt(dislikeContainer.find('span').text(), 10));
                if (commentParentList.length > 1) {
                    var nextComment = commentContainer.next();
                    if (nextComment.length) {
                        nextComment.after(commentContainer.detach());
                    }
                }
                // if comment was previously up-voted (and not by current user), remove thumbs up
                var likeContainer = dislikeContainer.prev(),
                    likeReviewId = likeContainer.attr('data-review-id');

                if (likeContainer.find('i').hasClass('fa-thumbs-up') && (likeReviewId != null)) {
                    $.post('../stergere-review-comentariu', {'id_review': likeContainer.attr('data-review-id')}, function(){
                        likeContainer.removeAttr('data-review-id');
                        likeContainer.find('i').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
                        likeContainer.find('span').text(parseInt(likeContainer.find('span').text(), 10) - 1);
                    });
                }
            })
        }
    });

    /**---------------------
     * End of Article Comments logic
     * --------------------- */
});