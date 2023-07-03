<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\ValidatePasswordRequest;
use App\Http\Resources\LoggedInUserResource;
use App\Http\Resources\UserOverview;
use App\Http\Responses\NoContentResponse;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PHPOpenSourceSaver\JWTAuth\JWTGuard;

class AuthController extends Controller
{
    private const COOKIE_NAME = 'Authorization';

    private JWTGuard $guard;

    /**
     * Construct a new controller
     *
     * @param Guard $guard
     */
    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param LoginUser $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $token = $this->guard->attempt(['email' => $validated['email'], 'password' => $validated['password']]);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        /**
         * The logged in user
         *
         * @var \App\Models\User | \App\Models\Client
         */
        $user = $this->guard->userOrFail();

        $responseData = [
            'status' => 'success',
            'user' => new LoggedInUserResource($user),
        ];

        $secureCookie = config('app.env') === 'production';
        
        return (new JsonResponse($responseData, Response::HTTP_OK))
            ->cookie(self::COOKIE_NAME, "Bearer {$token}", 60 * 24 * 30, '/', '', $secureCookie, true);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(): JsonResponse
    {
        return new JsonResponse([
            'user' => new LoggedInUserResource($this->guard->userOrFail()),
        ]);
    }

    /**
     * Log the user out (Invalidate the token). And delete the Authorization cookie
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        $this->guard->logout();

        return (new JsonResponse)->cookie(self::COOKIE_NAME);
    }

    /**
     * Register the user.
     *
     * @param \App\Http\Requests\ValidatePasswordRequest $request
     * @param \App\Models\User                           $user
     *
     * @return NoContentResponse
     */
    public function register(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $validated['inviteToken'] = Str::random(40);

        $user = User::create($validated);

        

        return new UserOverview($user);

    }

    /**
     * Send a reset password mail to user
     *
     * @param ResetPasswordRequest $request
     *
     * @return NoContentResponse
     */
    public function ResetPasswordRequest(ResetPasswordRequest $request): NoContentResponse
    {
        $validated = $request->validated();

        if (!User::where('email', $validated['email'])->exists()) {
            return new NoContentResponse;
        }

        $user = User::retrieveByEmail($validated['email']);
        
        $token = (new PasswordReset)->create($user);
        // Mail::to($user->email)->send(new ResetPasswordMail($token, $user));
    
        return new NoContentResponse;
    }

    /**
     * Send reset password
     *
     * @param ResetPasswordRequest $request
     *
     * @return NoContentResponse
     */
    public function updatePassword(UpdatePasswordRequest $request): NoContentResponse
    {
        $validated = $request->validated();

        if (!User::where('email', $validated['email'])->exists()) {
            return new NoContentResponse;
        }

        $user = User::retrieveByEmail($validated['email']);

        $user->forceFill([
            'password' => bcrypt($validated['password']),
        ])->setRememberToken(Str::random(60));
        
        $user->save();

        PasswordReset::where('email', $user->email)->delete();

        return new NoContentResponse;
    }
}