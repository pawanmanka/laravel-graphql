<?php

namespace App\graphql\Mutations\Users;

use App\Models\User;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Facades\Hash;

class CreateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createUser'
    ];

    public function type(): Type
    {
        return GraphQL::type('User');
    }

    public function args(): array
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'name of user',
            ],
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
        $checkUser =  User::where("email",$args['email'])->first();
        if(!$checkUser ){
            $createUser = new User();
            $createUser->fill(["name"=>$args['name'],"email"=>$args['email'],"password"=>Hash::make($args['password'])]);
            $createUser->save();
            return $createUser;
        }else{
            return null;
        }
    }
}
