<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Request;

use App\Content;
use App\Grads;
use App\Mentors;

use App\Traits\GetContent;

class Pages extends Controller
{
    use GetContent;

    public function home()
    {
        $data = $this->fetch_content();

        $data['title'] = 'Home';

        return view('pages.home', $data);
    }

    public function learn()
    {
        $data = $this->fetch_content();

        $data['title'] = 'Learn';

        return view('pages.learn', $data);
    }

    public function apply()
    {
        $secure = 'false'; if (Request::secure()) $secure = 'true';

        $data = $this->fetch_content();

        $data['title'] = 'Apply';
        $data['secure'] = $secure;

        return view('pages.apply', $data);
    }

    public function mentor()
    {
        $data = $this->fetch_content();

        $data['title'] = 'Mentor';
        $data['mentors'] = Mentors::orderBy('last')->get();

        return view('pages.mentor', $data);
    }

    public function mentor_add()
    {
        $data = [
            'title' => 'Mentor'
        ];

        return view('pages.mentor-form', $data);
    }

    public function mentor_edit($id)
    {
        $data = [
            'title' => 'Mentor',
            'mentor' => Mentors::find($id)
        ];

        return view('pages.mentor-form', $data);
    }

    public function graduates_add()
    {
        $data = [
            'title' => 'Graduates'
        ];

        return view('pages.graduates-form', $data);
    }

    public function graduates_edit($id)
    {
        $data = [
            'title' => 'Graduates',
            'grad' => Grads::find($id)
        ];

        return view('pages.graduates-form', $data);
    }

    public function hire()
    {
        $data = $this->fetch_content();

        $data['title'] = 'Hire';

        return view('pages.hire', $data);
    }

    public function graduates()
    {
        $data = array(
            'title' => 'Graduates',
            'grads' => Grads::all()
        );

        return view('pages.graduates', $data);
    }
}
