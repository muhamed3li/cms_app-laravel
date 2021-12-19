<?php

namespace App\Http\Middleware;

use App\Models\Categorie;
use Closure;
use Illuminate\Http\Request;

class checkCategory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    { 
      $count = Categorie::all()->count();
      if ($count == 0) {
        session()->flash('error', 'First you need to add some categories.');
        return redirect(route('categories.index'));
      }
        return $next($request);
    }
}
