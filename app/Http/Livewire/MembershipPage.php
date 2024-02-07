<?php

namespace App\Http\Livewire;

use Corcel\Model\User;
use Livewire\Component;

class MembershipPage extends Component
{
    public $user;
    public function mount()
    {
        if(isset($_COOKIE['token'])) {
            $n = explode("_",$_COOKIE['token']);
            $u=User::find($n[0]);
            if($u->meta->token == $n[1]){
                $this->user=$u;
            }
        }
    }
    public function render()
    {
        return view('livewire.membership-page')
        ->layout('layouts.wp');
    }
}
