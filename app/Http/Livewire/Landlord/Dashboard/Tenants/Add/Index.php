<?php

namespace App\Http\Livewire\Landlord\Dashboard\Tenants\Add;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class Index extends Component
{
    public $name, $user_name, $number, $email, $password, $password_confirmation;
    public function render()
    {
        return view('livewire.landlord.dashboard.tenants.add.index')
            ->extends('layouts.dashboard');
    }

    public function Add()
    {
        $validated = $this->validate([
            'name' => 'required|string|min:3',
            'user_name' => 'required|string|unique:users,user_name',
            'number' => 'required|numeric|unique:users,number',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required|string',
        ]);

        try {
            $data = [
                'name' => $validated['name'],
                'user_name' => $validated['user_name'],
                'email' => $validated['email'],
                'number' => $validated['number'],
                'password' => bcrypt($validated['password']),
                'role_id' => 3,
                'role' => 'client',
                'slug' => strtoupper(Str::random(20)),
            ];
            User::create($data);
            session()->flash('success', 'Added Successfully');
            return redirect(route('LandlordTenants'));
        } catch (Exception $e) {
            return session()->flash('error', $e->getMessage());
        }
    }
}
