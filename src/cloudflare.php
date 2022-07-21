<?php

namespace Cloudflare;

class api {

     public $base_url = 'https://api.cloudflare.com/client/v4/';
     public $api_key = 'kzis4udkWX4WtWtMd--b58Z5vr7HaeDJwMAzurYc';
     public $email = 'alexandermitru07@gmail.com';
     public $account_id = 'c719ea39b7f3af5cd26a95a58b2d4ac2';

     public function request($method, $uri, $data = []) {
          $url = $this->base_url . $uri;
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
          curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
          curl_setopt($ch, CURLOPT_HTTPHEADER, [
               'Content-Type: application/json',
               'X-Auth-Email: ' . $this->email,
               'X-Auth-Key: ' . $this->api_key,
          ]);
          $result = curl_exec($ch);
          curl_close($ch);
          return json_decode($result, true);
     }


     public function addDomain($domain) {
          $data = [
               'name' => $domain,
               'account' => [
                    'id' => $this->account_id,
               ],
          ];
          $result = $this->request('POST', 'zones', $data);
          return $result['result']['id'];
     }

     public function setRecords($domain, $wildcard = true, $id) {
          $data = [
               'type' => 'A',
               'name' => '@',
               'content' => '37.114.32.201',
               'ttl' => 1,
               'proxied' => true,
          ];
          if ($wildcard) {
               $data['name'] = '*';
               $data['content'] = $domain;
               $data['type'] = 'CNAME';
          }
          $this->request('POST', 'zones/' . $id . '/dns_records', $data);

     }

}
