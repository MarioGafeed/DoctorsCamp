<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class LangApiMiddleware
{

  public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle(Request $request, Closure $next)
    {
      // read the language from the request header
      $locale = $request->header('Accept-Language');

      // if the header is missed
      if(!$locale){
          // take the default local language
          $locale = $this->app->config->get('app.locale');
      }

      // check the languages defined is supported
      if (!array_key_exists($locale, $this->app->config->get('app.supported_languages'))) {
          // respond with error
          return abort(403, 'Language not supported. اللغة غير مدعومة');
      }

      // set the local language
      $this->app->setLocale($locale);

      // get the response after the request is done
      $response = $next($request);

      // set Accept Languages header in the response
      $response->headers->set('Accept-Language', $locale);

      // return the response
      return $response;
    }
}
