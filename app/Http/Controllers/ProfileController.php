<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use PragmaRX\Google2FAQRCode\Google2FA;
use PragmaRX\Google2FA\Google2FA as Google2FA2;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function enable2FA2()
    {
        $user = auth()->user();

        $google2fa = app(Google2FA::class);

        $user->google2fa_secret = $google2fa->generateSecretKey();
        $user->save();

        // Generate a QR code for the user to scan with Google Authenticator
        $qrCode = $google2fa->getQRCodeInline(
        config('app.name'),
        $user->email,
        $user->google2fa_secret
        );

        return view('enable-2fa', ['user' => $user, 'qrCode' => $qrCode]);
    }

    public function verify2FA(Request $request)
{
    $user = auth()->user();
    $google2fa = app(Google2FA::class);

    $is2faVerified = $google2fa->verifyKey($user->google2fa_secret, $request->input('2fa_code'));

    if ($is2faVerified) {
        // 2FA is verified; you can consider it enabled for the user
        $user->two_factor_secret = $user->google2fa_secret;
        $user->two_factor_recovery_codes = [];
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Two-factor authentication has been enabled.');
    } else {
        return back()->with('error', 'Invalid 2FA code. Please try again.');
    }
}

public function show2FASetupForm()
{
    $user = auth()->user();
    $google2fa = app(Google2FA::class);

    if ($user->two_factor_secret) {
        return redirect()->route('profile')->with('info', '2FA is already enabled.');
    }

    $secretKey = $google2fa->generateSecretKey();
    $qrCode = $google2fa->getQRCodeInline(
        config('app.name'),
        $user->email,
        $secretKey
    );

    return view('profile.2fa-setup', compact('user', 'qrCode', 'secretKey'));
}

public function enable2FA(Request $request)
{
    $user = auth()->user();

    $this->validate($request, [
        '2fa_code' => 'required',
    ]);

    $google2fa = app(Google2FA::class);

    if ($google2fa->verifyKey($user->two_factor_secret, $request->input('2fa_code'))) {
        $user->two_factor_secret = $request->input('2fa_secret');
        $user->save();

        return redirect()->route('profile')->with('success', '2FA has been enabled.');
    }

    return back()->with('error', 'Invalid 2FA code. Please try again.');
}


}
