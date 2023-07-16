<?php

namespace App\graphql\Mutations\Users;

use App\Models\User;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use \Exception;
class LoginUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'loginUser'
    ];

    public function type(): Type
    {
        return GraphQL::type('User');
    }

    public function args(): array
    {
        return [
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'User email',
            ],
            'password' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'User Password',
            ]
        ];
    }

    public function resolve($root, $args)
    {
        
        $user = User::where('email', $args['email'])->first();
        if ($user && Hash::check($args['password'], $user->password)) {
            $user['token'] = $user->createToken("API TOKEN")->plainTextToken;
            return $user;
        }
        throw new Exception('Error login');
        return null;
    }
}
