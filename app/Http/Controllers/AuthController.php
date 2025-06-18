<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->accessToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $google2fa = new Google2FA();

        // First-time setup: generate and save secret
        if (!$user->google2fa_secret) {
            $secret = $google2fa->generateSecretKey();
            $user->google2fa_secret = $secret;
            $user->two_factor_verified_at = null;
            $user->save();
        }

        $qrContent = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $user->google2fa_secret
        );

        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd() // No Imagick needed
        );

        $writer = new Writer($renderer);
        $svg = $writer->writeString($qrContent);

        return response()->json([
            'requires_2fa' => true,
            'qr_svg' => $svg,
            'message' => 'Scan the QR code using Google Authenticator and submit the code.'
        ]);
    }

    public function verify2fa(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'one_time_password' => 'required|digits:6'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !$user->google2fa_secret) {
            return response()->json(['message' => '2FA not set up'], 403);
        }

        $google2fa = new Google2FA();

        if (!$google2fa->verifyKey($user->google2fa_secret, $request->one_time_password)) {
            return response()->json(['message' => 'Invalid 2FA code'], 403);
        }

        $user->two_factor_verified_at = now();
        $user->save();

        $token = $user->createToken('api')->accessToken;

        return response()->json([
            'token' => $token,
            'message' => '2FA verified successfully.',
            'user' => $user
        ]);
    }
}
