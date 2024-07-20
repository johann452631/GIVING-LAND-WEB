<?php

namespace App\Livewire\Profile\Edit;

use App\Models\ContactInformation as ModelsContactInformation;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ContactInformation extends Component
{
    public $profile;

    #[Locked]
    public $id;

    public $item;
    public $is_link;
    public $name;
    public $info;
    public $editOrCreateDisplayed;
    public $editDisplayed;
    public $deleteDisplayed;

    public function mount()
    {
        $this->profile = Auth::user()->profile;
        $this->id = -1;
        $this->item = null;
        $this->is_link = 0;
        $this->name = '';
        $this->info = '';
        $this->editOrCreateDisplayed = false;
        $this->editDisplayed = false;
        $this->deleteDisplayed = false;
        $this->resetValidation();
    }

    public function editOrCreate($item = null)
    {
        if (isset($item)) {
            $this->fill((new ModelsContactInformation($item))->only(['name', 'info', 'is_link']));
            $this->id = $item['id'];
        } else {
            $this->mount();
        }
        $this->editOrCreateDisplayed = true;
    }

    public function onChange()
    {
        $this->resetValidation();
    }

    public function cancel()
    {
        $this->editOrCreateDisplayed = false;
    }

    public function updateOrStore()
    {
        $this->validate(
            [
                'name' => 'required',
                'info' => ($this->is_link) ? 'required|url' : 'required'
            ],
            [
                'info.required' => 'La :attribute es requerida.',
            ],
            [
                'info' => 'información',
            ]
        );
        $this->profile->contactInformation()->updateOrCreate($this->only('id'), $this->only(['name', 'info', 'is_link']));
        $this->editOrCreateDisplayed = false;
    }

    public function dialogDestroy(ModelsContactInformation $item)
    {
        $this->deleteDisplayed = true;
        $this->item = $item;
    }

    public function destroy($item = null)
    {
        ModelsContactInformation::destroy($item['id']);
        $this->deleteDisplayed = false;
        $this->dispatch('alert-sent', type: 'warning', message: 'Se eliminó la información de contacto');
        $this->item = null;
    }
    public function render()
    {
        return view('livewire.profile.edit.contact-information');
    }
}
