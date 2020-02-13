<?php


function formComment($id){
    $args = array(
        'id_form'           => 'commentform',
        'class_submit' => 'btn btn-outline-primary',
        'class_form' => 'form-row ',
        'comment_field' =>
        '<div class="form-group col-md-12"><textarea class="form-control" id="comment" placeholder="Masukkan Komentar anda." name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
        'fields' => apply_filters(
            'comment_form_default_fields',
            array(
                'author' =>
                '<div class="form-group col-md-4"><input placeholder="Masukkan nama." id="author" class="form-control" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '"/></div>',
                'email' =>
                '<div class="form-group col-md-4"><input placeholder="Masukkan Email." id="email" class="form-control" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '"  /></div>',
                'url' =>
                ' <div class="form-group col-md-4"><input placeholder="Masukkan URL Website." id="url" class="form-control" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '"  /></div>'
            )
            ),
        'comment_noted_after' => ''
    );
    comment_form($args, $id);
}
?>