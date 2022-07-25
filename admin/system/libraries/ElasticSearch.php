<?php
/**
 * Elasticsearch Library
 *
 * @package OpenLibs
 * 
 */
class CI_ElasticSearch
{
    public $index;

    /**
     * constructor setting the config variables for server ip and index.
     */

    public function __construct()
    {
        $ci = &get_instance();
        $ci -> config -> load("elasticsearch");
        $ci -> config -> item('index');
        $this -> server = $ci -> config -> item('es_server');
        $this -> index = $ci -> config -> item('index');
    }
    /**
     * Handling the call for every function with curl
     * 
     * @param type $path
     * @param type $method
     * @param type $data
     * 
     * @return type
     * @throws Exception
     */

    private function call($path, $method = 'GET', $data = null)
    {

        if (!$this -> index) {
            throw new Exception('$this->index needs a value');
        }

        $url = $this -> server . '/' . $this -> index . '/' . $path;
    //    $url1 = $this -> server . '/' . $path;
        $headers = array('Accept: application/json', 'Content-Type: application/json', );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        switch($method) { 
            case 'GET' :
                 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                 break;
            case 'POST' :
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                break;
            case 'PUT' :
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                break;
            case 'DELETE' :
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }

     $response = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        return json_decode($response, true);
    }


    /**
     * create a index with mapping or not
     * 
     * @param json $map
     */

    public function create($map = false)
    {
        if (!$map) {
            $this -> call(null, 'PUT');
        } else {
            $this -> call(null, 'PUT', $map);
        }
    }

    /**
     * get status
     * 
     * @return array
     */

    public function status()
    {
        return $this -> call('_status');
    }

    /**
     * count how many indexes it exists
     * 
     * @param string $type
     * 
     * @return array
     */

    public function count($type)
    {
        return $this -> call($type . '/_count?' . http_build_query(array(null => '{matchAll:{}}')));
    }

    /**
     * set the mapping for the index
     * 
     * @param string $type
     * @param json   $data
     * 
     * @return array
     */

    public function map($type, $data)
    {
        return $this -> call($type . '/_mapping', 'PUT', $data);
    }

    /**
     * set the mapping for the index
     * 
     * @param type $type
     * @param type $id
     * @param type $data
     * 
     * @return type
     */

    public function add($type, $id, $data)
    {
        return $this -> call($type . '/' . $id, 'PUT', $data);
    }

    /**
     * delete a index
     * 
     * @param type $type 
     * @param type $id 
     * 
     * @return type 
     */

    // by Smita

    public function delete_index($type)
    {
        //curl -XDELETE "http://localhost:9200/smita_test_folder";
        return $this -> delete_call($type,'DELETE');
    }

    public function delete($type, $id)
    {
        return $this -> call($type . '/' . $id, 'DELETE');
    }

    /**
     * make a simple search query
     * 
     * @param type $type
     * @param type $q
     * 
     * @return type
     */
  
    public function query($type, $q)
    {
        return $this -> call($type . '/_search?' . http_build_query(array('q' => $q)),'GET');
    }

    /**
     * make a advanced search query with json data to send
     * 
     * @param type $type
     * @param type $query
     * 
     * @return type
     */

    public function advancedquery($type, $query)
    {
        return $this -> call($type . '/_search', 'POST', $query);
    }

    /**
     * make a search query with result sized set
     * 
     * @param string  $type  what kind of type of index you want to search
     * @param string  $query the query as a string
     * @param integer $size  The size of the results
     * 
     * @return array
     */

    public function query_wresultSize($type, $query, $size = 999)
    {
        return $this -> call($type . '/_search?' . http_build_query(array('q' => $q, 'size' => $size)));
    }

    /**
     * get one index via the id
     * 
     * @param string  $type The index type
     * @param integer $id   the indentifier for a index
     * 
     * @return type
     */

    public function get($type, $id)
    {
        return $this -> call($type . '/' . $id, 'GET');
    }

    /**
     * Query the whole server
     * 
     * @param type $query
     * 
     * @return type
     */

    public function query_all($query)
    {
        return $this -> call('_search?' . http_build_query(array('q' => $query)),'GET');
    }

    /**
     * get similar indexes for one index specified by id - send data to add filters or more
     * 
     * @param string  $type
     * @param integer $id
     * @param string  $fields
     * @param string  $data 
     * 
     * @return array 
     */

