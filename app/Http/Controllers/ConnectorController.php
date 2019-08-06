<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
// use App\Http\Requests;
// use Validator;

class ConnectorController extends Controller
{



    public function deals()
    {
      $client = new Client();
//https://crm.zoho.com/crm/private/json/Info/getModules?authtoken=Auth Token&scope=crmapi
        $response = $client->request('GET', 'https://crm.zoho.com/crm/private/json/Leads/getRecords', [

           'query' => ['authtoken' => '2dc7ae3433c29c944ee958f630f785b9',
                       'scope' => 'crmapi'
            ]

        ]);
       return $response->getBody();
    }

    public function createDeal()
    {

      $xmlData=<<<XML
      <Deals>
        <row no="1">
          <FL val="Deal Name">First Potential</FL>
          <FL val="Account Name">Account Name</FL>
          <FL val="Closing Date">03.08.2019</FL>
          <FL val="Stage">10:Оценка пригодности</FL>
        </row>
      </Deals>
XML;


      $client = new Client();

      $response = $client->request('POST', 'https://crm.zoho.com/crm/private/xml/Deals/insertRecords', [
          'query' => ['authtoken' => '2dc7ae3433c29c944ee958f630f785b9',
                       'scope' => 'crmapi',
                       'xmlData' => $xmlData
          ],
          'headers' => [ 'Content-Type' => 'application/xml; charset=UTF8']
        ]);

       return $response->getBody();
      // return $xmlData;
    }


    public function createTask()
    {
          $xmlData=<<<XML
          <Tasks>
            <row no="1">
              <FL val="SMOWNERID">4121646000000224013</FL>
              <FL val="Task Owner">vusatiukt vusatiukt</FL>
              <FL val="Subject">Some Task 555</FL>
              <FL val="Due Date">09/09/2019</FL>
              <FL val="SEID">4121646000000254017</FL>
              <FL val="SEMODULE">Potentials</FL>
              <FL val="Status">In Progress</FL>
              <FL val="Priority">Highest</FL>
              <FL val="Send Notification Email">false</FL>
              <FL val="Description">Some description</FL>
            </row>
          </Tasks>
XML;

          $client = new Client();
          $response = $client->request('POST', 'https://crm.zoho.com/crm/private/xml/Tasks/insertRecords', [
              'query' => ['authtoken' => '2dc7ae3433c29c944ee958f630f785b9',
                           'scope' => 'crmapi',
                           'xmlData' => $xmlData
              ],
              'headers' => [ 'Content-Type' => 'application/xml; charset=UTF8']
            ]);

          return $response->getBody();
          //  return $xmlData;
     }

}
