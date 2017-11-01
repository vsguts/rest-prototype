<?php

namespace App\Models;

class User extends AbstractModel
{
    public $id;

    public $firstname;

    public $lastname;

    public $age;

    public static function findOne($id)
    {
        foreach (self::findMany() as $model) {
            if ($model->id == $id) {
                return $model;
            }
        }
    }

    public static function findMany()
    {
        return [
            (new self)->load([
                'id' => 1,
                'firstname' => 'Vladimir',
                'lastname' => 'Guts',
                'age' => 30,
            ]),
            (new self)->load([
                'id' => 2,
                'firstname' => 'Volodymyr',
                'lastname' => 'Huts',
                'age' => 30,
            ]),
            (new self)->load([
                'id' => 3,
                'firstname' => 'Inna',
                'lastname' => 'Guts',
                'age' => 30,
            ]),
            (new self)->load([
                'id' => 4,
                'firstname' => 'Maxim',
                'lastname' => 'Guts',
                'age' => 6,
            ]),
            (new self)->load([
                'id' => 4,
                'firstname' => 'Danik',
                'lastname' => 'Guts',
                'age' => 3,
            ]),
        ];
    }

}
