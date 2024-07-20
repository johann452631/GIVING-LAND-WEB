<?php

namespace App\Livewire\Profile\Edit;

use App\Models\SocialMedia as ModelsSocialMedia;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SocialMedia extends Component
{
    public $profile;
    public $createSocialMedia;
    public $createSelectedSocialMedia;
    public $item;
    public $inputUsername;
    public $inputNumber;
    public $createDisplayed;
    public $deleteDisplayed;

    public function mount()
    {
        $this->profile = Auth::user()->profile;
        $this->createSocialMedia = ModelsSocialMedia::all()->diff($this->profile->socialMedia);
        $this->createSelectedSocialMedia = ($this->createSocialMedia->first() !== null) ? $this->createSocialMedia->first()->id : 0;
        $this->item = null;
        $this->inputUsername = '';
        $this->inputNumber = '';
        $this->createDisplayed = false;
        $this->deleteDisplayed = false;
        $this->resetValidation();
    }

    public function create()
    {
        $this->mount();
        $this->createDisplayed = true;
    }

    public function onCreateChange()
    {
        $this->resetValidation();
    }

    public function cancelCreate(){
        $this->createDisplayed = false;
    }

    public function store()
    {
        if ($this->createSelectedSocialMedia == 1) {
            $this->validate(
                [
                    'inputNumber' => 'required|numeric|digits:10'
                ],
                [
                    'required' => 'El :attribute es requerido.',
                    'numeric' => 'Todo el campo debe ser numérico.',
                    'digits:10' => 'El :attribute debe contener :value dígitos.',
                ],
                [
                    'inputNumber' => 'número',
                ]
            );
        } else {
            $this->validate(
                [
                    'inputUsername' => 'required'
                ],
                [
                    'required' => 'El link es requerido.',
                ],
            );
        }
        $username = ($this->createSelectedSocialMedia == 1) ? $this->inputNumber : $this->inputUsername;
        $this->profile->socialMedia()->attach($this->createSelectedSocialMedia, compact('username'));
        $this->createDisplayed = false;
        $this->dispatch('alert-sent', type: 'success', message: "Se registró ".ModelsSocialMedia::find($this->createSelectedSocialMedia)->name);
        $this->mount();
    }

    public function dialogDestroy(ModelsSocialMedia $item)
    {
        $this->deleteDisplayed = true;
        $this->item = $item;
    }

    public function destroy ($item = null)
    {
        $this->profile->socialMedia()->detach($item['id']);
        $this->deleteDisplayed = false;
        $this->createSocialMedia = ModelsSocialMedia::all()->diff($this->profile->socialMedia);
        $this->dispatch('alert-sent', type: 'warning', message: 'Se eliminó '.$item['name']);
        $this->item = null;
    }

    public function render()
    {
        return view('livewire.profile.edit.social-media');
    }
}
