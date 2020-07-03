<?php 
namespace App\GraphQL\Queries;

//use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\SelectFields;
//use GraphQL\Type\Definition\ResolveInfo;
use App\User;

class UserQuery extends Query {

    protected $attributes = [
        'name'  => 'user',
    ];

    // public function authorize(array $args = []): bool
    // {
    //     return true;
    // }

    public function type(): Type
    {
        return GraphQL::type('User'); //retrieve a single user
    }

    public function rules(array $args = []): array
    {
        return [
            'id' => [
                'required',
                'numeric',
                'min:1',
                'exists:users,id'
            ],
        ];
    }

    public function args(): array
    {
        return [
            'id'    => [
                'name' => 'id',
                'type' => Type::int(),
            ],
        ];
    }

    public function resolve($root, $args, SelectFields $fields)
    {
        return User::findOrFail($args['id']);
    }

}
