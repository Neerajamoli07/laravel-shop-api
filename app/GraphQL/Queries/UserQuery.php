<?php 
namespace App\GraphQL\Queries;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\SelectFields;
use Illuminate\Support\Facades\DB;
//use GraphQL\Type\Definition\ResolveInfo;
use App\User;

class UserQuery extends Query {

    protected $attributes = [
        'name'  => 'User',
    ];

    public function type(): Type
    {
        return GraphQL::type('User'); // retrieve a single user detail
    }

    public function rules(array $args = []): array
    {
         return [

         ];
    }

    public function args(): array
    {
        return [
            'id'    => [
                'name' => 'id',
                'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return User::select('*')
        ->where('id',$args['id'])
        ->first();
    }

}
