<?php

namespace App\Exceptions;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

use Illuminate\Http\Response;


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
        if ($e instanceof \Exception && !$e instanceof \Illuminate\Validation\ValidationException) {

            //  if ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException){                
            //     $data['httpcode'] = $e->getStatusCode();
            // }    MARCHE PAS
                    
            //Methodes of the Exception class :
            $data['file']    = $e->getFile();
            $data['code']    = $e->getCode(); // User-defined Exception code
            $data['line']    = $e->getLine();
            $data['message'] = $e->getMessage();
            $data['trace']   = $e->getTrace(); // An array of the backtrace()
            $data['traceAsString'] = $e->getTraceAsString(); // Formated string of trace

            if(ENV('APP_ENV') == "local"){ //local or production
                Mail::to('philirol@hotmail.com')->send(new SendMailable($data));
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
            return redirect('songs')->with('messageDanger', 'Action non autorisée !');
        }

        if ($exception instanceof \Laravel\Cashier\Exceptions\InvalidStripeCustomer){
            return back()->with('messageDanger', __('Il y a eu un problème technique. Signaler votre problème dans Contact'));
        }

        if ($exception instanceof \Illuminate\Http\Exceptions\PostTooLargeException) 
            return response()->view('errors.post_too_large');
        
        return parent::render($request, $exception);        
    }
}
