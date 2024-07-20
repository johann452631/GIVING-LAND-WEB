<?php

namespace App\Livewire\Profile\Edit;

use App\Models\Image;
use App\MyOwn\classes\Utility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class ProfileImg extends Component
{
    use WithFileUploads;
    public $profile;
    public $photo;
    public $editDisplayed;
    public $deleteDisplayed;
    public $submitDisabled;

    public function mount()
    {
        $this->profile = Auth::user()->profile;
        $this->photo = null;
        $this->editDisplayed = false;
        $this->deleteDisplayed = false;
        $this->submitDisabled = true;
    }

    public function edit()
    {
        $this->editDisplayed = true;
    }

    public function photoLoaded()
    {
        $this->submitDisabled = false;
    }

    public function cancel()
    {
        $this->mount();
    }

    public function update()
    {
        // dd($this->photo);
        if ($this->profile->google_avatar !== null) {
            $this->profile->update(['google_avatar' => null]);

            $this->profile->image()->save(Image::create());
        }

        if ($this->profile->image->url != 'default.svg' && $this->profile->image->url !== null) {
            Storage::delete('public/users_profile_images/' . $this->profile->image->url);
        }

        $imgName = "image_" . Str::uuid() . "." . $this->photo->getClientOriginalExtension();

        $this->profile->image->update(['url' => $imgName]);

        $this->photo->storeAs('public/users_profile_images', $imgName);

        Utility::sendAlert('success', 'Se actualizó la foto de perfil');

        return to_route('profile.edit');
    }

    public function dialogDelete()
    {
        $this->deleteDisplayed = true;
    }

    public function delete()
    {
        Utility::sendAlert('warning', 'Se eliminó tu foto de perfil');

        if ($this->profile->google_avatar !== null) {
            $this->profile->update(['google_avatar' => null]);

            $this->profile->image()->save(Image::create(['url' => 'default.svg']));

            return to_route('profile.edit');
        }


        Storage::delete("public/users_profile_images/" . $this->profile->image->url);

        $this->profile->image->update(['url' => 'default.svg']);

        return to_route('profile.edit');
    }

    public function render()
    {
        // $this->editDisplayed = false;
        return view('livewire.profile.edit.profile-img');
    }
}
