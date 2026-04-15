<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $audits = Audit::with(['user', 'auditable'])
            ->latest()
            ->paginate(20);

        return view('backend.audits.index', compact('audits'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $audit = Audit::with(['user', 'auditable'])->findOrFail($id);

        return view('backend.audits.show', compact('audit'));
    }
}
