<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = array(
            "last_updated" => "2024-05-22 07:18:17",
            "download_speed" => "291.35 MB",
            "upload_speed" => "104.16 MB",
            "ping_latency" => "9.98 s",
            "dns_server" => "192.168.1.197",
            "timestamp" => "2024-05-21T19:17:55.196809Z",
            "asn_info" => null,
            "client_ip" => "47.72.253.252",
            "client_isp" => "Vodafone New Zealand",
            "country" => "NZ",
            "cpu_info" => array(
                "num_cpus" => 4,
                "cpu_freq" => array(
                    "current" => "1800.0 GHz",
                    "min" => "600.0 MHz",
                    "max" => "1800.0 MHz"
                ),
                "cpu_percent" => 14.6
            ),
            "memory_info" => array(
                "memory_percent" => 7.9,
                "disk_percent" => 30.5
            ),
            "network_info" => array(
                "lo" => array(
                    "data_sent" => "7.24 KB",
                    "data_received" => "7.24 KB"
                ),
                "eth0" => array(
                    "data_sent" => "1.56 TB",
                    "data_received" => "4.00 TB"
                ),
                "wlan0" => array(
                    "data_sent" => "3.57 MB",
                    "data_received" => "136.10 MB"
                )
            ),
            "mac" => "e4:5f:01:c4:2b:55"
        );
        return view('home', compact('data'));
    }
}
