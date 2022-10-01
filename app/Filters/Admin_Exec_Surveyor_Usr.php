<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Admin_Exec_Surveyor_Usr implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! ((session()->get("role") == 1) || (session()->get("role") == 2) || (session()->get("role") == 3) || (session()->get("role") == 4)))
        {
            return redirect()->to(base_url()."/dashboard");
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
