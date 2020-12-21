<?php

namespace App\Http\Resources\Admin\User;

use App\Models\Acl\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "created_at" => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "role_in_company_id" => $this->getRole($this->role_in_company_id),
            "tin" => $this->tin,
            "custom_role" => $this->custom_role,
            "company_name" => $this->company_name,
            "legal_address" => $this->legal_address,
            "kpp" => $this->kpp,
            "ogrn" => $this->ogrn,
            "function" => $this->getFunction($this->id),
        ];
    }

    public function getRole($role_id)
    {
        $role_name = '—';
        if ($role_id) {
            $user_roles_in_company = config('handbook.user_roles');
            $key = keySearchInMultidimensionalArray($user_roles_in_company, 'id', $role_id);

            if (array_key_exists($key, $user_roles_in_company)) {
                $role_name = $user_roles_in_company[$key]['name'];
            }
        }

        return $role_name;
    }

    public function getFunction($id)
    {
        $user = User::find($id);
        $roles = $user->roles;
        $functions = '—';
        if ($roles->isNotEmpty()) {
            $results_array = $roles->pluck('name');
            $functions = implode(', ', $results_array->toArray());
        }

        return $functions;
    }
}
