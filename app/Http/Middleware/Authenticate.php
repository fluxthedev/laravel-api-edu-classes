<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Auth\AuthenticationException;

class Authenticate extends Middleware
{
  /**
   * Get the path the user should be redirected to when they are not authenticated.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return string|null
   */
  protected function redirectTo($request)
  {
    if (!$request->expectsJson()) {
      throw new AuthenticationException(
        'Unauthenticated.',
        [],
        $this->jsonResponse($request)
      );
    }
  }

  /**
   * Get the JSON response for unauthenticated requests.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\JsonResponse
   */
  protected function jsonResponse($request)
  {
    return response()->json(['message' => 'Unauthenticated.'], 401);
  }
}
