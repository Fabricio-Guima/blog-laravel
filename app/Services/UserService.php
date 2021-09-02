<?php
namespace App\Services;

use App\Exceptions\UserHasBeenTakenException;
use App\User;

class UserService
{
	public function update(User $user, array $input){

		//rode o último where que retira o meu email atual (email vem do usuário autenticado) da lista e envia essa lista para o primeiro where e aqui eu vejo se meu input[email] existe e com certeza não existe (depende), mas se existir isso vira é verdadeiro e caio na exception

		$checkUserEmail = User::where('email', $input['email'])->where('email','!=' ,$user->email)->exists();

		if(!empty($input['email'] && $checkUserEmail)){

			throw new UserHasBeenTakenException();
		}

		if(!empty($input['password'])){
		$input['password'] = bcrypt($input['password']);
		}

		$user->fill($input);
		$user->save();

		return $user->fresh();
	}
}