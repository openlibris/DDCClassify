<?php
/*

    ____  ____  ______________                _ ____               
   / __ \/ __ \/ ____/ ____/ /___ ___________(_) __/_  __          
  / / / / / / / /   / /   / / __ `/ ___/ ___/ / /_/ / / /          
 / /_/ / /_/ / /___/ /___/ / /_/ (__  |__  ) / __/ /_/ /           
/_____/_____/\____/\____/_/\__,_/____/____/_/_/  \__, /            
    __             ____                   __    /____/       _     
   / /_  __  __   / __ \____  ___  ____  / /   (_) /_  _____(_)____
  / __ \/ / / /  / / / / __ \/ _ \/ __ \/ /   / / __ \/ ___/ / ___/
 / /_/ / /_/ /  / /_/ / /_/ /  __/ / / / /___/ / /_/ / /  / (__  ) 
/_.___/\__, /   \____/ .___/\___/_/ /_/_____/_/_.___/_/  /_/____/  
      /____/        /_/                                            
https://github.com/OpenLibris/DDCClassify

Copyright (c) 2023 OpenLibris. All rights reserved.

MIT License

*/
class DeweyDecimal
{
    private function fgc($url) {
        if (!is_dir('.ddccache')) {
            mkdir('.ddccache');
        }
        $cache_file = '.ddccache/' . md5($url);
        if(file_exists($cache_file)) {
            if(time() - filemtime($cache_file) > 31536000) {
                $cache = file_get_contents($url);
                file_put_contents($cache_file, $cache);
            } else {
                $cache = file_get_contents($cache_file);
            }
        } else {
            $cache = file_get_contents($url);
            file_put_contents($cache_file, $cache);
        }
        return $cache;
    }
    public function ClassifyISBN($isbn)
    {
        if (empty($isbn)) {
            return 'Error, empty ISBN!';
        }
        $apione = 'http://classify.oclc.org/classify2/Classify?isbn=' . urlencode($isbn) . '&summary=true';
        $xml = json_decode(json_encode(simplexml_load_string($this->fgc($apione))), true);
        if (isset($xml['recommendations']['ddc']['mostPopular']['@attributes']['nsfa'])) {
            $ddc = $xml['recommendations']['ddc']['mostPopular']['@attributes']['nsfa'];
        } elseif (isset($xml['recommendations']['ddc']['mostPopular']['nsfa'])) {
            $ddc = $xml['recommendations']['ddc']['mostPopular']['nsfa'];
        } else {
            $wi = $xml["works"]["work"][0]["@attributes"]["wi"];
            $ddcurl = 'http://classify.oclc.org/classify2/Classify?wi=' . $wi . '&summary=true';
            $ddccontent = json_decode(json_encode(simplexml_load_string($this->fgc($ddcurl))), true);
            if (isset($ddccontent['recommendations']['ddc']['mostPopular'][0]['@attributes']['nsfa'])) {
                $ddc = $ddccontent['recommendations']['ddc']['mostPopular'][0]['@attributes']['nsfa'];
            } elseif (isset($ddccontent['recommendations']['ddc']['mostPopular']['@attributes']['nsfa'])) {
                $ddc = $ddccontent['recommendations']['ddc']['mostPopular']['@attributes']['nsfa'];
            } else {
                $ddc = "FIC";
            }
        }
        return $ddc;
    }
    public function ClassifyTitleAuthor($title, $author = '')
    {
        if (empty($title)) {
            return 'Error, empty title!';
        }
        $apione = 'http://classify.oclc.org/classify2/Classify?title=' . urlencode($title) . '&author=' . urlencode($author) . '&summary=true';
        $xml = json_decode(json_encode(simplexml_load_string($this->fgc($apione))), true);
        if (isset($xml['recommendations']['ddc']['mostPopular']['@attributes']['nsfa'])) {
            $ddc = $xml['recommendations']['ddc']['mostPopular']['@attributes']['nsfa'];
        } elseif (isset($xml['recommendations']['ddc']['mostPopular']['nsfa'])) {
            $ddc = $xml['recommendations']['ddc']['mostPopular']['nsfa'];
        } else {
            $wi = $xml["works"]["work"][0]["@attributes"]["wi"];
            $ddcurl = 'http://classify.oclc.org/classify2/Classify?wi=' . $wi . '&summary=true';
            $ddccontent = json_decode(json_encode(simplexml_load_string($this->fgc($ddcurl))), true);
            if (isset($ddccontent['recommendations']['ddc']['mostPopular'][0]['@attributes']['nsfa'])) {
                $ddc = $ddccontent['recommendations']['ddc']['mostPopular'][0]['@attributes']['nsfa'];
            } elseif (isset($ddccontent['recommendations']['ddc']['mostPopular']['@attributes']['nsfa'])) {
                $ddc = $ddccontent['recommendations']['ddc']['mostPopular']['@attributes']['nsfa'];
            } else {
                $ddc = "FIC";
            }
        }
        return $ddc;
    }
}
