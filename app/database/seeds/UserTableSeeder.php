<?php

class UserTableSeeder extends Seeder
{

  public function run()
  {
    DB::table('users')->delete();
    User::create(array(
      'name'     => 'Alvin Almacin',
      'username' => 'alvin',
      'role' => 'reader',
      'password' => Hash::make('dragon1970'),
    ));
    User::create(array(
      'name'     => 'Miguelito Balingit',
      'username' => 'migs',
      'role' => 'reader',
      'password' => Hash::make('theman'),
    ));
    User::create(array(
      'name'     => 'Aldrin Almacin',
      'username' => 'aldrin',
      'role' => 'admin',
      'password' => Hash::make('miacbiaglc'),
    ));
    User::create(array(
      'name'     => 'Julien Almacin',
      'username' => 'julien',
      'role' => 'accounting',
      'password' => Hash::make('miacbiaglc'),
    ));
  }

}
