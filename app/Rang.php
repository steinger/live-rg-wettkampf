<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rang extends Model
{
    /**
     * get all Rang Data 
     * @param  int $event_id  Event ID
     * @return array          All data
     */
    public function getData($event_id)
    {
        $data = DB::table('results as r')
                          ->select('r.id', 'r.apparatus', 'r.startno', 'r.name', 'r.body', 'r.updated_at')
                          ->whereRaw("r.event_id LIKE $event_id")
                          ->orderBy('r.startno')
                          ->get();
        return ($this->parse($data));
    }

    /**
     * Parse DB data for Web
     * @param  array $data  all data
     * @return array        all data parse for web
     */
    public function parse($data)
    {
      $array = [];
      foreach ($data as $key => $value) {
        $name = explode(' ', trim($value->name));
        $cat = array_pop($name);
        $gymnastin = trim(implode(' ', $name));
        $array[$value->startno]['name'] = $gymnastin;
        $array[$value->startno]['kat'] = $cat;
        $bodyFirst = explode(',', trim($value->body));
        $bodyFirstOne = explode(' ', trim($bodyFirst[0]));
        $note = array_pop($bodyFirstOne);
        if (array_key_exists('note', $array[$value->startno]))
        {
           $array[$value->startno]['note'] += $note;
        }
        else
        {
           $array[$value->startno]['note'] = $note;
        }
      }
      return $array;
    }

    /**
     * List of all gymnasts by categories
     * @param  array $array all data
     * @return array        all data
     */
    public function getKat($array)
    {
        $arrayNew = array();
        foreach ($array as $startnr => $arrayV)
        {
            foreach ($arrayV as $key => $value)
            {
                if ($key == 'kat') $arrayNew[] = $value;
            }
        }
        $arrayNewUnique = array_unique($arrayNew);
        sort($arrayNewUnique);
        return $arrayNewUnique;
    }

    /**
     * List of all gymnasts by category and rank
     * @param  array $array all data
     * @param  string $kat   category
     * @return array        all data
     */
    public function getRangKat($array,$kat)
    {
        $arrayStatnr = array();
        foreach ($array as $startnr => $arrayV)
        {
            foreach ($arrayV as $key => $value)
            {
                if ($key == 'kat' && $value == $kat)
                {
                    // echo "$key $value $startnr<br>";
                    $arrayStatnr [] = $startnr;
                }
            }

        }
        // print_r($arrayStatnr);
        $arrayResult = array();
        $i =0;
        foreach ($array as $startnr2 => $arrayV2)
        {
                // echo "$startnr2<br>";
            if (in_array($startnr2, $arrayStatnr))
            {
                $arrayResult[$i]['startnr'] = $startnr2;
                foreach ($arrayV2 as $key => $value)
                {
                    // echo "$key $value $startnr2<br>";
                    if ($key == 'name') $arrayResult[$i]['name'] = $value;
                    if ($key == 'note') $arrayResult[$i]['note'] = $value;
                }
                $i++;
            }
        }
        foreach ($arrayResult as $key => $row) {
            $note[$key] = $row['note'];
            $name[$key] = $row['name'];
        }
        array_multisort($note, SORT_DESC, $name, SORT_ASC, SORT_STRING, $arrayResult);
        return $arrayResult;
    }
}
