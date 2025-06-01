<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class GeneralErrorException extends Exception
{
    /**
     * Report the exception.
     */
    public function report(): void
    {
        //
    }

    public function register()
    {
        $this->renderable(function (\Throwable $e, $request) {
            if ($request->expectsJson() || $request->header('X-Livewire')) {
                return response()->json([
                    'message' => 'Something went wrong. Please try again.',
                    'exception' => config('app.debug') ? $e->getMessage() : null,
                ], 500);
            }
        });
    }

    /**
     * Render the exception as an HTTP response.
     */
    public function render($request, Throwable $e)
    {
        if (! config('app.debug')) {
            // Return a clean error view for normal web requests
            return response()->view('errors.general', [
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }

        return parent::render($request, $e);
    }
}
