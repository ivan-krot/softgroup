<?php
/*
Plugin Name: post-publish-email-send
Plugin URI:
Description: Plugin send email after saving the post
Version: 1.0
Author: Ivan Krot
Author URI:
License: GPL2
*/

function post_publish_email_send($post_ID)
{
	$to = 'i.m.krot@ukr.net';
	$subject = "We have a NEW post !";
	$message = 'New post in our blog ! Send by ID:'.$post_ID;
	wp_mail($to, $subject, $message);
	return $post_ID;
}
add_action('publish_post', 'post_publish_email_send');