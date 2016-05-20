<?php

class ResponseAjax
{
    public function error($data = [], $status = 500)
    {
        set_status_header($status);
        
        $dataExtra = [
            'response' => 'error' ,
            'messageError' => $data['error']->getMessage(),
            'trace' => $data['error']->getTrace()
        ];


        return json_encode(array_merge($data, $dataExtra),JSON_NUMERIC_CHECK );
    }


    public function success($data = [], $status = 200)
    {
        set_status_header($status);
        $dataExtra = ['response' => 'success'];


        return json_encode(array_merge($data, $dataExtra),JSON_NUMERIC_CHECK );
    }

    public function validate($data = [], $status = 200)
    {
        set_status_header($status);
        $dataExtra = ['response' => 'validate'];


        return json_encode(array_merge($data, $dataExtra), JSON_NUMERIC_CHECK);
    }
}