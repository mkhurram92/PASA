<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Corcel\Model\User;
use Livewire\Component;

class MembershipProfile extends Component
{
    public $user;
    public $member;
    public function mount()
    {
        if(isset($_COOKIE['token'])) {
            $n = explode("_",$_COOKIE['token']);
            $u=User::find($n[0]);
            $member = Member::where('username',$u->user_login)->first();
            if($u->meta->token == $n[1]){
                $this->user=$u;
                if($member){
                    $this->member=$member;
                }
                else{
                    abort(404);
                }
            }
        }
        else{
            abort(404);
        }
    }
    public function render()
    {
        return view('livewire.membership-profile')
        ->layout('layouts.wp');
    }
}
