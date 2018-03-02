<?php
/**
 * Created by PhpStorm.
 * User: Stibo
 * Date: 1/03/2018
 * Time: 4:02 PM
 */

namespace AppBundle\Service;


class ApiService
{
    public function getListMangasTitle($search) {
        $data = array("Title" => $search);
        $data_string = json_encode($data);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)));
        curl_setopt($curl, CURLOPT_URL, "https://mcd.iosphe.re/api/v1/search/");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
        $result = curl_exec($curl);
        $list = json_decode($result);

        return $list;
    }

    public function getMangasFromTitle($id){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_URL, "https://mcd.iosphe.re/api/v1/series/".$id."/");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
        $result = curl_exec($curl);
        $list = json_decode($result);
        dump($list);
        $covers = array();
        $coverLists = $list->Covers;
        foreach($coverLists->a as $coverList){
            if($coverList->Side == "front"){
                array_push($covers, $coverList);
            }
        }
        $dataList = array(
            "Muid" => $list->MUid,
            "Title" => $list->Title,
            "CountMangas" => $list->Volumes,
            "Authors" => $list->Authors,
            "Year" => $list->ReleaseYear,
            "Covers" => $covers
        );

        return $dataList;
    }
}