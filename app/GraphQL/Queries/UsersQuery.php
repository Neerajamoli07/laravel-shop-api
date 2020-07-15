<?php 
namespace App\GraphQL\Queries;

//use GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use App\User;

class UsersQuery extends Query {

    protected $attributes = [
        'name'  => 'users',
    ];

    // public function authorize(array $args = [])
    // {
    //     return true;
    // }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('User')); // retrieve a collection of users...all users
    }

    public function args(): array
    {
        return [
            'ids'   => [
                'name' => 'ids',
                'type' => Type::listOf(Type::int()),
            ],
        ];
    }

    public function rules(array $args = []): array
    {
        return [
            'ids' => [
                'array',
            ],
            'ids.*' => [
                'numeric',
            ]
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['ids'])) {
            return User::find($args['ids']);
        }

        return User::all();
    }
}