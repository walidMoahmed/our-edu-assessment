<?php
    namespace App\Http\Controllers\Api;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\UserLoginRequest;
    use App\Http\Requests\UserRegisterRequest;
    use App\Models\User;

    class AuthController extends Controller
    {
        /**
         * Create a new AuthController instance.
         *
         * @return void
         */
        public function __construct() {
            $this->middleware('auth:api', ['except' => ['login']]);
        }
        /**
         * Get a JWT via given credentials.
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function login(UserLoginRequest $request){

            $credentials = $request->only('email', 'password');

            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            return $this->createNewToken($token);
        }
        /**
         * Register a User.
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function register(UserRegisterRequest $request) {
            $user = User::create(array_merge(
                $request->validated(),
                ['password' => bcrypt($request->password)]
            ));
            return response()->json([
                'message' => 'User successfully registered',
                'user' => $user
            ], 201);
        }

        /**
         * Log the user out (Invalidate the token).
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function logout() {
            auth()->logout();
            return response()->json(['message' => 'User successfully signed out']);
        }
        /**
         * Refresh a token.
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function refresh() {
            return $this->createNewToken(auth()->refresh());
        }
        /**
         * Get the authenticated User.
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function userProfile() {
            return response()->json(auth()->user());
        }
        /**
         * Get the token array structure.
         *
         * @param  string $token
         *
         * @return \Illuminate\Http\JsonResponse
         */
        protected function createNewToken($token){
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60,
                'user' => auth('api')->user()
            ]);
        }
    }
