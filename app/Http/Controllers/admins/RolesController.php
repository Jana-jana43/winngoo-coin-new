<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Role;

use Illuminate\Http\Request;

class RolesController extends Controller
{
    //
    public function index()
    {

        $roles = Role::with(['permissions' => function ($query) {
            $query->select('permissions.id', 'module', 'permission_name');
        }])->latest()->get();

        $total_roles_count = Role::count();
        $active_roles_count = Role::where('status', 'active')->count();
        $inactive_roles_count = Role::where('status', 'inactive')->count();

        return view('admin.roleManagement.rolemanagement', compact(
            'roles',
            'total_roles_count',
            'active_roles_count',
            'inactive_roles_count'
        ));
    }


    public function store(Request $request)
    {
        // 1. Validation
        $validated = $request->validate([
            'role_name'   => 'required|string|max:255|unique:roles,rolename',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
            'status'      => 'nullable|in:active,inactive',
        ]);

        // 2. Normalize status (string "active" or "inactive")
        $status = $request->input('status');
        $status = ($status === null || $status === '1' || $status === 'on' || $status === 'active')
            ? 'active'
            : 'inactive';

        // 3. Create role
        $role = Role::create([
            'rolename' => ucfirst($request->role_name),
            'status'   => $status,
        ]);

        // 4. Handle permissions and set 'is_checked' = 1 for selected
        $checkedPermissionIds = $request->input('permissions', []);

        $syncData = [];
        foreach ($checkedPermissionIds as $permissionId) {
            $syncData[$permissionId] = ['is_checked' => 1];
        }

        // Sync pivot table
        $role->permissions()->sync($syncData);

        return redirect()->back()->with('success', 'Role created successfully.');
    }

    public function toggleStatus(Request $request)
    {
        $role = Role::findOrFail($request->id);

        // If checkbox checked → active, else inactive
        $role->status = $request->has('status') ? 'active' : 'inactive';

        $role->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    public function update(Request $request, $id)
    {
        // 1. Find role
        $role = Role::findOrFail($id);

        // 2. Validation
        $validated = $request->validate([
            'role_name'   => 'required|string|max:255|unique:roles,rolename,' . $id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
            'status'      => 'nullable|in:active,inactive',
        ]);

        // 3. Normalize status
        $status = $request->input('status');
        $status = ($status === null || $status === '1' || $status === 'on' || $status === 'active')
            ? 'active'
            : 'inactive';

        // 4. Update role
        $role->update([
            'rolename' => ucfirst($request->role_name),
            'status'   => $status,
        ]);

        // 5. Handle permissions
        $checkedPermissionIds = $request->input('permissions', []);

        $syncData = [];

        foreach ($checkedPermissionIds as $permissionId) {
            $syncData[$permissionId] = ['is_checked' => 1];
        }

        // 🔥 IMPORTANT:
        // This will remove unchecked permissions automatically
        $role->permissions()->sync($syncData);

        return redirect()->back()->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {

        $role = Role::findOrFail($id);
      


        // Optional: detach permissions first to avoid pivot constraint errors
        $role->permissions()->detach();
        $role->delete();


        return redirect()->back()->with('success', 'Role deleted successfully.');
    }
}
