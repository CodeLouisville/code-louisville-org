<?php

namespace App\Traits;

use App\Content;

trait GetContent
{
    protected function fetch_content()
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

        return $data;
    }
}
