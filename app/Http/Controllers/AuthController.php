<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

/**
* @OA\Info(
*             title="EXTRANET", 
*             version="1.0",
*             description="Reservas API"
* )
*
* @OA\Server(url="${APP_URL_WEBSERVICE}")
* @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT"
 * )
*/


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

     /**
 * Login de usuarios
 * @OA\Post(
 *     path="/api/auth/login",
 *     tags={"Login"},
 *     @OA\RequestBody(
 *         required=true,
 *         description="Datos de inicio de sesión",
 *         @OA\JsonContent(
 *             required={"email", "password"},
 *             @OA\Property(property="email", type="string", format="email", example="usuario@example.com"),
 *             @OA\Property(property="password", type="string", format="password", example="contraseña_secreta")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 type="array",
 *                 property="rows",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(
 *                         property="access_token",
 *                         type="string",
 *                         example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vd2Vic2VydmljZS52aXNpb25tdW5kby5jb20vYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE2OTM3NzEwODksImV4cCI6MTY5Mzc3NDY4OSwibmJmIjoxNjkzNzcxMDg5LCJqdGkiOiJsNnJTeXFjVUdCWEd6dFdaIiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.n3hUXHvQcwsp1sFLEDqphBxHP7etHq-ngVUrvlWiy9U"
 *                     ),
 *                     @OA\Property(
 *                         property="token_type",
 *                         type="string",
 *                         example="Bearer"
 *                     ),
 *                     @OA\Property(
 *                         property="expires_in",
 *                         type="number",
 *                         example="3600"
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="No autorizado"
 *     ),
 * )
 */

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Sin autorización'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */

 /**
 * Obtener los datos del usuario autenticado
 *
 * @OA\Get(
 *     path="/api/auth/me",
 *     tags={"Usuarios"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="Datos del usuario autenticado",
 *         @OA\JsonContent(
 *             type="object",
 *               @OA\Property(
 *                 property="name",
 *                 type="string",
 *                 example="Nombre del Usuario"
 *             ),
 *             @OA\Property(
 *                 property="email",
 *                 type="string",
 *                 format="email",
 *                 example="usuario@example.com"
 *             ),
 *             @OA\Property(
 *                 property="email_verified_at",
 *                 type="string",
 *                 format="email",
 *                 example="null"
 *             ),
 *               @OA\Property(
 *                 property="created_at",
 *                 type="DATETIME",
 *                 format="2023-07-07",
 *                 example="2023-07-07T12:23:11.000000Z"
 *             ),
 *               @OA\Property(
 *                 property="updated_at",
 *                 type="DATETIME",
 *                 format="YYYY-MM-DD",
 *                 example="2023-07-07T12:23:11.000000Z"
 *             ),
 *               @OA\Property(
 *                 property="celular",
 *                 type="string",
 *                 example="+591-66655551"
 *             ),
 *               @OA\Property(
 *                 property="tipo_usuario",
 *                 type="string",
 *                 example="S"
 *             )              
 *         ),
 *      @OA\Header(
 *             header="Authorization",
 *             description="Token JWT de autenticación",
 *             @OA\Schema(type="string", format="Bearer {token}")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="No autorizado"
 *     ),
 * )
 */

    public function me()
    {
        $r= response()->json(auth()->user());  
        
        $data = json_decode($r->getContent(), true);

        // Modificar el valor de 'markup'
        unset($data['markup']);

        // Codificar los datos modificados de nuevo a formato JSON
        $content = response()->json($data);
        //print_r($r['markup']);  
       return $content;
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */

     /**
 * Cerrar sesión del usuario autenticado
 *
 * @OA\Post(
 *     path="/api/auth/logout",
 *     tags={"Login"},
 *     summary="Cerrar sesión del usuario autenticado",
 *     operationId="logoutUser",
 *     @OA\Parameter(
 *          name="Authorization",
 *          in="header",
 *          required=true,
 *          description="Token JWT de autenticación",
 *          @OA\Schema(type="string", format="Bearer {token}")
 *       ),
 *     @OA\Response(
 *         response=200,
 *         description="Cierre de sesión exitoso"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="No autorizado"
 *     ),
 *    security={{"bearerAuth": {}}},
 *    @OA\Header(
 *         header="Authorization",
 *         description="Token JWT de autenticación",
 *         @OA\Schema(type="string", format="Bearer {token}")
 *     )
 * )
 */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out'],200);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ],200);
    }
}