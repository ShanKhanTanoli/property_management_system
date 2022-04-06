<?php

namespace App\Http\Livewire\Admin\Dashboard\Settings;

use App\Models\Setting;
use Livewire\Component;

class Index extends Component
{
    public $company_name, $company_email, $company_phone, $company_address;

    public function mount()
    {
        if ($settings = Setting::first()) {
            $this->company_name = $settings->company_name;
            $this->company_email = $settings->company_email;
            $this->company_phone = $settings->company_phone;
            $this->company_address = $settings->company_address;
        } else {
            $this->company_name = "Home";
            $this->company_email = "Company Email";
            $this->company_phone = "00000000000";
            $this->company_address = "Company Address";
        }
    }

    public function render()
    {
        return view('livewire.admin.dashboard.settings.index')
            ->extends('layouts.dashboard')
            ->section('content');
    }

    public function Update()
    {
        $msg = [
            'company_name.required' => 'Enter Company Name',
        ];

        $validated = $this->validate([
            'company_name' => 'required|string',
            'company_email' => 'required|email',
            'company_phone' => 'required|numeric',
            'company_address' => 'required|string',
        ], $msg);

        if ($settings = Setting::first()) {

            $settings->update($validated);

            return session()->flash('success', 'Updated Successfully');
        } else {

            Setting::create($validated);
            return session()->flash('success', 'Updated Successfully');
        }
    }
}
