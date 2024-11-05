<?php
declare(strict_types=1);

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * @author frada <fbahezna@gmail.com>
 */
class UsersTableSeeder extends Seeder
{
    private $users = [
        ['id' => '19e7c4ff-3f57-4c33-9c76-fd7b86d7c3d8', 'name' => 'User1', 'phone' => '08225325818'],
        ['id' => 'a193c253-f34e-4494-af6c-261e558c42de', 'name' => 'User2', 'phone' => '08276440442'],
        ['id' => 'e624ba3b-5f4c-4825-b455-ce9b31882837', 'name' => 'User3', 'phone' => '08884949926'],
        ['id' => 'a15aee0c-9161-42f2-b7ed-c4a702f2f761', 'name' => 'User4', 'phone' => '08873228777'],
        ['id' => 'c4ece84c-0873-461f-abfa-aa0a824c8c36', 'name' => 'User5', 'phone' => '08759356065'],
        ['id' => 'f7607e4a-3f1b-41ff-83cc-fb93a073220a', 'name' => 'User6', 'phone' => '08195698891'],
        ['id' => '45111d00-7d3c-44d6-8d49-0520aeaf84b6', 'name' => 'User7', 'phone' => '08130657063'],
        ['id' => '1c242bec-2f35-4d72-9a9a-1ee13157efc8', 'name' => 'User8', 'phone' => '08389713461'],
        ['id' => '797c0bb9-239f-4c59-9351-322b3e231e72', 'name' => 'User9', 'phone' => '08548260286'],
        ['id' => '81e6ff45-e018-4548-b08f-9c5fd8bdfb85', 'name' => 'User10', 'phone' => '08642199009'],
        ['id' => '19bf9d07-ce54-4daf-802c-2d519a7b18a4', 'name' => 'User11', 'phone' => '08996134512'],
        ['id' => '4104c72d-f443-44e4-8bef-ba1f37290457', 'name' => 'User12', 'phone' => '08849170797'],
        ['id' => '62a6def6-0e10-4fde-a1a4-2de2651c794e', 'name' => 'User13', 'phone' => '08522892884'],
        ['id' => '8dc5ff45-2a55-4d82-acb3-b8eaccbffb3d', 'name' => 'User14', 'phone' => '08863464498'],
        ['id' => '93e6b2ae-5169-4a89-bc53-2dc4870b49dc', 'name' => 'User15', 'phone' => '08758134424'],
        ['id' => 'bafcfd6d-97db-4d1a-b366-8237d7184cc3', 'name' => 'User16', 'phone' => '08462222875'],
        ['id' => 'a50bbd9e-f65d-4c2d-851e-a353eefeacef', 'name' => 'User17', 'phone' => '08600220313'],
        ['id' => '32efec4a-fc29-43b9-9c07-79c7da2f9ab3', 'name' => 'User18', 'phone' => '08305376074'],
        ['id' => '8acb31dc-5cd9-4175-ad96-81a41f0a8f28', 'name' => 'User19', 'phone' => '08796379467'],
        ['id' => '116b12cb-e490-4bb6-a376-e499e4eb75f2', 'name' => 'User20', 'phone' => '08564535670'],
    ];

    public function run()
    {
        foreach ($this->users as $user) {
            try {
                DB::table('users')->insertOrIgnore(
                    [
                        'id' => $user['id'],
                        'name' => $user['name'],
                        'phone' => $user['phone']
                    ]
                );
            }catch (Exception $exception){
                dd($exception);
            }
        }
    }
}