<?php

namespace App\Http\Livewire\Admin\Dashboard\Tenants;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\Tenant\Tenant;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $tenants = Tenant::all()->latest()->paginate(6);
        return view('livewire.admin.dashboard.tenants.index')
            ->with(['tenants' => $tenants])
            ->extends('layouts.dashboard')
            ->section('content');
    }

    public function Edit($id)
    {
        if ($tenant = User::find($id)) {
            return redirect(route('AdminEditTenant', $tenant->slug));
        }
        return session()->flash('error', 'Something went wrong');
    }

    public function Delete($id)
    {
        if ($tenant = User::find($id)) {
            $tenant->delete();
            return session()->flash('success', 'Deleted Successfully');
        }
        return session()->flash('error', 'Something went wrong');
    }
}
