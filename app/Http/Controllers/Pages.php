<?php

namespace App\Http\Controllers;

use Auth;
use App\Content;
use App\Grads;
use App\Mentors;
use App\Http\Controllers\Controller;

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

        return view('pages.home', $data);
    }

    public function candidates()
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

        $data['title'] = 'Candidates';

        return view('pages.candidates', $data);
    }

    public function enroll()
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

        $data['title'] = 'Candidates';

        return view('pages.enroll', $data);
    }

    public function mentors()
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

        $data['title'] = 'Mentors';
        $data['mentors'] = Mentors::orderBy('last')->get();

        return view('pages.mentors', $data);
    }

    public function mentors_add()
    {
        $data = [
            'title' => 'Mentors'
        ];

        return view('pages.mentors-form', $data);
    }

    public function mentors_edit($id)
    {
        $data = [
            'title' => 'Mentors',
            'mentor' => Mentors::find($id)
        ];

        return view('pages.mentors-form', $data);
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

    public function employers()
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

        $data['title'] = 'Employers';

        return view('pages.employers', $data);
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
