<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; // Utilitzem el Controller normal de Laravel
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Funció Login
    public function login(Request $request)
    {
        // 1. Validar dades
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Error de validació', 'errors' => $validator->errors()], 400);
        }

        // 2. Intentar autenticar
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['success' => false, 'message' => 'Credencials incorrectes'], 401);
        }

        // 3. Generar Token
        $user = Auth::user();
        // L'error 500 sol venir aquí si falta HasApiTokens al model User
        $token = $user->createToken('AuthToken')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login correcte',
            'data' => [
                'token' => $token,
                'name' => $user->name,
                'role' => $user->role,
            ]
        ], 200);
    }

    // Funció Register (Opcional)
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Error de validació', 'errors' => $validator->errors()], 400);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        
        $token = $user->createToken('AuthToken')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Usuari registrat correctament',
            'data' => [
                'token' => $token,
                'name' => $user->name
            ]
        ], 200);
    }

    // Funció Logout
    public function logout(Request $request)
    {
        // Esborra el token actual
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout realitzat correctament'
        ], 200);
    }

    // Funció Profile (Per comprovar el token)
    public function profile(Request $request)
    {
        $user = $request->user();

        // 1. Definim els permisos segons el rol de l'usuari
        // Això compleix la part de "retornar els seus permisos"
        $permissions = [];
        
        switch ($user->role) {
            case 'admin':
                $permissions = ['admin:access', 'users:manage', 'equips:manage', 'partits:manage'];
                break;
            case 'directiva':
                $permissions = ['equips:read', 'equips:update', 'partits:manage'];
                break;
            case 'entrenador':
                $permissions = ['equips:read', 'partits:create', 'partits:update'];
                break;
            case 'jugadora':
                $permissions = ['profile:read', 'equips:read', 'partits:read'];
                break;
            default:
                $permissions = ['public:read'];
                break;
        }

        // 2. Construïm la resposta amb l'estructura demanada
        return response()->json([
            'success' => true,
            'message' => 'Dades del perfil recuperades correctament',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'team_id' => $user->team_id,
                    'created_at' => $user->created_at,
                ],
                // Aquí mostrem explícitament Rols i Permisos "a part de l'altre"
                'authorization' => [
                    'role' => $user->role,
                    'permissions' => $permissions
                ]
            ]
        ], 200);
    }
}