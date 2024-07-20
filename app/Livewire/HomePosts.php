<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class HomePosts extends Component
{
    public $posts;

    public function mount()
    {
        $this->posts = auth()->check() ? Post::where('user_id', '!=', auth()->user()->id)
        ->orderBy('created_at', 'desc')
        ->get() : Post::all()->sortByDesc('created_at');
        // dd(count($this->posts));
    }

    public function render()
    {
        return view('livewire.home-posts');
    }
}
