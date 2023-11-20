<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->descriptiveResponseMethods();
    }

    protected function descriptiveResponseMethods()
    {
        $instance = $this;
        Response::macro('ok', function ($message , $data = []) use ($instance) {
            return $instance->handleSuccessResponse( $message, $data , 200);
        });

        Response::macro('created', function ($data) use ($instance){
            if ($data) {
                return $instance->handleSuccessResponse(__('Created Successfully'), $data, 201);
            }

            return Response::json([], 201);
        });

        Response::macro('noContent', function ($data = []) {
            return Response::json([], 204);
        });

        Response::macro('badRequest', function ( $errors = []) use ($instance) {
            return $instance->handleErrorResponse(__('Validation Failure'), $errors, 400);
        });

        Response::macro('unauthorized', function ($message = 'User unauthorized', $errors = []) use ($instance) {
            return $instance->handleErrorResponse($message, $errors, 401);
        });

        Response::macro('forbidden', function ($errors = []) use ($instance) {
            return $instance->handleErrorResponse(__('Phone & Password does not match with our record'), $errors, 403);

        });

        Response::macro('notFound', function ($message = 'Resource not found.', $errors = []) use ($instance) {
            return $instance->handleErrorResponse($message, $errors, 404);
        });

        Response::macro('internalServerError', function ( $errors = []) use ($instance) {
            return $instance->handleErrorResponse(__('Internal Server Error'), $errors, 500);
        });

        Response::macro('error', function ( $message , $errors = []) use ($instance) {
            return $instance->handleErrorResponse($message, $errors, 500);
        });
    }

    public function handleErrorResponse( $message, $errors  ,$status)
    {
        $response = [
            'status' => false ,
            'message' => $message,
        ];

        if (count($errors)) {
            $response['errors'] = $errors;
        }

        return Response::json($response, $status);
    }

    public function handleSuccessResponse(  $message, $data  ,$status)
    {
        $response = [
            'status' => true ,
            'message' => $message,
        ];
        if ($data) {
            $response['data'] = $data;
        }
        return Response::json($response, $status);
    }

}
