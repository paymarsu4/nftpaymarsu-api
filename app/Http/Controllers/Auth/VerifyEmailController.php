<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Access\AuthorizationException; //added
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request; //Added
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth; //added
use App\Models\User;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(Request  $request): RedirectResponse
    {
        $user = User::findOrFail($request->route('id'));

        if (! hash_equals(sha1($user->getEmailForVerification()), (string) $request->route('hash'))) {
            throw new AuthorizationException();
        }

        // if ($request->user()->hasVerifiedEmail()) {
        if ($user->hasVerifiedEmail()) {
            Auth::loginUsingId($user->id, $remember = true);
            return redirect()->intended(
                config('app.frontend_url').RouteServiceProvider::HOME.'?verified=1'
            );
        }

        // if ($request->user()->markEmailAsVerified()) {
        if ($user->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        Auth::loginUsingId($user->id, $remember = true);

        return redirect()->intended(
            config('app.frontend_url').RouteServiceProvider::HOME.'?verified=1'
        );
    }
}
