<?php

namespace App\Http\Controllers\Workspace;

use App\DataTables\VisitorsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Visitor\{
    IndexRequest as IndexVisitorRequest
};

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexVisitorRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexVisitorRequest $request)
    {
        return (new VisitorsDataTable())
            ->render('workspace::visitors.index');
    }
}