    public function morelikethis($type, $id, $fields = false, $data = false)
    {
        if ($data != false && !$fields) {
            return $this -> call($type . '/' . $id . '/_mlt', 'GET', $data);
        } else if ($data != false && $fields != false) {
            return $this -> call($type . '/' . $id . '/_mlt?' . $fields, 'POST', $data);
        } else if (!$fields) {
            return $this -> call($type . '/' . $id . '/_mlt');
        } else {
            return $this -> call($type . '/' . $id . '/_mlt?' . $fields);
        }
    }

    /**
     * make a search query with result sized set
     * 
     * @param type $query
     * @param type $size
     * 
     * @return type
     */
    public function query_all_wresultSize($query, $size = 999)
    {
        return $this -> call('_search?' . http_build_query(array('q' => $query, 'size' => $size)));
    }

    /**
     * make a suggest query based on similar looking terms
     * 
     * @param type $query
     * 
     * @return array
     */
    public function suggest($query)
    {
        return $this -> call('_suggest', 'POST', $query);
    }

//by smita for searching in file content
    public function query_search($query)
    {
       /* GET /resumes/_search in kibana
        {
           "query": {
             "match": {
               "content": "Elich"
             }
           }
        }*/

       $query1 = '{"size":10000,"query":{"match":{"content":"'.$query.'"}}}';
         return $this -> call('_search','GET',$query1);

    }

    // function for php AND JAVA
    public function query_search_and($query2,$query3)
    {
       /* GET resumes/_search in kibana
        {
          "query":{
            "bool": {
            "must": [
                {"match": {
                  "content": "Eusterwiemann"
                }}
              ]
            }
          }
        }
        
        */
       // {"query":{"bool": {"must": [{"match": {"content": '.$query.'}}]}}}

       $query1 = '{"size":10000,"query":{"bool": {"must": [{"match": {"content": "'.$query2.'"}},{"match":{"content": "'.$query3.'"}}]}}}';//die();
         return $this -> call('_search','GET',$query1);

    }


    // function for php or JAVA
    public function query_search_or($query2,$query3)
    {
       /* GET resumes/_search in kibana
        {
          "query":{
            "bool": {
            "must": [
                {"match": {
                  "content": "Eusterwiemann"
                }}
              ]
            }
          }
        }
        */
       // {"query":{"bool": {"should": [{"match": {"content": '.$query.'}}]}}}

        $query1 = '{"size":10000,"query":{"bool": {"should": [{"match": {"content": "'.$query2.'"}},{"match":{"content": "'.$query3.'"}}]}}}';//die();
         return $this -> call('_search','GET',$query1);

    }

    // php not java
     // function for php not JAVA
    public function query_search_not($query1,$query2)
    {
       /* GET resumes/_search in kibana
        {
          "query":{
            "bool": {
            "must": [
                {"match": {
                  "content": "Eusterwiemann"
                }}
              ],
              "must_not": [
                {"match": {
                  "content": "aaron"
                }}
              ]
            }
          }
        }
        }
        */
       // {"query":{"bool": {"must": [{"match": {"content": '.$query.'}}]}}}}
      //  echo $query1."______".$query2;die();

        

        $search_query = '{"size":10000,"query":{"bool":{"must":[{"match": {"content": "'.$query1.'"}}],"must_not":[{"match":{"content":"'.$query2.'"}}]}}}';
        //die();
         return $this -> call('_search','GET',$search_query);

    }

// by smita to delete the resume index
    private function delete_call($path, $method = 'GET', $data = null)
    {

        if (!$this -> index) {
            throw new Exception('$this->index needs a value');
        }

        $url1 = $this -> server . '/' . $path;
        $headers = array('Accept: application/json', 'Content-Type: application/json', );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        switch($method) { 
            case 'GET' :
                 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                 break;
            case 'POST' :
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                break;
            case 'PUT' :
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                break;
            case 'DELETE' :
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }

        $response = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        return json_decode($response, true);
    }

    // new function to start fscrawler tool
    public function start_fscrawler()
    {

      shell_exec("C:/xampp/htdocs/Careerpath/admin/fscrawler-distribution-2.10-SNAPSHOT/bin/fscrawler resumes --loop 1 --restart 2>&1");

    }// start_fscrawler end

    // fetch fetch_file_content from file
     public function fetch_file_content($search_filename)
    {
        //echo $filename;die();
      
        /*GET /_search
        {
        "_source":"content",
        "query": {
        "match": {
        "file.filename": "Aaron_Becerra-Hurtado_3.pdf"
        }
        }
        }*/
        $query1 ='{"_source":"content","query":{"match":{"file.filename":"'.$search_filename.'"}}}';

    return $this -> call('_search','GET',$query1);

    }

}
