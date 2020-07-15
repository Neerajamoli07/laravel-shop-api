<?php 
namespace App\GraphQL\Queries;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\SelectFields;
use Illuminate\Support\Facades\DB;
//use GraphQL\Type\Definition\ResolveInfo;
use App\User;

class LoginQuery extends Query {

    protected $attributes = [
        'name'  => 'User'
    ];

    public function type(): Type
    {
        return GraphQL::type('User'); //retrieve a single user details
    }

    public function rules(array $args = []): array
    {
         return [

         ];
    }

    public function args(): array
    {
        return [
            'name'    => [
                'name' => 'name',
                'type' => Type::string(),
            ],
            'password'    => [
                'name' => 'password',
                'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return User::select('*')
        ->where('name',$args['name'])
        ->where('password',$args['password'])
        ->first();
    }

}
