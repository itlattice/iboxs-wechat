<?php
namespace iboxs\wechat\lib\traitlib;
trait Http
{
    public function Post($url, $post_data) {
        $postdata = http_build_query($post_data);
        $options = array(
          'http' => array(
            'method' => 'POST',
            'header' => 'Content-type:application/x-www-form-urlencoded',
            'content' => $postdata,
            'timeout' => 15 * 60 // 超时时间（单位:s）
          )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return json_decode($result,true);
    }

    public function PostJson($url = '',Array $data = array()){
        $data_string = json_encode($data,JSON_UNESCAPED_UNICODE);
        // $data_string = $data;
        $curl_con = curl_init();
        curl_setopt($curl_con, CURLOPT_URL,$url);
        curl_setopt($curl_con, CURLOPT_HEADER, false);
        curl_setopt($curl_con, CURLOPT_POST, true);
        curl_setopt($curl_con, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl_con, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($curl_con, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );
        curl_setopt($curl_con, CURLOPT_POSTFIELDS, $data_string);
        $res = curl_exec($curl_con);
        $status = curl_getinfo($curl_con);
        curl_close($curl_con);

        if (isset($status['http_code']) && $status['http_code'] == 200) {
            return $res;
        } else {
            return FALSE;
        }
    }

    public function Get($url,$data=[]){
        if(count($data)>0){
            $data=http_build_query($data);
            $url.="?".$data;
        }
        $result=file_get_contents($url);
        return json_decode($result,true);
    }
}