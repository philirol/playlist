<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mailgun\Mailgun;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Exception;

class TestMailgunController extends Controller
{
    public function testMailgun(){
        
        # Instantiate the client.
        $mgClient = new Mailgun(env('MAILGUN_SECRET'));
        $domain = env('MAILGUN_DOMAIN');
        # Make the call to the client.
        $result = $mgClient->sendMessage($domain, array(
        'from'	=> 'Excited User <mailgun@YOUR_DOMAIN_NAME>',
        'to'	=> 'Baz <YOU@YOUR_DOMAIN_NAME>',
        'subject' => 'Hello',
        'text'	=> 'Testing some Mailgun awesomness!'
            ));
    }

    public function sendmail(){
        $user = Auth::user();
        $data = array('name' => $user->name, 'email' => $user->email);
        Mail::send('emails.testmailgun', function($message) use ($data){
            $message->to($data['email'], $data['name'])->subject('Test Subject');
        });
        return back()->with('message', 'email envoyé');
    }

}
