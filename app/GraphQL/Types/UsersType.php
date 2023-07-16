<?php 

namespace App\GraphQL\Types;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UsersType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'Collection of User and details of Author',
        'model' => User::class
    ];


    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Id of a particular user',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'name of user',
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'User email',
            ],
            'email_verified_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Email verification at',
            ],
            'token' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Auth token',
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'created at',
            ]
        ];
    }
}

?>