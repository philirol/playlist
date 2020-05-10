<?php

namespace App\Exceptions;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Jobs\ErrorHandledMailToAdminJob;

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
    public function report(Throwable $e)
    {
        /* if ($e instanceof \Exception && !$e instanceof \Illuminate\Validation\ValidationException) {

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
        } */
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthorizationException){
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized.'], 403);
            }
            return redirect('songs')->with('messageDanger', 'Action non autorisée !');
        }
    
     //https://stripe.com/docs/api/errors/handling       
        if ($exception instanceof \Laravel\Cashier\Exceptions\InvalidStripeCustomer){
            $error['message'] = 'Error Stripe : InvalidStripeCustomer';
        } elseif ($exception instanceof \Stripe\Exception\CardException){
            $error['class'] = 'CardException';
            $error['stripe'] = 'Stripe says : Since it\'s a decline, \Stripe\Exception\CardException will be caught.';
            $error['status'] = $exception->getHttpStatus();
            $error['type'] = $exception->getError()->type; 
            $error['code'] = $exception->getError()->code;
            $error['param'] = $exception->getError()->message;
            $error['message'] = 'No advice yet';
        } elseif ($exception instanceof \Stripe\Exception\AuthenticationException){
            $error['class'] = 'AuthenticationException';
            $error['stripe'] = 'Authentication with Stripe\'s API failed';
            // $error['status'] = $exception->getHttpStatus();
            // $error['type'] = $exception->getError()->type; 
            // $error['code'] = $exception->getError()->code;
            // $error['param'] = $exception->getError()->message;
            $error['message'] = 'Maybe check the Strip customer stripe_id, maybe you changed API keys recently, or maybe run config:clear on the app';
        } elseif ($exception instanceof \Stripe\Exception\RateLimitException){
            $error['class'] = 'RateLimitException';
            $error['stripe'] = 'Too many requests made to the API too quickly';
            $error['status'] = $exception->getHttpStatus();
            $error['type'] = $exception->getError()->type; 
            $error['code'] = $exception->getError()->code;
            $error['param'] = $exception->getError()->message;
            $error['message'] = 'No advice';
        } elseif ($exception instanceof \Stripe\Exception\InvalidRequestException){
            $error['class'] = 'InvalidRequestException';
            $error['stripe'] = 'Invalid parameters were supplied to Stripe\'s API';
            $error['status'] = $exception->getHttpStatus();
            $error['type'] = $exception->getError()->type; 
            $error['code'] = $exception->getError()->code;
            $error['param'] = $exception->getError()->message;
            $error['message'] = 'Maybe check the Strip customer stripe_id o run config:clear on the app';
        } elseif ($exception instanceof \Stripe\Exception\ApiConnectionException ){
            $error['class'] = 'ApiConnectionException';
            $error['stripe'] = 'Network communication with Stripe failed';
            $error['status'] = $exception->getHttpStatus();
            $error['type'] = $exception->getError()->type; 
            $error['code'] = $exception->getError()->code;
            $error['param'] = $exception->getError()->message;
            $error['message'] = 'No advice';
        } elseif ($exception instanceof \Stripe\Exception\ApiErrorException ){
            $error['class'] = 'ApiErrorException';
            $error['stripe'] = 'Display a very generic error to the user, and maybe send yourself an email';
            $error['status'] = $exception->getHttpStatus();
            $error['type'] = $exception->getError()->type; 
            $error['code'] = $exception->getError()->code;
            $error['param'] = $exception->getError()->message;
            $error['message'] = 'No advice';
        }
        if(isset($error)){
        ErrorHandledMailToAdminJob::dispatch($error);
        return back()->with('messageDanger', __('Il y a eu un problème technique non identifié, désolé.'));
        }

        if ($exception instanceof \Illuminate\Http\Exceptions\PostTooLargeException) 
            return response()->view('errors.post_too_large');
        
        return parent::render($request, $exception);        
    }
}
