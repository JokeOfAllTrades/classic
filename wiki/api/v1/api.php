<?php

// Required functions for displaying wiki markup
require "../../functions.php";
require "../../fishformat.php";

class API
{
    // The model must be passed when the API is constructed
    function __construct($model)
    {
        $this->model = $model;
    }

    // Function to process requests
    public function request($url)
    {
        $url = parse_url($url);

        // Remove leading and trailing slashes, then explode the path into an array
        $path = explode('/', trim($url['path'], '/'));

        // Ignore the first two segments (/api/v1)
        $path = array_slice($path, 2);
        $method = array_shift($path);

        if(method_exists($this, $method))
        {
            return call_user_func(array($this, $method), $path);
        }
        else
        {
            $response = array
            (
                'status' => 'error',
                'message' => 'Invalid method.'
            );
            
            return json_encode($response);
        }
    }

    // Function to display a page's content
    public function content($path)
    {
        $path = implode('/', $path);
        $result = $this->model->page->get(array('path' => $path));
        $page = $result->fetch_object();

        return FishFormat($page->Content);
    }

    // Function to display a page's source
    public function source($path)
    {
        $path = implode('/', $path);
        $result = $this->model->page->get(array('path' => $path));
        $page = $result->fetch_object();

        return $page->Content;
    }
}

?>
