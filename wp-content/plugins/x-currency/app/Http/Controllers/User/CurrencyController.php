<?php

namespace XCurrency\App\Http\Controllers\User;

use XCurrency\App\Http\Controllers\Controller;
use XCurrency\App\Repositories\CurrencyRepository;
use XCurrency\WpMVC\Routing\Response;

class CurrencyController extends Controller
{
    public CurrencyRepository $currency_repository;

    public function __construct( CurrencyRepository $currency_repository ) {
        $this->currency_repository = $currency_repository;
    }

    public function index() {
        return Response::send(
            [
                'currencies' => $this->currency_repository->get_geo()
            ]
        );
    }
}
