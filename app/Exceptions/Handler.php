<?php namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use App\Mail\Error;
use Mail;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    /*public function report(Exception $exception)
    {
        try {
            // emails.exception is the template of your email
            // it will have access to the $error that we are passing below
            $receiverAddress = [env('MAIL_ALL_RECEIVER')];
            Mail::to($receiverAddress)->send(new Error($exception));

            parent::report($exception);
        } catch (Exception $exception){
            // parent::report($exception);
        }
    }*/

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // Handle 403 errors (forbidden)
        if ($exception instanceof HttpException && $exception->getStatusCode() == 403) {
            return redirect()->guest(route('home'));
        }

        // Handle 500 errors (internal server error)
        if ($exception instanceof HttpException && $exception->getStatusCode() == 500 && env('APP_DEBUG') === false) {
            return view('errors.500');
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        // return redirect()->guest(route('login'));

        $guard = array_get($exception->guards(), 0);

        switch ($guard) {
            case 'lawyer':
                $login = 'lawyer.login';
                break;
            case 'member':
                $login = 'member.login';
                break;
            default:
                $login = 'member.login';
                break;
        }
        return redirect()->guest(route($login));
    }
}
