<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TableController extends Controller
{
    // Show all tables
    public function index()
    {
        $tables = Table::latest()->get();
        return view('admin.tables.index', compact('tables'));
    }
    // Show single table details
    public function show(Table $table)
    {
        return view('admin.tables.show', compact('table'));
    }

    // Show create form
    public function create()
    {
        return view('admin.tables.create');
    }

    // Store new table
    public function store(Request $request)
    {
        $request->validate([
            'table_number' => 'required|unique:tables,table_number',
            'seats' => 'required|integer|min:1',
            'status' => 'in:available,occupied', // Optional, default is 'available'
        ]);
        $request->merge(['qr_token' => Str::uuid()]);
        Table::create($request->only('table_number', 'seats', 'qr_token'));

        return redirect()->route('admin.tables.index')->with('success', 'Table created successfully.');
    }

    // Show edit form
    public function edit(Table $table)
    {
        return view('admin.tables.edit', compact('table'));
    }

    // Update table
    public function update(Request $request, Table $table)
    {
        $request->validate([
            'table_number' => 'required|unique:tables,table_number,' . $table->id,
            'seats' => 'required|integer|min:1',
            'status' => 'in:available,occupied', // Optional, default is 'available'
        ]);

        $table->update($request->only('table_number', 'seats'));

        return redirect()->route('admin.tables.index')->with('success', 'Table updated successfully.');
    }

    // Delete table
    public function destroy(Table $table)
    {
        $table->delete();

        return redirect()->route('admin.tables.index')->with('success', 'Table deleted successfully.');
    }
}
