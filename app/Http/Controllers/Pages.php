<?php

namespace App\Http\Controllers;

use Auth;
use App\Content;
use App\Grads;
use App\Mentors;
use App\Http\Controllers\Controller;
use Request;

class Pages extends Controller
{
    public function home()
    {
        $content = Content::all();

        $data = [];

        foreach($content as $item)
        {
            $k = $item->key;
            $g = $item->group;
            $c = $item->content;

            if($g)
            {
                if( !isset($data[$g]) ) $data[$g] = [];

                $array = ['key' => $k, 'content' => $c];

                array_push($data[$g], $array);
            }
            else
            {
                $data[$k] = $c;
            }
        }

        $data['title'] = 'Home';

        return view('pages.home', $data);
    }

    public function learn()
    {
        $content = Content::all();

        $data = [];

        foreach($content as $item)
        {
            $k = $item->key;
            $g = $item->group;
            $c = $item->content;

            if($g)
            {
                if( !isset($data[$g]) ) $data[$g] = [];

                $array = ['key' => $k, 'content' => $c];

                array_push($data[$g], $array);
            }
            else
            {
                $data[$k] = $c;
            }
        }

        $data['title'] = 'Learn';

        return view('pages.learn', $data);
    }

    public function enroll()
    {
        $secure = false; if (Request::server('HTTP_X_FORWARDED_PROTO') == 'https') $secure = true;

        $content = Content::all();

        $data = [];

        foreach($content as $item)
        {
            $k = $item->key;
            $g = $item->group;
            $c = $item->content;

            if($g)
            {
                if( !isset($data[$g]) ) $data[$g] = [];

                $array = ['key' => $k, 'content' => $c];

                array_push($data[$g], $array);
            }
            else
            {
                $data[$k] = $c;
            }
        }

        $data['title'] = 'Candidates';
        $data['secure'] = $secure;

        return view('pages.enroll', $data);
    }

    public function mentor()
    {
        $content = Content::all();

        $data = [];

        foreach($content as $item)
        {
            $k = $item->key;
            $g = $item->group;
            $c = $item->content;

            if($g)
            {
                if( !isset($data[$g]) ) $data[$g] = [];

                $array = ['key' => $k, 'content' => $c];

                array_push($data[$g], $array);
            }
            else
            {
                $data[$k] = $c;
            }
        }

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
        $content = Content::all();

        $data = [];

        foreach($content as $item)
        {
            $k = $item->key;
            $g = $item->group;
            $c = $item->content;

            if($g)
            {
                if( !isset($data[$g]) ) $data[$g] = [];

                $array = ['key' => $k, 'content' => $c];

                array_push($data[$g], $array);
            }
            else
            {
                $data[$k] = $c;
            }
        }

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
