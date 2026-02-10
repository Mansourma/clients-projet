<?php
namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Total number of clients
        $totalClients = Client::count();
        $totalServices = Service::count();
        $totalEnterpriseClients = Client::where('client_type', 'society')->count();
        // Total number of subscribed clients
        $totalSubscribedClients = Service::where('is_subscription', 1)
            ->count();

        // Total number of non-subscribed clients
        $totalNonSubscribedClients = Service::where('is_subscription', 0)
            ->count();

        // Total number of clients (type "client")
        $totalClientType = Client::where('client_type', 'client')
            ->count();

        // Total number of clients (type "entreprise")
        $totalEnterpriseType = Client::where('client_type', 'society')
            ->count();
        $services = Service::latest()->take(10)->get();
        // Pass variables to the view
        return view('home.home', compact(
            'totalClients',
            'totalSubscribedClients',
            'totalNonSubscribedClients',
            'totalClientType',
            'totalEnterpriseType',
            'services',
            'totalServices',
            'totalEnterpriseClients'
        ));
    }
}
