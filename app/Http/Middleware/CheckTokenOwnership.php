<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckTokenOwnership
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
        $web3_helper = new \App\Lib\Web3Helper();
        $wallet_address = auth()->user()->wallet_address;

        session([
            'can_create' => $web3_helper->canCreateGame($wallet_address),
            'can_play' => $web3_helper->canPlayGame($wallet_address)
        ]);

        return $next($request);
    }
}
