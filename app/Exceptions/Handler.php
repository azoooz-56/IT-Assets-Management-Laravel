<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register() : void
    {
        $this->renderable( function (\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException $e, Request $request) {
            if ( $request->is( 'api/*' ) ) {
                return response()->json( [
                    'message' => $e->getMessage(),
                    'code'    => 'METHOD_NOT_ALLOWED | HTTP_NOT_FOUND',
                ], Response::HTTP_NOT_FOUND );
            }
        } );

        $this->renderable( function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, Request $request) {
            if ( $request->is( 'api/*' ) ) {
                return response()->json( [
                    'message' => $e->getMessage(),
                    'code'    => 'NOT_FOUND_EXCEPTION',
                ], Response::HTTP_NOT_FOUND );
            }
        } );


        $this->renderable( function (\Illuminate\Validation\ValidationException $e, Request $request) {
            if ( $request->is( 'api/*' ) ) {
                if ( $e->validator->fails() ) {
                    return response()->json( [
                        'message' => $e->validator->errors()->first(),
                        'code'    => 'VALIDATION_EXCEPTION',
                    ], Response::HTTP_UNPROCESSABLE_ENTITY );
                }
            }
        } );

        $this->reportable( function (Throwable $e) {
            //
        } );
    }
}
