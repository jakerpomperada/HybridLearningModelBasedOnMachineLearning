<?php

namespace App\Http\Middleware;

use App\Events\ChangeSemesterTermEvent;
use App\Models\AcademicTermSemester;
use Closure;
use Domain\Shared\AcademicTerm;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoadAcademicTermMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {



        return $next($request);
    }
}
