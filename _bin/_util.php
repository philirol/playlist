<?php
<a href="javascript:history.back()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-left"></span> @lang('Retour')</a>

<a class="navbar-brand" href="">Mentions légales</a>
			<a class="navbar-brand" href="">Politique de confidentialité</a>
			
SQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key constraint fails (`playlist7b`.`invitations`, CONSTRAINT `invitations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION) (SQL: delete from `users` where `id` = 12) 

SQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key constraint fails (`playlist7b`.`invitations`, CONSTRAINT `invitations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)) (SQL: delete from `users` where `id` = 12) 
//free
MAIL_DRIVER=smtp ou log
MAIL_HOST=smtp.free.fr
MAIL_PORT=25
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=webmaster@playlistband.net
MAIL_FROM_NAME="${APP_NAME}"
        
//Mailtrap
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=3ed2f506ff226d
MAIL_PASSWORD=d449799a951e8f
MAIL_FROM_ADDRESS=gazaoui34@outlook.fr
MAIL_FROM_NAME=Gazaoui34 

//Mailgun
MAIL_DRIVER=mailgun
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_USERNAME=postmaster@sandboxcd83986f9c13462db11df3740ed77599.mailgun.org
MAIL_PASSWORD=b74ceadd616ae03d55fe838c12cdac6f-f135b0f1-9f2a74a5
MAILGUN_DOMAIN=sandboxcd83986f9c13462db11df3740ed77599.mailgun.org
MAILGUN_SECRET=642c8f1f7caba00f96b4b9140895a0fa-f135b0f1-f51b171c
MAIL_ENCRYPTION=null

//TEST MAILGUN
Route::get('testmail', function(){
	Mail::raw('Sending emails with Mailgun and Laravel should be easy!', function($message)
	{
		$message->to('philirol58@gmail.com');
	});
});
Route::get('sendmail','TestMailgunController@sendmail');
Route::get('sendmail2','TestMailgunController@testMailgun');
// FIN TEST MAILGUN