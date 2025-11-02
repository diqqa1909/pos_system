<?php   
    namespace App\Http\Middleware;
    use Closure;
    
    use Illuminate\Http\Request;
    use symfony\Component\HttpFoundation\Response;
    use Auth;

    class AdminMiddleware
    {
       public function handle(Request $request, Closure $next):Response{
        if(Auth::check()){
            if(Auth::user()->is_role==1){
                return $next($request);
            }
            else{
                Auth::logout();
                return request(url('/'));
            }
        }else{
            Auth::logout();
            return request(url('/'));
        }
       } 
    }