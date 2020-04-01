<?php

namespace App\Exceptions;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(\Exception $e)
    {
        if ($e instanceof \Exception) {

            $error['file']    = $e->getFile();
            $error['code']    = $e->getCode();
            $error['line']    = $e->getLine();
            $error['message'] = $e->getMessage();
            $error['trace']   = $e->getTrace();

            if(ENV('APP_ENV') == "local"){
                #1. Queue email for sending on "exceptions_emails" queue
                #2. Use the emails.exception_notif view shown below
                #3. Pass the error array to the view as variable $e
                /* $email = 'philirol@hotmail.com';
                $subject = 'erreur';
                 Mail::to('errors.error', ["e" => $error], function ($m) use($email, $subject){
                       $m->to($email)->subject($subject);
                });  */
                $test = 'phil';
                Mail::to('philirol@hotmail.com')->send(new SendMailable($test));
            }
        }
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof AuthorizationException){
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized.'], 403);
            }
            return redirect('songs')->with('message', 'Action non autorisée !');
        }
        if ($exception instanceof \Illuminate\Http\Exceptions\PostTooLargeException) 
            return response()->view('errors.post_too_large');
        
        return parent::render($request, $exception);        
    }
}
